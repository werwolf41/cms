<?php

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