<?php
include("classes/DomDocumentParser.php");

function followLinks($url)
{
    //echo $url;
    $parser = new DomDocumentParser($url);

    $linkList = $parser->getLinks();

    foreach($linkList as $link) {
        $href = $link -> getAttribute("href");
        echo $href . "<br>"; 
    }
}

$startUrl = "https://www.stackoverflow.com/";
    followLinks($startUrl);

?>