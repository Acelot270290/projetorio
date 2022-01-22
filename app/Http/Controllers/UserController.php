<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        
        $usuarios = User::select('users.id', 'name', 'email', 'image', 'id_funcao','nome_funcao', 'estado')
        ->join('funcoes as f', 'f.id', '=', 'id_funcao')
        ->get();
       // print_r($usuarios);die;
        
        return view('admin.usuarios', ['usuarios'=>$usuarios]);
    }
}
