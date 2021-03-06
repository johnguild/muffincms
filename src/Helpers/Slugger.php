<?php

function makeSlug( $slug ){
	
	$text = preg_replace('~[^\pL\d]+~u', '-', $slug);
	$text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
	$text = preg_replace('~[^-\w]+~', '', $text);
	$text = trim($text, '-');
	$text = preg_replace('~-+~', '-', $text);
	$text = strtolower($text);

	return $text;
}

function unSlug( $slug ){

	return str_replace('-', ' ', $slug);
}