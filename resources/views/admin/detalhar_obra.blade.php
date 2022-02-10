@extends('layouts.app')

@section('titulo', "Detalhamento de obra ID: {{ $obra->id }}")

@section('content')

<div class="main-content">
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Detalhamento de obra ID: {{ !is_null($obra->id) ? $obra->id : '-'}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="owl-carousel owl-theme slider owl-loaded owl-drag" id="slider1">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.25s ease 0s; width: 450px;">
                                            @if(!is_null($obra->foto_frontal_obra))
                                                <div class="owl-item active" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_frontal_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($obra->foto_lateral_esquerda_obra))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_lateral_esquerda_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($obra->foto_lateral_direita_obra))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_lateral_direita_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($obra->foto_posterior_obra))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_posterior_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($obra->foto_superior_obra))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_superior_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($obra->foto_inferior_obra))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($obra->foto_inferior_obra) }}">
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-7">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <h5>{{ !is_null($obra->titulo_obra) ? $obra->titulo_obra : '-' }}</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Nome da obra:</b> {{ !is_null($obra->titulo_obra) ? $obra->titulo_obra : '-' }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-7">
                                        <b>Acervo pertencente:</b> {{ !is_null($obra->nome_acervo) ? $obra->nome_acervo : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Categoria:</b> {{ !is_null($obra->titulo_categoria) ? $obra->titulo_categoria : '-' }}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <b>Tesauro:</b> {{ !is_null($obra->titulo_tesauro) ? $obra->titulo_tesauro : '-' }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Dimensões cm</b>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <b>Altura:</b> {{ !is_null($obra->altura_obra) ? $obra->altura_obra : '-' }}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <b>Largura:</b> {{ !is_null($obra->largura_obra) ? $obra->largura_obra : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Profundidade:</b> {{ !is_null($obra->profundidade_obra) ? $obra->profundidade_obra : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Comprimento:</b> {{ !is_null($obra->comprimento_obra) ? $obra->comprimento_obra : '-' }}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <b>Diâmetro:</b> {{ !is_null($obra->diametro_obra) ? $obra->diametro_obra : '-' }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Materiais</b>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <b>Material 1:</b> {{ !is_null($obra->titulo_material_1) ? $obra->titulo_material_1 : '-'}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <b>Material 2:</b> {{ !is_null($obra->titulo_material_2) ? $obra->titulo_material_2 : '-'}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <b>Material 3:</b> {{ !is_null($obra->titulo_material_3) ? $obra->titulo_material_3 : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Técnicas</b>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <b>Técnica 1:</b> {{ !is_null($obra->titulo_tecnica_1) ? $obra->titulo_tecnica_1 : '-'}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <b>Técnica 2:</b> {{ !is_null($obra->titulo_tecnica_2) ? $obra->titulo_tecnica_2 : '-'}}
                                    </div>
                                    <div class="form-group col-md-4">
                                        <b>Técnica 3:</b> {{ !is_null($obra->titulo_tecnica_3) ? $obra->titulo_tecnica_3 : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <b>Século:</b> {{ !is_null($obra->titulo_seculo) ? $obra->titulo_seculo : '-'}}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <b>Ano:</b> {{ !is_null($obra->ano_obra) ? $obra->ano_obra : '-'}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Autoria:</b> {{ !is_null($obra->autoria_obra) ? $obra->autoria_obra : '-'}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Procedência:</b> {{ !is_null($obra->procedencia_obra) ? $obra->procedencia_obra : '-'}}
                                    </div>
                                    <div class="form-group col-md-2">
                                        <b>Localização:</b> {{ !is_null($obra->nome_localizacao) ? $obra->nome_localizacao : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <b>Estado de conservação:</b> {{ !is_null($obra->titulo_estado_conservacao_obra) ? $obra->titulo_estado_conservacao_obra : '-'}}
                                    </div>
                                    <div class="form-group col-md-10">
                                        <b>Especificações:</b> {{ !is_null($obra->titulo_especificacao_obra) ? $obra->titulo_especificacao_obra : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <b>Condição de segurança:</b> {{ !is_null($obra->titulo_condicao_seguranca_obra) ? $obra->titulo_condicao_seguranca_obra : '-'}}
                                    </div>
                                    <div class="form-group col-md-10">
                                        <b>Especificações de segurança:</b> {{ !is_null($obra->titulo_especificacao_seguranca_obra) ? $obra->titulo_especificacao_seguranca_obra : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Características estilísticas/iconográficas e ornamentais:</b> {{ !is_null($obra->caracteristicas_est_icono_orna_obra) ? $obra->caracteristicas_est_icono_orna_obra : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Observações:</b> {{ !is_null($obra->observacoes_obra) ? $obra->observacoes_obra : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <b>Cadastrado por:</b> {{ !is_null($obra->usuario_cadastrante) ? $obra->usuario_cadastrante : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Cadastrado em:</b> {{ !is_null($obra->created_at) ? date('d-m-Y', strtotime($obra->created_at)) : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Revisado por:</b> {{ !is_null($obra->usuario_revisor) ? $obra->usuario_revisor : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Revisado em:</b> {{ !is_null($obra->updated_at) ? date('d-m-Y', strtotime($obra->updated_at)) : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <a href="{{route('obra')}}" class="btn btn-dark">voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection