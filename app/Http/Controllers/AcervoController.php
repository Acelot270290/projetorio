<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Acervos;
use App\Models\EspecificacaoAcervos;
use App\Models\EstadoConservacaoAcervos;
use App\Models\Seculos;
use App\Models\Tombamentos;
//use Illuminate\Support\Facades\Storage;

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
        return view('admin.criar_acervo');
    }

    public function adicionar(Request $request)
    {
        $request->validate([
            'nome_acervo' => 'required|max:191',
            'cep_acervo' => 'required|max:9',
            'endereco_acervo' => 'required|max:250',
            'numero_endereco_acervo' => 'max:6',
            'bairro_acervo' => 'required|max:50',
            'cidade_acervo' => 'required|max:50',
            'UF_acervo' => 'required|max:2',
            'tombamento_id' => 'required|max:21',
            'seculo_id' => 'required|max:21',
            'ano_construcao_acervo' => 'required|max:4',
            'estado_conservacao_acervo_id' => 'required|max:21',
            'especificacao_acervo_id' => 'required|max:21',
            'descricao_fachada_planta_acervo' => 'required|max:10000',
            'usuario_insercao_id' => 'required|max:21',
            'foto_frontal_acervo' => 'max:250',
            'foto_lateral_1_acervo' => 'max:250',
            'foto_lateral_2_acervo' => 'max:250',
            'foto_posterior_acervo' => 'max:250',
            'foto_cobertura_acervo' => 'max:250',
            'plantas_situacao_acervo' => 'max:250'
        ]);
        //pPegando os dados do user
        $usuario = auth()->user('id');

        $adicionandoAcervoId =   Acervos::insertGetId([
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
            'estado_conservacao_acervo_id' => $request->estado_de_conservacao_acervo,
            'especificacao_acervo_id' => $request->especificacao_acervo,
            'descricao_fachada_planta_acervo' => $request->descricao_acervo,
            'usuario_insercao_id' => $usuario->id,
        ]);

        $basePath =  'imagem/acervos';
        if (!is_dir($basePath)) {
            mkdir(public_path($basePath));
        }

        $imagemacervo =  $basePath . '/' . $adicionandoAcervoId;
        if (is_dir($imagemacervo)) {
            // erro
        } else {
            mkdir(public_path($imagemacervo));
        }

        if ($request->file('foto_frontal_acervo')) {

            $image = $request->foto_frontal_acervo;
            $extension = $image->extension();
            $imageName = 'Frontal_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_1_acervo')) {

            $image = $request->foto_lateral_1_acervo;
            $extension = $image->extension();
            $imageName = 'Lateral_Esquerda_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_lateral_1_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_lateral_2_acervo')) {

            $image = $request->foto_lateral_2_acervo;
            $extension = $image->extension();
            $imageName = 'Lateral_Direita_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_lateral_2_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_posterior_acervo')) {

            $image = $request->foto_posterior_acervo;
            $extension = $image->extension();
            $imageName = 'Posterior_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_posterior_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_cobertura_acervo')) {

            $image = $request->foto_cobertura_acervo;
            $extension = $image->extension();
            $imageName = 'Cobertura_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_cobertura_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('plantas_situacao_acervo')) {

            $image = $request->plantas_situacao_acervo;
            $extension = $image->extension();
            $imageName = 'Plantas_Situacao_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['plantas_situacao_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($adicionandoAcervoId) {
            return view('admin.criar_acervo', ['alert_message' => 'Acervo cadastrado com sucesso!', 'alert_type' => 'success']);
        } else {
            return view('admin.criar_acervo', ['alert_message' => 'Falha ao cadastrar o acervo!', 'alert_type' => 'danger']);
        }
    }
}
