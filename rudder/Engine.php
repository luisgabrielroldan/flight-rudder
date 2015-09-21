<?php


namespace rudder;


class Engine extends \flight\Engine {

    /**
     * @var Route[]
     */
    private $_controllerRoutes;

    public function __construct() {

        $this->_controllerRoutes = array();

        parent::__construct();
    }

    public function controller($controllerName) {

        $controllerRoute = new Route($controllerName);
        array_push($this->_controllerRoutes, $controllerRoute);
        return $controllerRoute;

    }

    private function setupControllers() {

        foreach ($this->_controllerRoutes as $controllerRoute) {

            $controllerName = $controllerRoute->getControllerName();

            foreach ($controllerRoute->getActions() as $action) {
                $this->_route($action[0], array($controllerName, '__action__'.$action[1]));
            }
        }

    }

    public function _start() {
        $this->setupControllers();
        parent::_start();
    }

}