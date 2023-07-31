<?php

namespace App\Http\Controllers;
use App\Models\Pedido; // Agregar esta línea
use App\Models\Mojarra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Class MojarraController
 * @package App\Http\Controllers
 */
class MojarraController extends Controller
{
    public function calculate(Request $request)
    {
        $selected = $request->input('selected', []);
        $totalCalories = 0;
        
        // Recorre los registros seleccionados y suma las calorías
        foreach ($selected as $id) {
            $mojarra = Comida::find($id);
            if ($mojarra) {
                $totalCalories += $mojarra->calorias;
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
        $mojarras = Mojarra::paginate();

        return view('mojarra.index', compact('mojarras'))
            ->with('i', (request()->input('page', 1) - 1) * $mojarras->perPage());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $mojarra = new Mojarra();
        return view('mojarra.create', compact('mojarra'));
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

        $mojarra = new Mojarra();


if( $request->hasFile('imagen')){
    $file=$request->file('imagen');
    $destinationpath='images/';
    $filename=time() . '-' . $file->getClientOriginalName();
    $uploadSucces=$request->file('imagen')->move($destinationpath, $filename);
    $mojarra->imagen =$destinationpath . $filename ;
}

        
        $mojarra->nombre = $request->input('nombre');
        $mojarra->calorias = $request->input('calorias');


       

        $mojarra->save();

        return redirect()->route('mojarra.index')
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
        $mojarra = Mojarra::find($id);

        return view('mojarra.show', compact('mojarra'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $mojarra = Mojarra::find($id);

        return view('mojarra.edit', compact('mojarra'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  Mojarra $mojarra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Mojarra $mojarra)
    {
        request()->validate(Mojarra::$rules);

        $mojarra->update($request->all());

        return redirect()->route('mojarras.index')
            ->with('success', 'Mojarra updated successfully');
    }

    /**
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $mojarra = Mojarra::find($id)->delete();

        return redirect()->route('mojarra.index')
            ->with('success', 'Mojarra deleted successfully');
    }
    
    public function guardarPedido(Request $request)
    {
        $selectedIdsString = $request->input('selected_ids', '');
        $selectedIdsArray = explode(',', $selectedIdsString);

        $complemento1 = in_array('1', $selectedIdsArray) ? 'Verdura' : null;
        $complemento2 = in_array('4', $selectedIdsArray) ? 'Arroz' : null;

        DB::table('pedidos')->insert([
            'comida' => 'Sopa de camaron',
            'complemento1' => $complemento1,
            'complemento2' => $complemento2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        return redirect()->route('mojarra.index')->with('success', 'Pedidos enviados correctamente.');
    }
    
}
