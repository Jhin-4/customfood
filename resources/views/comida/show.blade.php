@extends('layouts.app')

@section('template_title')
    {{ $comida->name ?? "{{ __('Show') Comida" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Comida</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('comida.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $comida->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Calorias:</strong>
                            {{ $comida->calorias }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            {{ $comida->imagen }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
