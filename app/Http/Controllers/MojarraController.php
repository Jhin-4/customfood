<?php

namespace App\Http\Controllers;

use App\Models\Mojarra;
use Illuminate\Http\Request;

/**
 * Class MojarraController
 * @package App\Http\Controllers
 */
class MojarraController extends Controller
{
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
        request()->validate(Mojarra::$rules);

        $mojarra = Mojarra::create($request->all());

        return redirect()->route('mojarras.index')
            ->with('success', 'Mojarra created successfully.');
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

        return redirect()->route('mojarras.index')
            ->with('success', 'Mojarra deleted successfully');
    }
}
