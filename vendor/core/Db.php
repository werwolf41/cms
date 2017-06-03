<?php

namespace core;


use core\helpers\Debugg;

class Db
{
    /**
     * @var \PDO
     */
    private $pdo;

    /**
     * @var \PDO
     */
    private static $instance;

    /**
     * Db constructor.
     */
    private function __construct()
    {
        $config = require CONFIG.'/db.php';
        Debugg::debugVar($config);
        $this->pdo = new \PDO($config['dsn'], $config['user'], $config['password'], [
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
        ]);
    }

    /**
     * @return Db
     */
    public static function instance()
    {
        if (self::$instance === null){
            self::$instance = new self;
        }

        return self::$instance;
    }

    /**
     * @param $sql
     * @return bool
     */
    public function execute($sql, $params=[])
    {
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($params);
    }

    /**
     * @param $sql
     * @return array
     */
    public function query($sql, $params=[])
    {
        $stmt = $this->pdo->prepare($sql);
        $res =  $stmt->execute($params);
        if ($res !== false) {
            return $stmt->fetchAll();
        }
        return [];
    }
}