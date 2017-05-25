<?php

namespace app\database;

use \PDO;
use \PDOException;

class Connection
{
    /**
     * @var string
     */
    private $driver='';
    /**
     * @var string
     */
    private $host='';
    /**
     * @var string
     */
    private $db_name='';
    /**
     * @var string
     */
    private $user='';
    /**
     * @var string
     */
    private $password='';
    /**
     * @var string
     */
    private $charset='';
    /**
     * @var \PDO;
     */
    private $connection;

    public function __construct()
    {
        $config=require_once __DIR__.'/../../common/config/config.php';

        $this->driver = $config['db']['driver'];
        $this->host = $config['db']['host'];
        $this->db_name = $config['db']['db_name'];
        $this->user = $config['db']['user'];
        $this->password = $config['db']['password'];
        $this->charset = $config['db']['charset'];

        $this->connection();
    }

    private function connection()
    {
        try {
            $this->connection = new PDO($this->driver. ':dbname='.$this->db_name.';host='.$this->host.';charset='.$this->charset.';', $this->password);
        } catch (PDOException $e)
        {
            die($e->getMessage());
        }
    }



}