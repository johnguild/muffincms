<?php

/**
 * Check whether the site is under maintenance mode or not
 * @return boolean
 */
function isMaintenance( ){
	if(\Config::get('muffincms.maintenance'))	
		return true;
	return false;
}