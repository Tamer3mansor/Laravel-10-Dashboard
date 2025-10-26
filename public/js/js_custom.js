// Put this near top of app.js (runs once)
$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  // optional: set global error handler?
});

$(document).on('click', '.open-modal', function (e) {
  e.preventDefault();
  const url = $(this).data('url');
  const title = $(this).data('title') || 'Form';
  $('#ajaxModalLabel').text(title);
  $('#ajaxModalContent').html('<div class="text-center p-4"><i class="fas fa-spinner fa-spin fa-2x"></i></div>');
  $('#ajaxModal').modal('show');

  $.get(url)
    .done(function(response){
      // Expect HTML partial
      $('#ajaxModalContent').html(response);
    })
    .fail(function(xhr){
      let html = '<div class="alert alert-danger">Failed to load content.</div>';
      if (xhr.responseJSON && xhr.responseJSON.message) {
        html = '<div class="alert alert-danger">' + xhr.responseJSON.message + '</div>';
      }
      $('#ajaxModalContent').html(html);
    });
});

function showValidationErrors(form, errors) {
  // Remove old errors
  form.find('.is-invalid').removeClass('is-invalid');
  form.find('.invalid-feedback').remove();
  // Attach new errors
  Object.keys(errors).forEach(function(field) {
    const input = form.find('[name="'+ field +'"]');
    if (input.length) {
      input.addClass('is-invalid');
      // place after input or fallback to end of form
      input.closest('.form-group').append('<div class="invalid-feedback">' + errors[field][0] + '</div>');
    }
  });
}

$(document).on('submit', '#ajaxModal form', function(e) {
  e.preventDefault();
  const form = $(this);
  const url = form.attr('action');
  // Always send POST and let Laravel _method handle override for PUT/PATCH/DELETE
  const methodOverride = form.find('input[name="_method"]').val() || null;
  const data = form.serialize();

  // disable submit
  const submitBtn = form.find('[type="submit"]');
  submitBtn.prop('disabled', true);

  $.ajax({
    url: url,
    type: 'POST',
    data: data,
    success: function (response) {
      $('#ajaxModal').modal('hide');
      $('#roles-table').DataTable().ajax.reload(null, false);

      // If response includes message and success flag, show
      if (response && response.message) toastr.success(response.message);
      else toastr.success('Saved successfully');
      // reload datatable by id if exists
      if ($.fn.DataTable.isDataTable('#roles-table')) {
        $('#roles-table').DataTable().ajax.reload(null, false);
      }
    },
    error: function (xhr) {
      if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
        showValidationErrors(form, xhr.responseJSON.errors);
      } else if (xhr.responseText && xhr.getResponseHeader('Content-Type') && xhr.getResponseHeader('Content-Type').indexOf('text/html') !== -1) {
        // server returned HTML (e.g., full form), replace content
        $('#ajaxModalContent').html(xhr.responseText);
      } else {
        let msg = 'Something went wrong';
        if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
        toastr.error(msg);
      }
    },
    complete: function() {
      submitBtn.prop('disabled', false);
    }
  });
});

$(document).on('click', '.delete-record', function (e) {
  e.preventDefault();
  const url = $(this).data('url');
  const confirmMsg = $(this).data('confirm') || 'Are you sure you want to delete this record?';
  if (!confirm(confirmMsg)) return;

  $.ajax({
    url: url,
    type: 'POST', // use POST + method override to be consistent with Laravel's CSRF expectations
    data: { _method: 'DELETE' },
    success: function (response) {
      if (response && response.message) toastr.success(response.message);
      else toastr.success('Deleted successfully');
      if ($.fn.DataTable.isDataTable('#roles-table')) {
        $('#roles-table').DataTable().ajax.reload(null, false);
      }
    },
    error: function (xhr) {
      let msg = 'Failed to delete record.';
      if (xhr.responseJSON && xhr.responseJSON.message) msg = xhr.responseJSON.message;
      toastr.error(msg);
    }
  });
});

// Reload DataTable when modal is closed
$('#ajaxModal').on('hidden.bs.modal', function () {
  if ($.fn.DataTable.isDataTable('#roles-table')) {
    $('#roles-table').DataTable().ajax.reload(null, false);
  }
});
console.log('js_custom.js loaded ✅');

