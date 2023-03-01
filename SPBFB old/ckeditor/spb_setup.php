<?php
$CKEditor = new CKEditor();
$CKEditor->returnOutput = true;
$CKEditor->basePath = 'ckeditor/';
$config['skin'] = 'office2003';
$config['removePlugins'] = 'resize';
$config['removePlugins'] = 'elementspath';
$config['resize_enabled'] = false;
$config['toolbarCanCollapse'] = false;

$CKEditor->textareaAttributes = array("cols" => 80, "rows" => 4);

$config['toolbar'] = array(
array( 'Source', '-', 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', 'NumberedList', 'BulletedList', '-',  'Outdent','Indent','Blockquote', 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'),
array('Link','Unlink','Anchor','-','Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak', 'TextColor','BGColor'),
array('Styles','Format','Font','FontSize')
);


$code = $CKEditor->editor("editor1", $initialValue, $config);
?>


