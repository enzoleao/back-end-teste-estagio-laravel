<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sectors;

class SectorsController extends Controller
{
    public function index()
    {
        return Sectors::all();
    }

    public function show($id)
    {
        return Sectors::find($id);
    }

    public function store(Request $request)
    {
        return Sectors::create($request->all());
    }

    public function update(Request $request, $id)
    {
        $companies = Sectors::findOrFail($id);
        $companies ->update($request->all());

        return $companies;
    }

    public function delete(Request $request, $id)
    {
        $companies = Sectors::findOrFail($id);
        $companies->delete();

        return 204;
    }
}
