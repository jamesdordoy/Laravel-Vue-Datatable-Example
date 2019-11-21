<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use JamesDordoy\LaravelVueDatatable\Http\Resources\DataTableCollectionResource;

class UserController extends Controller
{
    public function index(Request $request)
    {   
        $length = $request->input('length');
        $column = $request->input('column');
        $dir = $request->input('dir');
        $searchValue = $request->input('search');

        $query = User::eloquentQuery($column, $dir, $searchValue);

        $isAdmin = $request->input('isAdmin');
        
        if (isset($isAdmin) && ! empty($isAdmin)) {
            $query->where("type", $isAdmin);
        }

        $query = $query->with("role");
        
        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    public function queryBuilder(Request $request)
    {
        $length = $request->input('length');
        $column = $request->input('column', 'id');
        $dir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');

        $query = User::queryBuilderQuery($column, $dir, $searchValue);

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
        
        $data = $query->paginate($length);

        return new DataTableCollectionResource($data);
    }

    /**
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request) {
        $searchValue = $request->input('search');

        $users = User::where("name", "like", "%" . $searchValue . "%")->get();
        
        return $users;
    }
}
