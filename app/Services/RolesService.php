<?php

namespace App\Services;

use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class RolesService
{
    public function insert($request){
        $role = Role::create([
            'name'          => $request->name,
            'display_name'  => $request->name,
            'description'   => $request->description
        ]);

        //add permissions to this role
        $role->attachPermissions($request->permissions);

        return $role;
    }

    public function update($role, $request){
        $role->name            = $request->name;
        $role->display_name    = $request->name;
        $role->description     = $request->description;
        $role->save();

        $role->syncPermissions($request->permissions); //update role permassion
    }
}