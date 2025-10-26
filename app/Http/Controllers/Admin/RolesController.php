<?php
namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $roles = Role::with('permissions')->select('roles.*');
            return DataTables::of($roles)
                ->addColumn('permissions', function ($role) {
                    // ensure safe escaping in JS/Blade when rendering
                    return $role->permissions->pluck('display_name')->implode(', ');
                })
                ->addColumn('actions', function ($role) {
                    $editButton = editModalButton('admin.roles.edit', $role->id);
                    $deleteButton = deleteAjaxButton('admin.roles.destroy', $role->id);
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['actions']) // only actions contains HTML
                ->make(true);
        }

        return view('admin.roles.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        // return HTML partial for modal
        return view('admin.roles.create', compact('permissions'))->render();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255','unique:roles,name'],
            'display_name' => ['required','string','max:255'],
            'description' => ['nullable','string','max:500'],
            'permissions' => ['nullable','array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role = Role::create([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
        ]);

        if (!empty($validated['permissions'])) {
            // Try to use syncPermissions if available (works for Spatie)
            if (method_exists($role, 'syncPermissions')) {
                $role->syncPermissions($validated['permissions']);
            } elseif (method_exists($role, 'attachPermissions')) {
                $role->attachPermissions($validated['permissions']);
            } else {
                // fallback: try to attach via relation
                $role->permissions()->sync($validated['permissions']);
            }
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Role created successfully.', 'role' => $role], 201);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view('admin.roles.edit', compact('role', 'permissions', 'rolePermissions'))->render();
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:255', Rule::unique('roles','name')->ignore($role->id)],
            'display_name' => ['required','string','max:255'],
            'description' => ['nullable','string','max:500'],
            'permissions' => ['nullable','array'],
            'permissions.*' => ['exists:permissions,id'],
        ]);

        $role->update([
            'name' => $validated['name'],
            'display_name' => $validated['display_name'],
            'description' => $validated['description'] ?? null,
        ]);

        $perms = $validated['permissions'] ?? [];
        if (method_exists($role, 'syncPermissions')) {
            $role->syncPermissions($perms);
        } elseif (method_exists($role, 'attachPermissions')) {
            // detach existing then attach
            $role->detachPermissions($role->permissions->pluck('id')->toArray());
            $role->attachPermissions($perms);
        } else {
            $role->permissions()->sync($perms);
        }

        if ($request->ajax()) {
            return response()->json(['message' => 'Role updated successfully.']);
        }

        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Role deleted successfully.']);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully.');
    }
}
