<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\CondicaoSegurancaObras;
use App\Models\EstadoConservacaoObras;
use App\Models\EspecificacaoObras;
use App\Models\EspecificacaoSegurancaObras;
use App\Models\Materiais;
use App\Models\Obras;
use App\Models\Seculos;
use App\Models\Tecnicas;
use App\Models\Tesauros;
use App\Models\Tombamentos;

class ObraController extends Controller
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
        return view('criar_obra');
    }

    public function criar(Request $request)
    {
        /*
        $acervos = Acervos::select('id')->get();
        $especificacoes = EspecificacaoObras::select('id', 'titulo_especificacao_obras')->get();
        $estados = EstadoConservacaoObras::select('id', 'titulo_estado_conservacao_obras', 'is_default_estado_conservacao_obras')->get();
        $condicoesSeg = CondicaoSegurancaObras::select('id','titulo_condicao_seguranca_obras','is_default_condicao_seguranca_obras')->get();
        $especificacoesSeg = EspecificacaoSegurancaObras::select('id','titulo_especificacao_seguranca_obras')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento')->get();
        $materiais = Materiais::select('id', 'titulo_material')->get();
        $tecnicas = Tecnicas::select('id', 'titulo_tecnica')->get();
        $tesauros = Tesauros::select('id', 'titulo_tesauro')->get();
        $condicoes = CondicaoSegurancaObras::select('id', 'titulo_condicao_seguranca_obras', 'is_default_condicao_seguranca_obras')->get();
        */

        #return view('admin.criar_obra',['acervos'=>$acervos,'especificacoes'=>$especificacoes, 'estados'=>$estados, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos,'condicoesSeg'=>$condicoesSeg, 'especificacoesSeg'=>$especificacoesSeg, 'materiais'=>$materiais,'tecnicas'=>$tecnicas,'tesauros'=>$tesauros,'condicoes'=>$condicoes]);
        return view('admin.criar_obra');
    }

    public function adicionar(Request $request)
    {

        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $request->seculo_acervo)->first();

        //validando os campos de obras
        $request->validate([

            'categoria_obra'=>'required',
            'titulo_obra'=>'required|max:250',
            'altura_obra'=>'required',
            'largura_obra'=>'required',
            'profundidade_obra'=>'required',
            'comprimento_obra'=>'required',
            'diâmetro_obra'=>'required',
            'tesauro_obra'=>'required',
            'localizacao_obra'=>'required',
            'condicao_seguranca_obra'=>'required',
            'tombamento_obra'=>'required',
            'estado_de_conservacao_obra'=>'required',
            'material_1_obra'=>'required',
            'tecnica_1_obra'=>'required',
            'especificacao_obra'=>'required',
            'seculo_obra'=>'required',
            'especificacao_seg_obra'=>'required',

        ]);


        //pPegando os dados do user
        $usuario =  auth()->user('id');
       
        $adicionandoObra = Obras::insertGetId([
            'id' => $request->id,
            'acervo_id'=> $request->acervo_obra,
            'created_at'=> new \DateTime(),
            'usuario_insercao_id'=> $usuario->id,
            'categoria_id' => $request->categoria_obra,
            'titulo_obra' => $request->titulo_obra,
            'altura_obra' => $request->altura_obra,
            'largura_obra' => $request->largura_obra,
            'profundidade_obra' => $request->profundidade_obra,
            'comprimento_obra' => $request->comprimento_obra,
            'diametro_obra' => $request->diâmetro_obra,
            'tesauro_id' => $request->tesauro_obra,
            'localizacao_obra_id' => $request->localizacao_obra,
            'condicoes_de_seguranca_obras_id' => $request->condicao_seguranca_obra,
            'tombamento_id' => $request->tombamento_obra,
            'seculo_id' => $request->seculo_obra,
            'ano_obra'=> $request->ano_obra,
            'autoria_obra'=> $request->autoria_obra,
            'estado_conservacao_obras_id'=> $request->estado_de_conservacao_obra,
            'material_id_1'=> $request->material_1_obra,
            'material_id_2'=> $request->material_2_obra,
            'material_id_3'=> $request->material_3_obra,
            'tecnica_id_1'=> $request->tecnica_1_obra,
            'tecnica_id_2'=> $request->tecnica_2_obra,
            'tecnica_id_3'=> $request->tecnica_3_obra,
            'especificacao_obras_id'=> $request->especificacao_obra,
            'especificacao_seguranca_obras_id'=> $request->especificacao_seg_obra,
            'caracteristicas_est_icono_orna_obra'=> $request->caracteristicas_estilisticas_obra,
            'observacoes_obra'=> $request->observacoes_obra,
            
        ]);

        // criando a variavel global para pegar o id da obra
        $IdObra = $adicionandoObra;
        
    
        $basePath =  'imagem/obras';
        if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemaobra =  $basePath . '/' . $adicionandoObra;
        if (is_dir($imagemaobra)) {
            // erro
        } else {
            mkdir(public_path($imagemaobra));
        }

       

        if ($request->file('foto_frontal_obras')) {

            $image = $request->foto_frontal_obras;
            $extension = $image->extension();
            $imageName = 'Frontal_obra.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id', $IdObra)->update(['foto_frontal_obras' => $imagemaobra . '/' . $imageName]);
        }
        

        
        if ($request->file('foto_lateral_esquerda_obras')) {

            $image = $request->foto_lateral_esquerda_obras;
            $extension = $image->extension();
            $imageName = 'Lateral_esquerda_obra.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id',$IdObra)->update(['foto_lateral_esquerda_obras' => $imagemaobra . '/' . $imageName]);
        }
        

        if ($request->file('foto_lateral_direita_obras')) {

            $image = $request->foto_lateral_direita_obras;
            $extension = $image->extension();
            $imageName = 'foto_lateral_direita_obras.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id', $IdObra)->update(['foto_lateral_direita_obras' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_posterior_obras')) {

            $image = $request->foto_posterior_obras;
            $extension = $image->extension();
            $imageName = 'Posterior_obra.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id', $IdObra)->update(['foto_posterior_obras' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_superior_obras')) {

            $image = $request->foto_superior_obras;
            $extension = $image->extension();
            $imageName = 'Superior_obra.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id', $IdObra)->update(['foto_superior_obras' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_inferior_obras')) {

            $image = $request->foto_inferior_obras;
            $extension = $image->extension();
            $imageName = 'Inferior_obra.' . $extension;
            $uploadImage = $image->move(public_path($imagemaobra), $imageName);

            $adicionandoObra =   Obras::where('id', $IdObra)->update(['foto_inferior_obras' => $imagemaobra . '/' . $imageName]);
        }


        if ($adicionandoObra) {
            $alertMsg = 'Obra cadastrada com sucesso!';
            $alertType = 'success';
        } else {
            $alertMsg = 'Falha ao cadastrar a obra!';
            $alertType = 'danger';
        }
      
        return redirect('/obra/criar')->with('alert_message', $alertMsg)->with('alert_type', $alertType);

    }
}
