<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class EmptyController extends Controller
{
    protected $main_route;
    protected $folder_path;
    public function __construct()
    {
        $main_route = "dumy route";
        $folder_path = "dumy path";

        // Constructor code if needed
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $obj = "dummydata";

            return DataTables::of($obj)

                ->addColumn('actions', function ($role) {
                    $editButton = editModalButton($this->main_route . '.edit', $role->id);
                    $deleteButton = deleteAjaxButton($this->main_route . '.destroy', $role->id);
                    return $editButton . ' ' . $deleteButton;
                })
                ->rawColumns(['actions']) // only actions contains HTML
                ->make(true);
        }

        return view($this->folder_path . '.index');
    }

    public function create()
    {
        $permissions = Permission::all();
        // return HTML partial for modal
        return view($this->folder_path . '.create', compact('permissions'))->render();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:roles,name'],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['nullable', 'array'],
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

        return redirect()->route($this->main_route . '.index')->with('success', 'Role created successfully.');
    }

    public function edit(Role $role)
    {
        $permissions = Permission::all();
        $rolePermissions = $role->permissions->pluck('id')->toArray();
        return view($this->folder_path . '.edit', compact('role', 'permissions', 'rolePermissions'))->render();
    }

    public function update(Request $request, Role $role)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', Rule::unique('roles', 'name')->ignore($role->id)],
            'display_name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:500'],
            'permissions' => ['nullable', 'array'],
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

        return redirect()->route($this->main_route . '.index')->with('success', 'Role updated successfully.');
    }

    public function destroy(Request $request, Role $role)
    {
        $role->delete();

        if ($request->ajax()) {
            return response()->json(['message' => 'Role deleted successfully.']);
        }
        return redirect()->route($this->main_route . '.index')->with('success', 'Role deleted successfully.');
    }
}
