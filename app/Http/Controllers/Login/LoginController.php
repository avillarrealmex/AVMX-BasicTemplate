<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Custom\NikkenFunctions;
use App\Models\Users;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public $nikkenFunctions;

    public function __construct()
    {
        $this->nikkenFunctions = new NikkenFunctions();
    }
    /**
     * Sección de vistas
     */
    public function viewLoginForm() {
        return view('login.formAuth');
    }

    public function viewDashboard() {
        return view('login.dashboard', []);
    }

    /**
     * Function para el logeo en la aplicación
     */
    public function checklogin(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'code' => 'required|min:6|max:100',
                'password' => 'required|min:6|max:20',
            ], [
                'code.required' => 'El código de usuario es requerido.',
                'code.min' => 'El código de usuario debe ser de al menos :min.',
                'code.max' => 'El código de usuario no debe ser mayor a :max.',
                'password.required' => 'La contrasela es requerida.',
                'password.min' => 'La contraseña debe ser de al menos :min.',
                'password.max' => 'La contraseña no debe ser mayor a :max.',
            ]);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                //Validamos temas del SetCokie para el remember me
                if ($request->code === null) {
                    setcookie('code', $request->code, 1);
                    setcookie('password', $request->password, 1);
                } else {
                    setcookie('code', $request->code, time() + 60 * 60 * 24 * 100);
                    setcookie('password', $request->password, time() + 60 * 60 * 24 * 100);
                }
                $user = Users::select(['id_users','user','pass', 'password','nombre','puesto', 'correo',
                        DB::raw("COALESCE(foto, 'Foto_default.jpg') AS foto")])
                    ->where('user', '=', $request->code)
                    ->where('activo', '=', 'Si')
                    ->with(['permissions'])
                    ->first();
                if (is_null($user)) {
                    return back()->withErrors(['msg' => "No existe el usuario",])->withInput();
                } else {
                    if((Hash::check($request->password,  Hash::make($user->pass))) && ($user->permissions->licenciasSAP !== 'noLogin')) {
                        Auth::login($user);
                        Session::put('id_users', $this->nikkenFunctions->aes_sap_encrypt($user->id_users));
                        Session::put('user',     $this->nikkenFunctions->aes_sap_encrypt($user->user));
                        Session::put('nombre', !is_null($user->nombre) ? $user->nombre : array());
                        Session::put('puesto', !is_null($user->puesto) ? $user->puesto : array());
                        Session::put('foto', !is_null($user->foto) ? $user->foto : array());
                        Session::put('correo', !is_null($user->correo) ? $user->correo : array());
                        Session::put('licenciasSAP', !is_null($user->permissions->licenciasSAP) ? $user->permissions->licenciasSAP : 'No');
                        Session::put('is_login', true);

                        return redirect()->route('login.dashboard')->with(['success' => 'Bienvenido ' . $user->userName]);
                    } else{
                        return back()->withErrors(['msg' => "Contraseña incorrecta o usuario inactivo."])->withInput();
                    }
                }
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => $th->getMessage()], 500); // Status code here
            } else {
                return back()->withErrors(['msg' => "Upss! ocurrio un error, por favor vuelvelo a intentar: " . $th->getMessage(),])->withInput();
            }
        }
    }

    public function autologin(Request $request) {
        try {
            $decrypt = base64_decode($request->keyToken);
            $explodeKey = explode('|',$decrypt);

            $code = $explodeKey[0];
            $password  = $explodeKey[1];

            //Validamos temas del SetCokie para el remember me
            if ($code === null) {
                setcookie('code', $code, 1);
                setcookie('password', $password, 1);
            } else {
                setcookie('code', $code, time() + 60 * 60 * 24 * 100);
                setcookie('password', $password, time() + 60 * 60 * 24 * 100);
            }
            $user = Users::select(['id_users','user','pass', 'password','nombre','puesto',
                    DB::raw("COALESCE(foto, 'Foto_default.jpg') AS foto")])
                ->where('user', '=', $code)
                ->where('activo', '=', 'Si')
                ->with(['permissions'])
                ->first();
            if (is_null($user)) {
                return back()->withErrors(['msg' => "No existe el usuario",])->withInput();
            } else {
                if((Hash::check($password,  Hash::make($user->pass))) && ($user->permissions->licenciasSAP !== 'noLogin')) {
                    Auth::login($user);
                    Session::put('id_users', $this->nikkenFunctions->aes_sap_encrypt($user->id_users));
                    Session::put('user',     $this->nikkenFunctions->aes_sap_encrypt($user->user));
                    Session::put('nombre', !is_null($user->nombre) ? $user->nombre : array());
                    Session::put('puesto', !is_null($user->puesto) ? $user->puesto : array());
                    Session::put('foto', !is_null($user->foto) ? $user->foto : array());
                    Session::put('correo', !is_null($user->correo) ? $user->correo : array());
                    Session::put('licenciasSAP', !is_null($user->permissions->licenciasSAP) ? $user->permissions->licenciasSAP : 'No');
                    Session::put('is_login', true);

                    return redirect()->route('login.dashboard')->with(['success' => 'Bienvenido ' . $user->userName]);
                } else{
                    return redirect('https://myNikken.com');
                }
            }
        } catch (\Throwable $th) {
            return redirect('https://myNikken.com');
        }
    }

    public function logout() {
        Auth::logout();
        Session::forget('id_users');
        Session::forget('user');
        Session::forget('nombre');
        Session::forget('puesto');
        Session::forget('foto');
        Session::forget('correo');
        Session::forget('is_login');
        return redirect()->route('user.login');
    }

    public function clearCache() {
        \Artisan::call('config:cache');
        \Artisan::call('config:clear');
        \Artisan::call('route:cache');
        \Artisan::call('route:clear');
        \Artisan::call('view:cache');
        \Artisan::call('view:clear');
        \Artisan::call('cache:clear');
        return response()->json([
            'transaction' => 'cleared!!',
            'phpInfo' => phpinfo(),
        ]);
    }
}
