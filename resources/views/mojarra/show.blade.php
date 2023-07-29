@extends('layouts.app')

@section('template_title')
    {{ $mojarra->name ?? "{{ __('Show') Mojarra" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Show') }} Mojarra</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('mojarras.index') }}"> {{ __('Back') }}</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Nombre:</strong>
                            {{ $mojarra->nombre }}
                        </div>
                        <div class="form-group">
                            <strong>Calorias:</strong>
                            {{ $mojarra->calorias }}
                        </div>
                        <div class="form-group">
                            <strong>Imagen:</strong>
                            {{ $mojarra->imagen }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
