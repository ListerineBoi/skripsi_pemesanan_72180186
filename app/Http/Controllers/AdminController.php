<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_pakaian;
use App\Models\Slot;
use App\Models\Jasa;
use App\Models\DetailFile;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\Katalog;
use App\Models\User;
use App\Models\DetailInvoice;
use App\Models\Nota;
use Illuminate\Support\Facades\Hash;
use App\Models\admin;
use PDF;
use Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $Katalog=Katalog::paginate(6);
        return view('homeAdmin',compact('Katalog'));
    }
    public function viewprofile()
    {
        $admin=admin::all();
        return view('profile.adminprofile',compact('admin'));
    }

    public function addadmin(Request $request)
    {
        $this->validate($request, [
            'email' => ['required','max:190','unique:admins'],
            'name' => 'required',
            'password' => ['required','min:8','max:190']    
        ]);
        
        $admin= new admin([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $admin->save();
        return redirect()->back();
    }
    public function setkatalog(Request $request)
    {
        $this->validate($request, [
            'desc' => 'required',
            'harga' => 'required',
            'title' => 'required'     
        ]);
        
        $Katalog= new Katalog([
            'title' => $request->title,
            'desc' => $request->desc,
            'harga' => $request->harga,
            'aktif' => '1',
        ]);
        $Katalog->save();
        return redirect()->back();
    }

    public function delkatalog(Request $request)
    {
        $Katalog=Katalog::where('id',$request->id)->first();
        if($Katalog->img_depan == null && $Katalog->img_belakang == null && $Katalog->img_dll1 == null 
        && $Katalog->img_dll2 == null && $Katalog->detail_id_s == null && $Katalog->detail_id_m == null 
        && $Katalog->detail_id_l == null && $Katalog->detail_id_xl == null)
        {
            $delpath='public/katalog/'.$Katalog->img;
            Storage::delete($delpath);
            Katalog::where('id', $request->id)->delete();
            return redirect()->back();
        }else{
            return redirect()->back()->with('Forbidden','Pastikan Isi Produk Katalog Sudah Kosong');
        } 
    }
    public function editkatalog(Request $request)
    {
        if($request->aktif==null){
            $aktif=0;
        }else{
            $aktif=1;
        }
        Katalog::where('id', $request->id)->update([
            'desc' => $request->desc,
            'aktif' => $aktif,
        ]);
        return redirect()->back();
    }
    public function addimgkatalog(Request $request)
    {
        $this->validate($request, [
            'img' => 'required',  
        ]);
        $fullname = $request->file('img')->getClientOriginalName();
        $extn =$request->file('img')->getClientOriginalExtension();
        $finalS='katalog'.'_'.$request->jenis.'_'.$request->id.'.'.$extn;
        $path = $request->file('img')->storeAs('public/katalog', $finalS);
        if($request->jenis=='dep'){
            Katalog::where('id', $request->id)->update([
                'img_depan' => $finalS,
            ]);
        }elseif ($request->jenis=='bel') {
            Katalog::where('id', $request->id)->update([
                'img_belakang' => $finalS,
            ]);
        }elseif ($request->jenis=='dll1') {
            Katalog::where('id', $request->id)->update([
                'img_dll1' => $finalS,  
            ]);
        }elseif ($request->jenis=='dll2') {
            Katalog::where('id', $request->id)->update([
                'img_dll2' => $finalS,   
            ]);
        }
        return redirect()->back();
    }
    public function delimgkatalog($id,$img)
    {
        $kat=Katalog::where('id', $id)->first();
        $delpath='public/katalog/'.$kat->$img;
        Storage::delete($delpath);
        Katalog::where('id', $id)->update([
            $img => null
        ]);
        return redirect()->back();
    }

    public function viewadmindetailkatalog($id)
    {
        $katalog=Katalog::where('id',$id)->first();
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
        return view('katalog.admindetailkatalog',compact('katalog','details','detailm','detaill','detailxl'));
    }
    public function createdetailkatalog($id,$tipe)
    {
        $katalog=Katalog::where('id',$id)->first();
        $Detail_pakaian= Detail_pakaian::create([
            'public' => '0',
            'nama_atasan' => $katalog->title.' '.$tipe,
            'jenis' => '1',
            'desc' => '',
        ]);
        if($tipe == 'S'){
            Katalog::where('id', $id)->update([
                'detail_id_s' => $Detail_pakaian->id,
            ]);
        }elseif ($tipe == 'M') {
            Katalog::where('id', $id)->update([
                'detail_id_m' => $Detail_pakaian->id,
            ]);
        }elseif ($tipe == 'L') {
            Katalog::where('id', $id)->update([
                'detail_id_l' => $Detail_pakaian->id,
            ]);
        }elseif ($tipe == 'XL') {
            Katalog::where('id', $id)->update([
                'detail_id_xl' => $Detail_pakaian->id,
            ]);
        }
        return redirect()->back();
    }
    public function vieweditdetailkatalog($id)
    {
        $detail=detail_pakaian::where('id','=', $id)->first();
        $redirURL = str_replace(url('/'), '', url()->previous());
        return view('katalog.admineditdetailkatalog',compact('detail','redirURL'));
        //return $redirURL;
    }
    public function delkatalogukuran($id,$id_kat,$tipe)
    {
        $cek=Jasa::where('detail_id',$id)->get();
        if(count($cek)==0){
            if($tipe == 'S'){
                Katalog::where('id', $id_kat)->update([
                    'detail_id_s' => null,
                ]);
            }elseif ($tipe == 'M') {
                Katalog::where('id', $id_kat)->update([
                    'detail_id_m' => null,
                ]);
            }elseif ($tipe == 'L') {
                Katalog::where('id', $id_kat)->update([
                    'detail_id_l' => null,
                ]);
            }elseif ($tipe == 'XL') {
                Katalog::where('id', $id_kat)->update([
                    'detail_id_xl' => null,
                ]);
            }
            $detail=detail_pakaian::where('id','=', $id)->delete();
            return redirect()->back();
        }else{
            return redirect()->back()->with('Forbidden','Pastikan Detail ini Belum Pernah Dipakai');
        }
        
        //return $cek;    
    }
    public function saveeditdetailkatalog(Request $request)
    {
        $this->validate($request, [
            'nama_atasan' => 'required',
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

    public function viewslotsampling()
    {
        $slot=Slot::where('jenis','=', '0')->get();
        return view('sampling.setslotsampling',compact('slot'));
    }

    public function viewslotproduksi()
    {
        $slot=Slot::where('jenis','=', '1')->get();
        return view('produksi.setslotproduksi',compact('slot'));
    }

    public function saveslot(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot= new Slot([
            'jenis' => $request->jenis,
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => 1
            
        ]);
        $Slot->save();
        return redirect()->back();
    }
    public function vieweditslot($id)
    {
        $slot=Slot::where('id','=', $id)->first();
        return view('sampling.editslotsampling',compact('slot'));
    }

    public function saveeditslot(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);
        if($request->status==null){
            $status=0;
        }else{
            $status=1;
        }
        Slot::where('id', $request->id)->update([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => $status
            
        ]);

        return redirect()->back();
       
        
    }

    public function delslot($id)
    {
        $cek=Slot::where('id', $id)->value('jml');
        if($cek=='0'){
            Slot::where('id', $id)->delete();
            return redirect()->back();
        }else{
            return redirect()->back()->with('Forbidden','Pastikan Slot Kosong');
        }
    }

    public function viewslistsampling(Request $request)
    {
        $srt='created_at';
        $status='All-on-going';
        $ascdsc='desc';
        $where=[['jenis_jasa','=', '0'],];
        if($request->sort!=null){
            if ($request->slot!='All'){
            array_push($where,array('slot_id','=', $request->slot));
            }
            $status=$request->status;
            $srt=$request->sort;
            $ascdsc=$request->ascdesc;
        }
        if ($status=='All-on-going') {
            array_push($where,array('status','!=', '5'));
        }else if ($status!='All-on-going'){
            array_push($where,array('status','=', $status));
        }
          
        
        $isislot=Slot::where('jenis','=', '0')->get();
        $sampling=Jasa::where($where)->orderBy($srt, $ascdsc)->paginate(10);
        if($request->sort==null){
            $request=['sort' => $srt,'ascdesc' => $ascdsc,'slot' => 'All','status' => $status];
            $request = (object)$request;
        }
        return view('sampling.listsampling',compact('sampling','isislot','request'));
        //return $request;
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
    }

    public function vieweditsampling($id)
    {
        $sampling=Jasa::where('id','=', $id)->first();
        $detail=detail_pakaian::where([
            ['id','=', $sampling->detail_id],
        ])->first();
        if($detail->public==1){
            $fileimg=DetailFile::where('detail_id','=', $sampling->detail_id)->get();
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
        return view('sampling.admineditsampling',compact('sampling','fileimg','detail'));
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

    public function statusSampling(Request $request)
    {
        $id_admin=Auth::user()->id;
        Jasa::where('id', $request->id)->update([
            'status' => $request->status,
            'admin_id' => $id_admin
        ]);
        return redirect()->back(); 
    }    

    public function viewslistproduksi(Request $request)
    {
        $srt='created_at';
        $status='All-on-going';
        $ascdsc='desc';
        $where=[['jenis_jasa','=', '1'],];
        if($request->sort!=null){
            if ($request->slot!='All'){
                array_push($where,array('slot_id','=', $request->slot));
            }
            $status=$request->status;
            $srt=$request->sort;
            $ascdsc=$request->ascdesc;
        }
        if ($status=='All-on-going') {
            array_push($where,array('status','!=', '5'));
        }else if ($status!='All-on-going'){
            array_push($where,array('status','=', $status));
        }
        $isislot=Slot::where('jenis','=', '1')->get();
        $produksi=Jasa::where($where)->orderBy($srt, $ascdsc)->paginate(10);
        if($request->sort==null){
            $request=['sort' => $srt,'ascdesc' => $ascdsc,'slot' => 'All','status' => $status];
            $request = (object)$request;
        }
        return view('produksi.listproduksi',compact('produksi','isislot','request'));
    }

    public function vieweditproduksi($id)
    {
        $produksi=Jasa::where([
            ['id','=', $id],
        ])->first();
        $detail=detail_pakaian::where([
            ['id','=', $produksi->detail_id],
        ])->first();
        if($detail->public==1){
            $fileimg=DetailFile::where('detail_id','=', $detail->id)->get();
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
        return view('produksi.admineditproduksi',compact('produksi','detail','fileimg','id'));
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
        return redirect()->route('viewslistproduksi');
    }
    public function saveeditsampkat(Request $request)
    {
        Jasa::where('id',$request->id)->update([
            'permintn' => $request->permintn
        ]);
        return redirect()->back();
    }
    public function statusProd(Request $request)
    {
        $id_admin=Auth::user()->id;
        Jasa::where('id', $request->id)->update([
            'status' => $request->status,
            'admin_id' => $id_admin
        ]);
        return redirect()->back(); 
    }
    public function vieweditdetailprod($id)
    {
        $detail=detail_pakaian::where('id','=', $id)->first();
        $redirURL = str_replace(url('/'), '', url()->previous());
        return view('produksi.admineditdetailprod',compact('detail','redirURL'));
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

    
    public function lihatinvoicesampling($id,$jns)
    {
        $jasa=Jasa::where('id',$id)->first();
        $dataD=User::where('id',$jasa->cus_id)->first();
        $pemb=Pembayaran::where('jasa_id',$id)->with('nota')->get();
        return view('invoice.lihatinvoiceadm',compact('dataD','jasa','id','jns','pemb'));
    }
    public function tambahinvoice(Request $request)
    {
        $bayar= new Pembayaran([
            'jasa_id' => $request->jasa_id,
            'jenis_jasa' => $request->jns,
        ]);
        $bayar->save();
        return redirect()->back();
    }
    public function lihatdetailinvoice($id,$jns)
    {
        $nota=Pembayaran::where('id',$id)->first();
        $jasa=Jasa::where('id',$nota->jasa_id)->first();
        $dataD=User::where('id',$jasa->cus_id)->first();
        $invoice=DetailInvoice::where('bayar_id',$id)->get();
        $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
        return view('invoice.lihatdetailadm',compact('nota','dataD','jasa','id','jns','invoice','sum'));
    }
    
    public function addinvoice(Request $request)
    {
        $this->validate($request, [
            'qty' => ['required','max:5'],
            'ket' => 'required',
            'harga' => ['required','max:10'],
            'total' => ['required','max:10']      
        ]);
       
            $invoice= new DetailInvoice([
                'bayar_id' => $request->id,
                'qty' => $request->qty,
                'ket' => $request->ket,
                'harga' => $request->harga,
                'total' => $request->total
                
            ]);
            $invoice->save();
        
        return redirect()->back();
    }
    public function delinvoice(Request $request)
    {     
        DetailInvoice::where('id', $request->id)->delete();
        return redirect()->back();
        //return $request->id;
    }

    public function generateinvoicesampling(Request $request)
    {
        $id=$request->id;
        $jns=$request->jns;
        $nota=Pembayaran::where('id',$id)->first();
        $jasa=Jasa::where('id',$nota->jasa_id)->first();
        $dataD=User::where('id',$jasa->cus_id)->first();
        $invoice=DetailInvoice::where('bayar_id',$id)->get();
        $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
        
        $pdf = PDF::loadview('/pdf/invoice',compact('dataD','jasa','invoice','id','jns','sum','nota'))->setpaper('Legal','potrait');
        return $pdf->stream('invoice');
        
    }
    public function sendinvoice(Request $request)
    {
        $id=$request->id;
        $jns=$request->jns;
        $nota=Pembayaran::where('id',$id)->first();
        $jasa=Jasa::where('id',$nota->jasa_id)->first();
        $dataD=User::where('id',$jasa->cus_id)->first();
        $invoice=DetailInvoice::where('bayar_id',$id)->get();
        $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
        $pdf = PDF::loadview('/pdf/invoice',compact('dataD','jasa','invoice','id','jns','sum','nota'))->setpaper('Legal','potrait');
        $content = $pdf->download()->getOriginalContent();
        $nama=$jns.'_'.$jasa->id.'_'.$dataD->id.'.pdf';
        Storage::put('public/invoice/'.$nama,$content);
        
        Pembayaran::where('id',$id)->update([
            'file_invoice' => $nama,
        ]);
        
        return redirect()->back();
    }
    public function verifbuktibyr(Request $request)
    {
        $id=$request->id;
        $jns=$request->jns;
        $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
        if($request->jp==0){
            Pembayaran::where('id',$request->id)->update([
                'status' => 2,
                'terbayar' => $sum
            ]);
        }else if($request->jp==1){
            $terbayar=Pembayaran::where('id',$request->id)->value('terbayar');
            $sumbayar=$terbayar+$request->terbayar;
            Pembayaran::where('id',$request->id)->update([
                'status' => 3,
                'terbayar' => $sumbayar
            ]);
        }
        $nota=Pembayaran::where('id',$id)->first();
        $jasa=Jasa::where('id',$nota->jasa_id)->first();
        $dataD=User::where('id',$jasa->cus_id)->first();
        $invoice=DetailInvoice::where('bayar_id',$id)->get();
        $pdf = PDF::loadview('/pdf/invoice',compact('dataD','jasa','invoice','id','jns','sum','nota'))->setpaper('Legal','potrait');
        $content = $pdf->download()->getOriginalContent();
        $nama=$jns.'_'.$jasa->id.'_'.$dataD->id.'.pdf';
        $namanota=$jns.'_'.$jasa->id.'_'.$dataD->id.'_'.time().'.pdf';
        Storage::put('public/invoice/'.$nama,$content);
        Storage::put('public/nota/'.$namanota,$content);
        Pembayaran::where('id',$id)->update([
            'file_invoice' => $nama,
        ]); 
        Nota::where('bayar_id',$id)->orderBy('id','desc')->first()->update([
            'jenis_pembayaran' =>$request->jp,
            'file_nota' => $namanota,
        ]);  
        
        return redirect()->back();
        //return $wow;
    }
    public function viewformtambahkonsul()
    {
        $id_admin=Auth::user()->id;
        $jadwal = Konsul::all();
        $jadwal1 = Konsul::where('status','1')->get();
        return view('konsul.setjadwal',compact('id_admin','jadwal','jadwal1'));
    }
    public function tambahkonsul(Request $request)
    { 
        $this->validate($request, [
            'title' => 'required',
            'jns' => 'required',
            'mulai' => 'required', 
        ]);
        $konsul= new Konsul([
            'title' => $request->title,
            'tgl' => $request->tgl,
            'jenis' => $request->jns,
            'mulai' => $request->mulai,
            'status' =>'0'
        ]);
        $konsul->save();
        return redirect()->back();
    }
    public function delkonsul($id)
    { 
        Konsul::where('id','=', $id)->delete();
        return redirect()->back();
    }
    public function tgljadi(Request $request)
    {
        $this->validate($request, [
            'tgl_jadi' => 'required',
        ]);
        
        Jasa::where('id',$request->id)->update([
            'tgl_jadi' => $request->tgl_jadi,
        ]);
        
        return redirect()->back();
    }

    public function addlink(Request $request)
    {
        Konsul::where('id', $request->id)->update([
            'link' => $request->link,
        ]);
        return redirect()->back();
    }
    
}
