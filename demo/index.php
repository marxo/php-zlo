<?php

use Zamphyr\ZLO;

include "../libzlo.php";

$libzlo = new ZLO\libzlo("l10n/");

$libzlo->ZL_LANG = isset($_GET["zl"]) ? $_GET['zl'] : NULL;

?>
<!DOCTYPE html>
<html lang="<?= $libzlo->zlo_header("$libzlo->ZL_LANG")["JEZ"];?>" dir="<?= $libzlo->zlo_header("$libzlo->ZL_LANG")["BDO"];?>">
<head>
    <meta charset="<?= $libzlo->zlo_header("$libzlo->ZL_LANG")["CHR"];?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Zamphyr">

    <title><?= $libzlo->zlo("libZLO test page");?></title>
</head>
<body>
    <div>
        <ul>
            <li><a href="?zl=eng">English</a>
            <li><a href="?zl=srp_RS@Cyrl">српски (Србија)</a>
            <li><a href="?zl=gle">Gaeilge</a>
            <li><a href="?zl=zho_CN">中文(简体)</a>
            <li><a href="?zl=kat">ქართული</a>
            <li><a href="?zl=ara_SA">اللغة العربية الفصحى</a>
            <li><a href="?zl=kaz">Қазақ тілі</a>
        </ul>
    </div>

    <?= $libzlo->zlo("Welcome!");?>
</body>
</html>