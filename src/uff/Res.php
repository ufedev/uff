<?php


namespace Uff;

/**
 * @author Malfasi Federico <federico.malfasi@gmail.com>
 */

class Res
{


    private ?int $status = null;

    final public function json($string): void
    {
        echo json_encode($string, http_response_code($this->status ?? 200));
        exit;
    }
    final public function status(int $status): Res
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @param string $pathview Directorio de la vista principal.
     * @param array $vars default [empty Array], Variables que se pasaran a la vista.
     * @param ?string $layout default NULL --- para la plantilla de fondo de la vista que se repite en varias vistas. Ejemplo un Header.
     */
    final public function render(string $pathview, array $vars = [], ?string $layout = null): void
    {
        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        if ($layout) {
            ob_start();
            include $pathview;
            $content = ob_get_clean();
            include $layout;
        } else {
            include $pathview;
        }
    }
}
