<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Roles;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::whereIn('roles_id', [1, 2])->get();
        // $roles = Roles::whereNotIn('id', [3])->get();
        return view('panitia.index', [
            'user' => $user,
            // 'roles' => $roles
        ]);
    }

    public function pemilihIndex(Request $request)
    {
        $user = User::where('roles_id', 3);
        $kelas = DB::table('kelas')->get();
        $periode = DB::table('periode')->get();
        
        
        if ($request->kelas && $request->status){
            $user = $user->where('kelas_id', $request->kelas)
                    ->where('status', $request->status);
            $namaKelas = $request->kelas;
            $status = $request->status;
            $user = $user->orderByDesc('created_at')->paginate(7);
            return view('pemilih.index',[
                'namakelas' => $namaKelas,
                'status' => $status,
                'pemilih' => $user,
                'kelas' => $kelas,
                'periode' => $periode
            ]);
        } elseif ($request->status){
            $user = $user->where('status', $request->status);
            $status = $request->status;
            $user = $user->orderByDesc('created_at')->paginate(7);
            return view('pemilih.index',[
                'status' => $status,
                'pemilih' => $user,
                'kelas' => $kelas,
                'periode' => $periode
            ]);
        } elseif ($request->kelas){
            $user = $user->where('kelas_id', $request->kelas);
            $namaKelas = $request->kelas;
            $user = $user->orderByDesc('created_at')->paginate(7);
            return view('pemilih.index',[
                'namakelas' => $namaKelas,
                'pemilih' => $user,
                'kelas' => $kelas,
                'periode' => $periode
            ]);
        } else {
            $user = $user->orderByDesc('created_at')->paginate(7);
            return view('pemilih.index',[
                'pemilih' => $user,
                'kelas' => $kelas,
                'periode' => $periode
            ]);
        }
        
        // $pemilih = $user->orderByDesc('created_at')->get();
        
    }

    public function pemilihStore(Request $request)
    {
        
        // dd($request->all());

        $request->validate([
            // 'nama' => 'required',
            'nim' => 'required',
            'email' => 'required',
            'kelas' => 'required',
            'periode' => 'required',
        ]);
        $CheckNim = User::where('nim', $request->nim)->first();
        if(empty($CheckNim)){
            $CheckEmail = User::where('email', $request->email)->first();
            if(empty($CheckEmail)){
                User::create([
                    'username' => $request->nim,
                    'nim' => $request->nim,
                    'roles_id' => 3,
                    'email' => $request->email,
                    'password' => Hash::make($request->nim . '*'),
                    'periode_id' => $request->periode,
                    'kelas_id' => $request->kelas
                ]);
                return redirect()->route('pemilih.index')
                ->with('success', 'Pemilih Berhasil Ditambahkan!');
            }
            else {
                return redirect()->route('pemilih.index')
                ->with('error', 'Email Sudah Digunakan');
            }   
        }
        else {
            return redirect()->route('pemilih.index')
            ->with('error', 'Nim Sudah Digunakan');
        }
        

        
        

        




        // $jumlah = $request->jumlah;
        // for ($i=0; $i < $jumlah ; $i++) { 
            // $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
            // $string = '';

        //     for ($x=0; $x < 6 ; $x++) { 
        //         $k = rand(0, strlen($karakter)-1);
        //         $string .= $karakter[$k];
        //     }
        //     $token = strtoupper($string);

        //     $cek = User::find($token);
            
        //     if (empty($cek)){
        //         User::create([
        //             'username' => $token,
        //             'name' => 0,
        //             'roles_id' => 3,
        //             'password' => Hash::make($token),
        //             'periode_id' => $request->periode,
        //             'kelas_id' => $request->kelas
        //         ]);
        //     }
        // }


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
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'roles' => 'required',
            'password' => 'required'
        ]);
        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'roles_id' => $request->roles
        ]);
        return redirect()->route('panitia.index')
        ->with('success', 'Panitia Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = User::find($id);
        return view('panitia.edit',[
            'edit' => $edit
        ]);
    }

    public function PemiilihEdit($id)
    {
        $edit = User::find($id);
        $kelas = DB::table('kelas')->get();
        return view('pemilih.edit',[
            'edit' => $edit,
            'kelas' => $kelas,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'roles' => 'required'

        ]);
        $user = User::find($id);
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'roles' => $request->roles,
        ]);
        return redirect()->route('panitia.index')
        ->with('success', 'Panitia Berhasil Diupdate');
    }

    public function PemilihUpdate(Request $request, $id)
    {
        $request->validate([
            'nim' => 'required',
            'email' => 'required',
            'kelas' => 'required'

        ]);
        $user = User::find($id);
        $user->update([
            'nim' => $request->nim,
            'email' => $request->email,
            'kelas' => $request->kelas,
        ]);
        return redirect()->route('pemilih.index')
        ->with('success', 'Pemilih Berhasil Diupdate');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->route('panitia.index')
        ->with('success', 'Panitia Berhasil Dihapus');

    }

    public function PemilihDestroy($id)
    {
        $delete = User::find($id);
        $delete->delete();
        return redirect()->route('pemilih.index')
        ->with('success', 'Panitia Berhasil Dihapus');

    }
}
