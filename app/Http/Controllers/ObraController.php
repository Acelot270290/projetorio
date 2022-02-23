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
        $obras = Obras::select('obras.id', 'titulo_obra', 'tesauro_id', 'titulo_tesauro', 'acervo_id', 'nome_acervo', 'material_id_1', 'm1.titulo_material as titulo_material_1', 'material_id_2', 'm2.titulo_material as titulo_material_2', 'material_id_3', 'm3.titulo_material as titulo_material_3', 'foto_frontal_obra', 'obras.seculo_id', 'titulo_seculo')
        ->join('seculos as s', 's.id', '=', 'obras.seculo_id')
        ->join('tesauros as t', 't.id', '=', 'tesauro_id')
        ->join('acervos as a', 'a.id', '=', 'acervo_id')
        ->leftjoin('materiais as m1', 'm1.id', '=', 'material_id_1')
        ->leftjoin('materiais as m2', 'm2.id', '=', 'material_id_2')
        ->leftjoin('materiais as m3', 'm3.id', '=', 'material_id_3')
        ->orderBy('obras.id', 'ASC')
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

        return view('admin.criar_obra', ['acervos'=>$acervos, 'categorias'=>$categorias, 'especificacoes'=>$especificacoes, 'estados'=>$estados, 'localizacoes'=>$localizacoes, 'seculos'=>$seculos, 'tombamentos'=>$tombamentos,'condicoes'=>$condicoes, 'especificacoesSeg'=>$especificacoesSeg, 'materiais'=>$materiais,'tecnicas'=>$tecnicas,'tesauros'=>$tesauros]);
    }

    public function adicionar(Request $request)
    {
        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $request->seculo_obra)->first();

        //validando os campos de obras
        $request->validate([
            'acervo_obra' => 'required|min:1|max:21',
            'categoria_obra'=>'required|min:1|max:21',
            'titulo_obra'=>'required|min:1|max:250',
            'tesauro_obra'=>'required|min:1|max:21',
            'localizacao_obra'=>'required|min:1|max:21',
            'condicao_seguranca_obra'=>'required|min:1|max:21',
            'tombamento_obra'=>'required|min:1|max:21',
            'estado_de_conservacao_obra'=>'required|min:1|max:21',
            'material_1_obra'=>'required|min:1|max:21',
            'tecnica_1_obra'=>'required|min:1|max:21',
            'seculo_obra'=>'required|min:1|max:21',
            'ano_obra' => 'nullable|max:5|gte:' . strval($seculo->ano_inicio_seculo) . '|lte:' . strval($seculo->ano_fim_seculo),
        ]);


        //Pegando os dados do user
        $usuario = auth()->user('id');

        if(isset($request->especificacao_obra) and !empty($request->especificacao_obra)){
            $check = implode(',', $request->especificacao_obra);
        } else {
            $check = '';
        }

        if(isset($request->especificacao_seg_obra) and !empty($request->especificacao_seg_obra)){
            $checkSeg = implode(',', $request->especificacao_seg_obra);
        } else {
            $checkSeg = '';
        }

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
            //'especificacao_obra_id'=> $request->especificacao_obra,
            //'especificacao_seguranca_obra_id'=> $request->especificacao_seg_obra,
            'checkbox_especificacao_obra' => $check,
            'checkbox_especificacao_seguranca_obra' => $checkSeg,
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
            // se a pasta esxistir, deleta tudo dentro dela, remove e depois recria
            array_map('unlink', glob(public_path($imagemaobra) . "/*.*"));
            rmdir(public_path($imagemaobra));
            mkdir(public_path($imagemaobra));
        } else {
            mkdir(public_path($imagemaobra));
        }

        if($request->hasFile('foto_frontal_obra') or $request->hasFile('foto_lateral_esquerda_obra') or $request->hasFile('foto_lateral_direita_obra') or $request->hasFile('foto_posterior_obra') or $request->hasFile('foto_superior_obra') or $request->hasFile('foto_inferior_obra')){
            $insereObra = Obras::find($IdObra);
            $insereObra->timestamps = false;

            if ($request->file('foto_frontal_obra')) {

                $imageName = 'Frontal_obra.webp';
                
                $img = Image::make($request->foto_frontal_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);
                
                $insereObra->foto_frontal_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_lateral_esquerda_obra')) {

                $imageName = 'Lateral_esquerda_obra.webp';
                
                $img = Image::make($request->foto_lateral_esquerda_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $insereObra->foto_lateral_esquerda_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_lateral_direita_obra')) {

                $imageName = 'foto_lateral_direita_obra.webp';
                
                $img = Image::make($request->foto_lateral_direita_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $insereObra->foto_lateral_direita_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_posterior_obra')) {

                $imageName = 'Posterior_obra.webp';
                
                $img = Image::make($request->foto_posterior_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $insereObra->foto_posterior_obra =$imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_superior_obra')) {

                $imageName = 'Superior_obra.webp';
                
                $img = Image::make($request->foto_superior_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $insereObra->foto_superior_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_inferior_obra')) {

                $imageName = 'Inferior_obra.webp';
                
                $img = Image::make($request->foto_inferior_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $insereObra->foto_inferior_obra = $imagemaobra . '/' . $imageName;
            }
            $insereObra->save();
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
        //$obra = Obras::select('obras.id', 'acervo_id', 'nome_acervo', 'obras.created_at', 'obras.updated_at', 'categoria_id', 'titulo_categoria', 'titulo_obra', 'foto_frontal_obra', 'foto_lateral_esquerda_obra', 'foto_lateral_direita_obra', 'foto_posterior_obra', 'foto_superior_obra', 'foto_inferior_obra', 'tesauro_id', 'titulo_tesauro', 'altura_obra', 'largura_obra', 'profundidade_obra', 'comprimento_obra', 'diametro_obra', 'material_id_1', 'm1.titulo_material as titulo_material_1', 'material_id_2', 'm2.titulo_material as titulo_material_2', 'material_id_3', 'm3.titulo_material as titulo_material_3', 'tecnica_id_1', 't1.titulo_tecnica as titulo_tecnica_1', 'tecnica_id_2', 't2.titulo_tecnica as titulo_tecnica_2', 'tecnica_id_3', 't3.titulo_tecnica as titulo_tecnica_3', 'obras.seculo_id', 'titulo_seculo', 'ano_obra', 'autoria_obra', 'procedencia_obra', 'estado_conservacao_obra_id', 'titulo_estado_conservacao_obra', 'especificacao_obra_id', 'titulo_especificacao_obra', 'condicoes_de_seguranca_obra_id', 'titulo_condicao_seguranca_obra', 'especificacao_seguranca_obra_id', 'titulo_especificacao_seguranca_obra', 'caracteristicas_est_icono_orna_obra', 'observacoes_obra', 'localizacao_obra_id', 'nome_localizacao', 'obras.usuario_insercao_id', 'u1.name as usuario_cadastrante', 'obras.usuario_atualizacao_id', 'u2.name as usuario_revisor')
        $obra = Obras::select('obras.id', 'acervo_id', 'nome_acervo', 'obras.created_at', 'obras.updated_at', 'categoria_id', 'titulo_categoria', 'titulo_obra', 'foto_frontal_obra', 'foto_lateral_esquerda_obra', 'foto_lateral_direita_obra', 'foto_posterior_obra', 'foto_superior_obra', 'foto_inferior_obra', 'tesauro_id', 'titulo_tesauro', 'altura_obra', 'largura_obra', 'profundidade_obra', 'comprimento_obra', 'diametro_obra', 'material_id_1', 'm1.titulo_material as titulo_material_1', 'material_id_2', 'm2.titulo_material as titulo_material_2', 'material_id_3', 'm3.titulo_material as titulo_material_3', 'tecnica_id_1', 't1.titulo_tecnica as titulo_tecnica_1', 'tecnica_id_2', 't2.titulo_tecnica as titulo_tecnica_2', 'tecnica_id_3', 't3.titulo_tecnica as titulo_tecnica_3', 'obras.seculo_id', 'titulo_seculo', 'ano_obra', 'autoria_obra', 'procedencia_obra', 'estado_conservacao_obra_id', 'titulo_estado_conservacao_obra', 'checkbox_especificacao_obra', 'condicoes_de_seguranca_obra_id', 'titulo_condicao_seguranca_obra', 'checkbox_especificacao_seguranca_obra','caracteristicas_est_icono_orna_obra', 'observacoes_obra', 'localizacao_obra_id', 'nome_localizacao', 'obras.usuario_insercao_id', 'u1.name as usuario_cadastrante', 'obras.usuario_atualizacao_id', 'u2.name as usuario_revisor')
        ->where('obras.id', '=', intval($id))
        ->join('acervos as a', 'a.id', '=', 'acervo_id')
        ->join('categorias as c', 'c.id', '=', 'categoria_id')
        ->join('tesauros as te', 'te.id', '=', 'tesauro_id')
        ->leftjoin('materiais as m1', 'm1.id', '=', 'material_id_1')
        ->leftjoin('materiais as m2', 'm2.id', '=', 'material_id_2')
        ->leftjoin('materiais as m3', 'm3.id', '=', 'material_id_3')
        ->leftjoin('tecnicas as t1', 't1.id', '=', 'tecnica_id_1')
        ->leftjoin('tecnicas as t2', 't2.id', '=', 'tecnica_id_2')
        ->leftjoin('tecnicas as t3', 't3.id', '=', 'tecnica_id_3')
        ->join('seculos as s', 's.id', '=', 'obras.seculo_id')
        ->join('estado_conservacao_obras as ec', 'ec.id', '=', 'estado_conservacao_obra_id')
        //->leftjoin('especificacao_obras as e', 'e.id', '=', 'especificacao_obra_id')
        ->join('condicao_seguranca_obras as cs', 'cs.id', '=', 'condicoes_de_seguranca_obra_id')
        //->leftjoin('especificacao_seguranca_obras as es', 'es.id', '=', 'especificacao_seguranca_obra_id')
        ->join('localizacoes_obras as l', 'l.id', '=', 'localizacao_obra_id')
        ->join('users as u1', 'u1.id', '=', 'obras.usuario_insercao_id')
        ->leftJoin('users as u2', 'u2.id', '=', 'obras.usuario_atualizacao_id')
        ->first();

        $especificacoes_array = explode(',', $obra->checkbox_especificacao_obra);
        $especificacoes = EspecificacaoObras::find($especificacoes_array);

        $especificacoes_seg_array = explode(',', $obra->checkbox_especificacao_seguranca_obra);
        $especificacoesSeg = EspecificacaoSegurancaObras::find($especificacoes_seg_array);

        return view('admin.detalhar_obra', ['obra' => $obra, 'especificacoes' => $especificacoes, 'especificacoesSeg' => $especificacoesSeg]);
    }

    public function editar(Request $request, $id){
        $obra = Obras::select('obras.id', 'acervo_id', 'categoria_id', 'titulo_obra', 'foto_frontal_obra', 'foto_lateral_esquerda_obra', 'foto_lateral_direita_obra', 'foto_posterior_obra', 'foto_superior_obra', 'foto_inferior_obra', 'tesauro_id', 'altura_obra', 'largura_obra', 'profundidade_obra', 'comprimento_obra',  'diametro_obra',  'material_id_1',  'material_id_2',  'material_id_3',  'tecnica_id_1',  'tecnica_id_2',  'tecnica_id_3', 'seculo_id', 'ano_obra', 'autoria_obra', 'procedencia_obra', 'tombamento_id', 'estado_conservacao_obra_id', 'checkbox_especificacao_obra', 'condicoes_de_seguranca_obra_id', 'checkbox_especificacao_seguranca_obra', 'caracteristicas_est_icono_orna_obra', 'observacoes_obra', 'localizacao_obra_id')
        ->where('obras.id', '=', intval($id))
        ->first();

        $check = array_map('intval', explode(',', $obra->checkbox_especificacao_obra));
        $checkSeg = array_map('intval', explode(',', $obra->checkbox_especificacao_seguranca_obra));

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

        return view('admin.editar_obra', ['obra' => $obra, 'acervos' => $acervos, 'categorias' => $categorias, 'especificacoes' => $especificacoes, 'check' => $check, 'estados'=>$estados, 'localizacoes' => $localizacoes, 'seculos' => $seculos, 'tombamentos' => $tombamentos, 'condicoes' => $condicoes, 'especificacoesSeg' => $especificacoesSeg, 'checkSeg' => $checkSeg, 'materiais' => $materiais, 'tecnicas' => $tecnicas, 'tesauros' => $tesauros]);
    }

    public function atualizar(Request $request, $id)
    {
        // Descobre quais anos são os limites do século escolhido
        $obra = Obras::select('seculo_id')->where('id', $id)->first();
        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $obra['seculo_id'])->first();

        //validando os campos de obras
        $request->validate([
            'acervo_obra' => 'required|min:1|max:21',
            'categoria_obra'=>'required|min:1|max:21',
            'titulo_obra'=>'required|min:1|max:250',
            'tesauro_obra'=>'required|min:1|max:21',
            'localizacao_obra'=>'required|min:1|max:21',
            'condicao_seguranca_obra'=>'required|min:1|max:21',
            'tombamento_obra'=>'required|min:1|max:21',
            'estado_de_conservacao_obra'=>'required|min:1|max:21',
            'material_1_obra'=>'required|min:1|max:21',
            'tecnica_1_obra'=>'required|min:1|max:21',
            'seculo_obra'=>'required|min:1|max:21',
            'ano_obra' => 'nullable|max:5|gte:' . strval($seculo->ano_inicio_seculo) . '|lte:' . strval($seculo->ano_fim_seculo),
        ]);

        //Pegando os dados do user
        $usuario = auth()->user('id');
       
        try{
            if(isset($request->especificacao_obra) and !empty($request->especificacao_obra)){
                $check = implode(',', $request->especificacao_obra);
            } else {
                $check = '';
            }
    
            if(isset($request->especificacao_seg_obra) and !empty($request->especificacao_seg_obra)){
                $checkSeg = implode(',', $request->especificacao_seg_obra);
            } else {
                $checkSeg = '';
            }
            
            $atualizaObra = Obras::where('id', '=', $id)
                ->update([
                'acervo_id' => $request->acervo_obra,
                'updated_at' => new \DateTime(),
                'usuario_atualizacao_id'=> $usuario->id,
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
                'checkbox_especificacao_obra'=> $check,
                'checkbox_especificacao_seguranca_obra'=> $checkSeg,
                'caracteristicas_est_icono_orna_obra'=> $request->caracteristicas_estilisticas_obra,
                'observacoes_obra'=> $request->observacoes_obra,
            ]);
            $isSuccess = true;
        }catch(Exception $e){
            $isSuccess = false;
        }

        $preBasePath =  'imagem';
        $basePath =  $preBasePath . '/obras';
        if (!is_dir($preBasePath)) {
            mkdir(public_path($preBasePath));
            mkdir(public_path($basePath));
        }else if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemaobra =  $basePath . '/' . $id;
        if (is_dir($imagemaobra)) {
            // erro
        } else {
            mkdir(public_path($imagemaobra));
        }


        if($request->hasFile('foto_frontal_obra') or $request->hasFile('foto_lateral_esquerda_obra') or $request->hasFile('foto_lateral_direita_obra') or $request->hasFile('foto_posterior_obra') or $request->hasFile('foto_superior_obra') or $request->hasFile('foto_inferior_obra')){
            $atualizaObra = Obras::find($id);
            $atualizaObra->timestamps = false;

            if ($request->file('foto_frontal_obra')) {

                $imageName = 'Frontal_obra.webp';
                
                $img = Image::make($request->foto_frontal_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);
                
                $atualizaObra->foto_frontal_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_lateral_esquerda_obra')) {

                $imageName = 'Lateral_esquerda_obra.webp';
                
                $img = Image::make($request->foto_lateral_esquerda_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $atualizaObra->foto_lateral_esquerda_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_lateral_direita_obra')) {

                $imageName = 'foto_lateral_direita_obra.webp';
                
                $img = Image::make($request->foto_lateral_direita_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $atualizaObra->foto_lateral_direita_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_posterior_obra')) {

                $imageName = 'Posterior_obra.webp';
                
                $img = Image::make($request->foto_posterior_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $atualizaObra->foto_posterior_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_superior_obra')) {

                $imageName = 'Superior_obra.webp';
                
                $img = Image::make($request->foto_superior_obra);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $atualizaObra->foto_superior_obra = $imagemaobra . '/' . $imageName;
            }

            if ($request->file('foto_inferior_obra')) {

                $imageName = 'Inferior_obra.webp';
                
                $img = Image::make($request->foto_inferior_obra)->orientate();
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemaobra) . '/' . $imageName)->encode('webp', 90);

                $atualizaObra->foto_inferior_obra = $imagemaobra . '/' . $imageName;
            }

            $atualizaObra->save();
        }

        if ($isSuccess) {
            $alertMsg = 'Obra atualizada com sucesso!';
            $alertType = 'success';
        } else {
            $alertMsg = 'Falha ao atualizada a obra!';
            $alertType = 'danger';
        }
      
        return redirect('/obra/editar/' . $request->id)->with('alert_message', $alertMsg)->with('alert_type', $alertType);
    }

    public function deletar(Request $request, $id){

        $obra = Obras::select()->where('id', '=', $id)->delete();

        $preBasePath =  'imagem';
        $basePath =  $preBasePath . '/obras';
        if (!is_dir($preBasePath)) {
            mkdir(public_path($preBasePath));
            mkdir(public_path($basePath));
        }else if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemaobra =  $basePath . '/' . $id;
        if (is_dir($imagemaobra)) {
            // se a pasta existir, deleta tudo dentro dela, remove e depois recria
            array_map('unlink', glob(public_path($imagemaobra) . "/*.*"));
            rmdir(public_path($imagemaobra));
        }

        if ($obra) {
            return response()->json(['status' => 'success', 'msg' => 'Obra deletada']);
        } else {
            return response()->json(['status' => 'error', 'msg' => 'Ops.. Não coneguimos deletar']);
        }
        
    }
}
