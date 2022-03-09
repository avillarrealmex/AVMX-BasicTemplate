<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewUserTable() {
        return view('management.user');
    }

    public function viewCreateUser() {
        return view('management.users.create');
    }

    /**
     * Sección para funciones y procedimientos
     */

    public function create(Request $request){
        $request->validate ([
            'name' => 'required|string|regex:/^[a-zA-Z ]+$/',
            'password' => [
                'required',
                'string',
                'min:6',
                'regex:/[a-z]/',
                'regex:/[A-Z]/',
                'regex:/[0-9]/',
            ],
            'password_confirm' => 'required|same:password|min:6',
            'email'=>'required|email',
        ]);

        User::create($this->UserObject([
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
        ]));

        return redirect()->route('users.table');
    }

    public function listAll() {

    }

    public function listOne() {

    }

    public function delete() {

    }

    private function UserObject($request) {
        $user = [
            'name' => $request['name'],
            'password' => bcrypt($request['password']),
            'email' => $request['email'],
        ];
        return $user;
    }
}
