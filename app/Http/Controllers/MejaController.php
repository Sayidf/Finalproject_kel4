<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //menampilkan seluruh data
        $meja = Meja::orderBy('no_meja', 'ASC')->get();
        return view('meja.index', compact('meja'));
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
            'no_meja' => 'required|unique:meja|max:45',
            'kapasitas' => 'required|max:45'
        ]);

        DB::table('meja')->insert(
            [
                'no_meja'=>$request->no_meja,
                'kapasitas'=>$request->kapasitas,
                'created_at'=>now(),
            ]);

        return redirect()->route('meja.index')
            ->with('success', 'Meja Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $row = Meja::find($id);
        return view('meja.index', compact('row'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $row = Meja::find($id);
        return view('meja.form_edit', compact('row'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_meja' => 'required|unique:meja|max:45',
            'kapasitas' => 'required|max:45'
        ]);

        DB::table('meja')->where('id',$id)->update(
            [
                'no_meja'=>$request->no_meja,
                'kapasitas'=>$request->kapasitas,
                'updated_at'=>now(),
            ]);

        return redirect('/administrator/meja')
            ->with('success', 'Data Meja Berhasil Diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $row = Meja::find($id);
        Meja::where('id',$id)->delete();
        return redirect()->route('meja.index')
                        ->with('success','Data Meja Berhasil Dihapus');
    }
}