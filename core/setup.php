<?php

	define('GLOBAL_URL','http://artory-lab.net/sample/');
	define('GLOBAL_SURL','http://artory-lab.net/sample/');

	///////////////////////////////////////////////////////////////////////////////////////
	// function
	///////////////////////////////////////////////////////////////////////////////////////

	function mbstw($str,$int)
	{
		$int  = $int + 3;
		$return = mb_strimwidth($str,0,$int,"...","UTF-8");
		return $return;
	}

	$timestamp	= date("Y-m-d H:i:s");
	$from		= 'info@artory.co.jp';

	///////////////////////////////////////////////////////////////////////////////////////
	// htmlspecialchars
	///////////////////////////////////////////////////////////////////////////////////////

	function h($str)
	{
		if(is_array($str))
		{
			return array_map("h",$str);
		}
		else
		{
			$str = str_replace( "\0", "", $str ); // NULL byte check
			return htmlspecialchars($str,ENT_QUOTES,'UTF-8'); // escape
		}
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// sanitize
	///////////////////////////////////////////////////////////////////////////////////////

	$p	= h($_POST);
	$g	= h($_GET);
	$sv	= h($_SERVER);
	$ss	= h($_SESSION);
	$c	= h($_COOKIE);
	$f	= h($_FILES);

	if($sv["REQUEST_METHOD"] == "POST")
	{
		foreach($p as $var => $key)
		{
			if(is_array($key)){ $p[$var] = implode("-", $key); }
		}
	}

?>