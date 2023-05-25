<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Supports\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\faturalars;
class FaturalarArsiviController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faturalars = faturalars::onlyTrashed()->get();
        return view('faturalar.faturalar_arsivi',compact('faturalars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function destroy(Request $request)
    {
        $faturalars = faturalars::withTrashed()->where('id',$request->fatura_id)->first();
        $faturalars->forceDelete();
        session()->flash('delete_fatura');
        return redirect('/Arsiv');



    }
    public function show(urunler $urunler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(urunler $urunler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->fatura_id;
        $flight = faturalars::withTrashed()->where('id', $id)->restore();
        session()->flash('restore_fatura');
        return redirect('/faturalars');
    }
    }
