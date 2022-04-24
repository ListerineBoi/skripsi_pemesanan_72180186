<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Detail_pakaian;
use App\Models\Slot_S;
use App\Models\Slot_P;
use App\Models\Sampling;
use App\Models\Produksi;
use App\Models\DetailFile;
use App\Models\Pembayaran;
use App\Models\Konsul;
use App\Models\User;
use App\Models\DetailInvoice;
use App\Models\Nota;
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
        return view('homeAdmin');
    }
    public function viewslotsampling()
    {
        $slot=Slot_S::all();
        return view('sampling.setslotsampling',compact('slot'));
    }

    public function saveslot(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot_S= new Slot_S([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => 1
            
        ]);
        $Slot_S->save();
        return redirect()->route('viewslotsampling');
    }
    public function vieweditslotsampling($id)
    {
        $slot=Slot_S::where('id','=', $id)->first();
        return view('sampling.editslotsampling',compact('slot'));
    }

    public function saveeditslotS(Request $request)
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
        Slot_S::where('id', $request->id)->update([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => $status
            
        ]);
        return redirect()->route('viewslotsampling');
       
        
    }

    public function delslotS($id)
    {
        Slot_S::where('id', $id)->delete();
        return redirect()->route('viewslotsampling');
    }

    public function viewslistsampling()
    {
        $sampling=Sampling::where('status','!=','6')->get();
        return view('sampling.listsampling',compact('sampling'));
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
    }

    public function vieweditsampling($id)
    {
        $sampling=Sampling::where('id','=', $id)->first();
        $fileimg=DetailFile::where('detail_id','=', $sampling->detail_id)->get();
        return view('sampling.admineditsampling',compact('sampling','fileimg'));
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

    public function statusSampling(Request $request)
    {
        Sampling::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return redirect()->route('viewslistsampling'); 
    }    

    public function viewslotproduksi()
    {
        $slot=Slot_P::all();
        return view('produksi.setslotproduksi',compact('slot'));
    }

    public function saveslotP(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'mulai' => 'required',
            'kuota' => 'required',
            'selesai' => 'required'      
        ]);

        $Slot_P= new Slot_P([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => 1
            
        ]);
        $Slot_P->save();
        return redirect()->route('viewslotproduksi');
    }

    public function vieweditslotproduksi($id)
    {
        $slot=Slot_P::where('id','=', $id)->first();
        return view('produksi.editslotproduksi',compact('slot'));
    }

    public function saveeditslotP(Request $request)
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
        Slot_P::where('id', $request->id)->update([
            'title' => $request->title,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'kuota' => $request->kuota,
            'status' => $status
            
        ]);
        return redirect()->route('viewslotproduksi');
       
        
    }

    public function viewslistproduksi()
    {
        $produksi=Produksi::all();
        return view('produksi.listproduksi',compact('produksi'));
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
        return view('produksi.admineditproduksi',compact('produksi','detail','fileimg','id'));
    }

    public function saveeditprod(Request $request)
    {
        $this->validate($request,[
            'jml' => 'required' 
        ]);
        Produksi::where('id',$request->id)->update([
            'jml' => $request->jml
        ]);
        return redirect()->route('viewslistproduksi');
    }
    public function statusProd(Request $request)
    {
        Produksi::where('id', $request->id)->update([
            'status' => $request->status
        ]);
        return redirect()->route('viewslistproduksi'); 
    }

    public function lihatinvoicesampling($id,$jns)
    {
        if($jns==0){
            $jasa=Sampling::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $pemb=Pembayaran::where('samp_id',$jasa->id)->with('nota')->get();
        }else{
            $jasa=Produksi::where('id',$id)->first();
            $dataD=User::where('id',$jasa->cus_id)->first();
            $pemb=Pembayaran::where('prod_id',$jasa->id)->with('nota')->get();
        }
        //eturn $pemb[0]->nota;
        return view('invoice.lihatinvoiceadm',compact('dataD','jasa','id','jns','pemb'));
    }
    public function tambahinvoice(Request $request)
    {
        if($request->jns==0){
            $bayar= new Pembayaran([
                'samp_id' => $request->jasa_id,
                'jenis_jasa' => $request->jns,
            ]);
            $bayar->save();
        }else{
            $bayar= new Pembayaran([
                'prod_id' => $request->jasa_id,
                'jenis_jasa' => $request->jns,
            ]);
            $bayar->save();
        }
        return redirect()->back();
    }
    public function lihatdetailinvoice($id,$jns)
    {
            if($jns==0){
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Sampling::where('id',$nota->samp_id)->first();
            }else{
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Produksi::where('id',$nota->prod_id)->first();
            }
            $dataD=User::where('id',$jasa->cus_id)->first();
            $invoice=DetailInvoice::where('bayar_id',$id)->get();
            $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
        
        //return
        return view('invoice.lihatdetailadm',compact('nota','dataD','jasa','id','jns','invoice','sum'));
    }
    
    public function addinvoice(Request $request)
    {
        $this->validate($request, [
            'qty' => 'required',
            'ket' => 'required',
            'harga' => 'required',
            'total' => 'required'      
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

    public function generateinvoicesampling(Request $request)
    {
        $id=$request->id;
        $jns=$request->jns;
        if($jns==0){
            $nota=Pembayaran::where('id',$id)->first();
            $jasa=Sampling::where('id',$nota->samp_id)->first();
        }else{
            $nota=Pembayaran::where('id',$id)->first();
            $jasa=Produksi::where('id',$nota->prod_id)->first();
        }
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
        if($jns==0){
            $nota=Pembayaran::where('id',$id)->first();
            $jasa=Sampling::where('id',$nota->samp_id)->first();
        }else{
            $nota=Pembayaran::where('id',$id)->first();
            $jasa=Produksi::where('id',$nota->prod_id)->first();
        }
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
        if($request->jp==0){
            $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
            Pembayaran::where('id',$request->id)->update([
                'status' => 2,
                'terbayar' => $sum
            ]);
            if($jns==0){
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Sampling::where('id',$nota->samp_id)->first();
            }else{
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Produksi::where('id',$nota->prod_id)->first();
            }
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
                'file_nota' => $namanota,
            ]);  
        }else if($request->jp==1){
            Pembayaran::where('id',$request->id)->update([
                'status' => 3,
                'terbayar' => $request->terbayar
            ]);
            if($jns==0){
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Sampling::where('id',$nota->samp_id)->first();
            }else{
                $nota=Pembayaran::where('id',$id)->first();
                $jasa=Produksi::where('id',$nota->prod_id)->first();
            }
            $sum=DetailInvoice::where('bayar_id',$id)->sum('total');
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
                'file_nota' => $namanota,
            ]); 
        }
        return redirect()->back();
        //return $wow;
    }
    public function viewjadwalkonsul()
    {
        $jadwal = Konsul::where('status','1')->get();
        //return view('');
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
    public function tgljadi(Request $request)
    {
        $this->validate($request, [
            'tgl_jadi' => 'required',
        ]);
        if($request->jns==0){
            Sampling::where('id',$request->id)->update([
                'tgl_jadi' => $request->tgl_jadi,
            ]);
        }else if($request->jns==1){
            Produksi::where('id',$request->id)->update([
                'tgl_jadi' => $request->tgl_jadi,
            ]);
        }
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
