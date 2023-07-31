<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\Pedido; // Agregar esta línea
use App\Models\Camaron;
use Illuminate\Http\Request;

/**
 * Class CamaronController
 * @package App\Http\Controllers
 */
class CamaronController extends Controller
{
    public function calculate(Request $request)
    {
        $selected = $request->input('selected', []);
        $totalCalories = 0;
        
        // Recorre los registros seleccionados y suma las calorías
        foreach ($selected as $id) {
            $camaron = Camaron::find($id);
            if ($camaron) {
                $totalCalories += $camaron->calorias;
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
        $camarons = Camaron::paginate();

        return view('camaron.index', compact('camarons'))
            ->with('i', (request()->input('page', 1) - 1) * $camarons->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $camaron = new Camaron();
        return view('camaron.create', compact('camaron'));
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

        $camaron = new Camaron();


if( $request->hasFile('imagen')){
    $file=$request->file('imagen');
    $destinationpath='images/';
    $filename=time() . '-' . $file->getClientOriginalName();
    $uploadSucces=$request->file('imagen')->move($destinationpath, $filename);
    $camaron->imagen =$destinationpath . $filename ;
}

        
        $camaron->nombre = $request->input('nombre');
        $camaron->calorias = $request->input('calorias');


       

        $camaron->save();

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
        $camaron = Camaron::find($id);

        return view('camaron.show', compact('camaron'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $camaron = Camaron::find($id);

        return view('camaron.edit', compact('camaron'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Camaron $camaron
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Camaron $camaron)
    {
        request()->validate(Camaron::$rules);

        $camaron->update($request->all());

        return redirect()->route('camarons.index')
            ->with('success', 'Camaron updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $camaron = Camaron::find($id)->delete();

        return redirect()->route('camaron.index')
            ->with('success', 'Camaron deleted successfully');
    }
    public function guardarPedido(Request $request)
    {
        $selectedIdsString = $request->input('selected_ids', '');
        $selectedIdsArray = explode(',', $selectedIdsString);

        $complemento1 = in_array('1', $selectedIdsArray) ? 'Verdura' : null;
        $complemento2 = in_array('2', $selectedIdsArray) ? 'Arroz' : null;

        DB::table('pedidos')->insert([
            'comida' => 'Sopa de camaron',
            'complemento1' => $complemento1,
            'complemento2' => $complemento2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('comida.index')->with('success', 'Pedidos enviados correctamente.');
    }
}
