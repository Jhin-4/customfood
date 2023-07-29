@extends('layouts.app')

@section('template_title')
    Camaron
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Camaron') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('camaron.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    @foreach ($camarons as $camaron)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $camaron->nombre }}</td>
											<td>{{ $camaron->calorias }}</td>
											<td>{{ $camaron->imagen }}</td>

                                            <td>
                                                <form action="{{ route('camarons.destroy',$camaron->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('camarons.show',$camaron->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('camarons.edit',$camaron->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $camarons->links() !!}
            </div>
        </div>
    </div>
@endsection
