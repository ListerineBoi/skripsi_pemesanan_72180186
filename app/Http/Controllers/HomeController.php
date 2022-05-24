<?php

namespace App\Http\Controllers;

use App\Models\Detail_pakaian;
use Illuminate\Http\Request;
use App\Models\Katalog;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $Katalog=Katalog::where('aktif', 1)->paginate(6);
        return view('home',compact('Katalog'));
        //return $Katalog;
    }
    public function viewdetailkatalogpublic($id)
    {
        $katalog=Katalog::where('id',$id)->firstorfail();
        $details=detail_pakaian::where([
            ['id','=', $katalog->detail_id_s],
        ])->first();
        $detailm=detail_pakaian::where([
            ['id','=', $katalog->detail_id_m],
        ])->first();
        $detaill=detail_pakaian::where([
            ['id','=', $katalog->detail_id_l],
        ])->first();
        $detailxl=detail_pakaian::where([
            ['id','=', $katalog->detail_id_xl],
        ])->first();
        return view('katalog.detailkatalogpublic',compact('katalog','details','detailm','detaill','detailxl'));
    }
}
