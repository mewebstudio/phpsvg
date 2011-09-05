<?php

require_once '../svglib/inkscape.php';
$inkscape = new Inkscape( '/home/trialforce/svn/phpsvg/example/resource/apple.svg' );
$inkscape->exportAreaSnap(); //better pixel art
$inkscape->exportTextToPath();
echo '<pre>';
//echo $inkscape->getVersion()."\n";
//echo $inkscape->getHelp()."\n";
//$inkscape->setQueryId( 'myId' );
echo $inkscape->export( 'png', '/home/trialforce/svn/phpsvg/example/output/apple.png' );
//echo $inkscape->execute();
echo '</pre>';
?>
