<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kandidat = Kandidat::all();
        return view('kandidat.index', compact('kandidat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = DB::table('periode')->first();
        return view('kandidat.create', [
            'periode' => $periode
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // return $request->file('image')->store('post-image');
        $validateData = $request->validate([
            'ketua' => 'required',
            'wakil' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'periode_id' => 'required'
        ]);
        
        

        if($request->file('image')){
            $validateData['image'] = $request->file('image')->store('post-image');
        };


        $kandidat = Kandidat::create($validateData);

        $pemilihan = Vote::create([
            'kandidat_id' => $kandidat->id,
            'periode_id' => $request->periode_id,
            'jml_pemilih' => 0
        ]);


        return redirect()->route('kandidat.index')
        ->with('success', 'Kandidat Berhasil Ditambahkan');
        

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $kandidat = Kandidat::find($id);
        return view('kandidat.edit',[
            'kandidat' => $kandidat,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    // public function edit(Kandidat $kandidat)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validateData = $request->validate([
            'ketua' => 'required',
            'wakil' => 'required',
            'deskripsi' => 'required',
        ]);

        if($request->file('image')){
            $validateDataImage = $request->validate([
                'ketua' => 'required',
                'wakil' => 'required',
                'deskripsi' => 'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $validateDataImage['image'] = $request->file('image')->store('post-image');
            $kandidat = Kandidat::find($id);
            unlink("storage/".$kandidat->image);  
            $kandidat->update($validateDataImage);
            return redirect()->route('kandidat.index')
            ->with('success', 'Kandidat Berhasil Diperbarui!');
        }else {
            $kandidat = Kandidat::find($id);
            $kandidat->update($validateData);
            return redirect()->route('kandidat.index')
            ->with('success', 'Kandidat Berhasil Diperbarui!');
        }
        

        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kandidat  $kandidat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kandidat = Kandidat::find($id);
        $kandidat->delete();
        return redirect()->route('kandidat.index')
        ->with('success', 'Kandidat Berhasil Dihapus');

    }
}
