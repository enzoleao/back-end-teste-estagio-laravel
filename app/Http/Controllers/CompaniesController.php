<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Sectors;
use Validator;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {   
        
        $response = Companies::with('sectors')->paginate(10);
        return response()-> json([
            'companies' => $response
        ], 200);
    }

    public function search($companyInitials)
    {
        $company = Companies::with('sectors')->where('name', 'like', $companyInitials . '%')->get();
        return response()-> json([
            'companies' => $company 
        ], 200);
    }

    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cnpj' => 'required|min:18',
            'sectorsId' => 'required',
        ]);
        if ($validator->fails()) {
            $erros = $validator->errors();
            return response()->json(['erro' => $erros->first()], 400);
        }

        $sec = $request->only('sectorsId');
        $sectorsId = $sec['sectorsId'];

        $companies = Companies::create($request->all());
        $companies->sectors()->attach($sectorsId);
        
        return response()-> json([
            'message'=> 'Empresa cadastrada com sucesso',
            'companies' => $companies
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $companies = Companies::findOrFail($id);
        $companies ->update($request->all());

        return $companies;
    }

    public function delete(Request $request, $id)
    {
        $companies = Companies::findOrFail($id);
        $companies->delete();

        return $companies;
    }
}
