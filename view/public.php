<?php

	// html header
	function html_header() {

	global $title,$keywords,$description,$h1,$meta,$css,$js,$level;

	echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Language" content="ja" />
<meta name="format-detection" content="telephone=no"> 
<meta name="viewport" content="width=device-width,user-scalable=no,maximum-scale=1" />
<link type="text/css" rel="stylesheet" href="'.$level.'css/import.css" />
'.$css.'
<title>'.$title.'</title>
	<meta name="Keywords" content="'.$keywords.'" />
	<meta name="Description" content="'.$description.'" />
'.$meta.'
</head>
<body id="top">

'; }


	// html footer
	function html_footer()
	{
		global $level,$css,$js;

		echo '
<script type="text/javascript" src="'.$level.'js/import.js"></script>
'.$js.'

'; }

?>