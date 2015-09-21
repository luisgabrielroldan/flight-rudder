<?php


class TestController extends \rudder\Controller {

    protected static $actions = array(
        '/index' => 'index',
        '/hello' => 'hello'
    );

    public function hello() {
        var_dump(TestController::actions());
    }

    public function index() {
        echo 'Hello index!';
    }

}