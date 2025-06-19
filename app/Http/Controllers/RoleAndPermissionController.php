<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\Response;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionController extends Controller
{
    use Response;


    public function createRole(Request $request)
    {
        $request->validate(['name' => 'required|unique:roles,name']);

        $role = Role::create(['name' => $request->name]);

        return $this->successResponse($role, 'Role created successfully.');
    }

    public function updateRole(Request $request, $id)
    {
        $role = Role::findById($id);

        if (!$role) {
            return $this->errorResponse('Role not found', 404);
        }

        $request->validate(['name' => 'required|unique:roles,name,' . $id]);

        $role->name = $request->name;
        $role->save();

        return $this->successResponse($role, 'Role updated successfully.');
    }

    public function deleteRole($id)
    {
        $role = Role::findById($id);

        if (!$role) {
            return $this->errorResponse('Role not found', 404);
        }

        $role->delete();

        return $this->successResponse([], 'Role deleted successfully.');
    }

    public function listRoles()
    {
        $roles = Role::all();

        return $this->successResponse($roles, 'Roles retrieved successfully.');
    }

    // Permission/////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function createPermission(Request $request)
    {
        $request->validate(['name' => 'required|unique:permissions,name']);

        $permission = Permission::create(['name' => $request->name]);

        return $this->successResponse($permission, 'Permission created successfully.');
    }

    public function updatePermission(Request $request, $id)
    {
        $permission = Permission::findById($id);

        if (!$permission) {
            return $this->errorResponse('Permission not found', 404);
        }

        $request->validate(['name' => 'required|unique:permissions,name,' . $id]);

        $permission->name = $request->name;
        $permission->save();

        return $this->successResponse($permission, 'Permission updated successfully.');
    }

    public function deletePermission($id)
    {
        $permission = Permission::findById($id);

        if (!$permission) {
            return $this->errorResponse('Permission not found', 404);
        }

        $permission->delete();

        return $this->successResponse([], 'Permission deleted successfully.');
    }

    public function listPermissions()
    {
        $permissions = Permission::all();

        return $this->successResponse($permissions, 'Permissions retrieved successfully.');
    }




    
    public function assignRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->assignRole($request->role);

        return $this->successResponse(null, 'Role assigned successfully.');
    }
    public function revokeRole(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'required|exists:roles,name',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->removeRole($request->role);

        return $this->successResponse(null, 'Role revoked successfully.');
    }
    public function givePermissionToRole(Request $request)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permission' => 'required|exists:permissions,name',
        ]);

        $role = Role::findByName($request->role);
        $role->givePermissionTo($request->permission);

        return $this->successResponse(null, 'Permission assigned to role successfully.');
    }
    public function revokePermissionFromRole(Request $request)
    {
        $request->validate([
            'role' => 'required|exists:roles,name',
            'permission' => 'required|exists:permissions,name',
        ]);

        $role = Role::findByName($request->role);
        $role->revokePermissionTo($request->permission);

        return $this->successResponse(null, 'Permission revoked from role successfully.');
    }
    public function checkUserAccess(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'role' => 'nullable|string',
            'permission' => 'nullable|string',
        ]);

        $user = User::findOrFail($request->user_id);

        $hasRole = $request->role ? $user->hasRole($request->role) : null;
        $hasPermission = $request->permission ? $user->hasPermissionTo($request->permission) : null;

        return $this->successResponse([
            'has_role' => $hasRole,
            'has_permission' => $hasPermission
        ], 'Check completed.');
    }
}
