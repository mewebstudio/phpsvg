<!doctype html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
        <title>phpSVG - Multipurpose SVG edit or create lib</title>
    </head>
    <body>
        <a href="http://phpsvg.nostaljia.eng.br">
            <img src="../example/resource/phpSVG.svg" style="width:7%; height: 7%; float:left;"/>
        </a>
        <h1>phpSVG</h1>
        <p>Lib version:&nbsp;<?php echo file_get_contents('svglib/VERSION'); ?> <a href="svglib/CHANGELOG">Changelog</a><p>
        <p>
            <a href='http://www.w3.org/TR/SVG/'>SVG</a> means <strong>Scalable Vector graphics</strong>, it a XML based, open-source vector graphics  <br/>
        supported by various drawings programs like <a href="http://inkscape.org/">Inkscape</a>, Corel Draw and Adobe Illustrator.</p>
        <p>PhpSVG is a multipurpose library to create or edit SVG using Object Oriented <a href="http://php.net/">PHP</a> scripts.<br/>
        It's possible to edit a existent SVG document or create a new from scratch.</p>
        <p>If you don't see the phpSVG logo you browsser don't have SVG view capabilities.</p>
        <p><strong>Links</strong></p>
        <a href='doc/html/index.html'>Documentation.</a>&nbsp;
        <a href='http://code.google.com/p/phpsvg/'>Source code.</a>&nbsp;
        <a href='http://trialforce.nostaljia.eng.br/'>Author's blog.</a>&nbsp;
        <a href='http://www.phpclasses.org/package/7073-PHP-Create-and-edit-vectorial-graphics-in-SVG-files.html'>PHP Classes Innovation award;</a>
        
        <p><strong>Examples</strong></p>
        <?php
        if ( is_array( $examples = glob('example/*.php') ) )
        {
            foreach ( $examples as $line => $info )
            {
                $name = basename($info);
                echo "\n        <a href='$info'>$name</a>&nbsp; - <a href='viewExample.php?example={$name}'>View source</a><br/>";
            }
        }
        ?>
        
    </body>
</html>