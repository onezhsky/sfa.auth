<?php
include_once("config.php");
include_once("lib.php");

$rights = sfa_check_rights();

if(!$rights && $_POST['sfaDoLogin'])
{
	if(!sfa_check_rights(false))
	{
		sfa_login_form(1);
	  
	 	exit();
	}
	else
		sfa_set_cookie();
}
elseif(!$rights)
{
	sfa_design_top();
	
	sfa_login_form();
	
	sfa_design_bottom();
	
	exit();
} 
?>