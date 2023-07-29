@@ -1,7 +1,7 @@
@extends('layouts.app')

@section('template_title')
    Mojarra
    Comida
@endsection

@section('content')
@ -11,16 +11,17 @@
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Mojarra') }}
                                {{ __('Comida') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('mojarra.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                        @auth
                            <div class="float-right">
                                <a href="{{ route('mojarra.create') }}" class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                              </div>
                            </div>
                        @endauth
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
@ -35,11 +36,9 @@
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Nombre</th>
										<th>Calorias</th>
										<th>Imagen</th>

                                        <th>Nombre</th>
                                        <th>Calorias</th>
                                        <th>Imagen</th>
                                        <th></th>
                                    </tr>
                                </thead>
@ -47,29 +46,87 @@
                                    @foreach ($mojarras as $mojarra)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $mojarra->nombre }}</td>
											<td>{{ $mojarra->calorias }}</td>
											<td>{{ $mojarra->imagen }}</td>

                                            <td>{{ $mojarra->nombre }}</td>
                                            <td>{{ $mojarra->calorias }}</td>
                                            <td>
                                                <center>
                                                    <img src="{{ asset($mojarra->imagen) }}" alt="{{ $mojarra->title }}" style="max-width: 100px; height: 100px;">
                                                </center>
                                            </td>
                                            <td>
                                                <form action="{{ route('mojarra.destroy',$mojarra->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('mojarra.show',$mojarra->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('mojarra.edit',$mojarra->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                <form action="{{ route('mojarra.destroy', $mojarra->id) }}" method="POST">
                                                    @auth
                                                        <a class="btn btn-sm btn-primary" href="{{ route('mojarra.show', $mojarra->id) }}">
                                                            <i class="fa fa-fw fa-eye"></i> {{ __('Show') }}
                                                        </a>
                                                        <a class="btn btn-sm btn-success" href="{{ route('mojarra.edit', $mojarra->id) }}">
                                                            <i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}
                                                        </a>
                                                    @endauth 
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                    @auth
                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                            <i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}
                                                        </button>
                                                    @endauth 
                                                </form>
                                            </td>
                                            <td>
                                                <!-- Checkbox personalizado -->
                                                <label class="custom-checkbox">
                                                    <input type="checkbox" name="selected[]" value="{{ $mojarra->id }}" onchange="calculateCalories()">
                                                    <span class="checkmark"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <!-- Footer de la card con el botón "Información Nutricional" -->
                    <div class="card-footer">
                        <button class="btn btn-primary" onclick="showNutritionalInformation()">
                            Información Nutricional
                        </button>
                    </div>
                </div>
                {!! $mojarras->links() !!}

                <div id="calories-container" style="font-size: 24px; font-weight: bold; color: green;">
                    Total de calorías seleccionadas: <span id="total-calories" style="font-size: 24px; font-weight: bold; color: black;">0</span>
                </div>

                <!-- Formulario para enviar pedidos -->
                <form action="{{ route('mojarra.guardarpedido') }}" method="POST">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <button type="submit" class="btn btn-primary">Enviar Pedido</button>
                </form>
                <br>
                <!-- Visualizar pedidos -->
                @auth
                <form action="{{ route('mojarra.index') }}" method="GET">
                    @csrf
                    <input type="hidden" name="selected_ids" id="selected_ids">
                    <button type="submit" class="btn btn-primary">Revisar pedidos</button>
                </form>
                @endauth
            </div>
        </div>
    </div>

    <!-- Ventana modal para mostrar la información nutricional -->
    <div id="modal-container" class="modal">
        <div class="modal-content">
            <span class="close" onclick="hideModal()">&times;</span>
            <img src="{{ asset('images/1689692175-1689373217-PHOTO-2023-07-14-14-01-42.jpg') }}" alt="Información Nutricional">
        </div>
    </div>

    <!-- Referencia a los archivos CSS y JavaScript -->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <script src="{{ asset('css/script.js') }}"></script>

@endsection
