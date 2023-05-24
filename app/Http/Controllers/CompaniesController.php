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
    public function searchBySec($sectorsInitials)
    {
        $company = Companies::with('sectors')->whereHas('sectors', function($q) use ($sectorsInitials) {
            $q -> where('name', 'like', $sectorsInitials . '%');
        })->get();
        return response()-> json([
            'companies' => $company 
        ], 200);
    }
    public function store(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'cnpj' => 'required|min:18',
            'sectors' => 'required',
        ]);
        $validator->setAttributeNames([
            'name' => 'Nome da Empresa',
            'cnpj' => 'CNPJ',
            'sectors' => 'Setores'
        ]);
        $validator->setCustomMessages([
            'name.required' => 'Por favor, preencha o campo :attribute.',
            'cnpj.required' => 'Por favor, preencha o campo :attribute.',
            'cnpj.min' => 'Por favor, insira um :attribute válido.',
            'sectors.required' => 'Por favor, selecione os :attribute.',
        ]);
        if ($validator->fails()) {
            $errors = $validator->errors();
            foreach ($errors->all() as $error) {
                return response()->json(['error' => $error,], 422);
            }
        }
        $companyExists = Companies::where('cnpj', $request['cnpj'])->exists();

        if ($companyExists) {
            return response()->json(['error' => 'Já existe uma empresa cadastrada com esse CNPJ.'], 400);
        }
        $sectorsId = [];
        foreach($request['sectors'] as $sectors) {
            $sectorsId[] = $sectors['id'];
        }
        $companies = Companies::create($request->all());
        $companies->sectors()->attach($sectorsId);
        
        return response()-> json([
            'message'=> 'Empresa cadastrada com sucesso',
            'company' => $companies
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
