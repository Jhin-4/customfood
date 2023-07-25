<?php

namespace App\Http\Controllers;
use App\Models\Pedido; // Agregar esta línea
use App\Models\Comida;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class ComidaController
 * @package App\Http\Controllers
 */
class ComidaController extends Controller
{
    public function calculate(Request $request)
    {
        $selected = $request->input('selected', []);
        $totalCalories = 0;
        
        // Recorre los registros seleccionados y suma las calorías
        foreach ($selected as $id) {
            $comida = Comida::find($id);
            if ($comida) {
                $totalCalories += $comida->calorias;
            }
        }
        
        return response()->json([
            'totalCalories' => $totalCalories
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comidas = Comida::paginate();

        return view('comida.index', compact('comidas'))
            ->with('i', (request()->input('page', 1) - 1) * $comidas->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $comida = new Comida();
        return view('comida.create', compact('comida'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'imagen' => 'required|image|max:2048'
        ]);

        $comida = new Comida();


if( $request->hasFile('imagen')){
    $file=$request->file('imagen');
    $destinationpath='images/';
    $filename=time() . '-' . $file->getClientOriginalName();
    $uploadSucces=$request->file('imagen')->move($destinationpath, $filename);
    $comida->imagen =$destinationpath . $filename ;
}

        
        $comida->nombre = $request->input('nombre');
        $comida->calorias = $request->input('calorias');


       

        $comida->save();

        return redirect()->route('comida.index')
            ->with('success', 'Comida created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comida = Comida::find($id);

        return view('comida.show', compact('comida'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comida = Comida::find($id);

        return view('comida.edit', compact('comida'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Comida $comida
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comida $comida)
    {
        request()->validate(Comida::$rules);

        $comida->update($request->all());

        return redirect()->route('comida.index')
            ->with('success', 'Comida updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $comida = Comida::find($id)->delete();

        return redirect()->route('comida.index')
            ->with('success', 'Comida deleted successfully');
    }

    public function guardarPedido(Request $request)
    {
        $selectedIdsString = $request->input('selected_ids', '');
        $selectedIdsArray = explode(',', $selectedIdsString);

        $complemento1 = in_array('7', $selectedIdsArray) ? 'Verdura' : null;
        $complemento2 = in_array('8', $selectedIdsArray) ? 'Arroz' : null;

        DB::table('pedidos')->insert([
            'comida' => 'pechuga de pollo',
            'complemento1' => $complemento1,
            'complemento2' => $complemento2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Resto del código...

        return redirect()->route('comida.index')->with('success', 'Pedidos enviados correctamente.');
    }
    
}
