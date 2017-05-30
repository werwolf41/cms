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
	protected $view = '';

    /**
     * @var string
     */
    protected $templateDir='';

	public function __construct(Registry $registry)
	{
		$this->registry = $registry;
	}

	public function view(){
		$vObj = new View($this->registry, $this->view, $this->layout, $this->templateDir);
		$vObj->render();
	}
}