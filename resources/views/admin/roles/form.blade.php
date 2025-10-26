<div class="form-group">
    <label for="name">{{ __('الاسم المختصر (Name)') }}</label>
    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $role->name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="display_name">{{ __('الاسم المعروض') }}</label>
    <input type="text" name="display_name" id="display_name" class="form-control" value="{{ old('display_name', $role->display_name ?? '') }}" required>
</div>

<div class="form-group">
    <label for="description">{{ __('الوصف') }}</label>
    <textarea name="description" id="description" class="form-control">{{ old('description', $role->description ?? '') }}</textarea>
</div>

<hr>

<h3>{{ __('الصلاحيات') }}</h3>

<div class="row">
    @foreach($permissions as $permission)
        <div class="col-md-3">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="permissions[]" value="{{ $permission->id }}" 
                       id="perm-{{ $permission->id }}" 
                       @if(isset($rolePermissions) && in_array($permission->id, $rolePermissions)) checked @endif>
                <label class="form-check-label" for="perm-{{ $permission->id }}">
                    {{ $permission->display_name ?? $permission->name }}
                </label>
            </div>
        </div>
    @endforeach
</div>