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
        return view('admin.criar_acervo',['especificacoes'=>$especificacoes, 'estados'=>$estados, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos]);
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

        // consulta pra saber o id baseado nas infos passadas (last id)
        //cria pasta com o id
        // coloca fotos lá

        if($adicionandoAcervo){
            echo'Acervo enviando com sucesso';
        }else{
            echo'Erro';
            var_dump($adicionandoAcervo);
        }

        return view('admin.adicionar_acervo');
    }
}