<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class AdminsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $admins = Admin::with('roles')->select('admins.*');
            
            return DataTables::of($admins)
                ->addColumn('role', function ($admin) {
                    return $admin->roles->pluck('display_name')->implode(', ');
                })
                ->addColumn('actions', function ($admin) {
                    return 
                        editModalButton('admin.admins.edit', $admin->id) .
                        deleteAjaxButton('admin.admins.destroy', $admin->id);
                        
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.admins.index');
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.admins.create', compact('roles'))->render();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        $admin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $admin->roles()->attach($request->role, ['user_type' => Admin::class]);
 return response()->json(['success' => true, 'message' => 'Admin created successfully.']);
     }

    public function edit(Admin $admin)
    {
        $roles = Role::all();
        $adminRole = $admin->roles->first();
        return view('admin.admins.edit', compact('admin', 'roles', 'adminRole'))->render();
    }

    public function update(Request $request, Admin $admin)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $admin->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|exists:roles,id'
        ]);

        $admin->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        if ($request->filled('password')) {
            $admin->update([
                'password' => Hash::make($request->password)
            ]);
        }

        $admin->roles()->sync([$request->role => ['user_type' => Admin::class]]);

        return redirect()->route('admin.admins.index')->with('success', 'Admin updated successfully.');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();
        return redirect()->route('admin.admins.index')->with('success', 'Admin deleted successfully.');
    }
}
