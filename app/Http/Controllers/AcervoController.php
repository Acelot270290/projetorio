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

        /*if ($request->file('foto_frontal_acervo')) {

            $image = $request->foto_frontal_acervo;
            $extension = $image->extension();
            $imageName = 'Frontal_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_frontal_acervo')) {

            $image = $request->foto_frontal_acervo;
            $extension = $image->extension();
            $imageName = 'Frontal_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
        }

        if ($request->file('foto_frontal_acervo')) {

            $image = $request->foto_frontal_acervo;
            $extension = $image->extension();
            $imageName = 'Frontal_Acervo.' . $extension;
            $uploadImage = $image->move(public_path($imagemacervo), $imageName);

            $adicionandoAcervoId =   Acervos::where('id', $adicionandoAcervoId)->update(['foto_frontal_acervo' => $imagemacervo . '/' . $imageName]);
        }*/



        if ($adicionandoAcervoId) {
            return view('admin.criar_acervo', ['alert_message' => 'Acervo cadastrado com sucesso!', 'alert_type' => 'success']);
        } else {
            return view('admin.criar_acervo', ['alert_message' => 'Falha ao cadastrar o acervo!', 'alert_type' => 'danger']);
        }
    }
}
