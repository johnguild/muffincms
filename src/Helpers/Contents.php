<?php

function contents($mod, $loc){

	return Johnguild\Muffincms\MVC\Controllers\PageController::getContents($mod, $loc);
}

function mypage(){

	return Johnguild\Muffincms\MVC\Controllers\PageController::getMyPage();
}