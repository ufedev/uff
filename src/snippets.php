<?php

/**
 * @param mixed $var
 * Formatea de forma legible los Arrays Objetos.
 */
function show($var): void
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
}

/**
 * @return string Request-Method
 */
function m(): string
{
    return $_SERVER["REQUEST_METHOD"];
}
