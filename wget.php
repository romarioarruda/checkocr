<?php

if(empty($argv[1])) exit("Informe um prefixo para a paginação.\n");

$prefixo = $argv[1];

$iniPag = 1;
$fimPag = 56;

$data = date('Ymd');

$accessToken = 'SNZf3fqFIiumZ-tbHe2pjhqMz5weCK9QhLDogTWKaYE54wm9vjuHYjeix8vhY7Qj3mNHCCTJoMOnmD_fieZYKg!!';

$issueId = '2069'.$data.'00000000001001';

for($i = $iniPag; $i <= $fimPag; $i++) {
    $fileTxt = $i.'.txt';
    exec('wget "https://svc.pressreader.com/se2skyservices/print/GetImageByRegion/?accessToken='.$accessToken.'&useContentProxy=true&issue='.$issueId.'&page='.$i.'&paper=A4&scale=false&scaleToLandscape=false" -O '.$fileTxt);

    if(file_exists($fileTxt)) {
        $txt = json_decode(file_get_contents($fileTxt), true);
        if(isset($txt['Data']['Src'])) {
            exec('wget "'.$txt['Data']['Src'].'" -O pags/'.$prefixo.$i.'.jpg');
        }
    }
}

exec('rm *.txt');
echo "Arquivos .txt removidos\n";
