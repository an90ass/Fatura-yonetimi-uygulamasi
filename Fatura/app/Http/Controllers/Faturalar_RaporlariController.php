<?php

namespace App\Http\Controllers;
use App\Models\bolumler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\urunler;
use App\Models\faturalars;

class Faturalar_RaporlariController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        return view('raporlar.faturalar_raporlari');

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
    public function Search_faturalar(Request $request){

        $rdio = $request->rdio;


     // Fatura tipine göre arama yapılması durumunda

        if ($rdio == 1) {


     // Tarih belirtilmemişse

            if ($request->type && $request->start_at =='' && $request->end_at =='') {

               $faturalars = faturalars::select('*')->where('durum','=',$request->type)->get();
               $type = $request->type;
               return view('raporlar.faturalar_raporlari',compact('type'))->withDetails($faturalars);
            }

            //Bir bitiş tarihi belirtilmişse
            else {

              $start_at = date($request->start_at);
              $end_at = date($request->end_at);
              $type = $request->type;

              $faturalars = faturalars::whereBetween('fatura_Tarihi',[$start_at,$end_at])->where('durum','=',$request->type)->get();
              return view('raporlar.faturalar_raporlari',compact('type','start_at','end_at'))->withDetails($faturalars);

            }



        }

    //====================================================================

    //Fatura numarasına göre arama durumunda

         else {

            $faturalars = faturalars::select('*')->where('fatura_numarasi','=',$request->fatura_numarasi)->get();
            return view('raporlar.faturalar_raporlari')->withDetails($faturalars);

        }

        }

    }

