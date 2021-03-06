@extends('layouts.menu')

@section('content')

    @if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="glyphicon glyphicon-ok"></span>
            {!! session('success_message') !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

    <!-- BEGIN HORIZONTAL FORM -->
        <div class="row">
            <div class="col-lg-12">
                <form method="POST" action="" accept-charset="UTF-8">
                    <input name="_method" value="DELETE" type="hidden">
                    {{ csrf_field() }}
                    <div class="card">
                        <div class="card-head style-primary">
                            <header>Lista de Eleitores</header>
                            <div class="tools">
                                <div class="btn-group">
                                    <a href="{{ route('cliente.cliente.create') }}" class="btn btn-primary" title="Novo Eleitor">
                                        <span class="glyphicon glyphicon-th-list" aria-hidden="true"></span>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--Accordion -->
                        <div class="col-md-12">
                            <div class="panel-group" id="accordion">
                                <div class="card panel">
                                    <div class="card-head card-head-xs collapsed" data-toggle="collapse" data-parent="#accordion7" data-target="#accordion7-1">
                                        <header>Filtro</header>
                                        <div class="tools">
                                            <a class="btn btn-icon-toggle"><i class="fa fa-angle-down"></i></a>
                                        </div>
                                    </div>
                                    <div id="accordion7-1" class="collapse">
                                        <div class="card-body">

                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="nome" class="col-sm-2 control-label">Nome:</label>
                                                        <div class="col-md-10">
                                                            <input class="form-control input-sm" name="name" type="text" id="name" maxlength="20" placeholder="Nome">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <label for="bairro_id" class="col-md-2 control-label text-bold">Bairro: *</label>
                                                        <div class="col-md-10">
                                                            <select   class="form-control input-sm" id="bairro_id" name="bairro_id">
                                                                <option value="" style="display: nosne;" {{ old('bairro_id', isset($cliente->bairro_id) ? $cliente->bairro_id : '') == '' ? 'selected' : '' }}  selected>Selecdione um Bairros</option>
                                                                @foreach ($bairros as $key => $bairro)
                                                                    <option value="{{ $key }}" {{ old('bairro_id', isset($cliente->bairro_id) ? $cliente->bairro_id : null) == $key ? 'selected' : '' }}>
                                                                        {{ $bairro }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            {!! $errors->first('bairro_id', '<p class="help-block">:message</p>') !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <div class="col-md-8">
                                                            <a href="#" type="button" id="localizar" class="btn btn-sm btn-flat btn-primary ink-reaction">Localizar</a>
                                                            <input class="btn btn-sm btn-primary"  id="limpar" type="button" value="Limpar">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end .panel -->
                            </div><!--end .panel-group -->


                            <div class="row">
                            <div class="col-lg-12">
                                <div class="panel-body panel-body-with-table">
                                    <div class="table-responsive">
                                        <table id="cliente" class="table order-column hover">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nome</th>
                                                    <th>Telefone</th>
                                                    <th>Bairro</th>
                                                    <th>Colégio Eleitoral</th>
                                                    <th>Ação</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div><!--end .table-responsive -->
                                </div>
                            </div><!--end .col -->
                        </div><!--end .row -->
                        <!-- END DATATABLE 1 -->




                        <div class="card-actionbar">
                            <div class="card-actionbar-row">
                                <a href="{{ route('cliente.cliente.create') }}" type="button" class="btn btn-flat btn-primary ink-reaction">Novo Eleitor</a>
                            </div>
                        </div>



                    </div><!--end .card -->

                </form>
            </div><!--end .col -->
        </div><!--end .row -->
        <!-- END HORIZONTAL FORM -->


@endsection

@section('javascript')
    <script src="{{ asset('/js/mascaras.js')}}" type="text/javascript"></script>
    <script src="{{ asset('/js/cliente/index.js')}}" type="text/javascript"></script>

@stop