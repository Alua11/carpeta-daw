<?php

// Include the main TCPDF library (search for installation path).
require_once('tcpdf/tcpdf.php');
require_once('Piezas_Model.php');
require_once('base_datos.php');

// create new PDF document
//Todas las mayusculas son defines
//estos se encuentran definidos en
// RUTA tcpdf/config/tcpdf_config.php
// Si quieres cambiar algo ahí tienes todas las opcciones
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Datos del creador
// //que evidentemente no SOY YO
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('TCPDF eJHEMFSAF 006');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// Que llava Cabecera por defecto
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

// Poner la fuentes por defecto de pie y cabecera
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Fuente por defecto de tipo monospaced 
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// Margenes por defecto
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Cuando por ejemplo una tabla no cabe, que pasa
// // en este caso creo una nueva página
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Como esclar las fotos
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// ---------------------------------------------------------

// Fuente por defecto, antes es en caso de fuente mono
$pdf->SetFont('dejavusans', '', 10);

// Nueva pagina
$pdf->AddPage();

// Empecemos generando a partir de HTML
// existen otra formas pero esta es la más sencilla para nosotros.
$html = '<h1>Ejemplo HTML</h1>
Usar caracteres especiales: &lt; € &euro; &#8364; &amp; è &egrave; &copy; &gt; \\slash \\\\double-slash \\\\\\triple-slash
<h2>List</h2>
List example:
<ol>
    <li><img src="tcpdf/images/logo.png" alt="test alt attribute" width="30" height="30" border="0" /> test image</li>
    <li><b>Negrita text</b></li>
    <li><i>Cursiva text</i></li>
    <li><u>Subrayado</u></li>
    <li><b>b<i>bi<u>biu</u>bi</i>b</b></li>
    <li><a href="http://www.tecnick.com" dir="ltr">link to http://www.tecnick.com</a></li>
    <li>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.<br />Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt.</li>
    <li>SUBLIST
        <ol>
            <li>row one
                <ul>
                    <li>sublist</li>
                </ul>
            </li>
            <li>row two</li>
        </ol>
    </li>
    <li><b>T</b>E<i>S</i><u>T</u> <del>line through</del></li>
    <li><font size="+3">font + 3</font></li>
    <li><small>small text</small> normal <small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal</li>
</ol>
<dl>
    <dt>Coffee</dt>
    <dd>Black hot drink</dd>
    <dt>Milk</dt>
    <dd>White cold drink</dd>
</dl>
<div style="text-align:center">IMAGES<br />
<img src="tcpdf/images/logo.png" alt="test alt attribute" width="100" height="100" border="0" /> <img src="tcpdf/images/logo2.jpg" alt="test alt attribute" width="100" height="100" border="0" />
</div>';

// Escribo el HTML en el pdf, pero de momento no lo genero
$pdf->writeHTML($html, true, false, true, false, '');


// Mas ejemplos
$html = '<div style="text-align:center">The words &#8220;<span dir="rtl">&#1502;&#1494;&#1500; [mazel] &#1496;&#1493;&#1489; [tov]</span>&#8221; mean &#8220;Congratulations!&#8221;</div>';
$pdf->writeHTML($html, true, false, true, false, '');

// Aqui ejemplos con CSS inline
$html = '<p>This is just an example of html code to demonstrate some supported CSS inline styles.
<span style="font-weight: bold;">bold text</span>
<span style="text-decoration: line-through;">line-trough</span>
<span style="text-decoration: underline line-through;">underline and line-trough</span>
<span style="color: rgb(0, 128, 64);">color</span>
<span style="background-color: rgb(255, 0, 0); color: rgb(255, 255, 255);">background color</span>
<span style="font-weight: bold;">bold</span>
<span style="font-size: xx-small;">xx-small</span>
<span style="font-size: x-small;">x-small</span>
<span style="font-size: small;">small</span>
<span style="font-size: medium;">medium</span>
<span style="font-size: large;">large</span>
<span style="font-size: x-large;">x-large</span>
<span style="font-size: xx-large;">xx-large</span>
</p>';

$pdf->writeHTML($html, true, false, true, false, '');

// Pongo el puntero del pdf al final
// Esto es necesario para generar una nueva pagina
$pdf->lastPage();

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Imprimir una tabla

// Nueva pagina
$pdf->AddPage();

// Creamos la tabla con HTML
$subtable = '<table border="1" cellspacing="6" cellpadding="4"><tr><td>a</td><td>b</td></tr><tr><td>c</td><td>d</td></tr></table>';

$html = '<h2>HTML TABLE:</h2>
<table border="1" cellspacing="3" cellpadding="4">
    <tr>
        <th>#</th>
        <th align="right">RIGHT align</th>
        <th align="left">LEFT align</th>
        <th>4A</th>
    </tr>
    <tr>
        <td>1</td>
        <td bgcolor="#cccccc" align="center" colspan="2">A1 ex<i>amp</i>le <a href="http://www.tcpdf.org">link</a> column span. One two tree four five six seven eight nine ten.<br />line after br<br /><small>small text</small> normal <sub>subscript</sub> normal <sup>superscript</sup> normal  bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla bla<ol><li>first<ol><li>sublist</li><li>sublist</li></ol></li><li>second</li></ol><small color="#FF0000" bgcolor="#FFFF00">small small small small small small small small small small small small small small small small small small small small</small></td>
        <td><img src="tcpdf/images/logo.png" alt="test alt attribute" width="100" height="100" border="0" /></td>
    </tr>
    <tr>
        <td>'.$subtable.'</td>
        <td bgcolor="#0000FF" color="yellow" align="center">A2 € &euro; &#8364; &amp; è &egrave;<br/>A2 € &euro; &#8364; &amp; è &egrave;</td>
        <td bgcolor="#FFFF00" align="left"><font color="#FF0000">Red</font> Yellow BG</td>
        <td>4C</td>
    </tr>
    <tr>
        <td>1A</td>
        <td rowspan="2" colspan="2" bgcolor="#FFFFCC">2AA<br />2AB<br />2AC</td>
        <td bgcolor="#FF0000">4D</td>
    </tr>
    <tr>
        <td>1B</td>
        <td>4E</td>
    </tr>
    <tr>
        <td>1C</td>
        <td>2C</td>
        <td>3C</td>
        <td>4F</td>
    </tr>
</table>';

// escribo pero todavía sin imprimir
$pdf->writeHTML($html, true, false, true, false, '');

// Colocamos el puntero al final
$pdf->lastPage();
// Nueva pagina
$pdf->AddPage();
$pieza_model= new Piezas_Model();
$piezas= $pieza_model->getPiezas();
$html= '<h2>HTML TABLE:</h2>
<table border="1">
    <tr>
    	<th><b>NUMERO PIEZA</b></th>
    	<th><b>NOMBRE PIEZA</b></th>
    	<th><b>PRECIO</b></th>
    </tr>';
 foreach ($piezas as $indice =>$pieza){
    $html.='<tr>
      <td>'.$pieza->getNUMPIEZA().'</td>
      <td>'. $pieza->getNOMPIEZA().'</td>
      <td align="right">'. number_format($pieza->getPRECIOVENT(),2,',','.') .' € </td>
     </tr>  ';
     }
    $html.='</table>';
    // escribo pero todavía sin imprimir
$pdf->writeHTML($html, true, false, true, false, '');
// Colocamos el puntero al final
$pdf->lastPage();

//Finalmente imprimos el PDF
$pdf->Output('EjemploClase.pdf', 'I');

?>