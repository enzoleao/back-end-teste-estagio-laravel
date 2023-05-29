<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Sectors;
use Validator;

class CompaniesController extends Controller
{
    public function index(Request $request)
    {   
        if (filter_var($request['order'], FILTER_VALIDATE_BOOLEAN) === true) {
            $response = Companies::with('sectors')->orderBy('name')->paginate(10);
            return response()-> json(['companies' => $response], 200);
        }
        $response = Companies::with('sectors')->paginate(10);
        return response()-> json(['companies' => $response], 200);
    }
    public function search(Request $request, $companyInitials)
    {   
        if (filter_var($request['order'], FILTER_VALIDATE_BOOLEAN) === true) {
            $company = Companies::with('sectors')->where('name', 'like', $companyInitials . '%')->orderBy('name')->get();
            return response()-> json([
                'companies' => $company 
            ], 200);
        }
            $company = Companies::with('sectors')->where('name', 'like', $companyInitials . '%')->get();
            return response()-> json([
                'companies' => $company 
            ], 200);
    }
    public function searchBySec(Request $request, $sectorsInitials)
    {
        if (filter_var($request['order'], FILTER_VALIDATE_BOOLEAN) === true) {
            $company = Companies::with('sectors')->whereHas('sectors', function($q) use ($sectorsInitials) {
                $q -> where('name', 'like', $sectorsInitials . '%');
            })->orderBy('name')->get();
            return response()-> json([
                'companies' => $company 
            ], 200);
        }
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
            $errors = $validator->messages()->all();
            return response()->json(['error' => $errors], 400);
  
        }
        $companyExists = Companies::where('cnpj', $request['cnpj'])->exists();
        if ($companyExists) {
            return response()->json(['error' => ['Já existe uma empresa cadastrada com esse CNPJ.']], 400);
        }
        $sectorsId = $request['sectors']; 
        $companies = Companies::create($request->all());
        $companies->sectors()->attach($sectorsId);

        return response()-> json([
            'message'=> 'Empresa cadastrada com sucesso',
            'company' => $companies
        ], 200);
    }
    public function update(Request $request, $id)
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
        $errors = $validator->messages()->all();
        return response()->json(['error' => $errors], 400);
    }
    $companyExists = Companies::where('cnpj', $request['cnpj'])->first();
    if ($companyExists !== null) {
        if ($companyExists['id'] != intval($id)) {
            return response()->json(['error' => 'Já existe uma empresa cadastrada com esse CNPJ.'], 400);
        }
    }
        $companyUpdate = Companies::find($id);
        $companyUpdate->update($request->all());
        $companyUpdate->sectors()->sync($request['sectors']);
        return response()->json($companyUpdate);
    }
    public function delete(Request $request, $id)
    {   
        $companies = Companies::findOrFail($id);
        $companies->delete();

        return $companies;
    }
}
