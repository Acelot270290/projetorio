@extends('layouts.app')

@section('titulo', 'Admin')

<div class="main-content">
@section('content')
<section class="section">
          <div class="row ">
            <div class="col-xl-2 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Usuários</h5>
                          <h2 class="mb-3 font-18">{{ $usuarios_total }}</h2>
                          @foreach ($estatisticasAcervo as $key => $estatisticaAcervo)
                            <p class="mb-0">&nbsp;</p>
                          @endforeach
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img style="max-width:140px; max-height:140px;" src="assets/img/banner/usuarios.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Acervos</h5>
                          <h2 class="mb-3 font-18">{{ $acervos_total }}</h2>
                            @foreach ($estatisticasAcervo as $key => $estatisticaAcervo)
                              <p class="mb-0">
                              @if($estatisticaAcervo > 0)
                              <span class="col-green">{{ $estatisticaAcervo }}</span> {{ $estatisticaAcervo > 1 ? 'acervos foram cadastrados' : 'acervo foi cadastrado' }} {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                              @else
                                @if($estatisticaAcervo < 0)
                                <span class="col-orange">{{ $estatisticaAcervo }}</span> {{ $estatisticaAcervo < 1 ? 'acervos foram descadastrados' : 'acervo foi descadastrado' }} {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                                @else
                                Nenhum acervo cadastrado {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                                @endif
                              @endif
                              </p>
                            @endforeach
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img style="max-width:140px; max-height:140px;" src="assets/img/banner/acervos.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-5 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-7 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Obras</h5>
                          <h2 class="mb-3 font-18">{{ $obras_total }}</h2>
                          @foreach ($estatisticasObra as $key => $estatisticaObra)
                              <p class="mb-0">
                              @if($estatisticaObra > 0)
                              <span class="col-green">{{ $estatisticaObra }}</span> {{ $estatisticaObra > 1 ? 'obras foram cadastradas' : 'obra foi cadastrada' }} {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                              @else
                                @if($estatisticaObra < 0)
                                <span class="col-orange">{{ $estatisticaObra }}</span> {{ $estatisticaObra < 1 ? 'obras foram descadastradas' : 'obra foi descadastrada' }} {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                                @else
                                Nenhuma obra cadastrada {{ $key > 1 ? 'nos últimos ' . $key . ' dias' : 'no último dia' }}.
                                @endif
                              @endif
                              </p>
                            @endforeach
                        </div>
                      </div>
                      <div class="col-lg-5 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img style="max-width:140px; max-height:140px;" src="assets/img/banner/obras.svg" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Últimas 10 obras cadastradas</h4>
                  <div class="card-header-form"></div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th style="padding-left:25px; text-align: center;">Id</th>
                        <th style="text-align: center;">Foto Principal</th>
                        <th>Título</th>
                        <th>Tesauro</th>
                        <th>Acervo</th>
                        <th>Material</th>
                        <th>Século</th>
                        <th>Ações</th>
                      </tr>
                      @foreach ($obras as $obra)
                      <tr>
                        <td style="padding-left:25px; text-align: center;">{{ $obra->id }}</td>
                        <td class="align-middle text-center">
                          <a href="{{ route('detalhar_obra', ['id' => $obra->id]) }}">
                          @if($obra->foto_frontal_obra)
                            <img class="team-member-sm" src="{{ asset($obra->foto_frontal_obra) }}" alt="obra_{{ $obra->id }}" data-toggle="tooltip" title="obra_{{ $obra->id }}" data-original-title="Foto frontal">
                            @else
                            <img class="team-member-sm" src="{{ asset('img/noimg.png') }}" alt="obra_{{ $obra->id }}" data-toggle="tooltip" title="obra_{{ $obra->id }}" data-original-title="Foto frontal">
                            @endif
                          </a>
                        </td>
                        <td>{{ $obra->titulo_obra }}</td>
                        <td>{{ $obra->titulo_tesauro }}</td>
                        <td>{{ $obra->nome_acervo }}</td>
                        <td>{{ $obra->titulo_material_1 }}</td>
                        <td>{{ $obra->titulo_seculo }}</td>
                        <td id="interacoes">
                          <a href="{{ route('detalhar_obra', ['id' => $obra->id]) }}" class="btn btn-outline-success"><i class="far fa-eye"></i></a>
                          <a href="{{ route('editar_obra', ['id' => $obra->id]) }}" class="btn btn-outline-primary"><i class="fas fa-edit"></i></a>
                          <a href="#" class="btn btn-danger deletanovo" id="{{ $obra->id }}"  name="{{ $obra->titulo_obra }}"><i class="fas fa-trash"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

    </div>

@endsection
