@extends('layouts.app')

@section('template_title')
    Comida
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span id="card_title">
                                {{ __('Comida') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('comida.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        <th>Nombre</th>
                                        <th>Calorias</th>
                                        <th>Imagen</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comidas as $comida)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td>{{ $comida->nombre }}</td>
                                            <td>{{ $comida->calorias }}</td>
                                            <td><center><img src="{{ asset($comida->imagen) }}" alt="{{ $comida->title }}"  style="max-width: 100px; height: 100px;"></center></td>
                                            <td>
                                                <form action="{{ route('comida.destroy', $comida->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary" href="{{ route('comida.show', $comida->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('comida.edit', $comida->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                            <td>
                                                <input type="checkbox" name="selected[]" value="{{ $comida->id }}" onchange="calculateCalories()">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="calories-container">
                    Total de calorías seleccionadas: <span id="total-calories">0</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        function calculateCalories() {
            var checkboxes = document.querySelectorAll('input[name="selected[]"]');
            var totalCalories = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var row = checkbox.closest('tr');
                    var calories = parseInt(row.querySelector('td:nth-child(3)').textContent);

                    totalCalories += calories;
                }
            });

            document.getElementById('total-calories').textContent = totalCalories;
        }
    </script>
@endsection
