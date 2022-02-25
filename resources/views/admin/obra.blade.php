@extends('layouts.app')

@section('titulo', 'Obras cadastradas')

<div class="main-content">
@section('content')

    {!! csrf_field() !!}
         
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4>Obras</h4>
                  <div class="card-header-form">
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped" id="table-obras"> 
                      <thead>
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
                      </thead>
                      <tbody>
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
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>

    <script>

    $(".deletanovo").click(function (e) {
  e.preventDefault();
  let id_obra = $(this).attr('id');
  let titulo_obra = $(this).attr('name');
  var botao = $(this);
  console.log(id_obra);
  console.log(titulo_obra);
  console.log(botao);

  swal({
    title: 'Tem certeza?',
    text: 'Deseja deletar a obra '+titulo_obra+ '?',
    icon: 'warning',
    buttons: true,
    dangerMode: true,
  })
    .then((willDelete) => {
      if (willDelete) {
        $.ajax({
          url: '/obra/deletar/'+ id_obra,
          type: 'POST',
          headers: {
								'X-CSRF-TOKEN': $('input[name=_token]').val()

						}}).done(function(data) {
						if(data.status == 'success')
						{
              swal('Sucesso!', data.msg, 'success');
               botao.parent().parent().remove();
              
              }else{
                    swal('Erro!', data.msg, 'error');
              }  
            });
         }
    });
});

    </script>

@endsection
