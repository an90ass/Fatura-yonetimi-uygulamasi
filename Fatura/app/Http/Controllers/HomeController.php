<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Supports\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }



    // public function geturunler($id){
    //     $urunler= \DB::table("urunlers")->where("bolum_id",$id)->pluck("urun_ismi","id");
    //     return json_encode($urunler);
    //     //\ json_encode
    // }
}
