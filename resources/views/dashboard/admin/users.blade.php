@extends('layouts.dashboard')
@push('HeaderScripts')
<!-- Header Personalizado [Modelo] -->
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="{{asset(mix('css/dashboard-control.min.css'))}}" rel="stylesheet" type="text/css">

<!-- /Header Personalizado [Modelo] -->
@endpush

@section('content')
    <!-- Conteudo Principal [Modelo] -->
    <div id="main">
        <div class="painel painel-admin">
            <h2>Filtro de Usuarios</h2>
            <div class="table-responsive">
                <form>
                    <div class="form-content">
                        <h2>Global search:</h2>
                        <div class="form-options">
                            <input class="global_filter" id="global_filter" type="text">
                            <input class="global_filter" id="global_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col0" data-column="0">
                        <h2>Por ID:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col0_filter" type="text">
                            <input class="column_filter" id="col0_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col0" data-column="1">
                        <h2>Por Nome:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col1_filter" type="text">
                            <input class="column_filter" id="col1_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col1" data-column="2">
                        <h2>Por Usuário:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col2_filter" type="text">
                            <input class="column_filter" id="col2_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col2" data-column="3">
                        <h2>Por Email:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col3_filter" type="text">
                            <input class="column_filter" id="col3_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col3" data-column="4">
                        <h2>Por Ativo:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col4_filter" type="text">
                            <input class="column_filter" id="col4_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                    <div class="form-content" id="filter_col4" data-column="5">
                        <h2>Por Data:</h2>
                        <div class="form-options">
                            <input class="column_filter" id="col5_filter" type="text">
                            <input class="column_filter" id="col5_smart" checked="checked" type="checkbox">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="painel painel-admin">
            <h2>Buscando Usuarios</h2>
            <div class="table-responsive">
                <table id="users" class="display table-datatables" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Ativo</th>
                            <th>Data de Cadastro</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Usuário</th>
                            <th>Email</th>
                            <th>Ativo</th>
                            <th>Data de Cadastro</th>
                            <th>#</th>
                        </tr>
                    </tfoot>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- /Conteudo Principal [Modelo] -->
@endsection

@push('FooterScripts')
<!-- Footer Personalizado [Modelo] -->
<script type="text/javascript" src="{{asset('dist/datatables/DataTables-1.10.16/js/jquery.dataTables.min.js')}}"></script>
<!-- Datatables -->
<script>
    function filterGlobal () {
        $('#users').DataTable().search(
            $('#global_filter').val(),
            $('#global_regex').prop('checked'),
            $('#global_smart').prop('checked')
        ).draw();
    }
    
    function filterColumn ( i ) {
        $('#users').DataTable().column( i ).search(
            $('#col'+i+'_filter').val(),
            $('#col'+i+'_regex').prop('checked'),
            $('#col'+i+'_smart').prop('checked')
        ).draw();
    }
	$(document).ready(function() {
		$('#users').dataTable( {
			responsive: true,
			responsive: {
				details: false
			},
			
			ajax: '{!! route('datatables.user') !!}',
			columns: [
				{ data: 'id', name: 'id'},
				{ data: 'nome', name: 'nome'},
				{ data: 'username', name: 'username'},
				{ data: 'email', name: 'email'},
				{ data: 'confirmed', name: 'confirmed'},
				{ data: 'created_at', name: 'created_at'},
				{ data: 'id', name: 'id'},
			],
			"paging":   true,
			"ordering": true,
			"info":     true,
			"searching": true,
			"bLengthChange": true,
			"pagingType": "simple_numbers",
			"lengthMenu": [[20, 50, 75, -1], [20, 50, 75, "All"]],
			"language": {
					"lengthMenu": "Mostrando _MENU_ entradas",
					"search": "Pesquisar:",
					"info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
					"emptyTable": "Sem dados disponíveis",
					"paginate": {
								"next": "<i class='fa fa-arrow-right'></i>",
								"previous": "<i class='fa fa-arrow-left'></i>"
								}
			},"columnDefs": [
				{
					"render": function ( data, type, row ) {
                        if(data == 1){
                            return 'Sim';
                        }else{
                            return 'Não';
                        }
					},
					"targets": [4]
                },
				{
					"render": function ( data, type, row ) {
                        return '<a href="#'+data+'" class="btn">Action</a>'
					},
					"targets": [6]
                },
            ]
        } );

        $('input.global_filter').on( 'keyup click', function () {
            filterGlobal();
        } );
    
        $('input.column_filter').on( 'keyup click', function () {
            filterColumn( $(this).parents('div.form-content').attr('data-column') );
        } );
	} );
</script>
@endpush