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
        // Somente usuários logados podem acessar esse controller
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Seleciona os dados dos usuários
        $usuarios = User::select('users.id', 'name', 'email', 'image', 'id_cargo','nome_cargo', 'estado')
            ->join('cargos as f', 'f.id', '=', 'id_cargo')
            ->orderBy('users.id', 'ASC')
            ->get();
        
        return view('admin.usuarios', [
            'usuarios' => $usuarios
        ]);
    }
}
