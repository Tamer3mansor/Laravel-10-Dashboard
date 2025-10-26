<form action="{{ route('admin.roles.store') }}" method="POST">
 <meta name="csrf-token" content="{{ csrf_token() }}">
    <div class="form-group">
        <label for="name">Name (slug) <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name') }}" required>
        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="display_name">Display Name <span class="text-danger">*</span></label>
        <input type="text" name="display_name" id="display_name"
               class="form-control @error('display_name') is-invalid @enderror"
               value="{{ old('display_name') }}" required>
        @error('display_name') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description"
                  class="form-control @error('description') is-invalid @enderror"
                  rows="3">{{ old('description') }}</textarea>
        @error('description') <span class="invalid-feedback">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label>Permissions</label>
        <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input"
                           type="checkbox"
                           name="permissions[]"
                           value="{{ $permission->id }}"
                           id="permission{{ $permission->id }}">
                    <label class="form-check-label" for="permission{{ $permission->id }}">
                        {{ $permission->display_name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>
