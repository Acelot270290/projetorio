<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\EspecificacaoAcervos;
use App\Models\EstadoConservacaoAcervos;
use App\Models\Seculos;
use App\Models\Tombamentos;
use Image;

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
        $acervos = Acervos::select('acervos.id', 'nome_acervo', 'cidade_acervo', 'UF_acervo', 'foto_frontal_acervo', 'seculo_id', 'titulo_seculo', 'ano_construcao_acervo')
        ->join('seculos as s', 's.id', '=', 'seculo_id')
        ->get();
        return view('admin.acervo', ['acervos' => $acervos]);
    }

    public function criar(Request $request)
    {
        $especificacoes = EspecificacaoAcervos::select('id', 'titulo_especificacao_acervo')->orderBy('titulo_especificacao_acervo', 'ASC')->get();
        $estados = EstadoConservacaoAcervos::select('id', 'titulo_estado_conservacao_acervo', 'is_default_estado_conservacao_acervo')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento', 'is_default_tombamento')->get();

        return view('admin.criar_acervo', ['especificacoes' => $especificacoes, 'estados' => $estados, 'seculos' => $seculos, 'tombamentos' => $tombamentos]);
    }

    public function adicionar(Request $request)
    {

        // Descobre quais anos são os limites do século escolhido
        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $request->seculo_acervo)->first();

        $request->validate([
            'nome_acervo' => 'required|min:2|max:191',
            'cep_acervo' => 'required|max:9',
            'endereco_acervo' => 'required|max:250',
            'numero_endereco_acervo' => 'max:6',
            'bairro_acervo' => 'required|max:50',
            'cidade_acervo' => 'required|max:50',
            'UF_acervo' => 'required|max:2',
            'tombamento_acervo' => 'required|max:21',
            'seculo_acervo' => 'required|max:21',
            'ano_acervo' => 'required|max:4|gte:' . strval($seculo->ano_inicio_seculo) . '|lte:' . strval($seculo->ano_fim_seculo),
            'estado_conservacao_acervo' => 'required|max:21',
            'especificacao_acervo' => 'max:21',
            'descricao_acervo' => 'required|max:10000',
        ]);

        //Pegando os dados do user
        $usuario = auth()->user('id');

        $adicionandoAcervoId = Acervos::insertGetId([
            'id' => $request->id,
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
            'estado_conservacao_acervo_id' => $request->estado_conservacao_acervo,
            'especificacao_acervo_id' => $request->especificacao_acervo,
            'descricao_fachada_planta_acervo' => $request->descricao_acervo,
            'usuario_insercao_id' => $usuario->id,
        ]);

        $preBasePath =  'imagem';
        $basePath =  $preBasePath . '/acervos';
        if (!is_dir($preBasePath)) {
            mkdir(public_path($preBasePath));
            mkdir(public_path($basePath));
        }else if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemacervo =  $basePath . '/' . $adicionandoAcervoId;
        if (is_dir($imagemacervo)) {
            // erro
        } else {
            mkdir(public_path($imagemacervo));
        }

        if ($request->file('foto_frontal_acervo')) {

            $imageName = 'Frontal_Acervo.webp';

            $img = Image::make($request->foto_frontal_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_1_acervo')) {

            $imageName = 'Lateral_Esquerda_Acervo.webp';
            
            $img = Image::make($request->foto_lateral_1_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['foto_lateral_1_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_2_acervo')) {

            $imageName = 'Lateral_Direita_Acervo.webp';

            $img = Image::make($request->foto_lateral_2_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['foto_lateral_2_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_posterior_acervo')) {

            $imageName = 'Posterior_Acervo.webp';
            
            $img = Image::make($request->foto_posterior_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['foto_posterior_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_cobertura_acervo')) {

            $imageName = 'Cobertura_Acervo.webp';
            
            $img = Image::make($request->foto_cobertura_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['foto_cobertura_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('plantas_situacao_acervo')) {

            $imageName = 'Plantas_Situacao_Acervo.webp';
            
            $img = Image::make($request->plantas_situacao_acervo);
            $img->resize(450, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);

            $adicionandoAcervoId = Acervos::where('id', $adicionandoAcervoId)->update(['plantas_situacao_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($adicionandoAcervoId) {
            $alertMsg = 'Acervo cadastrado com sucesso!';
            $alertType = 'success';
        } else {
            $alertMsg = 'Falha ao cadastrar o acervo!';
            $alertType = 'danger';
        }
        return redirect('/acervo/criar')->with('alert_message', $alertMsg)->with('alert_type', $alertType);
    }

    public function detalhar(Request $request, $id){
        $acervo = Acervos::select('acervos.id', 'nome_acervo', 'cep_acervo', 'endereco_acervo', 'numero_endereco_acervo', 'bairro_acervo', 'cidade_acervo', 'UF_acervo', 'descricao_fachada_planta_acervo', 'foto_frontal_acervo', 'estado_conservacao_acervo_id', 'titulo_estado_conservacao_acervo', 'ano_construcao_acervo', 'tombamento_id', 'titulo_tombamento', 'seculo_id', 'titulo_seculo', 'especificacao_acervo_id', 'titulo_especificacao_acervo', 'usuario_insercao_id', 'u1.name as usuario_cadastrante', 'usuario_atualizacao_id', 'u2.name as usuario_revisor')
        ->where('acervos.id', '=', intval($id))
        ->join('estado_conservacao_acervos as ec', 'ec.id', '=', 'estado_conservacao_acervo_id')
        ->join('tombamentos as t', 't.id', '=', 'tombamento_id')
        ->join('seculos as s', 's.id', '=', 'seculo_id')
        ->leftJoin('especificacao_acervos as ea', 'ea.id', '=', 'especificacao_acervo_id')
        ->join('users as u1', 'u1.id', '=', 'usuario_insercao_id')
        ->leftJoin('users as u2', 'u2.id', '=', 'usuario_atualizacao_id')
        ->first();
        

        return view('admin.detalhar_acervo', ['acervo' => $acervo]);
    }

    public function editar(Request $request, $id){
        $acervo = Acervos::select('acervos.id', 'nome_acervo', 'cep_acervo', 'endereco_acervo', 'numero_endereco_acervo', 'bairro_acervo', 'cidade_acervo', 'UF_acervo', 'descricao_fachada_planta_acervo', 'foto_frontal_acervo', 'estado_conservacao_acervo_id', 'ano_construcao_acervo', 'tombamento_id', 'seculo_id', 'especificacao_acervo_id')
        ->where('acervos.id', '=', intval($id))
        ->first();
        
        $especificacoes = EspecificacaoAcervos::select('id', 'titulo_especificacao_acervo')->orderBy('titulo_especificacao_acervo', 'ASC')->get();
        $estados = EstadoConservacaoAcervos::select('id', 'titulo_estado_conservacao_acervo', 'is_default_estado_conservacao_acervo')->get();
        $seculos = Seculos::select('id', 'titulo_seculo', 'ano_inicio_seculo', 'ano_fim_seculo', 'is_default_seculo')->get();
        $tombamentos = Tombamentos::select('id', 'titulo_tombamento', 'is_default_tombamento')->get();

        return view('admin.atualizar_acervo', ['acervo' => $acervo, 'especificacoes' => $especificacoes, 'estados' => $estados, 'seculos' => $seculos, 'tombamentos' => $tombamentos]);
    }

    public function editar_action(Request $request){
        // Descobre quais anos são os limites do século escolhido
        $acervo = Acervos::select('seculo_id')->where('id', $id)->first();
        $seculo = Seculos::select('ano_inicio_seculo', 'ano_fim_seculo')->where('id', $acervo['seculo_id'])->first();

        $request->validate([
            'nome_acervo' => 'required|min:2|max:191',
            'cep_acervo' => 'required|max:9',
            'endereco_acervo' => 'required|max:250',
            'numero_endereco_acervo' => 'max:6',
            'bairro_acervo' => 'required|max:50',
            'cidade_acervo' => 'required|max:50',
            'UF_acervo' => 'required|max:2',
            'tombamento_acervo' => 'required|max:21',
            'seculo_acervo' => 'required|max:21',
            'ano_acervo' => 'required|max:4|gte:' . strval($seculo->ano_inicio_seculo) . '|lte:' . strval($seculo->ano_fim_seculo),
            'estado_conservacao_acervo' => 'required|max:21',
            'especificacao_acervo' => 'max:21',
            'descricao_acervo' => 'required|max:10000',
        ]);

        //Pegando os dados do user
        $usuario = auth()->user('id');

        // Cria os diretórios para imagem
        $preBasePath =  'imagem';
        $basePath =  $preBasePath . '/acervos';
        if (!is_dir($preBasePath)) {
            mkdir(public_path($preBasePath));
            mkdir(public_path($basePath));
        }else if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemacervo =  $basePath . '/' . $adicionandoAcervoId;
        if (!is_dir($imagemacervo)) {
            mkdir(public_path($imagemacervo));
        }


            try{
                $editandoAcervo = Acervos::where('id', '=', $request->id)
                ->update([
                    'nome_acervo' => $request->nome_acervo,
                    'updated_at' => new \DateTime(),
                    'cep_acervo' => $request->cep_acervo,
                    'endereco_acervo' => $request->endereco_acervo,
                    'numero_endereco_acervo' => $request->numero_endereco_acervo,
                    'bairro_acervo' => $request->bairro_acervo,
                    'cidade_acervo' => $request->cidade_acervo,
                    'UF_acervo' => $request->UF_acervo,
                    'tombamento_id' => $request->tombamento_acervo,
                    'seculo_id' => $request->seculo_acervo,
                    'ano_construcao_acervo' => $request->ano_acervo,
                    'estado_conservacao_acervo_id' => $request->estado_conservacao_acervo,
                    'especificacao_acervo_id' => $request->especificacao_acervo,
                    'descricao_fachada_planta_acervo' => $request->descricao_acervo,
                    'usuario_atualizacao_id' => $usuario->id,
                ]);
                $isSuccess = true;
            }catch(Exception $e){
                $isSuccess = false;
            }

            // adição sem timestamp (importante pra não flagar como update)
            $updateAcervo = Acervos::where('id', $request->id);
            $updateAcervo->timestamps = false;

            if ($request->file('foto_frontal_acervo')) {

                $imageName = 'Frontal_Acervo.webp';
    
                $img = Image::make($request->foto_frontal_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
            }
    
            if ($request->file('foto_lateral_1_acervo')) {
    
                $imageName = 'Lateral_Esquerda_Acervo.webp';
                
                $img = Image::make($request->foto_lateral_1_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['foto_lateral_1_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['foto_lateral_1_acervo' => $imagemacervo . '/' . $imageName]);
            }
    
            if ($request->file('foto_lateral_2_acervo')) {
    
                $imageName = 'Lateral_Direita_Acervo.webp';
    
                $img = Image::make($request->foto_lateral_2_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['foto_lateral_2_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['foto_lateral_2_acervo' => $imagemacervo . '/' . $imageName]);
            }
    
            if ($request->file('foto_posterior_acervo')) {
    
                $imageName = 'Posterior_Acervo.webp';
                
                $img = Image::make($request->foto_posterior_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['foto_posterior_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['foto_posterior_acervo' => $imagemacervo . '/' . $imageName]);
            }
    
            if ($request->file('foto_cobertura_acervo')) {
    
                $imageName = 'Cobertura_Acervo.webp';
                
                $img = Image::make($request->foto_cobertura_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['foto_cobertura_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['foto_cobertura_acervo' => $imagemacervo . '/' . $imageName]);
            }
    
            if ($request->file('plantas_situacao_acervo')) {
    
                $imageName = 'Plantas_Situacao_Acervo.webp';
                
                $img = Image::make($request->plantas_situacao_acervo);
                $img->resize(450, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $img->save(public_path($imagemacervo) . '/' . $imageName)->encode('webp', 90);
    
                //$adicionandoAcervoId = Acervos::where('id', $request->id)->update(['plantas_situacao_acervo' => $imagemacervo . '/' . $imageName]);
                $updateAcervo->update(['plantas_situacao_acervo' => $imagemacervo . '/' . $imageName]);
            }

            if ($isSuccess) {
                $alertMsg = 'Acervo cadastrado com sucesso!';
                $alertType = 'success';
            } else {
                $alertMsg = 'Falha ao cadastrar o acervo!';
                $alertType = 'danger';
            }
            return redirect('/acervo/editar/' . $request->id)->with('alert_message', $alertMsg)->with('alert_type', $alertType);
    }

    public function deletar(Request $request, $id){
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
