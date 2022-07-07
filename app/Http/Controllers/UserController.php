<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slot;
use Illuminate\Support\Facades\Storage;
use App\Models\Jasa;
use App\Models\DetailFile;
use App\Models\Produksi;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\Katalog;
use App\Models\Detail_pakaian;
use App\Models\Nota;
use App\Models\User;
use Auth;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $Katalog=Katalog::where('aktif', 1)->paginate(6);
        return view('homeuser',compact('Katalog'));
    }
    public function viewprofile()
    {
        return view('profile.userprofile');
    }
    public function saveprofile(Request $request)
    {
        $id=Auth::user()->id;
        User::where('id', $id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'alamat' => $request->alamat,
            'no_telp' => $request->no_telp,
        ]);
        return redirect()->back();
    }
    public function viewdetailkatalog($id)
    {
        $katalog=Katalog::where('id',$id)->firstorfail();
        $details=Detail_pakaian::where([
            ['id','=', $katalog->detail_id_s],
        ])->first();
        $detailm=Detail_pakaian::where([
            ['id','=', $katalog->detail_id_m],
        ])->first();
        $detaill=Detail_pakaian::where([
            ['id','=', $katalog->detail_id_l],
        ])->first();
        $detailxl=Detail_pakaian::where([
            ['id','=', $katalog->detail_id_xl],
        ])->first();
        return view('katalog.detailkatalog',compact('katalog','details','detailm','detaill','detailxl'));
    }
    public function viewsampling()
    {
        $id=Auth::user()->id;
        $slot=Slot::where([
            ['jenis','=', '0'],
            ['status','=', '1'],
            ['selesai','>', date("Y-m-d")],
        ])->get();
        $sampling=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $id],
            ['status','!=', '5'],
        ])->paginate($perPage = 6, $columns = ['*'], $pageName = 'on-going');
        $samplingS=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->paginate($perPage = 6, $columns = ['*'], $pageName = 'selesai');
        return view('sampling.pengajuansampling',compact('slot','sampling','samplingS'));
    }
    public function savesampling(Request $request)
    {
        $jml=Slot::where('id', $request->slot_id)->value('jml');
        $kuota=Slot::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
            $id=Auth::user()->id;
            $this->validate($request, [
                'slot_id' => 'required',
                'jenis' => 'required',
                'desc' => 'required',
                'ling_b' => 'max:5',
                'ling_pgang' => 'max:5',
                'ling_pingl' => 'max:5',
                'ling_lh' => 'max:5',
                'leb_bahu' => 'max:5',
                'pj_lengan' => 'max:5',
                'ling_kr_leng' => 'max:5',
                'ling_lengan' => 'max:5',
                'ling_pergel' => 'max:5',
                'leb_muka' => 'max:5',
                'leb_pungg' => 'max:5',
                'panj_pungg' => 'max:5',
                'panj_baju' => 'max:5',
                'tinggi_pingl' => 'max:5',
                'ling_pinggang' => 'max:5',
                'ling_pesak' => 'max:5',
                'ling_paha' => 'max:5',
                'ling_lutut' => 'max:5',
                'ling_kaki' => 'max:5',
                'panj_cln_rok' => 'max:5',
                'tingg_dudk' => 'max:5',    
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
            
            $Sampling = new Jasa([
                'jenis_jasa' => '0',
                'detail_id' => $Detail_pakaian->id,
                'slot_id' => $request->slot_id,
                'cus_id' => $id,
                'status' => 0,
            ]);
            $Sampling->save();

            Slot::where('id', $request->slot_id)->increment('jml');
            return redirect()->back()->with('success','Sampling tersimpan');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
    }
    public function vieweditsampling($id)
    {
        $UsId=Auth::user()->id;
        $sampling=Jasa::where([
            ['id','=', $id],
            ['cus_id','=', $UsId]
            ])->firstorfail();
        $detail=detail_pakaian::where([
            ['id','=', $sampling->detail_id],
        ])->first();
        if($detail->public==1){
            $fileimg=DetailFile::where('detail_id','=', $sampling->detail_id)->paginate(6);
        }else{
            $file=detail_pakaian::where([
                ['id','=', $sampling->detail_id],
            ])->with('katalogs')->with('katalogm')->with('katalogl')->with('katalogxl')->first();
            if(count($file->katalogs)!=0){
                $fileimg=$file->katalogs; 
            }elseif(count($file->katalogm)!=0){
                $fileimg=$file->katalogm;
            }elseif(count($file->katalogl)!=0){
                $fileimg=$file->katalogl;
            }elseif(count($file->katalogxl)!=0){
                $fileimg=$file->katalogxl;
            }
        }
        //return $fileimg;
        return view('sampling.editsampling',compact('sampling','fileimg','detail'));
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
    public function delimg(Request $request)
    {   
        $delpath='public/imgdetail/'.$request->file;
        Storage::delete($delpath);
        DetailFile::where('id', $request->id)->delete();
        return redirect()->back();
    }
    public function saveeditS(Request $request)
    {
        $this->validate($request, [
            'jenis' => 'required',
            'desc' => 'required',
            'ling_b' => 'max:5',
            'ling_pgang' => 'max:5',
            'ling_pingl' => 'max:5',
            'ling_lh' => 'max:5',
            'leb_bahu' => 'max:5',
            'pj_lengan' => 'max:5',
            'ling_kr_leng' => 'max:5',
            'ling_lengan' => 'max:5',
            'ling_pergel' => 'max:5',
            'leb_muka' => 'max:5',
            'leb_pungg' => 'max:5',
            'panj_pungg' => 'max:5',
            'panj_baju' => 'max:5',
            'tinggi_pingl' => 'max:5',
            'ling_pinggang' => 'max:5',
            'ling_pesak' => 'max:5',
            'ling_paha' => 'max:5',
            'ling_lutut' => 'max:5',
            'ling_kaki' => 'max:5',
            'panj_cln_rok' => 'max:5',
            'tingg_dudk' => 'max:5',    
        ]);
        $id=Auth::user()->id;
        $iddetail=Jasa::where('id','=', $request->id)->value('detail_id');
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
        $sampling=Jasa::where('id','=', $id)->first();
        $detail=Detail_pakaian::where('id',$sampling->detail_id)->first();
        if($detail->public==1){
            $del=DetailFile::where('detail_id',$sampling->detail_id)->select('id','img')->get();
            if($del != null){
                foreach ($del as $row) {
                    $delpath='public/imgdetail/'.$row->img;
                    Storage::delete($delpath);
                    DetailFile::where('id', $row->id)->delete();
                }
            }
            Slot::where('id', $sampling->slot_id)->decrement('jml');
            Jasa::where('id', $id)->delete();
            Detail_pakaian::where('id',$sampling->detail_id)->delete();
        }else{
            Slot::where('id', $sampling->slot_id)->decrement('jml');
            Jasa::where('id', $id)->delete(); 
        }
        return redirect()->back();
        //return $delpath;
    }

    public function revisisampling($id)
    {
        $UsId=Auth::user()->id;
        $sampling=Jasa::where([
            ['id','=', $id],
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $UsId],
            ])->firstorfail();
        $detail=Detail_pakaian::where('id',$sampling->detail_id)->first();
        $slot=Slot::where([
            ['jenis','=', '0'],
            ['status','=', '1'],
            ['selesai','>', date("Y-m-d")],
        ])->get();
        //return $sampling;
        return view('sampling.revisisampling',compact('sampling','slot','detail'));
    }
    public function viewinputsampling($id)
    {
        $slot=Slot::where([
            ['jenis','=', '0'],
            ['status','=', '1'],
            ['selesai','>', date("Y-m-d")],
        ])->get();
        $detail=Detail_pakaian::where([
            ['id',$id],
            ['public','0']
            ])->firstorfail();
        return view('sampling.inputsampling',compact('slot','detail'));
    }
    public function saveinputsamp(Request $request)
    {
        $jml=Slot::where('id', $request->slot_id)->value('jml');
        $kuota=Slot::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
            $id=Auth::user()->id;
            $this->validate($request,[
                'slot_id' => 'required',
                'detail_id' => 'required',
            ]);

            $sampling= new Jasa([
                'jenis_jasa' => '0',
                'cus_id' => $id,
                'slot_id' => $request->slot_id,
                'detail_id' => $request->detail_id,
                'permintn' => $request->permintn,
                'status' => 0,
            ]);
        $sampling->save();
        Slot::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
    }
    public function saverevisiS(Request $request)
    {
        $jml=Slot::where('id', $request->slot_id)->value('jml');
        $kuota=Slot::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
        $id=Auth::user()->id;
        $this->validate($request, [
            'slot_id' => 'required',
            'jenis' => 'required',
            'desc' => 'required',
            'ling_b' => 'max:5',
            'ling_pgang' => 'max:5',
            'ling_pingl' => 'max:5',
            'ling_lh' => 'max:5',
            'leb_bahu' => 'max:5',
            'pj_lengan' => 'max:5',
            'ling_kr_leng' => 'max:5',
            'ling_lengan' => 'max:5',
            'ling_pergel' => 'max:5',
            'leb_muka' => 'max:5',
            'leb_pungg' => 'max:5',
            'panj_pungg' => 'max:5',
            'panj_baju' => 'max:5',
            'tinggi_pingl' => 'max:5',
            'ling_pinggang' => 'max:5',
            'ling_pesak' => 'max:5',
            'ling_paha' => 'max:5',
            'ling_lutut' => 'max:5',
            'ling_kaki' => 'max:5',
            'panj_cln_rok' => 'max:5',
            'tingg_dudk' => 'max:5',    
             
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
        $Sampling = new Jasa([
            'jenis_jasa' => 0,
            'detail_id' => $Detail_pakaian->id,
            'slot_id' => $request->slot_id,
            'cus_id' => $id,
            'status' => 0,
        ]);
        $Sampling->save();

        Slot::where('id', $request->slot_id)->increment('jml');
        return redirect()->route('viewsampling');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
    }
    public function viewproduksi()
    {
        $id=Auth::user()->id;
        $produksi=Jasa::where([
            ['jenis_jasa','=', '1'],
            ['cus_id','=', $id],
            ['status','!=', '5'],
        ])->paginate($perPage = 6, $columns = ['*'], $pageName = 'on-going');
        $sampling=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->whereNotIn('detail_id',  $produksi->pluck('detail_id'))
        ->with('detp')->get();
        $detail= Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->whereNotIn('detail_id',  $produksi->pluck('detail_id'))
        ->with('detp')->paginate($perPage = 6, $columns = ['*'], $pageName = 'detail');
        $produksiS=Jasa::where([
            ['jenis_jasa','=', '1'],
            ['cus_id','=', $id],
            ['status','=', '5'],
        ])->whereNotIn('detail_id',  $sampling->pluck('detail_id'))->paginate($perPage = 6, $columns = ['*'], $pageName = 'selesai');
        
        return view('produksi.pengajuanproduksi',compact('detail','produksi','produksiS'));
        //return $produksi->detail_id;
    }
    public function delprod(Request $request)
    {
        $produksi=Jasa::where('id','=', $request->id)->first();
        $iduser=$produksi->cus_id;
        $detail=Detail_pakaian::where('id',$produksi->detail_id)->first();
        $sampling=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $iduser],
            ['status','=', '5'],
        ])->pluck('detail_id')->toArray();
        $samp=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $iduser],
            ['status','=', '5'],
        ])->get();
        $produksiS=Jasa::where([
            ['jenis_jasa','=', '1'],
            ['cus_id','=', $iduser],
            ['status','=', '5'],
        ])->whereNotIn('detail_id',  $samp->pluck('detail_id'))->pluck('detail_id')->toArray();
        if(in_array($request->detail_id,$sampling)){
            Slot::where('id', $produksi->slot_id)->decrement('jml');
            Jasa::where('id', $request->id)->delete();
        }else if(in_array($request->detail_id,$produksiS)){
            Slot::where('id', $produksi->slot_id)->decrement('jml');
            Jasa::where('id', $request->id)->delete();
        }else if($detail->public==0){
            Slot::where('id', $produksi->slot_id)->decrement('jml');
            Jasa::where('id', $request->id)->delete();
        }else{
            $del=DetailFile::where('detail_id',$produksi->detail_id)->select('id','img')->get();
            if($del != null){
                foreach ($del as $row) {
                    $delpath='public/imgdetail/'.$row->img;
                    Storage::delete($delpath);
                    DetailFile::where('id', $row->id)->delete();
                }
            }
            Slot::where('id', $produksi->slot_id)->decrement('jml');
            Jasa::where('id', $request->id)->delete();
            Detail_pakaian::where('id',$produksi->detail_id)->delete();
        }
        return redirect()->back();
    }
    public function viewinputproduksi($id)
    {
        $slot=Slot::where([
            ['jenis','=', '1'],
            ['status','=', '1'],
            ['selesai','>', date("Y-m-d")],
        ])->get();
        $detail=Detail_pakaian::where([
            ['id',$id],
            ])->firstorfail();
        $fileimg=DetailFile::where('detail_id','=', $detail->id)->get();
        return view('produksi.inputproduksi',compact('slot','detail','fileimg'));
    }
    public function saveinputprod(Request $request)
    {
        $jml=Slot::where('id', $request->slot_id)->value('jml');
        $kuota=Slot::where('id', $request->slot_id)->value('kuota');
        if($jml < $kuota){
            $id=Auth::user()->id;
            $this->validate($request,[
                'slot_id' => 'required',
                'detail_id' => 'required',
                'jml' => 'required' 
            ]);

            $produksi= new Jasa([
                'jenis_jasa' => '1',
                'cus_id' => $id,
                'slot_id' => $request->slot_id,
                'detail_id' => $request->detail_id,
                'permintn' => $request->permintn,
                'status' => 0,
                'jml' => $request->jml 
            ]);
            $produksi->save();
            Slot::where('id', $request->slot_id)->increment('jml');
            return redirect()->route('viewproduksi');
        }else{
            return redirect()->back()->with('Forbidden','Maaf, kuota untuk slot ini sudah penuh. Silahkan memilih slot lain');
        }
    }
    public function viewcussampproduksi()
    {
        return view('produksi.inputsampprodcustom');
    }
    public function saveprodcustom(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [
            'jenis' => 'required',
            'desc' => 'required',
            'ling_b' => 'max:5',
            'ling_pgang' => 'max:5',
            'ling_pingl' => 'max:5',
            'ling_lh' => 'max:5',
            'leb_bahu' => 'max:5',
            'pj_lengan' => 'max:5',
            'ling_kr_leng' => 'max:5',
            'ling_lengan' => 'max:5',
            'ling_pergel' => 'max:5',
            'leb_muka' => 'max:5',
            'leb_pungg' => 'max:5',
            'panj_pungg' => 'max:5',
            'panj_baju' => 'max:5',
            'tinggi_pingl' => 'max:5',
            'ling_pinggang' => 'max:5',
            'ling_pesak' => 'max:5',
            'ling_paha' => 'max:5',
            'ling_lutut' => 'max:5',
            'ling_kaki' => 'max:5',
            'panj_cln_rok' => 'max:5',
            'tingg_dudk' => 'max:5',    
        ]);
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
        return redirect()->route('viewinputproduksi',['id' => $detail->id]);
        // return $id;
    }
    public function vieweditproduksi($id)
    {
        $UsId=Auth::user()->id;
        $produksi=Jasa::where([
            ['id','=', $id],
            ['jenis_jasa','=', '1'],
            ['cus_id','=', $UsId],
        ])->firstorfail();
        $detail=detail_pakaian::where([
            ['id','=', $produksi->detail_id],
        ])->first();
        if($detail->public==1){
            $fileimg=DetailFile::where('detail_id','=', $detail->id)->paginate(6);
        }else{
            $file=detail_pakaian::where([
                ['id','=', $produksi->detail_id],
            ])->with('katalogs')->with('katalogm')->with('katalogl')->with('katalogxl')->first();
            if(count($file->katalogs)!=0){
                $fileimg=$file->katalogs; 
            }elseif(count($file->katalogm)!=0){
                $fileimg=$file->katalogm;
            }elseif(count($file->katalogl)!=0){
                $fileimg=$file->katalogl;
            }elseif(count($file->katalogxl)!=0){
                $fileimg=$file->katalogxl;
            }
        }
        return view('produksi.editproduksi',compact('produksi','detail','fileimg','id'));
        //return $fileimg;
        
    }

    public function saveeditprod(Request $request)
    {
        $this->validate($request,[
            'jml' => 'required' 
        ]);
        Jasa::where('id',$request->id)->update([
            'jml' => $request->jml,
            'permintn' => $request->permintn
        ]);
        return redirect()->route('viewproduksi');
    }
    public function saveeditsampkat(Request $request)
    {
        Jasa::where('id',$request->id)->update([
            'permintn' => $request->permintn
        ]);
        return redirect()->back();
    }
    public function vieweditdetailprod($id)
    {
        $detail=detail_pakaian::where('id','=', $id)->firstorfail();
        $redirURL = str_replace(url('/'), '', url()->previous());
        return view('produksi.editdetailprod',compact('detail','redirURL'));
        //return $redirURL;
    }
    public function saveeditdetailprod(Request $request)
    {
        $this->validate($request, [
            'jenis' => 'required',
            'desc' => 'required',
            'ling_b' => 'max:5',
            'ling_pgang' => 'max:5',
            'ling_pingl' => 'max:5',
            'ling_lh' => 'max:5',
            'leb_bahu' => 'max:5',
            'pj_lengan' => 'max:5',
            'ling_kr_leng' => 'max:5',
            'ling_lengan' => 'max:5',
            'ling_pergel' => 'max:5',
            'leb_muka' => 'max:5',
            'leb_pungg' => 'max:5',
            'panj_pungg' => 'max:5',
            'panj_baju' => 'max:5',
            'tinggi_pingl' => 'max:5',
            'ling_pinggang' => 'max:5',
            'ling_pesak' => 'max:5',
            'ling_paha' => 'max:5',
            'ling_lutut' => 'max:5',
            'ling_kaki' => 'max:5',
            'panj_cln_rok' => 'max:5',
            'tingg_dudk' => 'max:5',    
        ]);
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
    public function viewlistbayar(Request $request)
    {
        $srt='created_at';
        $id=Auth::user()->id;
        $Kategori='All';
        $AS='!=';
        $ascdsc='desc';
        $where=[['cus_id',$id],];
        if($request->sort!=null){
                if ($request->Kategori!='All'){
                    array_push($where,array('jenis_jasa','=', $request->Kategori));
                }
                $srt=$request->sort;
                $ascdsc=$request->ascdesc;
                $Kategori=$request->Kategori;
                $AS=$request->AS;
        }else{
            $request=['sort' => $srt,'Kategori' => $Kategori,'ascdesc' => $ascdsc,'AS' => $AS];
            $request = (object)$request;
        }
        array_push($where,array('status',$AS, '5'));
        $jasa = Jasa::where($where)->get();
        $pemba =Pembayaran::wherein('jasa_id',$jasa->pluck('id'))->with('nota')->with('jasa')->orderBy($srt, $ascdsc)->paginate(10);
        //return $pemba_samp[0]->sampling->detail_id;
        return view('invoice.listbayar',compact('pemba','request'));
    }
    public function inputbuktibyr(Request $request)
    {
        $id=Auth::user()->id;
        $this->validate($request, [   
            'img_bukti' => 'required', 
        ]);
        $fullname = $request->file('img_bukti')->getClientOriginalName();
        $extn =$request->file('img_bukti')->getClientOriginalExtension();
        $finalS=$request->jns.'buktibayar'.'_'.$request->id.'_'.$id.'_'.time().'.'.$extn;
        $path = $request->file('img_bukti')->storeAs('public/buktibayar', $finalS);
        Pembayaran::where('id',$request->id)->update([
            'status' => 1,
        ]);
        Nota::create([
            'bayar_id' => $request->id,
            'img_bukti' => $finalS,
        ]); 
        return redirect()->back();
         //return $request->file('img_bukti')->getClientOriginalName();
    }

    public function viewkonsul()
    {
        $id=Auth::user()->id;
        $produksi=Jasa::where([
            ['jenis_jasa','=', '1'],
            ['cus_id','=', $id],
            ['status','!=', '5'],
        ])->paginate($perPage = 6, $columns = ['*'], $pageName = 'prod');
        $sampling=Jasa::where([
            ['jenis_jasa','=', '0'],
            ['cus_id','=', $id],
            ['status','!=', '5'],
        ])->paginate($perPage = 6, $columns = ['*'], $pageName = 'samp');
        
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

    public function viewpilihkonsul($id)
    {
        $UsId=Auth::user()->id;
        $valid=Jasa::where([
            ['id',$id],
            ['cus_id',$UsId],
            ])->firstorfail();
        $jadwal = Konsul::where([
            ['status','0'],
            ['tgl','>=', date("Y-m-d")],
            ])->get();
        $jadwal1 = Konsul::where([
            ['status','1'],
            ['jasa_id',$id]
        ])->get();
        $cal = Konsul::all();
        return view('konsul.ambiljadwal',compact('jadwal','jadwal1','id','cal'));
    }

    public function pilihkonsul(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',   
        ]);

        Konsul::where('id',$request->id)->update([
            'jasa_id' => $request->jasa_id,
            'status' => 1,
        ]);
        return redirect()->back();
    }
}
