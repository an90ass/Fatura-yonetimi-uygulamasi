<?php

namespace App\Http\Controllers;

use App\Models\faturalars;
use Illuminate\Http\Request;
use App\Models\faturalar_details;
use App\Models\fatura_attachments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use League\Flysystem\Filesystem;
use Illuminate\Filesystem\FilesystemAdapter;
class FaturalarDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(faturalar_details $faturalar_details)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faturalar = faturalars::where('id',$id)->first();
        $details    =faturalar_details::where('id_fatura',$id)->get();
        $attachments  = fatura_attachments::where('fatura_id',$id)->get();

         return view('faturalar.faturalar_details',compact('faturalar','details','attachments'));    //compact = bu bilgiler aal ve faturalar.faturalar_details git
        return $attachments ;
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, faturalar_details $faturalar_details)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $faturalar = fatura_attachments::findOrFail($request->id_file);
        $faturalar->delete();
        Storage::disk('public_uploads')->delete($request->fatura_numarasi.'/'.$request->file_name);
        session()->flash('delete', 'Dosyayı başarıyla silinmiştir');
        return back();
    }


    public function get_file($fatura_numarasi,$file_name)

    {
        //$contents= Storage::disk('public_uploads')->exists($fatura_numarasi.'/'.$file_name);
       // return response()->download( $contents);
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$fatura_numarasi.'/'.$file_name);
        return response()->download($pathToFile);
    }





    public function open_file($fatura_numarasi,$file_name)

    {
        $st="Attachments";
        $pathToFile = public_path($st.'/'.$fatura_numarasi.'/'.$file_name);
        return response()->file($pathToFile);
    }


}
