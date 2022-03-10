<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Sección de vistas
     */

    public function viewUserTable() {
        return view('management.users.table');
    }

    public function viewUserFormCreate() {
        return view('management.users.create');
    }

    /**
     * Sección para funciones y procedimientos
     */

    public function create(Request $request) {
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

        try {
            //forma 1 objeto Simplificado
            User::create($this->UserObject($request));
        } catch (\Throwable $th) {
            return view();
        }

        //Forma 2 Sql nativo
        /* DB::connection('sqlsrv')
            ->insert('INSERT INTO users VALUES (?, ?, ?)',[$request['name'],
                bcrypt($request['password']),
                $request['email']]); */

        //Forma 3 eloquent
        /* DB::connection('sqlsrv')
            ->table('users')
            ->insert([$this->UserObject($request)]); */


        //Forma 4 Objeto
        /* $user = new User;
        $user->name = $request['name'];
        $user->password = bcrypt($request['password']);
        $user->email = $request['email'];
        $user->save(); */

        return redirect()->route('users.table');
    }

    public function listAll(Request $request) {
        //Forma 1 Objeto simplificado
        $users = User::select(['name, email']);
        if ($request->has('find')) {
            $users->where('name', 'like', '%'.$request->find.'%');
        }
        $users->get();

            //Forma 2 Sql nativo
            /* $users = DB::connection('sqlsrv')
                ->select('SELECT * FROM users'); */

            //Forma 3 Eloquent
            /* $users = DB::connection('sqlsrv')
                ->table('users')
                ->select(['name, email'])
                ->get(); */

            //Forma 4 Objeto
            /* $users = new User;
            $users->select(['name, email']);
            $users->get(); */

        return $users;
    }

    public function listOne(Request $request) {

        //Forma 1 Objeto simplificado
        $user = User::select(['name, email'])
            ->where('id', $request->id)
            ->first();

        //Forma 2 Sql nativo
        /* $user = DB::connection('sqlsrv')
            ->select('SELECT name, email FROM users WHERE id = ?', [$request->id]); */

        //Forma 3 Eloquent
        /* $user = DB::connection('sqlsrv')
            ->table('users')
            ->select(['name, email'])
            ->where('id', $request->id)
            ->first(); */

        //Forma 4 Objeto
        /* $users = new User;
        $users->select(['name, email']);
        $users->where('id', $request->id);
        $users->first(); */

        return $user;
    }

    public function delete(Request $request) {
        $validator = Validator::make($request->all(),[
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return view();
        }

        //Forma 1 Objeto simplificado
        $userDeleted = User::where('id', '=', $request->id);

        //Forma 2 Sql nativo
        /* $userDeleted = DB::connection('sqlsrv')
            ->delete('DELETE FROM users WHERE id = ?', [$request->id]); */

        //Forma 3 Eloquent
        /* $userDeleted = DB::connection('sqlsrv')
            ->table('users')
            ->where('id', $request->id)
            ->delete(); */

        //Forma 4 Objeto
        /* $userDeleted = new User;
        $userDeleted->where('id', $request->id);
        $userDeleted->delete(); */

        return $userDeleted;
    }

    public function update(Request $request) {
        //Forma 1 Objeto simplificado
        $userUpdate = User::where('id', '=', $request->id)
            ->update($this->UserObject($request));

        //Forma 2 Sql nativo
        /* $userUpdate = DB::connection('sqlsrv')
            ->update('UPDATE users SET name = ?, email = ?, password = ? WHERE id = ?', [$request->name, $request->email, bcrypt($request->password), $request->id]); */

        //Forma 3 Eloquent
        /* $userUpdate = DB::connection('sqlsrv')
            ->table('users')
            ->where('id', '=', $request->id)
            ->update([$this->UserObject($request)]); */

        //Forma 4 Objeto
        /* $userUpdate = new User;
        $userUpdate->where('id', '=', $request->id);
        $userUpdate->update([$this->UserObject($request)]); */

        return $userUpdate;
    }

    /* Objeto Usuario */
    private function UserObject($request) {
        $user = new User;
        $user->name = $request['name'];
        $user->password = bcrypt($request['password']);
        $user->email = $request['email'];
        return $user;
    }
}


/* private function convertRequestToArrayPeopleReferences(Request $request, $people_id) {

    $arrayPeopleReference = [];
    if ($request->has('people_references') && !is_null($request->people_references)) {

        foreach ($request->people_references as $references) {
            $people = new PeopleReferencesBI();

            $people->people_id = $people_id;
            $people->name = $references['name'];
            $people->fatherLastname = $references['fatherLastname'];
            $people->motherLastname = $references['motherLastname'];
            $people->cellPhone = $references['cellPhone'];
            $people->addres = $references['addres'];

            array_push($arrayPeopleReference, $people);
        }

    }
    return $arrayPeopleReference;
}
 */
