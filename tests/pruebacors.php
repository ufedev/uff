<?php



$whiteList = array(
    "http://localhost:5173"
);
if (!isset($_SERVER["HTTP_ORIGIN"])) {
    http_response_code(403);
    exit;
}
if (isset($_SERVER["HTTP_ORIGIN"])) {
    if (!in_array($_SERVER["HTTP_ORIGIN"], $whiteList)) {
        http_response_code(403);
        exit;
    }
}



use Ufe\Router;

$router = new Router();

$router->get("/usuarios", function ($req, $res) {

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
$router->get("/404", function ($req, $res, $render) {

    $render("404.php", []);
    $res->json(['url no valida']);
});

$router->listen("404.php");
