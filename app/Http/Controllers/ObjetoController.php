<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\CondicaoSegurancaObras;
use App\Models\EstadoConservacaoObras;
use App\Models\EspecificacaoObras;
use App\Models\EspecificacaoSegurancaObras;
use App\Models\Materiais;
use App\Models\Seculos;
use App\Models\Tombamentos;

class ObjetoController extends Controller
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
        return view('admin.objeto');
    }

    public function criar(Request $request)
    {
        $acervos = Acervos::select('id')->get();
        $especificacoes = EspecificacaoObras::select('id', 'titulo_especificacao_obras')->get();
        $estados = EstadoConservacaoObras::select('id', 'titulo_estado_conservacao_obras', 'is_default_estado_conservacao_obras')->get();
        $condicoesSeg = CondicaoSegurancaObras::select('id','titulo_condicao_seguranca_obras','is_default_condicao_seguranca_obras')->get();
        $especificacoesSeg = EspecificacaoSegurancaObras::select('id','titulo_especificacao_seguranca_obras')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento')->get();
        $materiais = Materiais::select('id', 'titulo_material')->get();

        return view('admin.criar_objeto',['acervos'=>$acervos,'especificacoes'=>$especificacoes, 'estados'=>$estados, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos,'condicoesSeg'=>$condicoesSeg, 'especificacoesSeg'=>$especificacoesSeg, 'materiais'=>$materiais]);
    }

    public function adicionar(Request $request)
    {
        //pPegando os dados do user
        $usuario =  auth()->user('id');
       
        $adicionandoAcervo =   Acervos::insert([
            'nome_acervo' => $request->nome_acervo,
            'cep_acervo' => $request->cep_acervo,
            'endereco_acervo' => $request->endereco_acervo,
            'numero_endereco_acervo' => $request->numero_endereco_acervo,
            'bairro_acervo' => $request->bairro_acervo,
            'cidade_acervo' => $request->cidade_acervo,
            'UF_acervo' => $request->UF_acervo,
            'tombamento_id' => $request->tombamento_acervo,
            'seculo_id' => $request->seculo_acervo,
            'ano_construcao_acervo' => $request->ano_acervo,
            'estado_conservacao_acervo_id' => $request->estado_de_conservacao_acervo,
            'especificacao_acervo_id' => $request->especificacao_acervo,
            'descricao_fachada_planta_acervo'=> $request->descricao_acervo,
            'usuario_insercao_id'=> $usuario->id
        ]);

        if($adicionandoAcervo){
            echo'Acervo enviando com sucesso';
        }else{
            echo'Erro';
            var_dump($adicionandoAcervo);
        }

        return view('admin.adicionar_acervo');
    }
}
