<?php


namespace rudder;


class Route {

    private $_controllerName;

    private $_actions = array();

    /**
     * @param string $controllerName
     */
    function __construct($controllerName)
    {
        $this->_controllerName = $controllerName;

        if(!class_exists($this->_controllerName))
            throw new \Exception('Controller class not found!');

        if(!is_subclass_of($this->_controllerName, Controller::classname()))
            throw new \Exception('Controller class is not a BaseController children!');

        $actions = call_user_func(array($this->_controllerName, 'actions'));

        if ($actions != null && count($actions) > 0) {
            foreach ($actions as $pattern => $method) {
                $this->action($pattern, $method);
            }
        }
    }

    /**
     * @return Route
     */
    function action($pattern, $callback) {
        array_push($this->_actions, array($pattern, $callback));
        return $this;
    }

    function getControllerName() {
        return $this->_controllerName;
    }

    function getActions() {
        return $this->_actions;
    }

}