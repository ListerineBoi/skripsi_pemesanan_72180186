<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot_S;
use App\Models\Slot_P;
use Illuminate\Support\Facades\Storage;
use App\Models\Sampling;
use App\Models\DetailFile;
use App\Models\Produksi;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\Detail_pakaian;
use App\Models\Nota;
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
        ])->get();
        $samplingS=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->get();
        return view('sampling.pengajuansampling',compact('slot','sampling','samplingS'));
        
        
    }
    public function savesampling(Request $request)
    {
        $jml=Slot_S::where('id', $request->slot_id)->value('jml');
        $kuota=Slot_S::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
            $id=Auth::user()->id;
            $this->validate($request, [
                'slot_id' => 'required',
                'jenis' => 'required',
                'desc' => 'required', 
            ]);
            // $fullname = $request->file('img_model')->getClientOriginalName();
            // $extn =$request->file('img_model')->getClientOriginalExtension();
            // $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
            // $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

            $Detail_pakaian= Detail_pakaian::create([
                'public' => '1',
                'nama_atasan' => $request->nama_atasan,
                'nama_bawahan' => $request->nama_bawahan,
                'jenis' => $request->jenis,
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
        $fileimg=DetailFile::where('detail_id','=', $sampling->detail_id)->get();
        //return $fileimg;
        return view('sampling.editsampling',compact('sampling','fileimg'));
    }
    public function uploadimg(Request $request)
    {
            $this->validate($request, [
                'file_img' => 'required'
            ]);
            $fullname = $request->file('file_img')->getClientOriginalName();
            $extn =$request->file('file_img')->getClientOriginalExtension();
            $finalS=$request->slot_id.'detail'.'_'.$request->detail_id.'_'.time().'.'.$extn;
            $path = $request->file('file_img')->storeAs('public/imgdetail', $finalS);
            $Sampling = new DetailFile([
                'detail_id' => $request->detail_id,
                'img' => $finalS,
            ]);
            $Sampling->save();
            return redirect()->back()->with('success');
    }
    public function saveeditS(Request $request)
    {
        $id=Auth::user()->id;
        $iddetail=Sampling::where('id','=', $request->id)->value('detail_id');
            Detail_pakaian::where('id', $iddetail)->update([
                'nama_atasan' => $request->nama_atasan,
                'nama_bawahan' => $request->nama_bawahan,
                'jenis' => $request->jenis,
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
        
        return redirect()->back();
    }
    
    public function delS($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        $del=DetailFile::where('detail_id',$sampling->detail_id)->select('id','img')->get();
        if($del != null){
            foreach ($del as $row) {
                $delpath='public/imgdetail/'.$row->img;
                Storage::delete($delpath);
                DetailFile::where('id', $row->id)->delete();
            }
        }
        Slot_S::where('id', $sampling->slot_id)->decrement('jml');
        Sampling::where('id', $id)->delete();
        Detail_pakaian::where('id',$sampling->detail_id)->delete();
        return redirect()->back();
        //return $delpath;
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
        $id=Auth::user()->id;
        $this->validate($request, [
            'slot_id' => 'required',
            'jenis' => 'required',
            'desc' => 'required',  
        ]);
        $Detail_pakaian= Detail_pakaian::create([
            'public' => '1',
            'nama_atasan' => $request->nama_atasan,
            'nama_bawahan' => $request->nama_bawahan,
            'jenis' => $request->jenis,
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
        ]);
        $Sampling->save();

        Slot_S::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
    }
    public function viewproduksi()
    {
        $id=Auth::user()->id;
        $slot=Slot_P::where('status','=', '1')->get();
        $produksi=Produksi::where([
            ['cus_id','=', $id],
            ['status','!=', '4'],
        ])->get();
        $sampling=Sampling::where([
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->whereNotIn('detail_id',  $produksi->pluck('detail_id'))
        ->with('detp')->get();
        $detail= $sampling->pluck('detp');
        
        return view('produksi.pengajuanproduksi',compact('slot','detail','produksi'));
        //return $produksi->detail_id;
    }
    public function viewinputproduksi($id)
    {
        $slot=Slot_P::where('status','=', '1')->get();
        $detail=Detail_pakaian::where('id',$id)->first();
        $fileimg=DetailFile::where('detail_id','=', $detail->id)->get();
        return view('produksi.inputproduksi',compact('slot','detail','fileimg'));
    }
    public function saveinputprod(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request,[
            'slot_id' => 'required',
            'detail_id' => 'required',
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
        $slot=Slot_P::where('status','=', '1')->get();
        return view('produksi.inputsampprodcustom',compact('slot'));
    }
    public function savesamplingcustom(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'desc' => 'required',  
        ]);
        // $fullname = $request->file('img_model')->getClientOriginalName();
        // $extn =$request->file('img_model')->getClientOriginalExtension();
        // $finalS=$id.$request->slot_id.'sampling'.'_'.time().'.'.$extn;
        // $path = $request->file('img_model')->storeAs('public/imgsampling', $finalS);

        $detail= Detail_pakaian::create([
            'public' => '1',
            'nama_atasan' => $request->nama_atasan,
            'nama_bawahan' => $request->nama_bawahan,
            'jenis' => $request->jenis,
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
        $fileimg=DetailFile::where('detail_id','=', $detail->id)->get();
        return view('produksi.editproduksi',compact('produksi','detail','fileimg','id'));
        //return $currentURL;
    }

    public function saveeditprod(Request $request)
    {
        $this->validate($request,[
            'jml' => 'required' 
        ]);
        Produksi::where('id',$request->id)->update([
            'jml' => $request->jml
        ]);
        return redirect()->route('viewproduksi');
    }
    public function vieweditdetailprod($id)
    {
        $detail=detail_pakaian::where('id','=', $id)->first();
        $redirURL = str_replace(url('/'), '', url()->previous());
        return view('produksi.editdetailprod',compact('detail','redirURL'));
        //return $redirURL;
    }
    public function saveeditdetailprod(Request $request)
    {
        Detail_pakaian::where('id', $request->id)->update([
            'nama_atasan' => $request->nama_atasan,
            'nama_bawahan' => $request->nama_bawahan,
            'jenis' => $request->jenis,
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
    
    return redirect($request->redirect);
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
        $pemba_samp =Pembayaran::wherein('samp_id',$sampling->pluck('id'))->with('nota')->with('sampling')->get();
        $pemba_prod =Pembayaran::wherein('prod_id',$prod->pluck('id'))->with('nota')->with('produksi')->get();
        //return $pemba_samp[0]->sampling->detail_id;
        return view('invoice.listbayar',compact('pemba_samp','pemba_prod'));
    }
    public function inputbuktibyr(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'jenis_pembayaran' => 'required',   
            'img_bukti' => 'required', 
        ]);
        if($request->jns==0){
                $fullname = $request->file('img_bukti')->getClientOriginalName();
                $extn =$request->file('img_bukti')->getClientOriginalExtension();
                $finalS=$request->jns.'buktibayar'.'_'.$request->id.'_'.$id.'_'.time().'.'.$extn;
                $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
                Pembayaran::where('id',$request->id)->update([
                    'status' => 1,
                ]);
                Nota::create([
                    'bayar_id' => $request->id,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'img_bukti' => $finalS,
                ]); 
        }elseif ($request->jns==1) {
                $fullname = $request->file('img_bukti')->getClientOriginalName();
                $extn =$request->file('img_bukti')->getClientOriginalExtension();
                $finalS=$request->jns.'buktibayar'.'_'.$request->id.'_'.$id.'_'.time().'.'.$extn;
                $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
                Pembayaran::where('id',$request->id)->update([
                    'status' => 1,
                ]);
                Nota::create([
                    'bayar_id' => $request->id,
                    'jenis_pembayaran' => $request->jenis_pembayaran,
                    'img_bukti' => $finalS,
                ]); 
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
