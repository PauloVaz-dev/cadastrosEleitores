<div class="card-body">

    <div class="col-lg-12">
        <h4 class="text-bold">Dados Pessoais</h4>
        <hr class="ruler-lg"/>
    </div>

    <div class="row col-md-12">
        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
            <label for="name" class="col-md-2 control-label text-bold">Nome.: *</label>
            <div class="col-md-10">
                <input class="form-control input-sm" name="name" type="text" id="name" value="{{ old('name', isset($cliente->name) ? $cliente->name : null) }}" maxlength="255" placeholder="Nome">
                {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
            <label for="address" class="col-md-2 control-label text-bold">Endereço.: *</label>
            <div class="col-md-10">
                <input class="form-control input-sm" name="address" type="text" id="address" value="{{ old('endereco', isset($cliente->address) ? $cliente->address : null) }}" maxlength="255" placeholder="Endereço">
                {!! $errors->first('address', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="form-group {{ $errors->has('phone01') ? 'has-error' : '' }}">
            <label for="phone01" class="col-md-2 control-label text-bold">Telefone.: *</label>
            <div class="col-md-10">
                <input class="form-control input-sm phone" name="phone01" type="text" id="address" value="{{ old('phone01', isset($cliente->phone01) ? $cliente->phone01 : null) }}" maxlength="255" placeholder="Telefone">
                {!! $errors->first('phone01', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>

    <div class="row col-md-12">
        <div class="form-group {{ $errors->has('bairro_id') ? 'has-error' : '' }}">
            <label for="colegio_eleitoral_id" class="col-md-2 control-label text-bold">Colégio Eleitoral: *</label>
            <div class="col-md-10">
                <select   class="form-control input-sm" id="colegio_eleitoral_id" name="colegio_eleitoral_id">
                    <option value="" style="display: none;" {{ old('colegio_eleitoral_id', isset($cliente->colegio_eleitoral_id) ? $cliente->colegio_eleitoral_id : '') == '' ? 'selected' : '' }} disabled selected>Colégio Eleitoral</option>
                    @foreach ($colegiosEleitorais as $key => $colegioEleitoral)
                        <option value="{{ $key }}" {{ old('bairro_id', isset($cliente->colegio_eleitoral_id) ? $cliente->colegio_eleitoral_id : null) == $key ? 'selected' : '' }}>
                            {{ $colegioEleitoral }}
                        </option>
                    @endforeach
                </select>
                {!! $errors->first('colegio_eleitoral_id', '<p class="help-block">:message</p>') !!}
            </div>
        </div>
    </div>



    <div class="row col-md-12">
        <div class="form-group {{ $errors->has('bairro_id') ? 'has-error' : '' }}">
            <label for="bairro_id" class="col-md-2 control-label text-bold">Bairro: *</label>
            <div class="col-md-10">
                <select   class="form-control input-sm" id="bairro_id" name="bairro_id">
                    <option value="" style="display: none;" {{ old('bairro_id', isset($cliente->bairro_id) ? $cliente->bairro_id : '') == '' ? 'selected' : '' }} disabled selected>Bairros</option>
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

