<?php

namespace App\Http\Controllers;

use App\Models\DataUmum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LaporanKeuangan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataUmum = '';
        if (Auth::user()->userDetail->uptd_id == 0) {
            $dataUmum = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->orderBy('id', 'desc')->get();
        } else {
            $dataUmum = DataUmum::with('uptd')->with('detailWithJadual')->with('laporanUptdAproved')->with('laporanUptd')->with('laporanKonsultan')->where('uptd_id', Auth::user()->userDetail->uptd_id)->orderBy('id', 'desc')->get();
        }
        return view('laporan-keuangan.index', [
            'dataUmum' => $dataUmum
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

        return view('laporan-keuangan.create', [
            'dataUmum' => DataUmum::find($id)
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
