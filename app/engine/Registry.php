<?php
/**
 * Created by PhpStorm.
 * User: krasn
 * Date: 25.05.2017
 * Time: 15:23
 */

namespace app\engine;


class Registry
{
    /**
     * @var array
     */
    private $registry = [];

    /**
     * @param $key
     * @return mixed|null
     */
    public function getRegistry($key)
    {
        return isset($this->registry[$key])? $this->registry[$key]: null;
    }

    /**
     * @param $key
     * @param $value
     */
    public function setRegistry($key, $value)
    {
        $this->registry[$key] = $value;
    }


}