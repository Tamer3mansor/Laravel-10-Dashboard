@extends('adminlte::page')

@section('title', __('إدارة الأدوار'))

@section('content_header')
    <h1>{{ __('إدارة الأدوار') }}</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4>Roles Management</h4>
<a href="{{ route('admin.roles.create') }}" 
   class="btn btn-success open-modal" 
   data-title="Create New Role"
   data-url="{{ route('admin.roles.create') }}">
   Create New Role
</a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <table id="roles-table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('admin.partials.modal')
@endsection

@push('js')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/datatables.min.js"></script>
<script>
    
$(document).ready(function() {
    // alert( window.location.href);
$('#roles-table').DataTable({
    processing: true,
    serverSide: true,
    route : '{{ route('admin.roles.index') }}',
        ajax: '{{ route('admin.roles.index') }}',

     columns: [
        { data: 'id', name: 'id' },
        { data: 'display_name', name: 'display_name' },
        { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
        { data: 'actions', name: 'actions', orderable: false, searchable: false }
    ]
});

});
</script>
    <script src="{{ asset('js/js_custom.js') }}"></script>

@endpush