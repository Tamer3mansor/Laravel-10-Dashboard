<form action="{{ route('admin.roles.update', $role->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name (slug)</label>
        <input type="text" name="name" id="name" value="{{ $role->name }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="display_name">Display Name</label>
        <input type="text" name="display_name" id="display_name" value="{{ $role->display_name }}" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ $role->description }}</textarea>
    </div>

    <div class="form-group">
        <label>Permissions</label>
        <div class="border p-3" style="max-height: 300px; overflow-y: auto;">
            @foreach($permissions as $permission)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}"
                        id="permission{{ $permission->id }}"
                        {{ in_array($permission->id, $rolePermissions) ? 'checked' : '' }}>
                    <label class="form-check-label" for="permission{{ $permission->id }}">
                        {{ $permission->display_name }}
                    </label>
                </div>
            @endforeach
        </div>
    </div>

    <div class="form-group text-right">
        <button type="submit" class="btn btn-primary">Update</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
    </div>
</form>
