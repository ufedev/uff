<?php

namespace Uff;

use Uff\Res;

/**
 * @author Malfasi Federico <federico.malfasi@gmail.com>
 */

class Router
{


    private array $get = [];
    private array $post = [];
    private array $put = [];
    private array $delete = [];
    private array $options = [];
    public ?object $req = null;
    public $id;

    final public function get(string $path, callable ...$fn): void
    {
        $this->get[$path] = $fn;
        if (!in_array($fn, $this->options)) {
            $this->options[$path] = $fn;
        }
    }
    final public function post(string $path, callable ...$fn): void
    {
        $this->post[$path] = $fn;
    }
    final public function put(string $path, callable ...$fn): void
    {

        $this->put[$path] = $fn;
        if (!in_array($fn, $this->options)) {
            $this->options[$path] = $fn;
        }
    }
    final public function delete(string $path, callable ...$fn): void
    {

        $this->delete[$path] = $fn;
        if (!in_array($fn, $this->options)) {
            $this->options[$path] = $fn;
        }
    }

    final public function full(string $path,  array $methods = ["GET", "POST"], callable ...$fn): void
    {
        foreach ($methods as $method) {
            $method = strtolower($method);
            $routes_keys = array_keys($this->$method);
            if (in_array($path, $routes_keys)) {
                echo "'$path' is USED!";
                exit;
            }
        }

        foreach ($methods as $method) {
            $method = strtolower($method);
            $this->$method[$path] = $fn;
        }
    }



    //? Function Private for this class
    private function makeRoute(string $urlPath, array $fnsActive, string $method): ?array
    {
        $params = [];
        $realPath = "";
        $urlsActive_keys = array_keys($fnsActive);
        if (str_contains($urlPath, "?")) {
            $urlPath = explode("?", $urlPath)[0];
        }
        if (!in_array($urlPath, $urlsActive_keys)) {

            foreach ($fnsActive as $key => $value) {
                $countUrl = count(explode("/", $urlPath));
                $countKey = count(explode("/", $key));
                if (str_contains($key, "/:") && ($countKey === $countUrl)) {
                    $llaves = explode(":", $key);
                    if ($llaves[0] === substr($urlPath, 0, strlen($llaves[0]))) {

                        //una vez que separamos que se identifica la URL se obtiene el valor correspondiente y se asigna a su Llave definida :llave en el router
                        $varValue = explode($llaves[0], $urlPath)[1];
                        $var_key = array_keys($params);
                        if (!in_array($llaves[1], $var_key)) {
                            $params[$llaves[1]] = $varValue;
                            if ($varValue === "") {
                                $params = [];
                            }
                        }
                        $realPath = substr($urlPath, 0, strlen($llaves[0])) . ":$llaves[1]";
                    }
                }
            }
            $data = file_get_contents("php://input");
            $json_type = json_decode($data);
            if ($json_type && $data !== "") {
                $this->req = $this->compareMethods(["params" => $params ?? [], "body" => $json_type ?? []], $method);
            } else {
                //FormData
                $this->req = $this->compareMethods(["params" => $params ?? [], "body" => $_POST ?? []], $method);
            }
            $fn = $fnsActive[$realPath] ??  null;
        } else {

            $data = file_get_contents("php://input");
            $json_type = json_decode($data);
            if ($json_type && $data !== "") {
                $this->req = $this->compareMethods(["params" => $params ?? [], "body" => $json_type ?? []], $method);
            } else {
                //FormData
                $this->req = $this->compareMethods(["params" => $_GET ?? [], "body" => $_POST ?? []], $method);
            }
            $fn = $fnsActive[$urlPath] ??  null;
        }

        return $fn;
    }


    private function compareMethods(array $data = [], string $method = "GET"): object
    {
        $params = [];
        $body = [];
        foreach ($data as $key => $value) {
            if ($key === "params") {
                $params = $value;
            } else if ($key === "body") {
                $body = $value;
            }
        }
        $req = [];
        if ($method === "GET") {
            $req = [
                "params" => (array)$params
            ];
        } elseif ($method === "POST") {
            $req = [
                "params" => (array)$params,
                "body" => (array)$body,
                "files" => (array)$_FILES
            ];
        } elseif ($method === "PUT") {
            $req = [
                "params" => (array)$params,
                "body" => (array)$body
            ];
        } elseif ($method === "DELETE") {
            $req = [
                "params" => (array)$params
            ];
        }

        return (object)$req;
    }


    final public function listen(?string $notFound = null): void
    {
        $method = $_SERVER['REQUEST_METHOD'];

        $urlPath = $_SERVER['REQUEST_URI'] ?? "/";



        if ($method === 'GET') {

            $fn = $this->makeRoute(
                $urlPath,
                $this->get,
                $method

            );
        }
        if ($method === 'POST') {
            $fn = $this->makeRoute(
                $urlPath,
                $this->post,
                $method

            );
        }
        if ($method === 'PUT') {

            $fn = $this->makeRoute(
                $urlPath,
                $this->put,
                $method

            );
        }
        if ($method === 'DELETE') {

            $fn = $this->makeRoute(
                $urlPath,
                $this->delete,
                $method
            );
        }
        if ($method === "OPTIONS") {

            $fn = [function () {
            }];
            //Options
        }
        //Instancia de respuesta.
        $res = new Res;
        if (!empty($fn)) {
            /**
             * @var callable $fn
             * @var this $this
             * @var \Ufe\Res $res
             */
            foreach ($fn as $index => $f) {
                call_user_func($f, $this->req, $res);
            }
        } else {
            if ($notFound) {
                $res->render($notFound);
            } else {
                http_response_code(404);
            }
        }
    }
}
