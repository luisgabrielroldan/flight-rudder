<?php

namespace rudder;

abstract class Controller {

    protected static $actions = array();

    public static function actions() {
        $vars = get_class_vars(\get_called_class());
        return $vars['actions'];
    }

    public static function classname() {
        return \get_called_class();
    }

    public static function __callStatic($name, $params) {

        $class_name = \get_called_class();

        /** @var Controller $controllerInstance */
        $controllerInstance = new $class_name;
        $method_name = substr($name, 10);

        if (!method_exists($controllerInstance, $method_name)) {
            throw new \Exception('Method "'.$class_name.'::'.$method_name.'" not found."');
        }

        return \call_user_func_array(array($controllerInstance, $method_name), $params);
    }
}