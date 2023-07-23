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

                        @auth    <div class="float-right">
                                <a href="{{ route('comida.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div> @endauth
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
                                            <td>
                                                <center>
                                                    <img src="{{ asset($comida->imagen) }}" alt="{{ $comida->title }}" style="max-width: 100px; height: 100px;">
                                                </center>
                                            </td>
                                            <td>
                                              <form action="{{ route('comida.destroy', $comida->id) }}" method="POST">
                                              @auth   <a class="btn btn-sm btn-primary" href="{{ route('comida.show', $comida->id) }}">
                                                        <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                                    </a>@endauth 
                                                    @auth   <a class="btn btn-sm btn-success" href="{{ route('comida.edit', $comida->id) }}">
                                                        <i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}
                                                    </a>@endauth 
                                                    @csrf
                                                    @method('DELETE')
                                                    @auth    <button type="submit" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                    </button>@endauth 
                                                </form>
                                            </td>
                                            <td>
                                                <!-- Checkbox personalizado -->
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" name="selected[]" value="{{ $comida->id }}" onchange="calculateCalories()">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div id="calories-container" style="font-size: 24px; font-weight: bold; color: green;">
                    Total de calorías seleccionadas: <span id="total-calories" style="font-size: 24px; font-weight: bold; color: black;">0</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <!-- Formulario para enviar pedidos -->
                <form action="{{ route('comida.guardarpedido') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                </form>
                <br>
                                <!-- Formulario para enviar pedidos -->
                 @auth               <form action="{{ route('comida.guardarpedido') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <button type="submit" class="btn btn-primary">Revisar pedidos</button>
                </form> @endauth
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
        updateSelectedIds();
    }

    function updateSelectedIds() {
        var checkboxes = document.querySelectorAll('input[name="selected[]"]');
        var selectedIds = [];

        checkboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedIds.push(checkbox.value);
            }
        });

        // Filtrar los elementos vacíos antes de asignarlos al campo oculto
        selectedIds = selectedIds.filter(function(id) {
            return id !== '';
        });

        document.getElementById('selected_ids').value = selectedIds.join(',');
    }
</script>

@endsection
