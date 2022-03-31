<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return response()->json(['data'=>$users]);
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json(['data' => $user]);
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
