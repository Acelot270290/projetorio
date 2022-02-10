@extends('layouts.app')

@section('titulo', 'Usuários cadastrados')

@section('content')
<div class="main-content">

          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Usuários</h4>
                  <div class="card-header-form">
                    <form>
                    
                    </form>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-user">
                      <thead>
                        
                        <th style="padding-left:25px; text-align: center;">Id</th>
                        <th style="text-align: center;">Foto</th>
                        <th>Nome</th>
                        <th>Função</th>
                        <th>Ativo</th>
                        <th>Ações</th>
                      </tr>
                      </thead>
                      </tbody>
                      @foreach ($usuarios as $usuario )
                      
                      
                          
                      
                        <td style="padding-left:25px; text-align: center;">{{$usuario->id}}</td>
                        <td class="align-middle" style="text-align: center;">
                          @if($usuario->image)
                          <img class="team-member team-member-sm rounded-circle"
                                src="{{url('assets/img/users/' .$usuario->image)}}" alt="user" data-toggle="tooltip" title=""
                                data-original-title="{{$usuario->name}}">
                          @else
                          <img class="team-member team-member-sm rounded-circle"
                                src="{{url('assets/img/users/semfoto.jpg')}}" alt="user" data-toggle="tooltip" title=""
                                data-original-title="{{$usuario->name}}">
                          @endif
                        </td>
                        <td>{{$usuario->name}}</td>
                        <td>{{$usuario->nome_cargo}}</td>
                        <td>
                          @if($usuario->estado == 1)
                            <div class="badge badge-success">Ativo</div>
                          @else
                            <div class="badge badge-danger">Intaivo</div>
                          @endif
                        </td>
                        <td>
                        
                        <a href="#" class="btn btn-outline-primary">Editar</a>
                        <a href="#" class="btn btn-outline-danger">Deletar</a>
                        
                        </td>
                      </tr>
                      @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>

@endsection