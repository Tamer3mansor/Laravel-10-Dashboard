<form action="{{ route('admin.admins.update', $admin->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="name">Name <span class="text-danger">*</span></label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $admin->name) }}" required>
        @error('name')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="email">Email <span class="text-danger">*</span></label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $admin->email) }}" required>
        @error('email')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
        <small class="form-text text-muted">Leave blank to keep current password</small>
    </div>

    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
    </div>

    <div class="form-group">
        <label for="role">Role <span class="text-danger">*</span></label>
        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror" required>
            <option value="">Select Role</option>
            @foreach($roles as $role)
            <option value="{{ $role->id }}" {{ old('role', $adminRole ? $adminRole->id : '') == $role->id ? 'selected' : '' }}>
                {{ $role->display_name }}
            </option>
            @endforeach
        </select>
        @error('role')
        <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <button type="submit" class="btn btn-primary">Update Admin</button>
        <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">Cancel</a>
    </div>
</form>