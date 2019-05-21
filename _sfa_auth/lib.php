<?php 
include_once("_sfa_auth/config.php");

function sfa_login_form($err = 0)
{
	?>
	<form action="" method="post">
	 <p>Авторизация на сервере для разработки:</p>
	 <?php if($err==1) { ?>
	 <p style="color:#d00;">Неправильный логин/пароль. Попробуйте, пожалуйста, ещё раз.</p>
	 <?php } ?>
	 <table>
	 	<tr>
			<td>Логин:</td>	  
			<td><input type="text" name="sfaLog" value="<?php echo @$_POST['sfaLog'];?>" /></td>
	 	</tr>
	 	<tr>
			<td colspan="2"><p>&nbsp;</p></td>	  
	 	</tr>	
	 	<tr>
			<td>Пароль:</td>	  
			<td><input type="password" name="sfaPass" /></td>
	 	</tr>		
	 	<tr>
			<td colspan="2"><p>&nbsp;</p></td>	  
	 	</tr>		
		<tr>
			<td></td>	  
			<td><input type="submit" name="sfaDoLogin" value="Войти" /></td>		
		</tr>
	 </table>
	</form>
	<?php	
}

function sfa_design_top()
{
	?><html>
			<head>
				<title>Авторизация на сервере для разработки</title>
				<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />				
			</head>
			<body>
	<?php			
}

function sfa_design_bottom()
{
	?>
			</body>
		</html>	
	<?php 
}

function sfa_check_rights($bCookies = true)
{		
	global $ignoreIps;
	
	foreach($ignoreIps as $v)
		if ($_SERVER['REMOTE_ADDR'] == $v)
			return true;
	
	if($bCookies)
	{
		$dt 	     = $_COOKIE;
		$sfaConfPass = md5(_SFA_PASS);
	}
	else 
	{
		$dt = $_POST;
		$sfaConfPass = _SFA_PASS;
	}
 
	if(!$dt['sfaLog'] || !$dt['sfaPass'])
		return false;

	if($dt['sfaLog'] == _SFA_LOG && $dt['sfaPass'] == $sfaConfPass) 
		return true;
	else
		return false;
}

function sfa_set_cookie()
{
	
	$dt = $_POST;
	
	if(!$dt['sfaLog'] || !$dt['sfaPass'])
		die("sfa_error: не передан логин/пароль");
	
	setcookie("sfaLog",  $dt['sfaLog'], 0, "/");
	setcookie("sfaPass", md5($dt['sfaPass']), 0, "/");
}
?>