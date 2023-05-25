<?php

namespace App\Http\Controllers;
use App\Models\faturalars;

use App\Http\Controllers\Controller;
use Illuminate\Supports\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\fatura_attachments;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\faturalar_details;

use App\Models\bolumler;
use App\Models\urunler;

use Illuminate\Support\Facades\Notification;
use App\Notifications\AddFatura;
use App\Models\User;
class FaturalarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $faturalars=faturalars::all();
        return view('faturalar.faturalar',compact('faturalars'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      // $bolumler = bolumler::all();// table dan bilgiler gitermek icin
      // return view('faturalar.add_fatura',compact('bolumler'));

       $bolumler = bolumler::all();
        $urunler = urunler::all();

    return view('faturalar.add_fatura',compact('bolumler','urunler'));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        faturalars::create([
            'fatura_numarasi' => $request->fatura_numarasi,
            'fatura_Tarihi' => $request->fatura_tarihi,
            'Due_date' => $request->due_tarihi,
            'urun' =>  $request->urun,
            'bolum_id' => $request->bolum,
            'Tahsilat_tutari' => $request->Tahsilat_tutari,
            'Komisyon_tutari' => $request->Komisyon_tutari,
            'indirim' => $request->kesilen_tutar,
            'KDV_tutari' => $request->KDV_tutari,
            'KDV_orani' => $request->KDV_orani,
            'Toplam' => $request->toplam,
            'durum' => 'Ödenmemiş ',
            'Value_durum' => 2,
            'note' => $request->note,

        ]);


        $fatura_id = faturalars::latest()->first()->id;
        faturalar_details::create([
            'id_fatura' => $fatura_id,
            'fatura_numarasi' => $request->fatura_numarasi,
            'urun' => $request->urun,
            'bolum' => $request->bolum,
            'durum' => 'Ödenmemiş ',
            'Value_durumu' => 2,
            'note' => $request->Note,
            'kullanci' => (Auth::user()->name),
        ]);


       if ($request->hasFile('pic')) {

            $fatura_id = faturalars::latest()->first()->id;
            $image = $request->file('pic');
            $file_name = $image->getClientOriginalName();
            $fatura_numarasi = $request->fatura_numarasi;

            $attachments = new fatura_attachments();
            $attachments->file_name = $file_name;
            $attachments->fatura_numarasi = $fatura_numarasi;
            $attachments->Tarafindan_yaratildi = Auth::user()->name;
            $attachments->fatura_id = $fatura_id;
            $attachments->save();

            // move pic
            $imageName = $request->pic->getClientOriginalName();
            $request->pic->move(public_path('Attachments/' . $fatura_numarasi), $imageName);
        }

       /*
       fatura ekledikten sonra emila fatura detaylari gonderme kodu ama calismadi
       $user = User::get();
        //$faturalars = faturalars::latest()->first();
        //Notification::send($user, new \App\Notifications\AddFatura($faturalars));
         // $user = User::first();
        //Notification::send($user, new \App\Notifications\AddFatura($fatura_id));*/










                  session()->flash('Add', 'Fatura başarıyla eklenmiş');
                  return back();


    }

    /**
     * Display the specified resource.
     */
    public function show( $id)
    {
        $faturalar = faturalars::where('id', $id)->first();
        return view('faturalar.durum_update', compact('faturalar'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $faturalar = faturalars::where('id', $id)->first();
        $bolumler = bolumler::all();
        return view('faturalar.edit_fatura', compact('bolumler', 'faturalar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $faturalars = faturalars::findOrFail($request->fatura_id);
        $faturalars->update([
            'fatura_numarasi' => $request->fatura_numarasi,
            'fatura_Tarihi' => $request->fatura_tarihi,
            'Due_date' => $request->due_tarihi,
            'urun' =>  $request->urun,
            'bolum_id' => $request->bolum,
            'Tahsilat_tutari' => $request->Tahsilat_tutari,
            'Komisyon_tutari' => $request->Komisyon_tutari,
            'indirim' => $request->kesilen_tutar,
            'KDV_tutari' => $request->KDV_tutari,
            'KDV_orani' => $request->KDV_orani,
            'Toplam' => $request->toplam,
            'note' => $request->note,
        ]);

        session()->flash('edit', 'Fatura başarı ile düzenlendi');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $id = $request->fatura_id;
        $faturalar = faturalars::where('id', $id)->first();
        $Details = fatura_attachments::where('fatura_id', $id)->first();

         $id_page =$request->id_page;


        if (!$id_page==2) { // normal silme islemi (id_page arsivleme modelinde tanimladim ve 2 deger verdim - 2 arsevleme demek)

        if (!empty($Details->fatura_numarasi)) {
       //Önce faturayı silersem gidip fatura bilgilerini arayacak ve bulamayacak çünkü faturanın ID'si silinmiş olacak ve bir hata oluşacak
            Storage::disk('public_uploads')->deleteDirectory($Details->fatura_numarasi);                                 //İçinde kaç dosya olduğuna bakılmaksızın fatura numarasi ile ek dosyasının tamamı silinir.
            //deleteDirectory- laravel file storge.. İçinde kaç dosya olduğuna bakmadan fatura numarasi ile ek dosyasının tamamı silinir.


        }

        $faturalar->forceDelete();   //Veritabanından kalıcı olarak silinecek
        session()->flash('delete_fatura');
        return redirect('/faturalars');
        }

        else {

            $faturalar->delete();//delete = soft delete yani databaseten silme ama arsive gonder
            session()->flash('fatuar_arsivi');
            return redirect('/Arsiv');
        }

    }
    public function geturunler($id)
    {
        $urunler = \DB::table("urunlers")->where("bolum_id", $id)->pluck("urun_ismi", "id");

        $options = "";
        foreach ($urunler as $key => $value) {
            $options .= '<option value="' . $value . '">' . $value . '</option>';
        }

        return response()->json(['options' => $options]);
    }




    public function Durum_Update($id, Request $request)
    {
        $faturalar = faturalars::findOrFail($id);

        if ($request->Status === 'Ödenmiş') {

            $faturalar->update([
                'Value_durum' => 1,
                'durum' => $request->Status,
                'odeme_tarihi' => $request->odeme_tarihi,
            ]);

            faturalar_details::create([
                'id_fatura' => $request->fatura_id,
              'fatura_numarasi' => $request->fatura_numarasi,

                'urun' => $request->urun,// sorun burada deiştirilmeli
                'bolum' => $request->bolum,
                'durum' => $request->Status,
                'Value_durumu' => 1,
                'note' => $request->note,
                'odeme_tarihi' => $request->odeme_tarihi,
                'kullanci' => (Auth::user()->name),
            ]);
        }

        else {
            $faturalar->update([
                'Value_durum' => 3,
                'durum' => $request->Status,
                'odeme_tarihi' => $request->odeme_tarihi,
                'Toplam' => $request->toplam - $request->odenmis_tutar,

            ]);
            faturalar_details::create([
                'id_fatura' => $request->fatura_id,
                'fatura_numarasi' => $request->fatura_numarasi,
                'urun' => $request->urun,
                'bolum' => $request->bolum,
                'Toplam' => $request->toplam,
                'durum' => $request->Status,
                'Value_durumu' => 3,
                'note' => $request->note,
                'odeme_tarihi' => $request->odeme_tarihi,
                'kullanci' => (Auth::user()->name),
            ]);
        }
        session()->flash('Durum_Update');
        return redirect('/faturalars');
    }

    public function Odenmis_Faturalar()
    {
        $faturalars = faturalars::where('Value_durum',1)->get();
        return view('faturalar.odenmis_faturalar',compact('faturalars'));
    }

    public function Odenmemis_Faturalar()
    {
        $faturalars = faturalars::where('Value_durum',2)->get();
        return view('faturalar.odenmemis_faturalar',compact('faturalars'));
    }

    public function Kismenodenmis_Faturalar()
    {
        $faturalars = faturalars::where('Value_durum',3)->get();
        return view('faturalar.kismenodenmis_faturalar',compact('faturalars'));
    }
    public function print_fatura($id)
    {
        $faturalars = faturalars::where('id', $id)->first();
        return view('faturalar.print_fatura',compact('faturalars'));
    }

}
