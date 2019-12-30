<?php

namespace App\Http\Controllers;

use App\User;
use App\Role;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::eloquentQuery(
            $request->input('column'),
            $request->input('dir'),
            $request->input('search'),
            [
                "role",
            ]
        );

        // dd($query->toSql());

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
        $orderBydir = $request->input("dir");
        $length = $request->input('length');

        $data = \DB::table('users')
            ->join('roles', 'roles.id', '=', 'users.role_id')
            ->join('departments', 'departments.id', '=', 'roles.department_id')
            ->select(
                'roles.name as role_name',
                'users.id',
                'users.cost',
                'users.name as user_name',
                'users.email',
                'departments.name as department_name'
            )
            ->where("users.name", "LIKE", "%$searchValue%")
            ->orWhere('users.email', "LIKE", "%$searchValue%")
            ->orWhere('roles.name', "LIKE", "%$searchValue%")
            ->orWhere('departments.name', "LIKE", "%$searchValue%")
            ->orderBy($orderBy, $orderBydir)
            ->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function search(Request $request)
    {
        $searchValue = $request->input('search');
        return User::where("name", "like", "%$searchValue%")->get();
    }
}
