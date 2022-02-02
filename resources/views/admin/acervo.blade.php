@extends('layouts.app')

@section('content')

<div class="main-content" style="min-height: 562px;">
  <section class="section">
    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <form method="POST" name="form_core" id="form_core" accept-charset="utf-8"  enctype="multipart/form-data">
            @crsf
              <div class="card-header">
                <h4> Adicionar Acervo </h4>
              </div>
              <div class="card-body">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Nome do monumento</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-user text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="nome_monumento" value="">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-2">
                    <label>CEP</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-map-marker-alt text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control cep" name="user_cep"
                        value="25780-000" maxlength="9">
                    </div>
                    <div id="user_cep"></div>
                  </div>
                  <div class="form-group col-md-8">
                    <label>Endereço</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-road text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="user_endereco"
                        value="Camboatá" readonly="">
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Número</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-street-view text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="user_numero_endereco"
                        value="288">
                    </div>
                  </div>
                  <div class="form-row">
                  </div>
                  <div class="form-group col-md-4">
                    <label>Bairro</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-directions text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="user_bairro" value="Camboatá"
                        readonly="">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Cidade</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-location-arrow text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control" name="user_cidade"
                        value="São José do Vale do Rio Preto" readonly="">
                    </div>
                  </div>
                  <div class="form-group col-md-2">
                    <label>Estado</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-map text-info"></i>
                        </div>
                      </div>
                      <input type="text" class="form-control uf" name="user_estado" value="RJ"
                        readonly="" maxlength="2">
                    </div>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <label>Ano de Construção</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-check-circle text-info"></i>
                        </div>
                      </div>
                      <input type="number" class="form-control" name="ano_construcao" value="">
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label>Estado de Conservação</label>
                    <select class="form-control">
                      <option>Option 1</option>
                      <option>Option 2</option>
                      <option>Option 3</option>
                    </select>
                  </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label>Especificações</label>
                        <div style="display: flex; flex-wrap: wrap;">
                            <div class="pretty p-icon p-smooth" style="display: flex; flex-wrap: wrap; margin-right: 10px;">
                                <input type="checkbox" style="margin-top: 3px;">
                                <div class="state p-success">
                                    <label style="margin-left: 10px;">Excelente</label>
                                </div>
                            </div>
                            <div class="pretty p-icon p-smooth" style="display: flex; flex-wrap: wrap; margin-right: 10px;">
                                <input type="checkbox" style="margin-top: 3px;">
                                <div class="state p-success">
                                    <label style="margin-left: 10px;">Smithers</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <label>Breve descrição da fachada e planta</label>
                    <textarea class="form-control" name="anuncio_descricao" style="min-height: 200px;"></textarea>
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-3">
                    <label>Foto Frontal</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text">
                          <i class="fas fa-image text-info"></i>
                        </div>
                      </div>
                      <input type="file" class="form-control" name="foto_frontal_acervo" form="form_core">
                    </div>
                    <div id="user_foto"></div>
                  </div>
                  <div class="form-group col-md-3">
                    <input type="hidden" name="usuario_id" value="3">
                  </div>

                </div>
              <!--  <div class="form-row">
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
              </div>-->
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
  <div class="settingSidebar">
    <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
    </a>
    <div class="settingSidebar-body ps-container ps-theme-default" tabindex="2"
      style="overflow: hidden; outline: none;">
      <div class=" fade show active">
        <div class="setting-panel-header">Setting Panel
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Select Layout</h6>
          <div class="selectgroup layout-color w-50">
            <label class="selectgroup-item">
            <input type="radio" name="value" value="1" class="selectgroup-input-radio select-layout"
              checked="">
            <span class="selectgroup-button">Light</span>
            </label>
            <label class="selectgroup-item">
            <input type="radio" name="value" value="2" class="selectgroup-input-radio select-layout">
            <span class="selectgroup-button">Dark</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Sidebar Color</h6>
          <div class="selectgroup selectgroup-pills sidebar-color">
            <label class="selectgroup-item">
            <input type="radio" name="icon-input" value="1" class="selectgroup-input select-sidebar">
            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
              data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
            </label>
            <label class="selectgroup-item">
            <input type="radio" name="icon-input" value="2" class="selectgroup-input select-sidebar"
              checked="">
            <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
              data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <h6 class="font-medium m-b-10">Color Theme</h6>
          <div class="theme-setting-options">
            <ul class="choose-theme list-unstyled mb-0">
              <li title="white" class="active">
                <div class="white"></div>
              </li>
              <li title="cyan">
                <div class="cyan"></div>
              </li>
              <li title="black">
                <div class="black"></div>
              </li>
              <li title="purple">
                <div class="purple"></div>
              </li>
              <li title="orange">
                <div class="orange"></div>
              </li>
              <li title="green">
                <div class="green"></div>
              </li>
              <li title="red">
                <div class="red"></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
              id="mini_sidebar_setting">
            <span class="custom-switch-indicator"></span>
            <span class="control-label p-l-10">Mini Sidebar</span>
            </label>
          </div>
        </div>
        <div class="p-15 border-bottom">
          <div class="theme-setting-options">
            <label class="m-b-0">
            <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
              id="sticky_header_setting">
            <span class="custom-switch-indicator"></span>
            <span class="control-label p-l-10">Sticky Header</span>
            </label>
          </div>
        </div>
        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
          <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
          <i class="fas fa-undo"></i> Restore Default
          </a>
        </div>
      </div>
    </div>
    <div id="ascrail2001" class="nicescroll-rails nicescroll-rails-vr"
      style="width: 8px; z-index: 999; cursor: default; position: absolute; top: 0px; left: 272px; height: 248px; display: block; opacity: 0;">
      <div class="nicescroll-cursors"
        style="position: relative; top: 0px; float: right; width: 6px; height: 100px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px;">
      </div>
    </div>
    <div id="ascrail2001-hr" class="nicescroll-rails nicescroll-rails-hr"
      style="height: 8px; z-index: 999; top: 240px; left: 0px; position: absolute; cursor: default; display: none; width: 272px; opacity: 0;">
      <div class="nicescroll-cursors"
        style="position: absolute; top: 0px; height: 6px; width: 280px; background-color: rgb(66, 66, 66); border: 1px solid rgb(255, 255, 255); background-clip: padding-box; border-radius: 5px; left: 0px;">
      </div>
    </div>
  </div>
</div>      
   

@endsection