<html>
<head>
    <title>Receipt</title>
    <style type="text/css">
        <!--
        body {
            font-family: Arial;
            font-size: 18.6px
        }

        .pos {
            position: absolute;
            z-index: 0;
            left: 0px;
            top: 0px
        }

        -->
    </style>
</head>
<body>
<div style="top:-150px; left: -80px;position: absolute;">
    <nobr>
        <nowrap>
            <div class="pos" id="_0:0" style="top:80">
                <img name="_1170:827" src="image/page_001.jpg" height="1170" width="827" border="0" usemap="#Map"></div>
            <div class="pos" id="_132:151" style="top:201;left:132">
<span id="_13.6" style="font-weight:bold; font-family:Times New Roman; font-size:13.6px; color:#ff0000">
Sede Ufficiale Esami Internazionali</span>
            </div>
            <div class="pos" id="_78:198" style="top:228;left:78">
<span id="_15.0" style=" font-family:Arial; font-size:15.0px; color:#002060">
Milano, {{ $date }}</span>
            </div>
            <div class="pos" id="_521:251" style="top:251;left:421">
<span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#002060">
Yingzhen WU</span>
            </div>
            <div class="pos" id="_521:269" style="top:269;left:421">
<span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#002060">
Via 5 MAGGIO, 19</span>
            </div>
            <div class="pos" id="_521:286" style="top:286;left:421">
<span id="_15.0" style=" font-family:Times New Roman; font-size:15.0px; color:#002060">
20100 Milano</span>
            </div>
            <div class="pos" id="_78:337" style="top:307;left:78">
<span id="_15.0" style=" font-family:Arial; font-size:15.0px; color:#002060">
Rif.: Ricev. F.P./E.T. Cod. n.&#176; A &#8211; {{ $student->id }}/{{ date('Y') }}</span>
            </div>
            <div class="pos" id="_78:408" style="top:368;left:78">
<span id="_15.0" style=" font-family:Arial; font-size:15.0px; color:#002060">
Descrizione</span>
            </div>
            <div class="pos" id="_373:408" style="top:368;left:273">
<span id="_15.0" style="font-weight:bold; font-family:Arial; font-size:15.0px; color:#002060">
Data Appello</span>
            </div>
            <div class="pos" id="_619:408" style="top:368;left:519">
<span id="_15.0" style=" font-family:Arial; font-size:15.0px; color:#002060">
Costo unitario (&#8364;)</span>
            </div>
            <div class="pos" id="_78:443" style="top:403;left:78">
<span id="_14.3" style=" font-family:Arial; font-size:14.3px; color:#002060">
<span style="font-style:italic"> {{ $student->description }}</span>
            </div>
            <div class="pos" id="_78:496" style="top:436;left:78">
<span id="_14.8" style=" font-family:Arial; font-size:14.8px; color:#002060">
Iscrizione Toeic</span>
            </div>
            <div class="pos" id="_373:496" style="top:436;left:273">
<span id="_14.8" style="font-weight:bold; font-family:Arial; font-size:14.8px; color:#002060">
{{ $date }}</span>
            </div>
            <div class="pos" id="_619:496" style="top:436;left:519">
<span id="_14.8" style="font-weight:bold; font-family:Arial; font-size:14.8px; color:#002060">
{{ $student->total }}
</span>
            </div>
            <div class="pos" id="_78:513" style="top:463;left:78">
<span id="_14.8" style="font-style:italic; font-family:Arial; font-size:14.8px; color:#002060">
        @if($student->Exams[0]->sessionType)
        {{ $student->Exams[0]->sessionType->name }}
    @endif
</span>
            </div>
            <div class="pos" id="_78:548" style="top:478;left:78">
<span id="_14.8" style="font-style:italic; font-family:Arial; font-size:14.8px; color:#002060">
        @if($student->Exams[0]->courseType)
        ({{ $student->Exams[0]->courseType->name }} )
    @endif
</span>
            </div>
            <div class="pos" id="_78:882" style="top:582;left:78">
<span id="_14.8" style="font-weight:bold; font-family:Arial; font-size:14.8px; color:#002060">
Totale:</span>
            </div>
            <div class="pos" id="_618:882" style="top:582;left:518">
<span id="_14.8" style="font-weight:bold; font-family:Arial; font-size:14.8px; color:#002060">
&#8364; {{ $student->total }}</span>
            </div>
            <div class="pos" id="_78:900" style="top:630;left:78">
<span id="_13.4" style="font-style:italic; font-family:Arial; font-size:13.4px; color:#002060">
s.f.</span>
            </div>
            <div class="pos" id="_78:947" style="top:657;left:78">
<span id="_13.4" style="font-style:italic; font-family:Arial; font-size:13.4px; color:#002060">
Sedi d&#8217;esame:<span style="font-weight:bold"> Via</span><span style="font-weight:bold"> M.</span><span
            style="font-weight:bold"> Gioia,</span><span style="font-weight:bold"> 62</span><span
            style="font-weight:bold"> -</span><span style="font-weight:bold"> Milano</span> (MM3 &#8211; Sondrio). Seguir&#224; mail di convocazione<span
            style="font-weight:bold"> 4</span><span style="font-weight:bold"> gg</span> . ca. prima della</span>
            </div>
            <div class="pos" id="_78:963" style="top:673;left:78">
<span id="_13.4" style="font-style:italic; font-family:Arial; font-size:13.4px; color:#002060">
prova con l&#8217;indicazione dell&#8217;orario e altre istruzioni cui sar&#224; essenziale dare conferma di &#8220;<span
            style="font-weight:bold"> Presa</span><span style="font-weight:bold"> Visione&#8221;</span><span
            style="font-weight:bold"> entro</span></span>
            </div>
            <div class="pos" id="_78:979" style="top:689;left:78">
<span id="_13.4" style="font-weight:bold;font-style:italic; font-family:Arial; font-size:13.4px; color:#002060">
e non oltre le 48 ore prima dall&#8217;esame pena l&#8217;esclusione dallo stesso.</span>
            </div>
            <div class="pos" id="_242:1071" style="top:771;left:152">
<span id="_12.1" style=" font-family:Times New Roman; font-size:12.1px; color:#000000">
British Language Services s.n.c. &#8211; Sede Legale e Amministrativa: 20052 Monza</span>
            </div>
            <div class="pos" id="_151:1085" style="top:785;left:101">
<span id="_12.1" style="font-weight:bold; font-family:Times New Roman; font-size:12.1px; color:#000000">
Sede Operativa<span style="font-weight:normal"> :</span><span style="font-weight:normal"> Via</span><span
            style="font-weight:normal"> C.</span><span style="font-weight:normal"> De</span><span
            style="font-weight:normal"> Cristoforis,</span><span style="font-weight:normal"> 15</span><span
            style="font-weight:normal"> &#8211;</span><span style="font-weight:normal"> 20124</span><span
            style="font-weight:normal"> Milano</span><span style="font-weight:normal"> -</span><span
            style="font-weight:normal"> Tel.</span><span style="font-weight:normal"> ++39.02.6596401</span><span
            style="font-weight:normal"> &#8211;</span><span style="font-weight:normal"> Fax</span><span
            style="font-weight:normal"> ++39.02.29002395</span></span>
            </div>
            <div class="pos" id="_158:1099" style="top:799;left:108">
<span id="_12.1" style=" font-family:Times New Roman; font-size:12.1px; color:#0000ff">
<U>w</U><U>w</U><U>w</U><U>.</U><U>l</U><U>i</U><U>n</U><U>g</U><U>u</U><U>a</U><U>v</U><U>i</U><U>v</U><U>a</U><U>.</U><U>n</U><U>e</U><U>t</U><span
            style=" color:#000000"> &#8211;</span><span style="font-weight:bold"> segreteria@linguaviva.net</span><span
            style=" color:#000000"> -</span><span style=" color:#000000"> Cod.Fiscale</span><span
            style=" color:#000000"> e</span><span style=" color:#000000"> P.IVA:</span><span style=" color:#000000"> 03720660962</span><span
            style=" color:#000000"> -</span><span style=" color:#000000"> R.E.A.</span><span style=" color:#000000"> 1697380</span></span>
            </div>
        </nowrap>
    </nobr>
</div>
</body>
</html>
