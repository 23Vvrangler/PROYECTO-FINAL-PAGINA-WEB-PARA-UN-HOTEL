<?php
class Controller {
    protected $model;
    public function __construct()
    {
        $this->cargarModel();
    }
    public function cargarModel(){
        $isAdmin = strpos($_SERVER['REQUEST_URI'], '/' . ADMIN) !==false;
        $nModel   = get_class($this) . 'Model';
        $ruta    = ($isAdmin) ? 'models/admin/' . $nModel . '.php': 'models/principal/' . $nModel . '.php'; 

        if (file_exists($ruta)) {
            require_once $ruta;
            $this->model = new $nModel();
        } 
    }
}


?>