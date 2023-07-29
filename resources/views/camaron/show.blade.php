@extends('layouts.app')

@section('template_title')
    {{ $camaron->name ?? "{{ __('Show') Camaron" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Camaron</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('camarons.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $camaron->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Calorias:</strong>
                            {{ $camaron->calorias }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            {{ $camaron->imagen }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
