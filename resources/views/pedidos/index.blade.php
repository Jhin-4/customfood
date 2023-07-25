@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Listado de Pedidos</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Comida</th>
                            <th>Complemento 1</th>
                            <th>Complemento 2</th>
                            <th>Fecha de Creación</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pedidos as $pedido)
                            <tr>
                                <td>{{ $pedido->id }}</td>
                                <td>{{ $pedido->comida }}</td>
                                <td>{{ $pedido->complemento1 }}</td>
                                <td>{{ $pedido->complemento2 }}</td>
                                <td>{{ $pedido->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
