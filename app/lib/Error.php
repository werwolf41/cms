<?php

namespace app\lib;

use app\lib\Controller;

Class Error extends Controller
{
	public function error404()
	{
		echo '404 error';
	}

	public function error403()
	{
		echo '403 error';
	}
}