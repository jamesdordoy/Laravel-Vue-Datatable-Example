<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::eloquentQuery(
            $request->input('column'),
            $request->input('dir', 'asc'),
            $request->input('search'),
            [
                "role",
            ]
        );

        $isActive = $request->input('isActive');
        
        if (isset($isActive)) {
            $query->where("is_active", $isActive);
        }
        
        $data = $query->paginate($request->input('length'));

        return new DataTableCollectionResource($data);
    }

    public function queryBuilder(Request $request)
    {
        $searchValue = $request->input('search');
        $orderBy = $request->input('column');
        $orderBydir = $request->input("dir", "asc");
        $isActive = $request->input('isActive');
        $roleId = $request->input('roleId');

        $query = User::join('roles', 'roles.id', '=', 'users.role_id')
                ->join('departments', 'departments.id', '=', 'roles.department_id')
                ->select(
                'roles.name as role_name',
                'users.id',
                'users.cost',
                'users.is_active',
                'users.name as user_name',
                'users.email',
                'departments.name as department_name'
            )
            ->where(function ($query) use($searchValue) {
                $query->where("users.name", "LIKE", "%$searchValue%")
                    ->orWhere('users.email', "LIKE", "%$searchValue%")
                    ->orWhere('roles.name', "LIKE", "%$searchValue%")
                    ->orWhere('departments.name', "LIKE", "%$searchValue%");
            })
            ->orderBy($orderBy, $orderBydir);

        if (isset($isActive) && ! empty($isActive)) {
            $query = $query->where("users.is_active", $isActive);
        }

        if (isset($roleId) && ! empty($roleId)) {
            $query = $query->where("users.role_id", $roleId);
        }
          
        $data = $query->paginate($request->input('length'));

        return new DataTableCollectionResource($data);
    }

    public function search(Request $request)
    {
        $searchValue = $request->input('search');
        return User::where("name", "like", "%$searchValue%")->get();
    }
}
