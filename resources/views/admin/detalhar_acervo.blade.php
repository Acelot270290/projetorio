@extends('layouts.app')
<div class="main-content">
@section('content')
    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Detalhamento de acervo ID: {{ !is_null($acervo->id) ? $acervo->id : '-'}}</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <div class="owl-carousel owl-theme slider owl-loaded owl-drag" id="slider1">
                                    <div class="owl-stage-outer">
                                        <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0.25s ease 0s; width: 100%;">
                                            @if(!is_null($acervo->foto_frontal_acervo))
                                                <div class="owl-item active" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->foto_frontal_acervo) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($acervo->foto_lateral_1_acervo))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->foto_lateral_1_acervo) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($acervo->foto_lateral_2_acervo))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->foto_lateral_2_acervo) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($acervo->foto_posterior_acervo))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->foto_posterior_acervo) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($acervo->foto_cobertura_acervo))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->foto_cobertura_acervo) }}">
                                                    </div>
                                                </div>
                                            @endif
                                            @if(!is_null($acervo->plantas_situacao_acervo))
                                                <div class="owl-item" style="width: 450px; display: flex; justify-content: center; align-items: center; overflow: hidden">
                                                    <div>
                                                        <img alt="image" style="flex-shrink: 0; min-width: 100%; min-height: 100%" src="{{ asset($acervo->plantas_situacao_acervo) }}">
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
                                        <h5>{{ !is_null($acervo->nome_acervo) ? $acervo->nome_acervo : '-'}}</h5>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Nome da obra:</b> {{ !is_null($acervo->nome_acervo) ? $acervo->nome_acervo : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Logradouro:</b> {{ !is_null($acervo->endereco_acervo) ? $acervo->endereco_acervo : '-' }} Nᵒ {{ !is_null($acervo->numero_endereco_acervo) ? $acervo->numero_endereco_acervo : '-'}} - {{ !is_null($acervo->bairro_acervo) ? $acervo->bairro_acervo : '-'}} - {{ !is_null($acervo->cidade_acervo) ? $acervo->cidade_acervo : '-'}} - {{ !is_null($acervo->UF_acervo) ? $acervo->UF_acervo : '-'}} CEP: {{ !is_null($acervo->cep_acervo) ? $acervo->cep_acervo : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <b>Breve descrição da fachada e planta:</b> {{ !is_null($acervo->descricao_fachada_planta_acervo) ? $acervo->descricao_fachada_planta_acervo : '-' }}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <b>Estado de conservação:</b> {{ !is_null($acervo->titulo_estado_conservacao_acervo) ? $acervo->titulo_estado_conservacao_acervo : '-'}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Século:</b> {{ !is_null($acervo->titulo_seculo) ? $acervo->titulo_seculo : '-'}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Ano de construção:</b> {{ !is_null($acervo->ano_construcao_acervo) ? $acervo->ano_construcao_acervo : '-'}}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Tombamento:</b> {{ !is_null($acervo->titulo_tombamento) ? $acervo->titulo_tombamento : '-'}}
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <b>Cadastrado por:</b> {{ !is_null($acervo->usuario_cadastrante) ? $acervo->usuario_cadastrante : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Cadastrado em:</b> {{ !is_null($acervo->created_at) ? $acervo->created_at : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Revisado por:</b> {{ !is_null($acervo->usuario_revisor) ? $acervo->usuario_revisor : '-' }}
                                    </div>
                                    <div class="form-group col-md-3">
                                        <b>Revisado em:</b> {{ !is_null($acervo->updated_at) ? $acervo->updated_at : '-' }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection