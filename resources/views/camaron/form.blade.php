<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('nombre') }}
            {{ Form::text('nombre', $camaron->nombre, ['class' => 'form-control' . ($errors->has('nombre') ? ' is-invalid' : ''), 'placeholder' => 'Nombre']) }}
            {!! $errors->first('nombre', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('calorias') }}
            {{ Form::text('calorias', $camaron->calorias, ['class' => 'form-control' . ($errors->has('calorias') ? ' is-invalid' : ''), 'placeholder' => 'Calorias']) }}
            {!! $errors->first('calorias', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
        {{ Form::label('imagen', 'Imagen') }}
            {{ Form::file('imagen', ['class' => 'form-control-file' . ($errors->has('imagen') ? ' is-invalid' : '')]) }}
            {!! $errors->first('imagen', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>