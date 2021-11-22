<?php
	///////////////////////////////////////////////////////////////////////////////////////
 	// 空欄チェック
 	///////////////////////////////////////////////////////////////////////////////////////

	function checkVOID($key,$val,$type)
	{
		$alert = '';
		$error = 0;

		switch($type)
		{
			case 'check'	:
			case 'radio'	: $error_text = 'をチェック'; break;
			case 'select'	: $error_text = 'を選択'; break;
			case 'agree'	: $error_text = 'に同意'; break;
			default		: $error_text = 'を入力';
		}

		if($val == '' OR $val == NULL)
		{
			$alert = '<span>'.$key.$error_text.'してください。</span>';
			$error = 1;
		}

		return array($alert,$error);
	}

	///////////////////////////////////////////////////////////////////////////////////////
 	// 文字数チェック
 	///////////////////////////////////////////////////////////////////////////////////////

	function checkLENGTH($key,$val,$max,$min)
	{
		$alert = '';
		$error = 0;

		if(isset($min) OR isset($max))
		{
	 		$len = mb_strlen($val,"UTF-8");

			if(!empty($min) AND !empty($max) AND (!($min <= $len) OR !($len <= $max)))
			{
				$alert = '<span>'.$key.'は'.$min.'文字から'.$max.'文字で入力してください。</span>';
				$error = 1;
			}
			elseif(!empty($min) AND !($min <= $len))
			{
				$alert = '<span>'.$key.'は'.$min.'文字以上で入力してください。</span>';
				$error = 1;
			}
			elseif(!empty($max) AND !($len <= $max))
			{
				$alert = '<span>'.$key.'は'.$max.'文字以内で入力してください。</span>';
				$error = 1;
			}
		}
		return array($alert,$error);
	}

	///////////////////////////////////////////////////////////////////////////////////////
 	// 形式チェック
 	///////////////////////////////////////////////////////////////////////////////////////

	function checkSTRING($key,$val,$type)
	{
		$alert = '';
		$error = 0;

		$ary_patterns = array(
		'tel'		=>	array('を正しく','/^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$|^[0-9]{7,12}$/'),
		'postal'	=>	array('を正しく','/^[0-9]{3}-[0-9]{2,4}$/'),
		'mail'		=>	array('を正しく','/^([a-z0-9_]|\-|\.|\+)+@(([a-z0-9_]|\-)+\.)+[a-z]{2,6}$/i'),
		'pass'		=>	array('を正しく','/[\@-\~]/'),
		'url'		=>	array('を正しく','/^(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)$/'),
		'alpha'		=>	array('は半角英字で','/^[a-zA-Z]+$/'),
		'alpha2'	=>	array('は半角英字で','/^[a-zA-Z\s]+$/'),
		'num'		=>	array('は半角数字で','/^[0-9]+$/'),
		'numpoint'	=>	array('は小数点第2位までの半角数字で','/^[0-9]+$|^[0-9]+.[0-9]{1,2}$/'),
		'alphanum'	=>	array('は半角英数で','/^[a-zA-Z0-9]+$/'),
		'alphanum_'	=>	array('は半角英数で','/^[a-zA-Z0-9_\-]+$/'),
		'hira'		=>	array('はひらがなで','/^[ぁ-ん゛゜ゝゞーむ]+$/'),
		'kana'		=>	array('はカタカナで','/^[ァ-ヾ]+$/u'),
		'date'		=>	array('を正しく','/^[0-9]+\-[0-9]+\-[0-9]+$/'),
		'time'		=>	array('を正しく','/^[0-9]+\-[0-9]+$/'),
		);

		list($error_text,$pattern) = $ary_patterns[$type];

		if(!preg_match($pattern,$val))
		{
			$alert = '<span>'.$key.$error_text.'入力してください。</span>';
			$error = 1;
		}

	      return array($alert,$error);
	}

	///////////////////////////////////////////////////////////////////////////////////////
 	// 一致チェック
 	///////////////////////////////////////////////////////////////////////////////////////

	function checkMATCH($origin,$val,$origin_val)
	{
		$alert = '';
		$error = 0;

		if(!($val === $origin_val))
		{
			$alert = '<span>'.$origin.'が一致しません。</span>';
			$error = 1;
		}

	      return array($alert,$error);
	}

	///////////////////////////////////////////////////////////////////////////////////////
 	// DB一致チェック
 	///////////////////////////////////////////////////////////////////////////////////////

	///////////////////////////////////////////////////////////////////////////////////////
 	// dispatch
 	// ary_elem		: key => array(type,require,max,min,match)
 	// ary_errors	: key => array(alert,count)
 	///////////////////////////////////////////////////////////////////////////////////////

	function check_form($ary_elem,$p)
	{

		global $render_alert,$error_cnt;

		foreach($ary_elem as $key => $val)
		{
			if(!isset($val[2])){ $val[2] = '';}
			if(!isset($val[3])){ $val[3] = '';}
			if(!isset($val[4])){ $val[4] = '';}
			list($type,$require,$max,$min,$match) = $val;

			// check VOID
			if($require == 1){ $ary_errors[$key] = checkVOID($key,$p[$key],$type); }

			if(!empty($p[$key]))
			{
				// check FORMAT
				if($ary_errors[$key][1] == 0)
				{
					switch($type)
					{
						case 'text'			: break;
						case 'check'		: break;
						case 'radio'		: break;
						case 'select'		: break;
						case 'agree'		: break;
						default			: $ary_errors[$key] = checkSTRING($key,$p[$key],$type);
					}
				}

				// check LENGTH
				if($ary_errors[$key][1] == 0)
				{
					$ary_errors[$key] = checkLENGTH($key,$p[$key],$max,$min);
				}

				// check MATCH
				if($ary_errors[$key][1] == 0 AND $match == 1)
				{
					$origin = $key.'（確認）';
					if($ary_errors[$key][1] == 0){ $ary_errors[$key] = checkMATCH($key,$p[$key],$p[$origin]); }
				}
			}
		}

		foreach($ary_errors as $key => $ary)
		{
			list($alert,$count) = $ary;

			$render_alert .= $alert;
			$error_cnt = $error_cnt + $count;
		}

		return array($render_alert,$error_cnt);
	}
?>