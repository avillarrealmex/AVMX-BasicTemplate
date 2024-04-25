<?php

namespace App\Http\Controllers\Management;
use Illuminate\Http\Request;
use App\Models\Products;
use App\Http\Controllers\Management\ProviderController;
use App\Custom\NikkenFunctions;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    /**
     * Sección de vistas
     */
    public function viewIndex(Request $request) {
        try {
            $objectproducts = $this->listAll($request);
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'html' => view('catalogs.products.table', [
                        'findFilters' => $request,
                        'products' => $objectproducts->products,
                        'productsTableDefinition' => $objectproducts->productsTableDefinition
                    ])->render()
                ]);
            } else {
                return view('catalogs.products.index', [
                    'findFilters' => $request,
                    'products' => $objectproducts->products,
                    'productsTableDefinition' => $objectproducts->productsTableDefinition
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
     * Sección de funciones y procedimientos
     */
    public function listAll(Request $request) {
        $query = products::select('id', 'providerId', 'name');

        if ($request->has('providerId')) {
            $query->where('providerId', '=', $request->providerId);
        }
        if ($request->has('name')) {
            $query->where('name', 'LIKE', '%'.$request->name.'%');
        }

        $products = $query->paginate(10); //Agregamos el paginador

        //Encriptamos los Ids
        $NFuctions = new NikkenFunctions();
        if ($products) {
            foreach ($products as $key => $value) {
                $products[$key]->id = $NFuctions->aes_sap_encrypt($value->id);
            }
        }

        $objectproducts = new \stdClass();
        $objectproducts->products = $products;
        $objectproducts->productsTableDefinition = $this->GetObjectFromproductsTable();

        return $objectproducts;
    }

    static function listAllFromView() {
        $query = products::select('accountId AS id', 'accountNumber AS description')
            ->where('isAccountActive', '=', 1)
            ->orderby('accountNumber');
        $products = $query->get();

        return $products;
    }

    public function managementproducts (Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'countryId' => 'required',
                'accountNumber' => 'required',
                'acountName' => 'required',
                'U_TB_code' => 'required',
                'U_Codigo' => 'required',
            ],[
                'countryId' => 'El país es requerido',
                'accountNumber' => 'La cuenta contable es requerida',
                'acountName' => 'El nombre de la cuenta requerido',
                'U_TB_code' => 'El campo TB_Code es requerido',
                'U_Codigo' => 'El código es requerido',
            ]);

            if ($validator->fails()) {
                if ($request->ajax()) {
                    //generar JSON
                } else {
                    return redirect('catalog/products/index')->withErrors($validator);
                }
            } else {
                $msg = '';
                if ($request->accountId !== 'newRegister') {
                    $NFuctions = new NikkenFunctions();
                    products::where('accountId', '=', $NFuctions->aes_sap_decrypt($request->accountId))
                        ->update([
                            'countryId' => $request->countryId,
                            'accountNumber' => $request->accountNumber,
                            'acountName' => $request->acountName,
                            'U_TB_code' => $request->U_TB_code,
                            'U_Codigo' => $request->U_Codigo,
                            'isAccountActive' => isset($request->isAccountActive) ? $request->isAccountActive : 1,
                        ]);
                    $msg = 'Se ha actualizado el registro correctamente';
                } else {
                    products::create([
                        'countryId' => $request->countryId,
                        'accountNumber' => $request->accountNumber,
                        'acountName' => $request->acountName,
                        'U_TB_code' => $request->U_TB_code,
                        'U_Codigo' => $request->U_Codigo,
                        'isAccountActive' => isset($request->isAccountActive) ? $request->isAccountActive : 1,
                    ]);
                    $msg = 'Se ha creado el registro correctamente';
                }
                if ($request->ajax()) {
                    //generar JSON
                } else {
                    return redirect('catalog/products/index')->with('success', $msg);
                }
            }

        } catch (\Throwable $th) {
            if ($request->ajax()) {
                return response()->json(['error' => $th->getMessage()], 500); // Status code here
            } else {
                return view('layouts.errors.500', ['message' => $th->getMessage()]);
            }
        }
    }

    private function GetObjectFromproductsTable() {

        $productsTableDefinition = array();

        $productsTableDefinition[0] = new \stdClass;
        $productsTableDefinition[0]->tittleColumn = '';
        $productsTableDefinition[0]->tittleHeader = 'id';
        $productsTableDefinition[0]->typeData = 'hidden';
        $productsTableDefinition[0]->isRequired = false;
        $productsTableDefinition[0]->canEdit = true;
        $productsTableDefinition[0]->canFilter = false;

        $productsTableDefinition[1] = new \stdClass;
        $productsTableDefinition[1]->tittleColumn = 'Proveedor';
        $productsTableDefinition[1]->tittleHeader = 'providerId';
        $productsTableDefinition[1]->typeData = 'select';
        $productsTableDefinition[1]->isRequired = true;
        $productsTableDefinition[1]->canEdit = true;
        $productsTableDefinition[1]->canFilter = true;
        $products = new ProviderController;
        $productsTableDefinition[1]->options = $products->listAllFromView();

        $productsTableDefinition[2] = new \stdClass;
        $productsTableDefinition[2]->tittleColumn = 'Nombre';
        $productsTableDefinition[2]->tittleHeader = 'name';
        $productsTableDefinition[2]->typeData = 'text';
        $productsTableDefinition[2]->isRequired = true;
        $productsTableDefinition[2]->canEdit = true;
        $productsTableDefinition[2]->canFilter = true;

        $productsTableDefinition[3] = new \stdClass;
        $productsTableDefinition[3]->tittleColumn = 'Descripción';
        $productsTableDefinition[3]->tittleHeader = 'description';
        $productsTableDefinition[3]->typeData = 'text';
        $productsTableDefinition[3]->isRequired = false;
        $productsTableDefinition[3]->canEdit = false;
        $productsTableDefinition[3]->canFilter = false;

        $productsTableDefinition[4] = new \stdClass;
        $productsTableDefinition[4]->tittleColumn = 'Precio';
        $productsTableDefinition[4]->tittleHeader = 'price';
        $productsTableDefinition[4]->typeData = 'text';
        $productsTableDefinition[4]->isRequired = false;
        $productsTableDefinition[4]->canEdit = false;
        $productsTableDefinition[4]->canFilter = false;

        return $productsTableDefinition;
    }
}
