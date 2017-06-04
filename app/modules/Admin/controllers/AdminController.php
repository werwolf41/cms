<?php

namespace app\modules\Admin\controllers;

use app\controllers\App;

/**
* 
*/
class AdminController extends App
{
	
	public function indexAction()
	{
		$this->layout = 'login';
		$title = 'Login';
		$this->view('index', compact('title'));
	}
}