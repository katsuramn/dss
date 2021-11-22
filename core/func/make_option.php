<?php
	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	数字
	// 第1引数	：	INT		=>	最大数
	// 第2引数	：	INT		=>	(n)毎
	// 第3引数	：	INT		=>	初期値
	//			INT		=>	$_POST
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_num($int,$int2,$int3,$flg)
	{
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		for($i = 0; $i <= $int; $i++){
			if($i == $int3 AND $int3 !== null){ $selected = ' selected="selected"'; } // 0以外入っていたら
			if(($i % $int2) === 0)
			{
				$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			}
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	曜日
	// 第1引数	：	1		=>	今
	//			STR		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_wday($str)
	{
		$wday = date('w');
		$option = '<option value="">選択</option>';
		$wday_array = array('Sun','Mon','Tue','Wed','Thu','Fri','Sat');
		for($i = 0; $i <= 6; $i++){
			if($str == $wday_array[$i]){ $selected = ' selected="selected"'; }
			if($str == 1 AND $i == $wday){ $selected = ' selected="selected"'; }
			$option .= '<option value="'.$wday_array[$i].'"'.$selected.'>'.$wday_array[$i].'</option>';
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	分
	// 第1引数	：	0		=>	今
	//			INT		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_min($int)
	{
		$min = date('i');
		$option .= '<option value="">選択</option>';
		for($i = 0; $i <= 59; $i++){
			if($i == $int AND $int != NULL){ $selected = ' selected="selected"'; } // 0以外入っていたら
			if($int === 0 AND $i == $min){ $selected = ' selected="selected"'; } // 0なら今月
			$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	時
	// 第1引数	：	0		=>	今
	//			INT		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_hour($int)
	{
		$hour = date('H');
		$option .= '<option value="">選択</option>';
		for($i = 0; $i < 24; $i++){
			if($i == $int AND $int != NULL){ $selected = ' selected="selected"'; } // 0以外入っていたら
			if($int === 0 AND $i == $hour){ $selected = ' selected="selected"'; } // 0なら今月
			$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	日
	// 第1引数	：	0		=>	今日
	//			INT		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_day($int)
	{
		$day = date('d');
		$option .= '<option value="">選択</option>';
		for($i = 1; $i <= 31; $i++){
			if($i == $int){ $selected = ' selected="selected"'; } // 0以外入っていたら
			if($int === 0 AND $i == $day){ $selected = ' selected="selected"'; } // 0なら今月
			$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	月
	// 第1引数	：	0		=>	今月
	//			INT		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_month($int)
	{
		$month = date('n');
		$option .= '<option value="">選択</option>';
		for($i = 1; $i <= 12; $i++){
			if($i == $int){ $selected = ' selected="selected"'; } // 0以外入っていたら
			if($int === 0 AND $i == $month){ $selected = ' selected="selected"'; } // 0なら今月
			$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
			$selected = null;
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	年
	// 第1引数	：	0		=>	過去へ数える
	//			1		=>	未来へ数える
	// 第2引数	：	年
	// 第3引数	：	0		=>	今年
	//			INT		=>	$_POST
	//			NULL		=>	初期値
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_year($int1,$int2,$int3,$flg)
	{
		$year = date('Y');
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		if($int1 == 0) // 過去
		{
			for($i = $int2; $i <= $year; $i++){
				if($i == $int3){ $selected = ' selected="selected"'; } // 0以外入っていたら
				if($int3 === 0 AND $i == $year){ $selected = ' selected="selected"'; } // 0なら今月
				$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
				$selected = null;
			}
		}
		if($int1 == 1) // 未来
		{
			for($i = $year; $i <= $int2; $i++){
				if($i == $int3){ $selected = ' selected="selected"'; } // 0以外入っていたら
				if($int3 === 0 AND $i == $year){ $selected = ' selected="selected"'; } // 0なら今月
				$option .= '<option value="'.$i.'"'.$selected.'>'.$i.'</option>';
				$selected = null;
			}
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	ARRAY
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_Array($arr,$str,$flg)
	{
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		for($i = 0; $i < count($arr); $i++)
		{
			if($str == $arr[$i]){ $selected = ' selected="selected"'; }
			$option .= '<option value="'.$arr[$i].'"'. $selected.'>'.$arr[$i].'</option>';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	ARRAY NEW
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function optionArray($arr,$int,$flg)
	{
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		for($i = 0; $i < count($arr); $i++)
		{
			if($int != '' AND $int == $i){ $selected = ' selected="selected"'; }
			$option .= '<option value="'.$i.'"'. $selected.'>'.$arr[$i].'</option>';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	ASS ARRAY
	// 第1引数	：	ARRAY		=>	連想配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_AssArray($arr,$str,$flg)
	{
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		foreach($arr as $key => $val)
		{
			if($str == $key){ $selected = 'selected'; }
			$option .= '<option value="'.$key.'"'. $selected.'>'.$val.'</option>';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	ASS ARRAY
	// 第1引数	：	ARRAY		=>	連想配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_AssArray2($arr,$str,$flg)
	{
		if($flg == 1){ $option .= '<option value="">選択</option>'; }
		foreach($arr as $key => $val)
		{
			if($str == $key){ $selected = 'selected'; }
			$option .= '<option value="'.$key.'"'. $selected.'>'.$val.'</option>';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	radio
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	name
	// 第3引数	：	STRING	=>	param
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_radio($arr,$name,$param)
	{
		foreach($arr as $key => $val)
		{
			if($param == $val){ $selected = ' checked="checked"'; }
			$option .= '<label><input type="radio" name="'.$name.'" value="'.$val.'"'.$selected.' /> '.$val.'</label> ';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	radio
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	name
	// 第3引数	：	STRING	=>	param
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function optionRadio($arr,$name,$param)
	{
		foreach($arr as $key => $val)
		{
			if($param == $key){ $selected = ' checked="checked"'; }
			$option .= '<label><input type="radio" name="'.$name.'" value="'.$key.'"'.$selected.' /> '.$val.'</label> ';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	chck
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	name
	// 第3引数	：	STRING	=>	param
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_chck($arr,$name,$param)
	{
		foreach($arr as $key => $val)
		{
			if(preg_match("/$val/",$param)){ $selected = ' checked="checked"'; }
			$option .= '<label><input type="checkbox" name="'.$name.'" value="'.$val.'"'.$selected.' /> '.$val.'</label> ';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	chck
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	name
	// 第3引数	：	ARRAY		=>	param
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function optionChck($arr,$name,$array)
	{
		foreach($arr as $key => $val)
		{
			if(is_array($array)){ if(in_array($key,$array) AND $array[0] != null){ $selected = ' checked="checked"'; } }
			$option .= '<label><input type="checkbox" name="'.$name.'" value="'.$key.'"'.$selected.' /> '.$val.'</label> ';
			$selected = '';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	HierSelect
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_HierSelect($arr,$str)
	{
		foreach($arr as $key => $array)
		{
			$option .= '<optgroup label="'.$key.'">';
	
			foreach($array as $key2 => $val2)
			{
				if($str == $val2){ $selected = ' selected="selected"'; }
				$option .= '<option value="'.$val2.'"'. $selected.'>'.$val2.'</option>';
				$selected = '';
			}
	
			$option .= '</optgroup>';
		}
		return $option;
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// OPTION	HierSelect
	// 第1引数	：	ARRAY		=>	配列
	// 第2引数	：	STRING	=>	selected
	// 戻り値	：	<option>
	///////////////////////////////////////////////////////////////////////////////////////

	function option_narrows($arr,$str1,$str2)
	{
		foreach($arr as $key => $array)
		{
			foreach($array as $key2 => $val2)
			{

				if($str1 == $key AND $str2 == $key2){ $selected = ' selected="selected"'; }
				$option .= '<option value="'.$key2.'" data-opt-store="'.$key.'"'.$selected.'>'.$val2.'</option>';
				$selected = '';
			}
	
		}
		return $option;
	}

?>