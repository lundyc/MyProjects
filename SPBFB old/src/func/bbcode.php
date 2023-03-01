<?php
function icon($text) {
    
    $replace = Array();
    
    $sql = mysql_query("SELECT code, url FROM smilies ORDER BY id");
    while (list($code, $url) = mysql_fetch_array($sql))
    {         
        $replace[$code] = '<img src="images/icones/'. $url .'" />';
    }

$output = strtr($text, $replace);

return ($output);
}

?>