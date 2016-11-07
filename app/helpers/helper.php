<?php
if(!function_exists('flash_info')){
	function flash_info($result,$successMsg = 'success !',$errorMsg = 'something error !')
	{
		return $result ? flash($successMsg,'success')->important() : flash($errorMsg,'danger')->important();
	}
}

if(!function_exists('getUser')){
	function getUser($guards='')
	{
		return auth($guards)->user();
	}
}

if(!function_exists('getUerId')){
	function getUerId()
	{
		return $this->getUser()->id;
	}
}