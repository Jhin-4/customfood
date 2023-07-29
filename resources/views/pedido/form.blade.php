<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('comida') }}
            {{ Form::text('comida', $pedido->comida, ['class' => 'form-control' . ($errors->has('comida') ? ' is-invalid' : ''), 'placeholder' => 'Comida']) }}
            {!! $errors->first('comida', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('complemento1') }}
            {{ Form::text('complemento1', $pedido->complemento1, ['class' => 'form-control' . ($errors->has('complemento1') ? ' is-invalid' : ''), 'placeholder' => 'Complemento1']) }}
            {!! $errors->first('complemento1', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('complemento2') }}
            {{ Form::text('complemento2', $pedido->complemento2, ['class' => 'form-control' . ($errors->has('complemento2') ? ' is-invalid' : ''), 'placeholder' => 'Complemento2']) }}
            {!! $errors->first('complemento2', '<div class="invalid-feedback">:message</div>') !!}
        </div>

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>