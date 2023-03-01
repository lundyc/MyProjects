<?php 
extract($_POST, EXTR_SKIP);
extract($_GET, EXTR_SKIP);
set_magic_quotes_runtime(0);

// Anti-SQL Injection
$query_string = strtolower(rawurldecode($_SERVER['QUERY_STRING']));
$bad_string = array("%20union%20", "/*", "*/union/*", "+union+", "load_file", "outfile", "document.cookie", "onmouse", "<script", "<iframe", "<applet", "<meta", "<style", "<form", "<img", "<body", "<link");
foreach ($bad_string as $string_value)
{
    if (strpos($query_string, $string_value)) die("<br /><br /><br /><div style=\"text-align: center;\"><big>What are you trying to do ?</big></div>");
}
unset($query_string, $bad_string, $string_value);


$get_id = array("NewsID", "InfoID", "month", "year", "EventID", "AlbumID", "PhotoID", "start", "sign");
foreach ($get_id as $int_id)
{
    if (isset($_GET[$int_id]) && $_GET[$int_id] != "" && !is_numeric($_GET[$int_id])) die("<br /><br /><br /><div style=\"text-align: center;\"><big>Error : ID must be a number !</big></div>");
}
unset($get_id, $int_id);


// FONCTION POUR EMPECHER L'ENVOIE DE FORMULAIRE EXTERNE
/*
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    if ($_SERVER['HTTP_REFERER'] != "")
    {
		if (!ereg($_SERVER['HTTP_HOST'], $_SERVER['HTTP_REFERER'])) die("<br /><br /><br /><div style=\"text-align: center;\"><big>Error : you can't submit request from another server !</big></div>");
    }
    else
    {
		die("<br /><br /><br /><div style=\"text-align: center;\"><big>Error : Referer not found ! Check your browser or firewall's settings.</big></div>");
    }
}
*/

// FONCTION DE SUBSTITUTION POUR MAGIC_QUOTE_GPC
if (!get_magic_quotes_gpc())
{
    if (is_array($_GET))
    {
        while (list($k, $v) = each($_GET))
        {
            if (is_array($_GET[$k]))
            {
                while (list($k2, $v2) = each($_GET[$k]))
                {
                    $_GET[$k][$k2] = addslashes($v2);
                } 
                @reset($_GET[$k]);
            } 
            else
            {
                $_GET[$k] = addslashes($v);
            } 
        } 
        @reset($_GET);
    } 
    if (is_array($_POST))
    {
        while (list($k, $v) = each($_POST))
        {
            if (is_array($_POST[$k]))
            {
                while (list($k2, $v2) = each($_POST[$k]))
                {
                    $_POST[$k][$k2] = addslashes($v2);
                } 
                @reset($_POST[$k]);
            } 
            else
            {
                $_POST[$k] = addslashes($v);
            } 
        } 
        @reset($_POST);
    } 
    if (is_array($_COOKIE))
    {
        while (list($k, $v) = each($_COOKIE))
        {
            if (is_array($_COOKIE[$k]))
            {
                while (list($k2, $v2) = each($_COOKIE[$k]))
                {
                    $_COOKIE[$k][$k2] = addslashes($v2);
                } 
                @reset($_COOKIE[$k]);
            } 
            else
            {
                $_COOKIE[$k] = addslashes($v);
            } 
        } 
        @reset($_COOKIE);
    } 
} 

?>