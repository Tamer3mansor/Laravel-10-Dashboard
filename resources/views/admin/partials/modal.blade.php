<!-- resources/views/admin/partials/modal.blade.php -->
<div class="modal fade" id="ajaxModal" tabindex="-1" role="dialog" aria-labelledby="ajaxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ajaxModalLabel">Loading...</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="ajaxModalContent" class="p-3 text-center text-muted">
          <i class="fas fa-spinner fa-spin fa-2x"></i>
        </div>
      </div>
    </div>  
  </div>
</div>
