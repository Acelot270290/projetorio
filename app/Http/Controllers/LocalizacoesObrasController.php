<?php

namespace App\Http\Controllers;

use App\Models\LocalizacoesObras;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LocalizacoesObrasController extends Controller
{
    public function adicionar(Request $request){
        //Verificação caso já exista o registro

        
        $existe = LocalizacoesObras::select('id','nome_localizacao','descricao_localizacao')
        ->where('nome_localizacao', $request->all())
        ->get();

        if(count($existe)>0){

        Alert::error('Erro ao Cadastrar', 'Dados já Existente');
        return back();

        }else{

        $localicacaoObras = new LocalizacoesObras();
        $localicacaoObras->nome_localizacao = $request->cadatro_nome_localicacao;
        $localicacaoObras->save();

        Alert::success('Localização Salva', 'Registro salvo com sucesso!');
        return back();

        }
        

        

    }
}
