<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Acervos;
use App\Models\Obras;

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
        $usuarios_total = User::select('id')->count('id');
        $acervos_total = Acervos::select('id')->count('id');
        $obras_total = Obras::select('id')->count('id');

        $obras = Obras::select('obras.id', 'titulo_obra', 'tesauro_id', 'titulo_tesauro', 'acervo_id', 'nome_acervo', 'material_id_1', 'm1.titulo_material as titulo_material_1', 'material_id_2', 'm2.titulo_material as titulo_material_2', 'material_id_3', 'm3.titulo_material as titulo_material_3', 'foto_frontal_obra', 'obras.seculo_id', 'titulo_seculo')
        ->join('seculos as s', 's.id', '=', 'obras.seculo_id')
        ->join('tesauros as t', 't.id', '=', 'tesauro_id')
        ->join('acervos as a', 'a.id', '=', 'acervo_id')
        ->leftjoin('materiais as m1', 'm1.id', '=', 'material_id_1')
        ->leftjoin('materiais as m2', 'm2.id', '=', 'material_id_2')
        ->leftjoin('materiais as m3', 'm3.id', '=', 'material_id_3')
        ->orderBy('obras.id', 'DESC')
        ->limit(10)
        ->get();

        $obras = $obras->reverse();

       // print_r($usuarios);die;

        return view('home', ['usuarios_total' => $usuarios_total, 'acervos_total' => $acervos_total, 'obras_total' => $obras_total, 'obras' => $obras]);
    }
}
