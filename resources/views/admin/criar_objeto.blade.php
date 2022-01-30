@extends('layouts.app')

@section('content')

<div class="main-content" style="min-height: 562px;">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form method="POST" action="{{route('adicionar_acervo')}}" name="criar_acervo"  accept-charset="utf-8" enctype="multipart/form-data">
            @csrf
              <div class="card-header">
                <h4> Adicionar Objeto </h4>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Títulos</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-user text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="nome_objeto" value="">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Dimensões (cm)</label>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label>Altura</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-map-marker-alt text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="altura_objeto"
                        value="">
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Largura</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-road text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="largura_objeto"
                        value="">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Profundidade</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-road text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="profundidade_objeto"
                        value="">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Comprimento</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-road text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="comprimento_objeto"
                        value="">
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Diâmetro</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-street-view text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="diâmetro_objeto">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Tombamento</label>
                    <select name="tombamento_acervo" class="form-control">
                    @foreach ($tombamentos as $tombamento)
                        <option value="{{$tombamento->id}}">{{$tombamento->titulo_tombamento}}</option>
                    @endforeach
                      
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Século</label>
                    <select name="seculo_acervo" class="form-control">
                    @foreach ($seculos as $seculo)
                      @if($seculo->is_default_seculo)
                        <option value="{{$seculo->id}}" selected>{{$seculo->titulo_seculo}}</option>
                      @else
                        <option value="{{$seculo->id}}">{{$seculo->titulo_seculo}}</option>
                      @endif
                    @endforeach
                      
                    </select>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Ano</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-check-circle text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="ano_acervo" value="">
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label>Estado de Conservação</label>
                    <select name="estado_de_conservacao_acervo" class="form-control">
                      @foreach ($estados as $estado)
                        @if($estado->is_default_estado_conservacao_obras)
                          <option value="{{$estado->id}}" selected>{{$estado->titulo_estado_conservacao_obras}}</option>
                        @else
                          <option value="{{$estado->id}}">{{$estado->titulo_estado_conservacao_obras}}</option>
                        @endif
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-row">
                 <div class="form-group col-md-4">
                    <label>Material 1</label>
                    <select name="estado_de_conservacao_acervo" class="form-control">
                      <option value="">Selecione um Material</option>
                      @foreach ($materiais as $material)
                          <option value="{{$material->id}}">{{$material->titulo_material}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Material 2</label>
                    <select name="estado_de_conservacao_acervo" class="form-control">
                      <option value="">Selecione um Material</option>
                      @foreach ($materiais as $material)
                          <option value="{{$material->id}}">{{$material->titulo_material}}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <label>Material 3</label>
                    <select name="estado_de_conservacao_acervo" class="form-control">
                      <option value="">Selecione um Material</option>
                      @foreach ($materiais as $material)
                          <option value="{{$material->id}}">{{$material->titulo_material}}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Especificações</label>
                        <div style="display: flex; flex-wrap: wrap;">
                         @foreach ($especificacoes as $especificacao)
                          <div class="pretty p-icon p-smooth" style="display: flex; flex-wrap: wrap; margin-right: 10px;">
                              <input name="especificacao_acervo" type="checkbox" style="margin-top: 3px;" value="{{$especificacao->id}}">
                              <div class="state p-success">
                                  <label style="margin-left: 10px;">{{$especificacao->titulo_especificacao_obras}}</label>
                              </div>
                          </div>
                         @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Breve descrição da fachada e planta</label>
                    <textarea class="form-control" name="descricao_acervo" style="min-height: 200px;"></textarea>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                  <div class="form-group col-md-3">
                    <label>Avatar</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="user_foto_file">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <div id="box-foto-usuario">
                      <input type="hidden" name="user_foto"
                        value="8db47dc2764e22fae2e36627d4f3abdd.jpg">
                      <img width="100" alt="Usuário imagem"
                        src="https://infoanuncios.com.br/uploads/usuarios/8db47dc2764e22fae2e36627d4f3abdd.jpg"
                        class="rounded-circle">
                    </div>
                    <input type="hidden" name="usuario_id" value="3">
                  </div>
                </div>
              </div>
              <!-- Finalizar forms Acervos (estado de conservação e século (combombox), especificação (checkbox)) -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="https://infoanuncios.com.br/restrita/usuarios" class=" btn btn-dark">voltar</a>
              </div>
            </form>
          </div>
        </div>
        <!-- Home da área restrita -->
      </div>
    </div>
  </section>
</div>      
   

@endsection