<?php
function limpiarDatos($dato) {
    if (is_array($dato)) {
        return array_map('limpiarDatos', $dato);
    }
    return htmlspecialchars(trim($dato), ENT_QUOTES, 'UTF-8');
}

function validarEntero($valor, $min = 0, $max = PHP_INT_MAX) {
    $opciones = [
        'options' => [
            'min_range' => $min,
            'max_range' => $max
        ]
    ];
    return filter_var($valor, FILTER_VALIDATE_INT, $opciones) !== false;
}