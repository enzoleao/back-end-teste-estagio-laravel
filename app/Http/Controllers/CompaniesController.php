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
        $company = Companies::findOrFail($id);
        $sectors = Sectors::all();
        return compact('company', 'sectors');
    }

    public function store(Request $request)
    {
        return Companies::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $companies = Companies::findOrFail($id);
        $companies ->update($request->all());

        return $companies;
    }

    public function delete(Request $request, $id)
    {
        $companies = Article::findOrFail($id);
        $companies->delete();

        return 204;
    }
}
