<?php
    namespace Controller;

    class Controller {
        var $controllerName;
        var $controllerMethod;

        public function getContollerAttribute() {
            return[
                "ControllerName" => $this->controllerName,
                "Method" => $this->controllerMethod,
            ];
        }
    }
?>