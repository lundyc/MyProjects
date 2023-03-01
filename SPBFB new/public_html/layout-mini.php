<?php 
header('Expires: '.gmdate('D, d M Y H:i:s \G\M\T', time()+3600*24*7));
header('Content-type: text/html; charset=iso-8859-1');
header('Last-Modified: '.gmdate('D, d M Y H:i:s', filemtime(__FILE__)).' GMT', true, 200);
header("Content-type: text/css; charset: UTF-8"); 
 if (substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip')) ob_start("ob_gzhandler"); else ob_start();
?> 
html{overflow:auto;overflow-x:auto;background-color:#E9E3D1;}
* body{font-family:'lucida grande',tahoma,verdana,arial,sans-serif;font-size:10px;margin:0px;padding:0px;line-height:1.5em;text-align:center;height:100%;min-height:100%;}
a:link, a:visited, a:active{color:#222;}
a:hover{color:#5f6069;}
#container{width:988px;margin:0 auto;padding:0;-webkit-box-shadow:4px 2px #BDB8AD, -4px 0 2px #BDB8AD;-moz-box-shadow:4px 0 2px #BDB8AD, -4px 0 2px #BDB8AD;box-shadow:4px 0 2px #BDB8AD, -4px 0 2px #BDB8AD;background:#FFFFFF;}
header{background:#1B3F6E url("/userfiles/image/new%20badge.png") no-repeat center center;width:988px;height:324px;}
#main{width:100%;padding:0;background-color:#FFFFFF;}
#sideBar{width:29%;min-height:100%;float:right;display:block;margin:0;font-size:11px;text-align:left;vertical-align:top;}
#content{width:71%;min-height:100%;float:left;display:block;margin:0;font-size:11px;text-align:left;vertical-align:top;}
footer{background:#B3B5B5;width:100%;clear:both;text-align:center;vertical-align:middle;padding:15px 0 15px;}
nav{width:100%;height:32px;margin:0 0 4px;padding:0px;background:#7C8F9C;;}
nav ul{width:100%;margin:0 auto;padding:0px;list-style-type:none;float:left;}
nav ul li{float:left;}
nav ul li a:link, nav ul li a:visited, nav ul li a:active{display:block;width:auto;height:24px;font:bold 10px;font-family:'lucida grande',tahoma,verdana,arial,sans-serif;color:#E9E3D1 !important;text-decoration:none;text-transform:uppercase;margin:0;padding:8px 26px 0 !important;}
nav ul li a:hover{background: #1B3F6E; }
div .mb h2{background-color:#B3B5B5;color:#FFF;font-size:12px;font-weight:bold;text-transform:uppercase;letter-spacing:2px;margin:0 0 0.6em;padding:0.7em;}
h4 { font-size:16px;border-bottom: 1px dashed #cccccc; text-transform: uppercase; margin-bottom: 2px; }
div.module{margin-bottom:1em;padding:1px 3px 1px 3px;}
.featBanner{text-align:center;}
.fadelisting{border-bottom: 2px dashed #cccccc;margin-bottom:9px;padding:0 6px;}
#news .header{font-size:20px;color:#000;font-weight:bold;line-height:1.2em;font-family:arial;}
#news .h4{font-weight:normal;font-size:10px;}
#news .MainBody{padding:0 0 6px 0;}
#login{border:0 none;margin:1px;padding:1px;width:100%;}
#login span{width:10%;font-weight:bold;}
#login .input{width:80%;border:1px solid #000000;padding-left:3px;margin-bottom:3px;}
#login div{padding-left:15px;}
.row1{float:left;width:27%;font-weight: bold;padding-left:10px}
.row2{float:left;width:60%;}
.subtitle{font-size:14px;padding:3px 0 3px 10px;}
.subtitle a{text-decoration:none;}
.where{clear: both; padding-bottom: 3px; margin-bottom: 3px; border-bottom: 1px dashed black;padding-left:10px;}
f.login_button {padding: 3px 6px;background-color: #7C8F9C;color: #E9E3D1;border: 1px solid #234B76;}
#links {text-align: center;margin: 0px;padding: 3px;border-bottom: 1px dashed #cccccc}
#links span {padding-right: 6px;padding-left: 6px;border-right: 2px solid #656766;}
.subtitle {font-size: 12px;font-weight: bold;margin: 3px 0 0 0;padding: 5px;background: #E9E3D1;border-bottom: 1px solid #B3B5B5;color: #464c55;}
.popup_box {display:none;position:fixed;_position:absolute;height:30%;width:50%;background:#FFFFFF;  left: 300px;top: 150px;z-index:100;margin-left: 15px;border:1px solid #1B3F6E;padding:15px;font-size:15px;-moz-box-shadow: 0 0 5px #1B3F6E;-webkit-box-shadow: 0 0 5px #1B3F6E;box-shadow: 0 0 5px #1B3F6E;text-align: left;}
.popup_box a, .openpopup{cursor: pointer;text-decoration:none;} 
.popupBoxClose {font-size:14px;line-height:15px;right:5px;top:5px;position:absolute;color:#6fa5e2;font-weight:500;}