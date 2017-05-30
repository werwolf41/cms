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

	public function view($view, $data=[]){
		$vObj = new View($this->registry, $this->layout, $this->templateDir);
		$vObj->render($view, $data);
	}
}