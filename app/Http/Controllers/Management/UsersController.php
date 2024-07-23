<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\Permissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Custom\NikkenFunctions;
use App\Models\Countries;
use App\Models\SAPLicenses;
use App\Models\Users;

class UsersController extends Controller
{
    public $nikkenFunctions;

    public function __construct()
    {
        $this->nikkenFunctions = new NikkenFunctions();
    }
    /**
     * Sección de vistas
     */
    //Vista del index
    public function viewIndex(Request $request) {
        try {
            $objectUsers = $this->listAll($request);
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('management.users.table', [
                        'findFilters' => $request,
                        'usersTable' => $objectUsers->users,
                        'usersTableDefinition' => $this->UsersTableDefinition(),
                    ])->render()
                ]);
            } else {
                return view('management.users.index', [
                    'findFilters' => $request,
                    'usersTable' => $objectUsers->users,
                    'usersTableDefinition' => $this->UsersTableDefinition(),
                ]);
            }
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => $th->getMessage()], 500); // Status code here
            } else {
                return view('layouts.errors.500', ['message' => $th->getMessage()]);
            }
        }
    }

    /**
     * Funciones del controlador
     */

    //Función que extrae la información de los usuarios
    public function listAll(Request $request) {
        $query = Users::select([
            'users.id_users',
            'users.user',
            'users.pass',
            'users.password',
            'users.nombre',
            'users.pais',
            'users.area',
            'users.puesto',
            'users.correo',
            'users.dia_cumple',
            DB::raw('(CASE
                WHEN users.mes_cumple = "01" THEN "ENERO"
                WHEN users.mes_cumple = "02" THEN "FEBRERO"
                WHEN users.mes_cumple = "03" THEN "MARZO"
                WHEN users.mes_cumple = "04" THEN "ABRIL"
                WHEN users.mes_cumple = "05" THEN "MAYO"
                WHEN users.mes_cumple = "06" THEN "JUNIO"
                WHEN users.mes_cumple = "07" THEN "JULIO"
                WHEN users.mes_cumple = "08" THEN "AGOSTO"
                WHEN users.mes_cumple = "09" THEN "SEPTIEMBRE"
                WHEN users.mes_cumple = "10" THEN "OCTUBRE"
                WHEN users.mes_cumple = "11" THEN "NOVIEMBRE"
                WHEN users.mes_cumple = "12" THEN "DICIEMBRE"
                ELSE ""
            END) AS mes_cumple'),
            'users.telefono',
            DB::raw('CASE
                WHEN licenciasSAP = "manager" THEN "Administrador"
                WHEN licenciasSAP = "reader" THEN "Solo lectura"
                WHEN licenciasSAP = "noLogin" THEN "Inhabilitado"
                END AS licenciasSAP')])
        ->where('activo', '=', 'Si')
        ->join('permisos', 'permisos.id_permisos', '=', 'users.id_users')
        ->orderby('pais', 'desc');

        if (($request->has('generalFind')) && ($request->generalFind !== null)) {
            $query->where('user', 'like', '%' . $request->generalFind . '%')
                ->orWhere('nombre', 'like', '%' . $request->generalFind . '%')
                ->orWhere('pais', 'like', '%' . $request->generalFind . '%')
                ->orWhere('area', 'like', '%' . $request->generalFind . '%')
                ->orWhere('puesto', 'like', '%' . $request->generalFind . '%');
        } else {
            if ($request->has('typeLicenseId')) {
                $query->where('TypeOfLicense.typeLicenseId', '=', $request->typeLicenseId);
            }
            if ($request->has('user')) {
                $query->where('user', 'like', '%' . $request->user . '%');
            }
            if ($request->has('nombre')) {
                $query->where('nombre', 'like', '%' . $request->nombre . '%');
            }
            if ($request->has('pais')) {
                $query->where('pais', '=', $request->pais);
            }
            if ($request->has('area')) {
                $query->where('area', '=', $request->area);
            }
            if ($request->has('puesto')) {
                $query->where('puesto', '=', $request->puesto);
            }
            if ($request->has('activo')) {
                $query->where('licenciasSAP', '=', $request->activo);
            }
        }
        $users = $query->paginate(isset($request->paginate) ? $request->paginate : 25); //Agregamos el paginador
        //$requestLicenses = $query->get(); //Agregamos el paginador

        //Encriptamos los Ids
        if ($users) {
            foreach ($users as $userKey => $userValue) {
                $users[$userKey]->userId = base64_encode($this->nikkenFunctions->aes_sap_encrypt($userValue->id_users));
            }
        }
        $objectUsers = new \stdClass();
        $objectUsers->users = $users;

        return $objectUsers;
    }

    public function updateStatus(Request $request) {
        try {
            $this->nikkenFunctions = new NikkenFunctions;

            DB::connection('mysql_intralat')->update('UPDATE permisos SET licenciasSAP = ? WHERE id_permisos = ?', [($request->userActivo !== 'noLogin' ? $request->userActivo : 'noLogin'), $this->nikkenFunctions->aes_sap_decrypt(base64_decode($request->id_users))]);
            $objectUsers = $this->listAll($request);
            return response()->json([
                'success' => true,
                'html' => view('management.users.table', [
                    'findFilters' => $request,
                    'usersTable' => $objectUsers->users,
                    'usersTableDefinition' => $this->UsersTableDefinition(),
                ])->render()
            ]);
        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => $th->getMessage()], 500); // Status code here
            } else {
                return view('layouts.errors.500', ['message' => $th->getMessage()]);
            }
        }
    }

    //Obtener los paises
    public function getCountries() {
        $countries = Countries::select('countryId', 'countryName', 'countryMysql')
            ->where('isCountryActive', '=', 1)
            ->orderby('countryName', 'desc')
            ->get();

        if ($countries) {
            foreach ($countries as $key => $value) {
                $countries[$key]->id = base64_encode($this->nikkenFunctions->aes_sap_encrypt($value->countryId));
            }
        }
        return $countries;
    }

    public function getUsersbyOption() {
        $countryOptions = '<option value=""> Seleccione una opción </option>';

        foreach ($this->getCountries() as $keyCountry => $country) {
            if (old('countryId') != $country->id) {
                $countryOptions .= '<option value="'. $country->id .'" > '. $country->countryName .' </option>';
            } else {
                $countryOptions .= '<option value="'. $country->id .'" selected> '. $country->countryName .' </option>';
            }
        }

        return $countryOptions;
    }

    public function getUsersByCountry(Request $request) {
        $userOptions = '<option value=""> Seleccione una opción </option>';
        $users = Users::select('id_users as id', 'nombre', 'user')
            ->where('activo', '=', 'Si')
            ->where('pais','=', $request->countryId)
            ->where('puesto', 'like', '%Jefe%')
            ->orwhere('puesto', 'like', '%Gerencia%')
            ->orderby('user', 'asc')
            ->orderby('nombre', 'asc')
            ->get();
        if ($users) {
            foreach ($users as $keyUser => $user) {
                $userOptions .= '<option value="'. $user->id .'"> '. $user->user .'--'. $user->nombre .' </option>';
            }
        }
        return response()->json([
            'success' => true,
            'userOptions' => $userOptions,
        ]);
    }

    public function getUsers() {
        $userOptions = '<option value=""> Seleccione una opción </option>';
        $users = Users::select('id_users as id', 'nombre', 'user')
            ->where('activo', '=', 'Si')
            ->orderby('user', 'asc')
            ->orderby('nombre', 'asc')
            ->get();
        if ($users) {
            foreach ($users as $keyUser => $user) {
                if (old('requestUserId') != $user->id) {
                    $userOptions .= '<option value="'. $user->id .'"> '. $user->user .'--'. $user->nombre .' </option>';
                } else {
                    $userOptions .= '<option value="'. $user->id .'" selected> '. $user->user .'--'. $user->nombre .' </option>';
                }
            }
        }
        return $userOptions;
    }

    public function getCountryIdByIdUser($idUser) {
        $user = Users::select('id_users as id', 'pais')
            ->where('id_users', '=', $idUser)
            ->first();

        $countryId = Countries::select('countryId')
            ->where('countryMysql', '=', (isset($user->pais) ? $user->pais : 'MEX'))
            ->first();

        return isset($countryId->countryId) ? $countryId->countryId : 2;
    }

    public function findUser() {
        $userOptions = '<option value=""> Historial por usuario </option>';
        $users = Users::select('id_users as id', 'nombre', 'user', 'pais')
            ->orderby('user', 'asc')
            ->orderby('nombre', 'asc')
            ->get();

        if ($users) {
            foreach ($users as $keyUser => $user) {
                $userOptions .= '<option value="'. $user->id .'" country="'. $user->pais .'"> '. $user->user .'--'. $user->nombre .' </option>';
            }
        }
        return $userOptions;
    }

    private function UsersTableDefinition() {

        $UsersTableDefinition = array();

        $UsersTableDefinition[0] = new \stdClass;
        $UsersTableDefinition[0]->tittleColumn = 'Usuario';
        $UsersTableDefinition[0]->tittleHeader = 'user';
        $UsersTableDefinition[0]->typeData = 'text';
        $UsersTableDefinition[0]->canEdit = true;
        $UsersTableDefinition[0]->canFilter = true;

        $UsersTableDefinition[1] = new \stdClass;
        $UsersTableDefinition[1]->tittleColumn = 'nombre';
        $UsersTableDefinition[1]->tittleHeader = 'nombre';
        $UsersTableDefinition[1]->typeData = 'text';
        $UsersTableDefinition[1]->canEdit = true;
        $UsersTableDefinition[1]->canFilter = true;

        $UsersTableDefinition[2] = new \stdClass;
        $UsersTableDefinition[2]->tittleColumn = 'País';
        $UsersTableDefinition[2]->tittleHeader = 'pais';
        $UsersTableDefinition[2]->typeData = 'select';
        $UsersTableDefinition[2]->canEdit = true;
        $UsersTableDefinition[2]->canFilter = true;
        $UsersTableDefinition[2]->options = $this->getPaises();

        $UsersTableDefinition[3] = new \stdClass;
        $UsersTableDefinition[3]->tittleColumn = 'Área';
        $UsersTableDefinition[3]->tittleHeader = 'area';
        $UsersTableDefinition[3]->typeData = 'select';
        $UsersTableDefinition[3]->canEdit = true;
        $UsersTableDefinition[3]->canFilter = true;
        $UsersTableDefinition[3]->options = $this->getArea();

        $UsersTableDefinition[4] = new \stdClass;
        $UsersTableDefinition[4]->tittleColumn = 'Puesto';
        $UsersTableDefinition[4]->tittleHeader = 'puesto';
        $UsersTableDefinition[4]->typeData = 'select';
        $UsersTableDefinition[4]->canEdit = true;
        $UsersTableDefinition[4]->canFilter = true;
        $UsersTableDefinition[4]->options = $this->getPuesto();

        $UsersTableDefinition[5] = new \stdClass;
        $UsersTableDefinition[5]->tittleColumn = 'Cumpleaños';
        $UsersTableDefinition[5]->tittleHeader = 'cumpleaños';
        $UsersTableDefinition[5]->typeData = 'text';
        $UsersTableDefinition[5]->canEdit = false;
        $UsersTableDefinition[5]->canFilter = false;

        $UsersTableDefinition[6] = new \stdClass;
        $UsersTableDefinition[6]->tittleColumn = 'Teléfono';
        $UsersTableDefinition[6]->tittleHeader = 'telefono';
        $UsersTableDefinition[6]->typeData = 'text';
        $UsersTableDefinition[6]->canEdit = false;
        $UsersTableDefinition[6]->canFilter = false;

        $UsersTableDefinition[7] = new \stdClass;
        $UsersTableDefinition[7]->tittleColumn = 'Rol';
        $UsersTableDefinition[7]->tittleHeader = 'activo';
        $UsersTableDefinition[7]->typeData = 'select';
        $UsersTableDefinition[7]->canEdit = true;
        $UsersTableDefinition[7]->canFilter = true;
        $UsersTableDefinition[7]->options = $this->getStatus();

        return $UsersTableDefinition;
    }

    private function getPaises() {
        return Users::select(['pais',])
            ->whereNotIn('pais', [''])
            ->groupby('pais')
            ->orderBy('pais', 'desc')
            ->get();
    }

    private function getArea() {
        return Users::select(['area',])
            ->whereNotIn('area', [''])
            ->groupby('area')
            ->orderBy('area', 'desc')
            ->get();
    }

    private function getPuesto() {
        return Users::select(['puesto',])
            ->whereNotIn('puesto', [''])
            ->groupby('puesto')
            ->orderBy('puesto', 'desc')
            ->get();
    }

    private function getStatus() {
        return Permissions::select(['licenciasSAP',
            DB::raw('CASE
                WHEN licenciasSAP = "manager" THEN "Administrador"
                WHEN licenciasSAP = "reader" THEN "Solo lectura"
                WHEN licenciasSAP = "noLogin" THEN "Inhabilitado"
                END AS license')])
            ->whereNotIn('licenciasSAP', [''])
            ->groupby('licenciasSAP')
            ->orderBy('licenciasSAP', 'asc')
            ->get();
    }
}
