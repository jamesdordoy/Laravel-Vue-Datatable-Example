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
        $dir = $request->input('dir', 'asc');
        $searchValue = $request->input('search');

        $data = User::dataTableQuery($column, $dir, $length, $searchValue);

        return new DataTableCollectionResource($data);
    }
}
