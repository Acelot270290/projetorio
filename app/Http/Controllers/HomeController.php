<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
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

        $usuarios = User::select('users.id', 'name', 'email', 'image', 'id_cargo','nome_cargo', 'estado')->count('users.id');

       // print_r($usuarios);die;

        return view('home',['usuarios'=>$usuarios]);
    }
}
