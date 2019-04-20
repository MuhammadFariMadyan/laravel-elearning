<html>

<head>
<meta http-equiv=Content-Type content="text/html; charset=windows-1252">
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
@font-face
  {font-family:"Adobe Devanagari";
  panose-1:0 0 0 0 0 0 0 0 0 0;}
@font-face
  {font-family:"Bernard MT Condensed";
  panose-1:2 5 8 6 6 9 5 2 4 4;}
 /* Style Definitions */
 p.MsoNormal, li.MsoNormal, div.MsoNormal
  {margin-top:0cm;
  margin-right:0cm;
  margin-bottom:8.0pt;
  margin-left:0cm;
  line-height:107%;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";}
p.MsoListParagraph, li.MsoListParagraph, div.MsoListParagraph
  {margin-top:0cm;
  margin-right:0cm;
  margin-bottom:8.0pt;
  margin-left:36.0pt;
  line-height:107%;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpFirst, li.MsoListParagraphCxSpFirst, div.MsoListParagraphCxSpFirst
  {margin-top:0cm;
  margin-right:0cm;
  margin-bottom:0cm;
  margin-left:36.0pt;
  margin-bottom:.0001pt;
  line-height:107%;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpMiddle, li.MsoListParagraphCxSpMiddle, div.MsoListParagraphCxSpMiddle
  {margin-top:0cm;
  margin-right:0cm;
  margin-bottom:0cm;
  margin-left:36.0pt;
  margin-bottom:.0001pt;
  line-height:107%;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";}
p.MsoListParagraphCxSpLast, li.MsoListParagraphCxSpLast, div.MsoListParagraphCxSpLast
  {margin-top:0cm;
  margin-right:0cm;
  margin-bottom:8.0pt;
  margin-left:36.0pt;
  line-height:107%;
  font-size:11.0pt;
  font-family:"Calibri","sans-serif";}
.MsoChpDefault
  {font-family:"Calibri","sans-serif";}
.MsoPapDefault
  {margin-bottom:8.0pt;
  line-height:107%;}
@page WordSection1
  {size:595.3pt 841.9pt;
  margin:72.0pt 42.45pt 72.0pt 42.55pt;}
div.WordSection1
  {page:WordSection1;}
 /* List Definitions */
 ol
  {margin-bottom:0cm;}
ul
  {margin-bottom:0cm;}
-->
</style>

</head>

<body lang=IN>

<div class=WordSection1>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt; text-align:center;text-indent:63.8pt;line-height:normal'>
   <span style='position:relative;z-index:251659258'>
   <span style='left:0px;position: absolute;left:-80px;top:-18px;width:70px;height:95px'>
  <img width=70 height=95 src="{{asset('/img2/image002.jpg')}}" align=left hspace=12>>
  </span>
  </span>
  <b><span style='font-size:14.0pt;font-family:"Times New Roman","serif"'>PEMERINTAH KABUPATEN TANGGAMUS</span></b></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:70pt;line-height:normal'><b>
  <span style='font-size:14.0pt;font-family:"Times New Roman","serif"'>DINAS KESEHATAN</span></b>
</p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt; text-align:center;text-indent:50pt;line-height:normal'>
<span style='font-size:11.0pt;font-family:"Bernard MT Condensed","serif"'>UNIT PELAKSANA TEKNIS PUSKESMAS RAWAT INAP TALANG PADANG</span></p>

<div style='border:none;border-bottom:double windowtext 4.5pt;padding:0cm 0cm 1.0pt 0cm'>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:40pt;line-height:normal;border:none;padding:
0cm'><span style='font-family:"Times New Roman","serif"'>Alamat : Jl. Raden Intan
telp. (0729) 41061 Talang Padang Kab. Tanggamus</span></p>

<p class=MsoNormal align=center style='margin-bottom:0cm;margin-bottom:.0001pt;
text-align:center;text-indent:63.8pt;line-height:normal;border:none;padding:
0cm'><span style='font-size:1.0pt;font-family:"Times New Roman","serif"'>&nbsp;</span></p>

</div>
  <h7>&nbsp;</h7>
                    @if(isset($dataPasienCetak))  
                      @foreach($dataPasienCetak as $dataPasien)                                          
                      <center>
                          <u><font size="14">DATA PASIEN RAWAT JALAN<br></u>
                          </font>  
                          <h7>&nbsp;</h7>        
                       </center>
                            <table width="80%" align="center" >
                                <tbody>
                                  <tr>                                  
                                  <td>Kode Pasien </td>                                  
                                  <td><span class="badge bg-white">:  {{$dataPasien->kode_pasien}}</span></td>
                                </tr>
                                <tr>                                  
                                  <td>Nama Pasien </td>                                  
                                  <td><span class="badge bg-white">:   {{$dataPasien->nama_pasien}}</span></td>
                                </tr>                                
                                <tr>
                                  <td>Alamat </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->alamat}}</span></td>
                                </tr>  
                                <tr>
                                  <td>Rt </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->rt}}</span></td>
                                </tr>
                                <tr>
                                  <td>Rw </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->rw}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Tanggal Lahir </td>                                  
                                  <td><span class="badge bg-light-white">: {{date('d - m - Y', strtotime($dataPasien->tgl_lahir))}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Agama </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->agama}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Jenis Pembayaran </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->Jen_pmbyrn}}</span></td>
                                </tr> 
                                <tr>
                                  <td>No Jaminan </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->no_jaminan}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Pekerjaan </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->pekerjaan}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Pendidikan Terakhir </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->pend_trkhr}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Telp </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->telp}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Ortu/Suami </td>                                  
                                  <td><span class="badge bg-light-white">: {{$dataPasien->ortu_suami}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Istri/Anak </td>                               
                                  <td><span class="badge bg-light-white">: {{$dataPasien->istri_anak}}</span></td>
                                </tr> 
                                <tr>
                                  <td>Alergi Obat </td>                                
                                  <td><span class="badge bg-light-white">: {{$dataPasien->alergi_obat}}</span></td>
                                </tr>                                                                         
                              </tbody>
                            </table>                                                                
                       @endforeach     
                    @endif
                    <h7>&nbsp;</h7>
                  <table border="0" width="85%">                    
                    <tr>
                      <td width="70%" align="center"></td>
                      <td align="center"> Talang Padang, {{date('d-m-Y')}}</td>                              
                    </tr>
                    <tr height="60px">
                      <td width="70%" align="center"></td>
                      <td></td>                             
                    </tr>              
                    <tr>
                      <td width="70%" align="center"></td>
                      <td align="center"><br><br><br>Pasien</u></td>                             
                    </tr>            
                  </table>

    </div>

  </body>

</html>