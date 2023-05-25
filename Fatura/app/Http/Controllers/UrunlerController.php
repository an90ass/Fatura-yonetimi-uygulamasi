<?php

namespace App\Http\Controllers;
use App\Models\bolumler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\urunler;


class UrunlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bolumler = bolumler::all();
        $urunler = urunler::all();
       return view('urunler.urunler',compact('bolumler','urunler'));
   
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
    public function store(Request $request)
    {
        urunler::create([

            'urun_ismi' => $request->urun_ismi,
            'bolum_id' => $request->bolum_id,
            'tanim' => $request->tanim,
        ]);
        session()->flash('Add', 'Ürün başarıyla eklenmiş');
        return redirect('/urunler');    }

    /**
     * Display the specified resource.
     */
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
        $id = bolumler::where('bolum_ismi', $request->bolum_ismi)->first()->id;

        $urunler = urunler::findOrFail($request->urun_id);
 
        $urunler->update([
        'urun_ismi' => $request->urun_ismi,
        'tanim' => $request->tanim,
        'bolum_id' => $id,
        ]);
 
        session()->flash('edit', 'Ürün başarıyla düzenlenmiş');
        return back();    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $urunler = urunler::findOrFail($request->urun_id);
         $urunler->delete();
         session()->flash('delete', ' Ürün başarıyla silenmiş ');
         return back();
    }
    }

