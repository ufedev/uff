<?php
//This is an example
////////////////////////////////////////////////////////////////
include __DIR__ . "/vendor/autoload.php";


use Ufe\Router;

$router = new Router();

$router->get("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->get("/usuarios/:idGet", function ($req, $res) { //GET dont take body
    $res->json($req);
});
$router->put("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->put("/usuarios/:idPut", function ($req, $res) {
    $res->json($req);
});
$router->post("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->post("/usuarios/:tokenPost", function ($req, $res) { //POST dont take params
    $res->json($req);
});
$router->delete("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->delete("/usuarios/:tokenDel", function ($req, $res) { // DELETE dont take body
    $res->json($req);
});
$router->listen();
/* 

? Prueba para uso de CORS  
$cor = new Cors();


$whitelist = array(
    "http://127.0.0.1:8000"

);
if (isset($_SERVER["HTTP_ORIGIN"])) {
    if (in_array($_SERVER["HTTP_ORIGIN"], $whitelist)) {
        header("Access-Control-Allow-Origin:" . $_SERVER["HTTP_ORIGIN"]);
        header("Access-Control-Allow-Headers:*");

        $router = new Router;
        $router->get("/", function ($req, $res) {
            $ret = [];
            $header = getallheaders();

            if (isset($_SERVER["HTTP_ORIGIN"])) {
                $ret["HTTP_ORIGIN"] = $_SERVER["HTTP_ORIGIN"];
            }
            if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
                $ret["HTTP_AUTHORIZATION"] = $_SERVER["HTTP_AUTHORIZATION"];
            }
            if (isset($_SERVER["Authorization"])) {
                $ret["Authorization"] = $_SERVER["Authorization"];
            }

            $ret[] = $header;

            $res->json($ret);
        });
        $router->get("/:id", function ($req, $res) {
            var_dump($req->id);
            $res->json($req);
        });

        $router->listen(); // Comprueba las URL y las carga según el metodo de envio
    }
}
*/




//ROuter FullStack

// use Ufe\RouterFS;


// $router = new RouterFS();
// $router->get("/", function () {
//     echo "index";
// });
// $router->get("/:id", function () {
//     var_dump($_GET);
// });
// $router->get("/usuarios", function () {
//     var_dump($_GET);
// });
// $router->get("/usuarios/:id", function () {
//     var_dump($_GET);
// });
// $router->get("/editarUsuario/:id", function () {
//     var_dump($_GET);
// });
// $router->post("/editarUsuario/:id", function () {
//     var_dump($_GET);
// });

// $router->listen();


//This is an example
////////////////////////////////////////////////////////////////
include __DIR__ . "/vendor/autoload.php";
//ROuter FullStack

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Methods: *");

//use Ufe\Router;


$router = new Router();

$router->get("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->get("/usuarios/:idGet", function ($req, $res) { //GET dont take body
    $res->json($req);
});
$router->put("/usuarios", function ($req, $res) {
    $imagen = $req->body->imagen;
    $url = explode("blob:", $imagen)[1];


    $res->json(file_get_contents("php://input"));
});
$router->put("/usuarios/:idPut", function ($req, $res) {
    $req->body;
    $res->json($req->body);
});
$router->post("/usuarios", function ($req, $res) {

    $res->json([$req, $_FILES, $_POST, file_get_contents("php://input")]);
});
$router->post("/usuarios/:tokenPost", function ($req, $res) { //POST dont take params
    $res->json($req);
});
$router->post("/usuarius/:token", function ($req, $res) { //POST dont take params
    $res->json($req);
});
$router->delete("/usuarios", function ($req, $res) {
    $res->json($req);
});
$router->delete("/usuarios/:tokenDel", function ($req, $res) { // DELETE dont take body
    $res->json($req);
});
$router->listen();

// $whitelist = array(
//     "http://localhost:5173"

// );


// if (isset($_SERVER["HTTP_ORIGIN"])) {

//     if (in_array($_SERVER["HTTP_ORIGIN"], $whitelist)) {

//         $router = new Router;
//         $router->get("/", function ($req, $res) {
//             $ret = [];
//             $header = getallheaders();

//             if (isset($_SERVER["HTTP_ORIGIN"])) {
//                 $ret["HTTP_ORIGIN"] = $_SERVER["HTTP_ORIGIN"];
//             }
//             if (isset($_SERVER["HTTP_AUTHORIZATION"])) {
//                 $ret["HTTP_AUTHORIZATION"] = $_SERVER["HTTP_AUTHORIZATION"];
//             } else {
//                 echo json_encode("no autorizado");
//                 exit;
//             }
//             if (isset($_SERVER["Authorization"])) {
//                 $ret["Authorization"] = $_SERVER["Authorization"];
//             }

//             $ret[] = $header;

//             $res->json($ret);
//         });
//         $router->get("/:id", function ($req, $res) {
//             var_dump($req->id);
//             $res->json($req);
//         });

//         $router->listen(); // Comprueba las URL y las carga según el metodo de envio
//     } else {
//         echo json_encode("no autorizado");
//     }
// } else {
//     echo json_encode("no autorizado");
// }
