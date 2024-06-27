<?php
class  Principal extends Controller{
    public function __construct() {
        parent::__construct();
    }
    function index(){
        $data = $this->model->getPrueba();
        echo $data;
    }

}

?>