<?php

namespace app\model;

use app\interfaces\IModel;

abstract class Model implements IModel
{

    public function __set($name, $value)
    {
        if (array_key_exists($name, $this->props)) {
            $this->$name = $value;
            $this->props[$name] = true;
        }
    }

    public function __get($name)
    {
        if (array_key_exists($name, $this->props)) {
            return $this->$name;
        }
        return $this->$name;
    }

    public function __isset($name) {
        return isset($this->$name);
    }

}
