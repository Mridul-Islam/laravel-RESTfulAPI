<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Http\Controllers\Controller;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;

class UserController extends ApiController
{

    public function index()
    {
        $users = User::all();
        return $this->showAll($users);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ];

        $this->validate($request, $rules);

        $data = $request->all();
        $data['password']           = bcrypt($request->password);
        $data['verified']           = User::UNVERIFIED_USER;
        $data['verification_token'] = User::generateVerificationCode();
        $data['admin']              = User::REGULAR_USER;

        $newUser = User::create($data);
        return $this->showOne($newUser, 201);

    }


    public function show(User $user)
    {
        //$user = User::findOrFail($id);
        return $this->showOne($user);
    }


    public function update(Request $request, User $user)
    {
        if($request->has('name')){
            $user->name = $request->name;
        }
        if($request->has('email') && $user->email != $request->email){
            $user->verified = User::UNVERIFIED_USER;
            $user->verification_token = User::generateVerificationCode();
            $user->email = $request->email;
        }
        if($request->has('password')){
            $user->password = bcrypt($request->password);
        }
        if($request->has('admin')){
            if(!$user->isVerified()){
                return $this->errorResponse('Only verified user can be a admin', 409);
            }
            $user->admin = $request->admin;
        }
        if(!$user->isDirty()){
            return $this->errorResponse('You need to specify a different value to update',  422);
        }

        $user->save();
        return $this->showOne($user);

    }


    public function destroy(User $user)
    {
        //$user = User::findOrFail($id);
        $user->delete();
        return $this->showOne($user);
    }
}
