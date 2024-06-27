<?php
require_once 'config/config.php';
// URL ACTUAL
$currentPageUrl = $_SERVER['REQUEST_URI'];
// VERIFICAR SI EXISTE LA RUTA ADMIN
$isAdmin = strpos($currentPageUrl, '/' . ADMIN) !== false;
// GET -> URL
$ruta = empty($_GET['url']) ? 'principal/index' : $_GET['url'];
// SEPARAMOS LA RUTA EN UN ARRAY
$array = explode('/', $ruta);
print_r($array);
// VER SI ESTAMOS EN LA RUTA
if ($isAdmin && (count($array) == 1 
|| (count($array) == 2 && empty($array[1]))) 
&& $array[0] == ADMIN) {
    // CREAMOS CONTROLLERS
    $controller = 'Admin';
    $metodo = 'login';
} else {
    $controllerAdmin = ($isAdmin) ? 1 : 0;
    // PONEMOS UNA FUNCION PHP PARA QUE PONGA EL COMIENZO EN MAYUS
    $controller = ucfirst($array[$controllerAdmin]);
    $metodo = 'index';
    // VALIDAR METODOS
    $metodoIndice = ($isAdmin) ? 2 : 1;
    if (!empty($array[$metodoIndice]) && $array[$metodoIndice] != '') {
        $metodo = $array[$metodoIndice];
    }
    // VALIDAR PARAMETROS
    $parametro = '';
    $parametroIndice = ($isAdmin) ? 3 : 2;
    if (!empty($array[$parametroIndice]) && $array[$parametroIndice] != '') {
        for ($i = $parametroIndice; $i < count($array); $i++) {
            $parametro .= $array[$i] . ',';
        }
    }
    $parametro = trim($parametro, ',');
}
    //LLAMAR AUTOLOAD->REQUARE_ONCE
    require_once 'config/app/Autoload.php';
   // VALIDAR DIRECTORIO DE CONTROLLERS
$dirControllers = ($isAdmin) ? 'controllers/admin/' . $controller . '.php' : 'controllers/principal/' . $controller . '.php';
    echo $dirControllers;
    if (file_exists($dirControllers)){
        require_once $dirControllers;
        $controller = new $controller();
        if (method_exists($controller, $metodo)){
            $controller->$metodo($parametro);
    }else{
            echo'METODO NO EXISTE';
        }
    }else{
        echo'CONTROLADOR NO EXISTE';
    }
?>




