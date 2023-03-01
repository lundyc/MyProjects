<?php 
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()+3600*24*7));
header('Content-type: text/html; charset=iso-8859-1');
header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime(__FILE__)).' GMT', true, 200);
header("Content-type: text/css; charset: UTF-8"); 
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
?> 
html{overflow:auto;overflow-x:auto;background-color:#E9E3D1;width:100%;}
* body{font-family:'lucida grande',tahoma,verdana,arial,sans-serif;font-size:100%;margin:0px;padding:0px;line-height:1.5em;text-align:center;height:100%;min-height:100%;}
a:link, a:visited, a:active{color:#222;}
a:hover{color:#5f6069;}
#container{width:100%;margin:0 auto;padding:0;background:#FFFFFF;}
header{display:none;}
#main{padding:0;background-color:#FFFFFF;width:100%;}
#sideBar{display:none;}
#content{margin:0;font-size:0.688em;text-align:left;vertical-align:top;width:100%;}
footer{background:#B3B5B5;width:100%;clear:both;text-align:center;vertical-align:middle;padding:0.938em 0 0.938em;}
nav{width:100%;height:2em;margin:0;padding:0;background:#7C8F9C;;}
nav ul{width:100%;margin:0 auto;padding:0;list-style-type:none;float:left;}
nav ul li{float:left;}
nav ul li a:link, nav ul li a:visited, nav ul li a:active{display:block;width:auto;height:1.5em;font:bold;font-family:'lucida grande',tahoma,verdana,arial,sans-serif;color:#E9E3D1 !important;text-decoration:none;text-transform:uppercase;margin:0;padding:0.5em 0.938em 0 !important;}
nav ul li a:hover{background: #1B3F6E; }
#media {display:none;}
div .mb h2{background-color:#B3B5B5;color:#FFF;font-size:0.75em;font-weight:bold;text-transform:uppercase;letter-spacing:0.125em;margin:0 0 0.6em;padding:0.7em;}
div.module{margin-bottom:1em;padding:0.063em 0.188em 0.063em 0.188em;}
.featBanner{text-align:center;}
.fadelisting{background:url("images/fade.jpg") bottom left repeat-x;margin-bottom:0.563em;padding:0 0.375em;}
#news .header{font-size:1.250em;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;}
#news .h4{font-weight:normal;font-size:0.625em;}
#news .MainBody{padding:0 0 0.375em 0;}