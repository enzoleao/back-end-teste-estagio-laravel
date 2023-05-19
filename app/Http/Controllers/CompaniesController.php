<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Companies;

class CompaniesController extends Controller
{
    public function index()
    {
        return Companies::all();
    }

    public function show($id)
    {
        return Companies::find($id);
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
