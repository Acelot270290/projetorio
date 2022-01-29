<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\EspecificacaoAcervos;
use App\Models\EstadoConservacaoAcervos;
use App\Models\Seculos;
use App\Models\Tombamentos;

class AcervoController extends Controller
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
 
        return view('admin.acervo');
    }

    public function criar(Request $request)
    {
        $especificacoes = EspecificacaoAcervos::select('id', 'titulo_especificacao_acervo')->get();
        $estados = EstadoConservacaoAcervos::select('id', 'titulo_estado_conservacao_acervo', 'is_default_estado_conservacao_acervo')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento')->get();
        //print_r($especificacoes); print_r($estados); print_r($seculos); print_r($tombamentos);die;
        return view('admin.criar_acervo',['especificacoes'=>$especificacoes, 'estados'=>$estados, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos]);
    }

    public function adicionar()
    {
        Acervos::insert(''); // TODO adicionar
        return view('admin.adicionar_acervo');
    }
}
