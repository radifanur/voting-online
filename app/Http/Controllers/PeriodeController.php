<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all();
        return view('periode.index', [
            'periode' => $periode
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request -> validate([
            'tahun' => 'required',
            'mulai' => 'required',
            'akhir' => 'required'
        ]);

        Periode::create([
            'tahun' => $request->tahun,
            'mulai' => $request->mulai,
            'akhir' => $request->akhir,
        ]);
        return redirect()->route('periode.index')
        ->with('success', 'Periode Berhasil Ditambahkan');
        // dd($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show(Periode $periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Periode::find($id);
        return view('periode.edit',[
            'edit' => $edit
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request -> validate([
            'tahun' => 'required',
            'mulai' => 'required',
            'akhir' => 'required'
        ]);

        $periode = Periode::find($id);

        $periode->update([
            'tahun' => $request->tahun,
            'mulai' => $request->mulai,
            'akhir' => $request->akhir,
        ]);
        return redirect()->route('periode.index')
        ->with('success', 'Periode Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Periode::find($id);
        $delete->delete();
        return redirect()->route('periode.index')
        ->with('success', 'Periode Berhasil Dihapus');
    }
}
