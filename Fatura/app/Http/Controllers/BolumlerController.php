<?php

namespace App\Http\Controllers;

use App\Models\bolumler;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class BolumlerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bolumler = bolumler::all();// table dan bilgiler gitermek icin
        return view('bolumler.bolumler',compact('bolumler'));
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
       /* $input = $request->all();
        $b_exists = bolumler::where('bolum_ismi','=',$input['bolum_ismi'])->exists();
        if($b_exists){
            session()->flash('Error','Bu Bölüm daha önceden mevcuttur');
            return redirect('/bolumler');
        }else{}*/

        $validated = $request->validate([
            'bolum_ismi' => 'required|unique:bolumlers|max:255',
            'tanim' => 'required',],[
                'bolum_ismi.required' =>'Lütfen bölüm ismi girin',
                'bolum_ismi.unique' =>'Bölüm ismi daha önceden kayıtlı',
                'tanim.required' =>'Lütfen bilgileri girin',

        ]);
           bolumler::create([
            'bolum_ismi' =>$request->bolum_ismi,
            'tanim' =>$request->tanim,
            'Tarafindan_yaratildi' =>(Auth::user()->name),

           ]);
           session()->flash('Add','Başarı ile bölüm eklenmiş');
           return redirect('/bolumler');

        
    }

    /**
     * Display the specified resource.
     */
    public function show(bolumler $bolumler)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(bolumler $bolumler)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $id = $request->id;

        $this->validate($request, [

            'bolum_ismi' => 'required|max:255|unique:bolumlers,bolum_ismi,'.$id,
            'tanim' => 'required',
        ],[

            'bolum_ismi.required' =>'Lütfen bölüm ismi girin',
            'bolum_ismi.unique' =>'Bölüm ismi daha önceden kayıtlı',
            'tanim.required' =>'Lütfen bilgileri girin',


        ]);

        $bolumler = bolumler::find($id);
        $bolumler->update([
            'bolum_ismi' => $request->bolum_ismi,
            'tanim' => $request->tanim,
        ]);

        session()->flash('edit','Bölüm başarı ile düzenledi');
        return redirect('/bolumler'); 


}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->id;
        bolumler::find($id)->delete();
        session()->flash('delete','Bölüm başarı ile silendi');
        return redirect('/bolumler');
    }
}
