<?php
    namespace Controller;

    include "Traits/ResponseFormatter.php";
    include "Controllers/Controller.php";
    
    use Traits\ResponseFormatter;

    class ProductController extends Controller{
        use ResponseFormatter;

        public function __construct() 
        {
            $this->controllerName = "Get All Product";
            $this->controllerMethod = "GET";
        }

        public function getAllProduct() {
            $dummyData = [
                "Air Mineral",
                "Kebab",
                "Spagetti",
                "Jus jambu"
            ];

            $response = [
                "controller_attribute" => $this->getContollerAttribute(),
                "product" => $dummyData
            ];

            return $this->ResponseFormatter(200, "Success", $response);
        }
    }
?>