<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getAllData()
	{
		$columns = ['id','name','email'];
		$dataset = User::select($columns)
						->orderBy('id', 'asc')
						->Paginate(10);
		// $columns = \Schema::getColumnListing('users');
		return view('pruebatabla', compact('dataset', 'columns'));
	}

	public function viewmodal($id)
	{
		$columns = ['id','name','email'];
		$data = User::where('id', '=', $id)->first();
		// return view('modal.edit', ['data' => $data])->render();
		return view('modal.edit', ['data' => $data, 'columns' => $columns])->render();
	}
}
