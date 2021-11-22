<?php
	require_once('../core/setup.php');
	require_once('../view/public.php');

	///////////////////////////////////////////////////////////////////////////////////////
	// param
	///////////////////////////////////////////////////////////////////////////////////////

	$level		= '../';
	$css		= '<link type="text/css" rel="stylesheet" href="../css/contact.css" />';
	$js			= '';

	$title			= ' | ';
	$keywords		= '';
	$description	= '';
	$h1				= '';
	$meta			= '';

	///////////////////////////////////////////////////////////////////////////////////////
	// before filter
	///////////////////////////////////////////////////////////////////////////////////////

	require_once('../core/func/sendmail.php');

	///////////////////////////////////////////////////////////////////////////////////////
 	// 処理：完了画面
 	///////////////////////////////////////////////////////////////////////////////////////

 	if($sv["REQUEST_METHOD"] == "POST" AND $p['submit'] == "送信する")
 	{
		unset($p['submit']);

		//　運営
		$subject = '〈〉問い合わせ';
		$body = "〈〉問い合わせがありました。\n\n";
		$body .= "-------------------------------------------------\n\n";
		foreach($p as $key => $var)
		{
			$body .= "[".$key."] ".htmlspecialchars_decode($var)."\n";
		}
		$body.="\n-------------------------------------------------\n\n";
		$body.="送信日時：".date( "Y/m/d (D) H:i:s", time() )."\n";
		$body.="ホスト名：".getHostByAddr(getenv('REMOTE_ADDR'))."\n\n";

		sendmail($from,$from,$from,$subject,$body);

		//　応募者
		$subject = '〈〉お問い合わせありがとうございます';
		$body =
$p['お名前'].'様

この度はお問い合わせいただきありがとうございます。
担当者より追ってご連絡差し上げます。
	
下記内容をご確認下さい。
---------------------------------------------------------
';
		foreach($p as $key => $var)
		{
			$body .= "\n■".$key."\n".htmlspecialchars_decode($var)."\n";
		}
		$body .=
'
---------------------------------------------------------

xxx
TEL. 
FAX. 
URL. ';

		sendmail($p['メールアドレス'],$from,$from,$subject,$body);


		header('Location:./thanks.php'); exit;

	}

 	///////////////////////////////////////////////////////////////////////////////////////
 	// 処理：確認画面
 	///////////////////////////////////////////////////////////////////////////////////////

 	if($sv["REQUEST_METHOD"] == "POST" AND $p['submit'] == "確認画面へ")
 	{

	 	///////////////////////////////////////////////////////////////////////////////////////
 	 	// 処理：エラー画面
 	 	///////////////////////////////////////////////////////////////////////////////////////

		// array(type,require,max,min,match)
		$ary_elem = array(
		'お問い合わせ項目'		=>	array('text',1),
		'お名前'				=>	array('text',1),
		'フリガナ'			=>	array('kana',1),
		'メールアドレス'		=>	array('mail',1),
		'電話番号'			=>	array('tel',0),
//		'郵便番号'			=>	array('num',0),
		'お問い合わせ内容'		=>	array('text',1),
		'個人情報のお取り扱い'	=>	array('agree',1),
		);

		require_once('../core/func/check_form.php');
		list($alert,$error_cnt) = check_form($ary_elem,$p);

 	 	if($error_cnt > 0){ $page = 1; }
 	 	else
 	 	{
	 	 	unset($p['submit'],$p['個人情報のお取り扱い']);

	 	 	foreach($p as $key => $var)
	 	 	{
	 	 	 	$hidden	 = '<input type="hidden" name="'.$key.'" value="'.stripslashes($var).'" />';

	 	 	 	switch($key)
	 	 	 	{
		 	 	 	default		: $echo_param .= '<tr><th>'.$key.'</th><td>'.$hidden.stripslashes(nl2br($var)).'</td></tr>';
	 	 	 	}
	 	 	}

	 	 	$page = 2;
 	 	}
 	}

 	///////////////////////////////////////////////////////////////////////////////////////
 	// 処理：確認画面
 	///////////////////////////////////////////////////////////////////////////////////////

 	if(!isset($page)){ $page = ''; }
	switch($page)
	{
		///////////////////////////////////////////////////////////////////////////////////////
		// error
		///////////////////////////////////////////////////////////////////////////////////////

		case 1:
		$render = '
		<div class="note">
			<h3>入力エラー</h3>
			<p class="caution">以下の項目が未入力、または受け付けられない文字が入力されています。</p>
			<p class="alert">'.$alert.'</p>
			<p class="btn"><a href="#" onClick="history.back(); return false;" class="back">入力画面に戻る</a></p>
		</div>
		';
		break;

		///////////////////////////////////////////////////////////////////////////////////////
		// confirm
		///////////////////////////////////////////////////////////////////////////////////////

		case 2:
		$render = '
		<div class="note">
			<h3>入力内容の確認</h3>
			<p>下記の内容でお間違いなければ、送信ボタンを押してください。</p>
			<form action="./" method="post">
				<table>
				'.$echo_param.'
				</table>
				<p class="btn">
				      <a href="#" onClick="history.back(); return false;" class="back">入力画面に戻る</a>
				      <input type="submit" name="submit" value="送信する" class="opc"/>
				</p>
			</form>
		</div>
		';
		break;

		///////////////////////////////////////////////////////////////////////////////////////
		// default
		///////////////////////////////////////////////////////////////////////////////////////

		default:

		$render = '
			<div id="intro">
				<p>分からない事、気になる事がございましたら。お気軽にお問い合わせ下さい。<br /><span>＊の項目は必ずご入力下さい。</span></p>
			</div>
			<form action="./" method="POST">
				<table>
					<tr><th>お名前<span> ＊</span></th><td><input type="text" name="お名前" value="" /></td></tr>
					<tr><th>フリガナ<span> ＊</span></th><td><input type="text" name="フリガナ" value="" /></td></tr>
					<tr><th>メールアドレス<span> ＊</span></th><td><input type="text" name="メールアドレス" value="" /><span>※半角英数字</span></td></tr>
					<tr><th>電話番号</th><td><input type="text" name="電話番号" value="" /><span>※ハイフンなし</span></td></tr>
					<tr><th>郵便番号</th><td><input type="text" name="郵便番号" value="" /><span>※ハイフンなし</span></td></tr>
					<tr><th>ご住所<span> ＊</span></th><td><input type="text" name="ご住所" value="" /></td></tr>
					<tr><th>お問い合わせ項目<span> ＊</span></th>
						<td class="cfx">
							<label><input type="radio" name="お問い合わせ項目" value="資料請求" checked="checked"/>資料請求</label>
							<label><input type="radio" name="お問い合わせ項目" value="見積依頼" />見積依頼</label>
							<label><input type="radio" name="お問い合わせ項目" value="モデルハウス見学" />モデルハウス見学</label>
							<label><input type="radio" name="お問い合わせ項目" value="その他" />その他</label>
						</td>
					</tr>
					<tr><th>お問い合わせ内容</th><td><textarea name="お問い合わせ内容" rows="6"/></textarea></td></tr>
				</table>
				<div id="privacy">
	    		    <h3>個人情報のお取り扱いについて</h3>
	    		    <p>当サイトより取得した個人情報は適切に管理いたします。<br />
	    		    個人情報保護法に定める例外事項を除き、本人の同意を得ることなく第三者に提供、開示しません。</p>
	    		</div>
	    		<p class="center"><label><input type="checkbox" name="個人情報のお取り扱い">入力内容をご確認いただき、個人情報の取扱にご同意いただけましたらチェックを入れてください。</label></p>
				<p class="btn"><input type="submit" name="submit" value="確認画面へ" class="opc"/></p>
			</form>
		';
	}

	///////////////////////////////////////////////////////////////////////////////////////
	// render
	///////////////////////////////////////////////////////////////////////////////////////

	html_header();
?>
	<div id="contact">

		<div id="bread" class="inner">
			<p><a href="../">HOME</a> &gt; <strong>お問い合わせ</strong></p>
		</div>
		
		<div id="title">
			<h2>お問い合わせ<br /><span>contact</span></h2>
		</div>
		<div id="contents">
			<?= $render ?>
		</div>
		
		<?php html_footer(); ?>		
</body>
</html>