<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::eloquentQuery(
            $request->input('column'),
            $request->input('dir'),
            $request->input('search')
        );

        $isAdmin = $request->input('isAdmin');
        
        if (isset($isAdmin) && ! empty($isAdmin)) {
            $query->where("type", $isAdmin);
        }
        
        $data = $query->with("role")->paginate($request->input('length'));

        return new DataTableCollectionResource($data);
    }

    public function queryBuilder(Request $request)
    {
        $searchValue = $request->input('search');

        $query = User::queryBuilderQuery(
            $request->input('column'),
            $request->input('dir'),
            $searchValue
        );

        $query
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
            ->orWhere('roles.name', "LIKE", "%$searchValue%")
            ->orWhere('departments.name', "LIKE", "%$searchValue%");

        $isAdmin = $request->input('isAdmin');
        
        if (isset($isAdmin) && ! empty($isAdmin)) {
            $query->where("type", $isAdmin);
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
