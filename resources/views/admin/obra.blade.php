@extends('layouts.app')

@section('titulo', 'Obras cadastradas')

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
                        <th>Título</th>
                        <th>Tesauro</th>
                        <th>Acervo</th>
                        <th>Material</th>
                        <th>Século</th>
                        <th>Ações</th>
                      </tr>
                      <tr>
                      @foreach ($obras as $obra)
                        <td> </td>
                        <td class="text-center">{{ $obra->id }}</td>
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
                        <td>
                          <a href="{{route('detalhar_obra', ['id' => $obra->id])}}" class="btn btn-outline-success">Visualizar</a>
                          <a href="{{route('editar_obra', ['id' => $obra->id])}}" class="btn btn-outline-primary">Editar</a>
                          <a href="#" class="btn btn-danger" data-toggle="modal" data-target="#deleteObra">Deletar</a>
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

@include('modal.deleteObraModal')
@endsection
