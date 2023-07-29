<?php

namespace App\Http\Controllers;

use App\Models\Camaron;
use Illuminate\Http\Request;

/**
 * Class CamaronController
 * @package App\Http\Controllers
 */
class CamaronController extends Controller
{
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
        request()->validate(Camaron::$rules);

        $camaron = Camaron::create($request->all());

        return redirect()->route('camarons.index')
            ->with('success', 'Camaron created successfully.');
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

        return redirect()->route('camarons.index')
            ->with('success', 'Camaron deleted successfully');
    }
}
