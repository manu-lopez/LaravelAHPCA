<?php

namespace App\Http\Controllers;

use App\Fondo;

use Illuminate\Http\Request;

class FondoController extends Controller
{
	public function getAllData()
	{
		$dataset = Fondo::all();
		$columns = \Schema::getColumnListing('-Fondos');
		return view('pruebatabla', compact('dataset', 'columns'));
	}
}
