@extends('layouts.app')

@section('titulo', 'Admin')

<div class="main-content">
@section('content')
<section class="section">
          <div class="row ">
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Usuários</h5>
                          <h2 class="mb-3 font-18">{{ $usuarios_total }}</h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/1.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Acervos</h5>
                          <h2 class="mb-3 font-18">{{ $acervos_total }}</h2>
                          <p class="mb-0"><span class="col-orange">09%</span> Decrease</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/2.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Obras</h5>
                          <h2 class="mb-3 font-18">{{ $obras_total }}</h2>
                          <p class="mb-0"><span class="col-green">18%</span>
                            Increase</p>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="assets/img/banner/3.png" alt="">
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
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
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
