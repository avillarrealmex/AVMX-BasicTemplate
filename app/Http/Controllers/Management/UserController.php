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
    public function viewUserTable(Request $request) {
        try {
            $objectUsers = $this->listAll($request);

            if ($request->ajax()) {
                return response()->json([
                    'users' => $objectUsers->users,
                    'tittleColumns' => $objectUsers->tittleColumns,
                    'tittleHeaders' => $objectUsers->tittleHeaders,
                ]);
            } else {
                return view('management.users.table', [
                    'users' => $objectUsers->users,
                    'tittleColumn' => $objectUsers->tittleColumns,
                    'tittleHeaders' => $objectUsers->tittleHeaders,
                ]);
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                dd($th->getMessage());
            } else {
                return view('layouts.errors.500', ['message' => $th->getMessage()]);
            }
        }

    }

    public function viewUserFormCreate() {
        return view('management.users.create');
    }

    /**
     * Sección para funciones y procedimientos
     */

    public function create(Request $request) {
        $request->validate (
            [
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
                'email'=>'required|email'],
            [
                'name.required' => 'El nombre es requerido',
                'password.required' => 'La contraseña debe contar con almenos 6 dígitos',
                'password_confirm.required' => 'No concuerda la contraseña',
                'email.required' => 'El email es requerido',
            ]
        );

        try {
            //forma 1 objeto Simplificado
            User::create($this->UserObject($request));
            return view('management.users.create', [

            ]);
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
        $tittleColumns = array('Usuario','email','Creado el', 'status');
        $tittleHeaders = array('name', 'email', 'created_at', 'isActive');
        //DB::enableQueryLog(); //Se ocupa para debug de la consulta
        //Forma 1 Objeto simplificado
        $query = User::select('id', 'name', 'email', 'created_at')
            ->selectRaw("IIF(isActive = 1, 'Activo', 'Inactivo') AS isActive");
        if ($request->has('name')) {
            $query->where('name', 'like', '%'.$request->name.'%');
        }
        if ($request->has('email')) {
            $query->where('email', 'like', '%'.$request->email.'%');
        }
        if ($request->has('created_at')) {
            $query->where('created_at', '=', $request->created_at);
        }
        if ($request->has('isActive')) {
            $query->where('isActive', '=', $request->isActive);
        }
        $users = $query->get();

        //Forma 2 Sql nativo
        /* if ($request->has('find')) {

            $users = DB::connection('sqlsrv')->select("SELECT id, name, email, created_at FROM users WHERE name LIKE '%?%'", $request->find);
        } else {
            $users = DB::connection('sqlsrv')->select('SELECT id, name, email, created_at FROM users');
        } */

        //Forma 3 Eloquent
        /* $query = DB::connection('sqlsrv')
            ->table('users')
            ->select(['id', 'name', 'email', 'created_at']);
        if ($request->has('find')) {
            $query->where('name', 'like', '%'.$request->find.'%');
        }
        $users = $query->get(); */

        //Forma 4 Objeto
        /* $query = new User;
        $query->select(['id', 'name', 'email', 'created_at']);
        if ($request->has('find')) {
            $query->where('name', 'like', '%'.$request->find.'%');
        }
        $users = $query->get(); */

        //dd(DB::getQueryLog()); //Se ocupa para debug de la consulta

        $objectUsers = new \stdClass();
        $objectUsers->users = $users;
        $objectUsers->tittleColumns = $tittleColumns;
        $objectUsers->tittleHeaders = $tittleHeaders;

        return $objectUsers;
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
