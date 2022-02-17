<?php
include("classes/DomDocumentParser.php");

function createLink($src, $url)
{
    echo "SRC: $src<br>";
    // echo "URL: $url<br>";

    $scheme = parse_url($url)["scheme"]; //http
    $host = parse_url($url)["host"]; //www.name.com

    #//www.name.com
    if (substr($src, 0, 2) == "//") {
        $src = $scheme . ":" . $src; # http://www.name.com
    } 
    # /page.php
    else if (substr($src, 0, 1) == "/") {
        $src = $scheme . "://" . $host . $src; # http://www.name.com/page.php
    }

    # ./page.php
    else if (substr($src, 0, 2) == "./") {
        $src = $scheme . "://" . $host . dirname(parse_url($url)["path"]) . substr($src,1); 
    }
   
    #../path/page.php
    else if (substr($src, 0, 3) == "../") {
        $src = $scheme . "://" . $host . "/" . $src;
    }

    #www.name.com/page.php
    else if (substr($src, 0, 4) == "https" || substr($src, 0, 3) == "http") {
        $src = $scheme . "://" . $host . "/" .  $src;
    }
    echo "Final SRC: $src<br><br><br>";
    return $src;
}

function followLinks($url)
{
    //echo $url;
    $parser = new DomDocumentParser($url);

    $linkList = $parser->getLinks();

    foreach ($linkList as $link) {
        $href = $link->getAttribute("href");
        #echo $href . "<br>"; 

        if (strpos($href, "#") !== false) {
            continue;
        } else if (substr($href, 0, 11) == "javascript:") {
            continue;
        }

        $href = createLink($href, $url);

        echo $href . "<br>";
    }
}

$startUrl = "https://www.bbc.com/";
followLinks($startUrl);
