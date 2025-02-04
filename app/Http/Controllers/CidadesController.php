<?php

namespace App\Http\Controllers;

use App\Models\Cidade;
use Illuminate\Http\Request;

class CidadesController extends Controller
{
    public function index()
    {
        return response()->json(Cidade::all());
    }
}
