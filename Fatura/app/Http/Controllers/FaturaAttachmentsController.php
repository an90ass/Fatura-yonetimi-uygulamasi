<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\fatura_attachments;
use Illuminate\Support\Facades\Auth;
class FaturaAttachmentsController extends Controller
{
        /**
     * Display a listing of the resource.
     */
    public function index()
    {


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
        $this->validate($request, [

            'file_name' => 'mimes:pdf,jpeg,png,jpg',

            ], [
                'file_name.mimes' => 'dosya biçimi pdf, jpeg , png , jpg olmalıdır',
            ]);

            $image = $request->file('file_name');
            $file_name = $image->getClientOriginalName();

            $attachments =  new fatura_attachments();
            $attachments->file_name = $file_name;
            $attachments->fatura_numarasi = $request->fatura_numarasi;
            $attachments->fatura_id = $request->fatura_id;
            $attachments->Tarafindan_yaratildi = Auth::user()->name;
            $attachments->save();

            // move pic
            $imageName = $request->file_name->getClientOriginalName();
            $request->file_name->move(public_path('Attachments/'. $request->fatura_numarasi), $imageName);

            session()->flash('Add', ' Dosya başarıyla eklenmiş');
            return back();
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
    }
