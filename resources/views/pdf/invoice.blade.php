<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<meta name=Generator content="Microsoft Word 15 (filtered)">
<style>
<!--
 /* Font Definitions */
 @font-face
	{font-family:"Cambria Math";
	panose-1:2 4 5 3 5 4 6 3 2 4;}
@font-face
	{font-family:Calibri;
	panose-1:2 15 5 2 2 2 4 3 2 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
	{margin-top:0in;
	margin-right:0in;
	margin-bottom:8.0pt;
	margin-left:0in;
	line-height:107%;
	font-size:11.0pt;
	font-family:"Calibri",sans-serif;}
.MsoChpDefault
	{font-family:"Calibri",sans-serif;}
.MsoPapDefault
	{margin-bottom:8.0pt;
	line-height:107%;}
@page WordSection1
	{size:8.5in 11.0in;
	margin:1.0in 1.0in 1.0in 1.0in;}
div.WordSection1
	{page:WordSection1;}
-->
</style>

</head>

<body lang=EN-US style='word-wrap:break-word'>

<div class=WordSection1>

<p class=MsoNormal style='margin-left:276.45pt'><span style='position:absolute;
z-index:-1895825408;left:0px;margin-left:-35px;margin-top:0px;width:299px;
height:89px'><img width=299 height=89
src="{{'images/logo_1.png'}}"></span></p>
<br>
<p class=MsoNormal style='margin-left:276.45pt'>No                              :{{$id}}</p>
<p class=MsoNormal style='margin-left:276.45pt'>Nama                         :{{$dataD->name}}</p>

<p class=MsoNormal style='margin-left:276.45pt'>No Telp                      :{{$dataD->no_telp}}</p>
<p class=MsoNormal style='margin-bottom:7.5pt;line-height:normal;background:
white'><span style='font-size:13.0pt;font-family:Roboto;color:#212529'>082123488998
@amoora.couture                               </span><span style='color:black'>Tgl.
Masuk                 :{{$jasa->created_at}}</span></p>

<p class=MsoNormal style='margin-left:276.45pt'>Tgl. Selesai               :{{$jasa->tgl_jadi}}</p>

<p class=MsoNormal>&nbsp;</p>

<table class=MsoTableGrid border=1 cellspacing=0 cellpadding=0
 style='border-collapse:collapse;border:none'>
 <tr>
  <td width=56 valign=top style='width:42.3pt;border:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>NO</p>
  </td>
  <td width=57 valign=top style='width:42.5pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>QTY</p>
  </td>
  <td width=261 valign=top style='width:195.7pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>Keterangan</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>Harga</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border:solid windowtext 1.0pt;
  border-left:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>Jumlah</p>
  </td>
 </tr>
 <tr style='height:175.95pt'>
  <td width=56 valign=top style='width:42.3pt;border:solid windowtext 1.0pt;
  border-top:none;padding:0in 5.4pt 0in 5.4pt;height:175.95pt'>
  @foreach($invoice as $row)
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$loop->iteration}}</p>
  @endforeach
  
  </td>
  <td width=57 valign=top style='width:42.5pt;border-top:none;border-left:none;
  border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:175.95pt'>
  @foreach($invoice as $row)
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$row->qty}}</p>
  @endforeach
  </td>
  <td width=261 valign=top style='width:195.7pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:175.95pt'>
  @foreach($invoice as $row)
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$row->ket}}</p>
  @endforeach
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:175.95pt'>
  @foreach($invoice as $row)
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$row->harga}}</p>
  @endforeach
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt;height:175.95pt'>
  @foreach($invoice as $row)
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$row->total}}</p>
  @endforeach
  </td>
 </tr>
 @if($nota->terbayar!=null)
 <tr>
  <td width=56 valign=top style='width:42.3pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=57 valign=top style='width:42.5pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=261 valign=top style='width:195.7pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>Terbayar</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$nota->terbayar}}</p>
  </td>
 </tr>
 @endif
 <tr>
  <td width=56 valign=top style='width:42.3pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=57 valign=top style='width:42.5pt;border:none;padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=261 valign=top style='width:195.7pt;border:none;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>&nbsp;</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>Total</p>
  </td>
  <td width=125 valign=top style='width:93.5pt;border-top:none;border-left:
  none;border-bottom:solid windowtext 1.0pt;border-right:solid windowtext 1.0pt;
  padding:0in 5.4pt 0in 5.4pt'>
  <p class=MsoNormal style='margin-bottom:0in;line-height:normal'>{{$sum - $nota->terbayar}}</p>
  </td>
 </tr>
 
 
</table>

<p class=MsoNormal><span style='color:white'>                                                                </span></p>

<p class=MsoNormal>&nbsp;</p>

<p class=MsoNormal align=center style='margin-left:4.0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>No.
Rekening BCA 8610672311</span></b></p>

<p class=MsoNormal align=center style='margin-left:4.0in;text-align:center'><b><span
style='font-size:12.0pt;line-height:107%;font-family:"Times New Roman",serif'>a/n
Nurulita Nurjannah</span></b></p>







</div>

</body>

