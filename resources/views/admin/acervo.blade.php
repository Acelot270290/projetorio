@extends('layouts.app')

@section('titulo', 'Acervos cadastrados')

<div class="main-content">
@section('content')

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Acervos</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary" style="height: 31px;"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <tr>
                        <th class="text-center">
                        </th>
                        <th class="text-center">Id</th>
                        <th class="text-center">Fachada Principal</th>
                        <th>Nome</th>
                        <th>Cidade</th>
                        <th>UF</th>
                        <th>Século</th>
                        <th>Ano de construção</th>
                        <th>Ações</th>
                      </tr>
                      <tr>
                      @foreach ($acervos as $acervo)
                        <td> </td>
                        <td class="text-center">{{$acervo->id}}</td>
                        <td class="align-middle text-center">
                          <a href="{{route('detalhar_acervo', ['id' => $acervo->id])}}">
                          @if($acervo->foto_frontal_acervo)
                            <img class="team-member-sm"
                                  src="{{url($acervo->foto_frontal_acervo)}}" alt="acervo_{{$acervo->id}}" data-toggle="tooltip" title="acervo_{{$acervo->id}}"
                                  data-original-title="Foto frontal">
                            @else
                            <img class="team-member-sm"
                                  src="{{url('assets/img/noimg.png')}}" alt="acervo_{{$acervo->id}}" data-toggle="tooltip" title="acervo_{{$acervo->id}}"
                                  data-original-title="Foto frontal">
                            @endif
                          </a>
                        </td>
                        <td>{{$acervo->nome_acervo}}</td>
                        <td>{{$acervo->cidade_acervo}}</td>
                        <td>{{$acervo->UF_acervo}}</td>
                        <td>{{$acervo->titulo_seculo}}</td>
                        <td>{{$acervo->ano_construcao_acervo}}</td>
                        <td>
                          <a href="{{route('detalhar_acervo', ['id' => $acervo->id])}}" class="btn btn-outline-success">Visualizar</a>
                          <a href="{{route('editar_acervo', ['id' => $acervo->id])}}" class="btn btn-outline-primary">Editar</a>
                          <a href="#" class="btn btn-outline-danger">Deletar</a>
                        </td>
                      </tr>
                      @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>

@endsection