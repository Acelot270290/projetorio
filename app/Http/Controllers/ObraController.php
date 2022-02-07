<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\Categorias;
use App\Models\CondicaoSegurancaObras;
use App\Models\EspecificacaoObras;
use App\Models\EspecificacaoSegurancaObras;
use App\Models\EstadoConservacaoObras;
use App\Models\LocalizacoesObras;
use App\Models\Materiais;
use App\Models\Obras;
use App\Models\Seculos;
use App\Models\Tecnicas;
use App\Models\Tesauros;
use App\Models\Tombamentos;
use App\Models\User;
use Image;

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
        $obras = Obras::select('obras.id', 'titulo_obra', 'tesauro_id', 'titulo_tesauro', 'acervo_id', 'nome_acervo', 'material_id_1', 'm1.titulo_material as titulo_material_1', 'material_id_2', 'm2.titulo_material as titulo_material_2', 'material_id_3', 'm3.titulo_material as titulo_material_3', 'foto_frontal_acervo', 'obras.seculo_id', 'titulo_seculo', 'ano_construcao_acervo')
        ->join('seculos as s', 's.id', '=', 'obras.seculo_id')
        ->join('tesauros as t', 't.id', '=', 'tesauro_id')
        ->join('acervos as a', 'a.id', '=', 'acervo_id')
        ->leftjoin('materiais as m1', 'm1.id', '=', 'material_id_1')
        ->leftjoin('materiais as m2', 'm2.id', '=', 'material_id_2')
        ->leftjoin('materiais as m3', 'm3.id', '=', 'material_id_3')
        ->get();

        return view('admin.obra', ['obras' => $obras]);
    }

    public function criar(Request $request)
    {
        $acervos = Acervos::select('id', 'nome_acervo')->get();
        $categorias = Categorias::select('id', 'titulo_categoria')->get();
        $condicoes = CondicaoSegurancaObras::select('id', 'titulo_condicao_seguranca_obra', 'is_default_condicao_seguranca_obra')->get();
        $especificacoes = EspecificacaoObras::select('id', 'titulo_especificacao_obra')->orderBy('titulo_especificacao_obra', 'ASC')->get();
        $especificacoesSeg = EspecificacaoSegurancaObras::select('id', 'titulo_especificacao_seguranca_obra')->get();
        $estados = EstadoConservacaoObras::select('id', 'titulo_estado_conservacao_obra', 'is_default_estado_conservacao_obra')->get();
        $localizacoes = LocalizacoesObras::select('id', 'nome_localizacao')->orderBy('nome_localizacao', 'ASC')->get();
        $materiais = Materiais::select('id', 'titulo_material')->orderBy('titulo_material', 'ASC')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tecnicas = Tecnicas::select('id', 'titulo_tecnica')->orderBy('titulo_tecnica', 'ASC')->get();
        $tesauros = Tesauros::select('id', 'titulo_tesauro')->orderBy('titulo_tesauro', 'ASC')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento')->get();

        return view('admin.criar_obra',['acervos'=>$acervos, 'categorias'=>$categorias, 'especificacoes'=>$especificacoes, 'estados'=>$estados, 'localizacoes'=>$localizacoes, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos,'condicoes'=>$condicoes, 'especificacoesSeg'=>$especificacoesSeg, 'materiais'=>$materiais,'tecnicas'=>$tecnicas,'tesauros'=>$tesauros]);
        #return view('admin.criar_obra');
    }

    public function adicionar(Request $request)
    {

        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $request->seculo_acervo)->first();

        //validando os campos de obras
        $request->validate([

            'categoria_obra'=>'required',
            'titulo_obra'=>'required|max:250',
            'altura_obra'=>'',
            'largura_obra'=>'',
            'profundidade_obra'=>'',
            'comprimento_obra'=>'',
            'diâmetro_obra'=>'',
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


        //Pegando os dados do user
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
            'condicoes_de_seguranca_obra_id' => $request->condicao_seguranca_obra,
            'tombamento_id' => $request->tombamento_obra,
            'seculo_id' => $request->seculo_obra,
            'ano_obra'=> $request->ano_obra,
            'autoria_obra'=> $request->autoria_obra,
            'estado_conservacao_obra_id'=> $request->estado_de_conservacao_obra,
            'material_id_1'=> $request->material_1_obra,
            'material_id_2'=> $request->material_2_obra,
            'material_id_3'=> $request->material_3_obra,
            'tecnica_id_1'=> $request->tecnica_1_obra,
            'tecnica_id_2'=> $request->tecnica_2_obra,
            'tecnica_id_3'=> $request->tecnica_3_obra,
            'especificacao_obra_id'=> $request->especificacao_obra,
            'especificacao_seguranca_obra_id'=> $request->especificacao_seg_obra,
            'caracteristicas_est_icono_orna_obra'=> $request->caracteristicas_estilisticas_obra,
            'observacoes_obra'=> $request->observacoes_obra,
        ]);

        // criando a variavel global para pegar o id da obra
        $IdObra = $adicionandoObra;
        
        $preBasePath =  'imagem';
        $basePath =  $preBasePath . '/obras';
        if (!is_dir($preBasePath)) {
            mkdir(public_path($preBasePath));
            mkdir(public_path($basePath));
        }else if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemaobra =  $basePath . '/' . $adicionandoObra;
        if (is_dir($imagemaobra)) {
            // erro
        } else {
            mkdir(public_path($imagemaobra));
        }

        if ($request->file('foto_frontal_obra')) {

            $imageName = 'Frontal_obra.webp';
            
            $img = Image::make($request->foto_frontal_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
           
            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id', $IdObra)->update(['foto_frontal_obra' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_esquerda_obra')) {

            $imageName = 'Lateral_esquerda_obra.webp';
            
            $img = Image::make($request->foto_lateral_esquerda_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });

            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id',$IdObra)->update(['foto_lateral_esquerda_obra' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_direita_obra')) {

            $imageName = 'foto_lateral_direita_obra.webp';
            
            $img = Image::make($request->foto_lateral_direita_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id', $IdObra)->update(['foto_lateral_direita_obra' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_posterior_obra')) {

            $imageName = 'Posterior_obra.webp';
            
            $img = Image::make($request->foto_posterior_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id', $IdObra)->update(['foto_posterior_obra' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_superior_obra')) {

            $imageName = 'Superior_obra.webp';
            
            $img = Image::make($request->foto_superior_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id', $IdObra)->update(['foto_superior_obra' => $imagemaobra . '/' . $imageName]);
        }

        if ($request->file('foto_inferior_obra')) {

            $imageName = 'Inferior_obra.webp';
            
            $img = Image::make($request->foto_inferior_obra);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

            $adicionandoObra = Obras::where('id', $IdObra)->update(['foto_inferior_obra' => $imagemaobra . '/' . $imageName]);
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

    public function detalhar(Request $request, $id){
        /*$acervo = Acervos::select('acervos.id', 'nome_acervo', 'cep_acervo', 'endereco_acervo', 'numero_endereco_acervo', 'bairro_acervo', 'cidade_acervo', 'UF_acervo', 'descricao_fachada_planta_acervo', 'foto_frontal_acervo', 'estado_conservacao_acervo_id', 'titulo_estado_conservacao_acervo', 'ano_construcao_acervo', 'tombamento_id', 'titulo_tombamento', 'seculo_id', 'titulo_seculo', 'especificacao_acervo_id', 'titulo_especificacao_acervo', 'usuario_insercao_id', 'u1.name as usuario_cadastrante', 'usuario_atualizacao_id', 'u2.name as usuario_revisor')
        ->where('acervos.id', '=', intval($id))
        ->join('estado_conservacao_acervos as ec', 'ec.id', '=', 'estado_conservacao_acervo_id')
        ->join('tombamentos as t', 't.id', '=', 'tombamento_id')
        ->join('seculos as s', 's.id', '=', 'seculo_id')
        ->leftJoin('especificacao_acervos as ea', 'ea.id', '=', 'especificacao_acervo_id')
        ->join('users as u1', 'u1.id', '=', 'usuario_insercao_id')
        ->leftJoin('users as u2', 'u2.id', '=', 'usuario_atualizacao_id')
        ->first();

        return view('admin.detalhar_acervo', ['acervo' => $acervo]);*/
        return;
    }

    public function editar(Request $request, $id){
        /*$acervo = Acervos::select('acervos.id', 'nome_acervo', 'cep_acervo', 'endereco_acervo', 'numero_endereco_acervo', 'bairro_acervo', 'cidade_acervo', 'UF_acervo', 'descricao_fachada_planta_acervo', 'foto_frontal_acervo', 'estado_conservacao_acervo_id', 'ano_construcao_acervo', 'tombamento_id', 'seculo_id', 'especificacao_acervo_id', 'usuario_insercao_id', 'usuario_atualizacao_id')
        ->where('acervos.id', '=', intval($id))
        ->first();
        
        $especificacoes = EspecificacaoAcervos::select('id', 'titulo_especificacao_acervo')->orderBy('titulo_especificacao_acervo', 'ASC')->get();
        $estados = EstadoConservacaoAcervos::select('id', 'titulo_estado_conservacao_acervo', 'is_default_estado_conservacao_acervo')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento', 'is_default_tombamento')->get();

        return view('admin.editar_acervo', ['acervo' => $acervo, 'especificacoes' => $especificacoes, 'estados' => $estados, 'seculos' => $seculos, 'tombamentos' => $tombamentos]);*/
        return;
    }
}
