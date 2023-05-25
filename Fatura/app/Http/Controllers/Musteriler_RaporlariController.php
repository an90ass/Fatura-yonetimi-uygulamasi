<?php

namespace App\Http\Controllers;
use App\Models\bolumler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\faturalars;
use App\Models\urunler;
class Musteriler_RaporlariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $bolumler = bolumler::all();
        $urunler = urunler::all();
     return view('raporlar.musteriler_raporlari',compact('bolumler','urunler'));
   //  return view('raporlar.musteriler_raporlari', ['bolum' => $bolumler],['urun' => $urunler]);
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
    }

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
         }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {

    }
    public function Search_musteriler(Request $request){
        if ($request->bolum && $request->urun && $request->start_at =='' && $request->end_at=='') {


            $faturalars = faturalars::select('*')->where('bolum_id','=',$request->bolum)->where('urun','=',$request->urun)->get();
            $bolumler = bolumler::all();
             return view('raporlar.musteriler_raporlari',compact('bolumler'))->withDetails($faturalars);


           }


        //  Tarih ile ara durumunda

           else {

             $start_at = date($request->start_at);
             $end_at = date($request->end_at);

            $faturalars = faturalars::whereBetween('fatura_Tarihi',[$start_at,$end_at])->where('bolum_id','=',$request->bolum)->where('urun','=',$request->urun)->get();
            $bolumler = bolumler::all();
             return view('raporlar.musteriler_raporlari',compact('bolumler'))->withDetails($faturalars);


           }



          }
      }
