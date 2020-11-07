<?php
if(empty($argv[1])) exit("Identifique um formato de página\n");

$formato = $argv[1];

$urlOCR  = 'page.html';

$ocrHtml = file_get_contents($urlOCR);

preg_match_all('#<div id="pag_[^>]*?>Página:?\s*(\w+)#is', $ocrHtml, $paginas);

if(empty($paginas[1])) exit("Não identifiquei as páginas\n");

foreach($paginas[1] as $key => $pagina){
    $arquivo = "pags/$pagina.$formato";

    if(file_exists($arquivo)){
        echo "Página conferida: $pagina \n";
        exec("rm $arquivo");
    }
}
