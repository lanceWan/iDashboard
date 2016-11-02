<?php
if(!function_exists('flash_info')){
	function flash_info($result,$successMsg = 'success !',$errorMsg = 'something error !')
	{
		return $result ? flash($successMsg,'info') : flash($errorMsg,'danger');
	}
}