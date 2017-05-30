<?php

namespace app\lib;

use app\engine\Registry;

abstract Class Controller 
{
	/**
	* @var Registry
	*/
	protected $registry = '';

	/**
	* @var array
	*/
	protected $data = [];

	/**
	* @var string
	*/
	protected $layout = '';

	/**
	* @var string
	*/
	protected $template = '';

	public function __construct(Registry $registry)
	{
		$this->registry = $registry;
	}

	protected function render(){
		
	}
}