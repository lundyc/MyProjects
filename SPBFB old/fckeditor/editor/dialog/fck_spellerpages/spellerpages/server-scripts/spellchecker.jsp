<%@page language="java"%>
<%@page import="java.io.*"%>
<%@page import="java.util.Enumeration"%>
<%@page import="org.apache.commons.lang.*"%>

<%

String osName = System.getProperty("os.name");
String s = null;

//The following variables values must reflect your installation needs.
//convert from php to jsp by windu gata 10 October 2007 budi luhur university
//fixed 17 october 2007

//String aspell_prog = "C:\\Program Files\\Aspell\\bin\\aspell.exe"; //windows
String aspell_prog = "/usr/local/bin/aspell"; //linux
//String aspell_prog = "/opt/local/bin/aspell"; //apple
String aspell_opts = "-a --lang=en_US --encoding=utf-8 -H --rem-sgml-check=alt";
String spellercss = "../spellerStyle.css"; 
String word_win_src = "../wordWindow.js";

String input_separator = "A";
//java has no decode html so u acan add character
//String escape_char[] = {"%0D%0A" , "%3Cp%3E" , "%3C%2Fp%3E", "%3Cb%3E", "%3C%2Fb%3E", "%20", " %3Cbr%3E", "%0A", "%2C", "%22", "%27", "%3C", "a href%3D\"mailto%A", "%3C%2Fa%3E", "%40", "%3A", "%3D", "_fcksavedurl=", "<%2Fa%3E", "%3E", "%26nbsp", "%3B", "<br"}; 
//String replace_char[]= {" " , " " , " " , " " , " " , " " , " " , " " , "," , " " , " " , "<" , " " , " " , "@" , ":" , "=" , " " , " " , " " , " " , " " , " " };

%>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<%=spellercss %>" />
<script language="javascript" src="<%=word_win_src %>"></script>
<script language="javascript">
var suggs = new Array();
var words = new Array();
var textinputs = new Array();
var error;

<%


//get parameter
String textinputs = request.getParameter("textinputs[]");
//out.write("textinputs[0] = decodeURIComponent(\"\");\n");
out.write("textinputs[0] = decodeURIComponent(\"" + textinputs + "\");\n");
System.out.println(textinputs);

//delete escape character
//for (int i=0; i<escape_char.length;i++) {
//textinputs = textinputs.replace(escape_char[i],replace_char[i]);
//}

textinputs=java.net.URLDecoder.decode(textinputs,"UTF-8");

//get temporary servlet directory
ServletContext context=request.getSession().getServletContext();
File tmpdir=(File)context.getAttribute("javax.servlet.context.tempdir");
String tmpfile="/aspell_data_"+new java.util.Random().nextLong();

//Replace newline characters
System.out.println("Before newline char replace: " + textinputs);
textinputs=textinputs.replaceAll("\n",""); 
textinputs=textinputs.replaceAll("\r",""); 
System.out.println("After newline char replace: " + textinputs);


try {
//save temporary file
PrintWriter printout = new PrintWriter (new BufferedWriter (new FileWriter (tmpdir.getPath() + tmpfile)));
printout.print (textinputs);
printout.flush ();
printout.close ();
}
catch (IOException e) {
out.write("Cannot Create File Temporary " + e.toString()) ;
}

try {

// Windows Nt or XP, change "cmd " t0 "command" on windows 98
// String[] cmd = {
// "cmd",
// "-c",
// aspell_prog + " " + aspell_opts + "<" + tmpdir.getPath() + tmpfile + " 2>&1"
// };

//Test
//tmpfile="/aspell_data_-4239128009781966915";
//End Test

String[] cmd = {
"/bin/sh",
"-c",
aspell_prog + " " + aspell_opts + "<" + tmpdir.getPath() + tmpfile + " 2>&1"
};

Process p1 = Runtime.getRuntime().exec(cmd);


int exitValue = p1.waitFor();

System.out.println("jalan " + exitValue);

if (exitValue == 0){
BufferedReader stdInput = new BufferedReader(new InputStreamReader(p1.getInputStream()));
int index = 0;
int text_input_idx = -1; 
int line=0;
//boolean noMispelled = false;


while ((s = stdInput.readLine()) != null) {
if (text_input_idx == -1) {

text_input_idx++;
out.write("words[" + text_input_idx + "] = [];\n");
out.write("suggs[" + text_input_idx + "] = [];\n");

}

if (!s.startsWith("@") && s.length() > 0) {

if (s.startsWith("&") || s.startsWith("#")) {

//if (text_input_idx == -1) {

// text_input_idx++;
// out.write("words[" + text_input_idx + "] = [];\n");
// out.write("suggs[" + text_input_idx + "] = [];\n");


//}

System.out.println(" nilai " + s.replace("\'", "\\'"));

String word[] = s.replace("\'", "").split(":");
String wordleft[] = word[0].split(" ");

out.write ("words[" + text_input_idx + "][" + index + "] = '" + wordleft[1].replace("\'", "\\'") + "';\n"); 
if ( word.length > 1) {
String suggs[] = word[1].split(", ");
out.write("suggs[" + text_input_idx + "][" + index + "] = [");

for (int i=0; i< suggs.length ; i++) {
out.write( "'" + suggs[i].trim().replace("\'","") + "'");
if (i < suggs.length-1 ) {
out.write(",");
}
}

out.write("];\n");
} 
//noMispelled = true;
index++;

} else if (s.startsWith("*") ) {
//text_input_idx++;
//if(noMispelled) {
//out.write("words[" + text_input_idx + "] = [];\n");
//out.write("suggs[" + text_input_idx + "] = [];\n");
//index = 0;
//}
} 

line++;
}

}
}

}
catch (Exception e) {
System.out.println(e.toString());
}

File f1 = new File(tmpdir.getPath() + tmpfile );
boolean success = f1.delete();
if (!success){
System.out.println("Deletion failed.");
}


%>

var wordWindowObj = new wordWindow();
wordWindowObj.originalSpellings = words;
wordWindowObj.suggestions = suggs;
wordWindowObj.textInputs = textinputs;

function init_spell() {
// check if any error occured during server-side processing
if( error ) {
alert( error );
} else {
// call the init_spell() function in the parent frameset
if (parent.frames.length) {
parent.init_spell( wordWindowObj );
} else {
alert('This page was loaded outside of a frameset. It might not display properly');
}
}
}

</script>

</head>
<!-- <body onLoad="init_spell();"> by FredCK -->
<body onLoad="init_spell();" bgcolor="#ffffff">

<script type="text/javascript">

wordWindowObj.writeBody();
</script>
</body>
</html>