<?php

function isSetted( $str=null, $r=null ){
	
	$tmp = isset($str) ? $str : '';

	if($r!==null && $tmp=='') $tmp = $r;

	return $tmp;
}