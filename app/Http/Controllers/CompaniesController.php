<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;
use App\Models\Sectors;


class CompaniesController extends Controller
{
    public function index()
    {
        $response = Companies::with('sectors')->get();
        return response()-> json([
            'companies' => $response
        ], 200);
    }

    public function show($id)
    {
        $company = Companies::findOrFail($id)::with('sectors')->get();
        return response()-> json([
            'companies' => $company
        ], 200);
    }

    public function store(Request $request)
    {   

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
