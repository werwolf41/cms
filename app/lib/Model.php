<?php
namespace app\lib;

use app\database\Connection;
use app\engine\Registry;

class Model extends Connection
{
    /**
     * @var \app\engine\Registry;
     */
    protected $registry;

    /**
     * Model constructor.
     * @param Registry $registry
     */
    public function __construct(Registry $registry)
    {
        parent::__construct();
        $this->registry = $registry;
    }


}