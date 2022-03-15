<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Slot_P;
use Illuminate\Support\Facades\Storage;
use App\Models\Sampling;
use App\Models\Produksi;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\Detail_pakaian;
use Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('homeuser');
    }
    public function viewsampling()
    {
        $id=Auth::user()->id;
        $slot=Slot_S::where('status','=', '1')->get();
        $sampling=Sampling::where([
            ['cus_id','=', $id],
            ['status','!=', '5'],
            ['status','!=', '6'],
        ])->get();
        $samplingS=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->orwhere([
            ['cus_id','=', $id],
            ['status','=', '6'],
        ])->get();
        return view('sampling.pengajuansampling',compact('slot','sampling','samplingS'));
        //return $slot;
    }
    public function savesampling(Request $request)
    {
        $jml=Slot_S::where('id', $request->slot_id)->value('jml');
        $kuota=Slot_S::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
            $id=Auth::user()->id;
            $this->validate($request, [
                'slot_id' => 'required',
                'model' => 'required',
                'img_model' => 'required',
                'desc' => 'required',
                'jml' => 'required'     
            ]);
            $fullname = $request->file('img_model')->getClientOriginalName();
            $extn =$request->file('img_model')->getClientOriginalExtension();
            $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
            $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

            $Detail_pakaian= Detail_pakaian::create([
                'model' => $request->model,
                'img' => $finalS,
                'desc' => $request->desc,
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
            ]);
            
            $Sampling = new Sampling([
                'detail_id' => $Detail_pakaian->id,
                'slot_id' => $request->slot_id,
                'cus_id' => $id,
                'status' => 0,
                'jml' => $request->jml,
            ]);
            $Sampling->save();

            Slot_S::where('id', $request->slot_id)->increment('jml');
            return redirect()->route('viewsampling');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
    }
    public function vieweditsampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        //return $sampling;
        return view('sampling.editsampling',compact('sampling'));
    }
    public function saveeditS(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'model' => 'required',
            'desc' => 'required',
            'jml' => 'required'      
        ]);
        $iddetail=Sampling::where('id','=', $request->id)->value('detail_id');
        if($request->img_model != null){
            $fullname = $request->file('img_model')->getClientOriginalName();
            $extn =$request->file('img_model')->getClientOriginalExtension();
            $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
            $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);
            $del=Sampling::where('id','=', $request->id)->value('img');
            $delpath='public/imgsampling/'.$del;
            Storage::delete($delpath);
            Detail_pakaian::where('id', $iddetail)->update([
                'model' => $request->model,
                'img' => $finalS,
                'desc' => $request->desc,
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
            ]);
            Sampling::where('id', $iddetail)->update([
                'cus_id' => $id,
                'jml' => $request->jml,
            ]);
        }else{
            Detail_pakaian::where('id', $iddetail)->update([
                'model' => $request->model,
                'desc' => $request->desc,
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
            ]);
            Sampling::where('id', $request->id)->update([
                'cus_id' => $id,
                'jml' => $request->jml,
            ]); 
        }
        //return $request;
        return redirect()->route('viewsampling');
    }
    
    public function delS($id)
    {
        $del=Sampling::where('id','=', $id)->value('img');
        $delpath='public/imgsampling/'.$del;
        Storage::delete($delpath);
        $id_slot=Sampling::where('id', $id)->value('slot_id');
        Sampling::where('id', $id)->delete();
        Slot_S::where('id', $id_slot)->decrement('jml');
        return redirect()->route('viewsampling');
    }

    public function revisisampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        $detail=Detail_pakaian::where('id',$sampling->detail_id)->first();
        $slot=Slot_S::where('status','=', '1')->get();
        //return $sampling;
        return view('sampling.revisisampling',compact('sampling','slot','detail'));
    }

    public function saverevisiS(Request $request)
    {
        $iduser=Auth::user()->id;
        $this->validate($request, [
            'slot_id' => 'required',
            'model' => 'required',
            'desc' => 'required',
            'jml' => 'required'      
        ]);
        if($request->img_model != null){
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        Detail_pakaian::where('id',$request->id)->update([
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'ling_b' => $request->ling_b,
            'ling_pgang' => $request->ling_pgang,
            'ling_pingl' => $request->ling_pingl,
            'ling_lh' => $request->ling_lh,
            'leb_bahu' => $request->leb_bahu,
            'pj_lengan' => $request->pj_lengan,
            'ling_kr_leng' => $request->ling_kr_leng,
            'ling_lengan' => $request->ling_lengan,
            'ling_pergel' => $request->ling_pergel,
            'leb_muka' => $request->leb_muka,
            'leb_pungg' => $request->leb_pungg,
            'panj_pungg' => $request->panj_pungg,
            'panj_baju' => $request->panj_baju,
            'tinggi_pingl' => $request->tinggi_pingl,
            'ling_pinggang' => $request->ling_pinggang,
            'ling_pesak' => $request->ling_pesak,
            'ling_paha' => $request->ling_paha,
            'ling_lutut' => $request->ling_lutut,
            'ling_kaki' => $request->ling_kaki,
            'panj_cln_rok' => $request->panj_cln_rok,
            'tingg_dudk' => $request->tingg_dudk,
        ]);
        }else{
            Detail_pakaian::where('id',$request->id)->update([
                'model' => $request->model,
                'desc' => $request->desc,
                'ling_b' => $request->ling_b,
                'ling_pgang' => $request->ling_pgang,
                'ling_pingl' => $request->ling_pingl,
                'ling_lh' => $request->ling_lh,
                'leb_bahu' => $request->leb_bahu,
                'pj_lengan' => $request->pj_lengan,
                'ling_kr_leng' => $request->ling_kr_leng,
                'ling_lengan' => $request->ling_lengan,
                'ling_pergel' => $request->ling_pergel,
                'leb_muka' => $request->leb_muka,
                'leb_pungg' => $request->leb_pungg,
                'panj_pungg' => $request->panj_pungg,
                'panj_baju' => $request->panj_baju,
                'tinggi_pingl' => $request->tinggi_pingl,
                'ling_pinggang' => $request->ling_pinggang,
                'ling_pesak' => $request->ling_pesak,
                'ling_paha' => $request->ling_paha,
                'ling_lutut' => $request->ling_lutut,
                'ling_kaki' => $request->ling_kaki,
                'panj_cln_rok' => $request->panj_cln_rok,
                'tingg_dudk' => $request->tingg_dudk,
            ]);
        }
        Sampling::create([
            'slot_id' => $request->slot_id,
            'cus_id' => $iduser,
            'detail_id' => $request->id,
            'model' => $request->model,
            'desc' => $request->desc,
            'status' => 0,
            'jml' => $request->jml
            
        ]); 
        Slot_S::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
    }
    public function viewproduksi()
    {
        $id=Auth::user()->id;
        $slot=Slot_P::where('status','=', '1')->get();
        $detail=Detail_pakaian::all();
        $produksi=Produksi::where([
            ['cus_id','=', $id],
            ['status','!=', '4'],
        ])->get();
        return view('produksi.pengajuanproduksi',compact('slot','detail','produksi'));
       
    }
    public function viewinputproduksi($id)
    {
        $slot=Slot_P::where('status','=', '1')->get();
        $detail=Detail_pakaian::where('id',$id)->first();
        return view('produksi.inputproduksi',compact('slot','detail'));
    }
    public function saveinputprod(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request,[
            'slot_id' => 'required',
            'detail_id' => 'required',
            'desc' => 'required',
            'jml' => 'required' 
        ]);

        $produksi= new Produksi([
            'cus_id' => $id,
            'slot_id' => $request->slot_id,
            'detail_id' => $request->detail_id,
            'desc' => $request->desc,
            'status' => 0,
            'jml' => $request->jml 
        ]);
        $produksi->save();
        Slot_P::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewproduksi');
    }
    public function viewcussampproduksi()
    {
        return view('produksi.inputsampprodcustom');
    }
    public function savesamplingcustom(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'model' => 'required',
            'img_model' => 'required',
            'desc' => 'required',  
        ]);
        $fullname = $request->file('img_model')->getClientOriginalName();
        $extn =$request->file('img_model')->getClientOriginalExtension();
        $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

        $detail= Detail_pakaian::create([
            'model' => $request->model,
            'img' => $finalS,
            'desc' => $request->desc,
            'ling_b' => $request->ling_b,
            'ling_pgang' => $request->ling_pgang,
            'ling_pingl' => $request->ling_pingl,
            'ling_lh' => $request->ling_lh,
            'leb_bahu' => $request->leb_bahu,
            'pj_lengan' => $request->pj_lengan,
            'ling_kr_leng' => $request->ling_kr_leng,
            'ling_lengan' => $request->ling_lengan,
            'ling_pergel' => $request->ling_pergel,
            'leb_muka' => $request->leb_muka,
            'leb_pungg' => $request->leb_pungg,
            'panj_pungg' => $request->panj_pungg,
            'panj_baju' => $request->panj_baju,
            'tinggi_pingl' => $request->tinggi_pingl,
            'ling_pinggang' => $request->ling_pinggang,
            'ling_pesak' => $request->ling_pesak,
            'ling_paha' => $request->ling_paha,
            'ling_lutut' => $request->ling_lutut,
            'ling_kaki' => $request->ling_kaki,
            'panj_cln_rok' => $request->panj_cln_rok,
            'tingg_dudk' => $request->tingg_dudk,
        ]);
        $detailid=detail_pakaian::where([
            ['id','=', $detail->id],
        ])->latest()->first();
        return redirect()->route('viewinputproduksi',['id' => $detailid->id]);
        // return $id;
    }
    public function vieweditproduksi($id)
    {
        $produksi=Produksi::where([
            ['id','=', $id],
        ])->first();
        $detail=detail_pakaian::where([
            ['id','=', $produksi->detail_id],
        ])->first();
        return view('produksi.editproduksi',compact('produksi','detail'));
    }

    public function saveeditprod(Request $request)
    {
        $this->validate($request,[
            'desc' => 'required',
            'jml' => 'required' 
        ]);
        Produksi::where('id',$request->id)->update([
            'desc' => $request->desc,
            'jml' => $request->jml
        ]);
        return redirect()->route('viewproduksi');
    }
    public function viewlistbayar()
    {
        $id=Auth::user()->id;
        $sampling = Sampling::where([
            ['cus_id',$id],
            ['status','!=', '5'],
            ['status','!=', '6'],
            ])->get();
        $prod = Produksi::where('cus_id',$id)->get();
        $pemba1 =Pembayaran::wherein('samp_id',$sampling->pluck('id'));
        $pemba =Pembayaran::wherein('prod_id',$prod->pluck('id'))->union($pemba1)->get();
        //return $pemba;
        return view('invoice.listbayar',compact('pemba'));
    }
    public function inputbuktibyr(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'jenis_pembayaran' => 'required',   
        ]);
        if($request->jns==0){
            if($request->img_bukti){
                $fullname = $request->file('img_bukti')->getClientOriginalName();
                $extn =$request->file('img_bukti')->getClientOriginalExtension();
                $finalS=$request->jns.'buktibayar'.'_'.$request->id.'_'.$id.'.'.$extn;
                $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
                Pembayaran::where('id',$request->id)->update([
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'img_bukti' => $finalS,
                    'status' => 1,
                ]);
            }else{
                Pembayaran::where('id',$request->id)->update([
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'status' => 1,
                ]);
            }
        }elseif ($request->jns==1) {
            if($request->img_bukti){
                $fullname = $request->file('img_bukti')->getClientOriginalName();
                $extn =$request->file('img_bukti')->getClientOriginalExtension();
                $finalS=$request->jns.'buktibayar'.'_'.$request->id.'_'.$id.'.'.$extn;
                $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
                Pembayaran::where('id',$request->id)->update([
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'img_bukti' => $finalS,
                    'status' => 1,
                ]);
            }else{
                Pembayaran::where('id',$request->id)->update([
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'status' => 1,
                ]);
            }
        }
        return redirect()->back();
         //return $request->file('img_bukti')->getClientOriginalName();
    }

    public function viewkonsul()
    {
        $id=Auth::user()->id;
        $produksi=Produksi::where('cus_id',$id)->get();
        $sampling=Sampling::where('cus_id',$id)->get();
        
            $jadwal = Konsul::where([
                ['status','1'],
                //['prod_id',$produksi[0]->id],
                ])->orwhere([
                ['status','1'],
                //['samp_id',$sampling[0]->id],
            ])->get();
        
        //return $jadwal;
        return view('konsul.pengajuankonsul',compact('sampling','produksi'));
    }

    public function viewpilihkonsul($id,$jns)
    {
        $jadwal = Konsul::where('status','0')->get();
        if($jns==0){
            $jadwal1 = Konsul::where([
                ['status','1'],
                ['samp_id',$id]
            ])->get();
        }else{
            $jadwal1 = Konsul::where([
                ['status','1'],
                ['prod_id',$id]
            ])->get();
        }
        $cal = Konsul::all();
        return view('konsul.ambiljadwal',compact('jadwal','jadwal1','id','cal'));
    }

    public function pilihkonsul(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',   
        ]);
        if($request->tipe==0){
            Konsul::where('id',$request->id)->update([
                'samp_id' => $request->jasa_id,
                'status' => 1,
            ]);
        }elseif($request->tipe==0){
            Konsul::where('id',$request->id)->update([
                'prod_id' => $request->jasa_id,
                'status' => 1,
            ]);
        }
        return redirect()->back();
    }
}
