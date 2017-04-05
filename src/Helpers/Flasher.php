<?php

function flash($style='info', $message){

	// styles are
	// success, danger, warning, info
	session()->flash('flash', $message);
	session()->flash('flash_class', 'alert-'.$style);
}