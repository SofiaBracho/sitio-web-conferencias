<?php

function productos_json(&$boletos, &$camisas, &$etiquetas) {
    $dias = array(0 => 'pase_dia', 1 => 'pase_completo', 2 => 'pase_dosdias');
    $total_boletos = array_combine($dias, $boletos);

    unset($total_boletos['pase_dia']['precio']);
    unset($total_boletos['pase_completo']['precio']);
    unset($total_boletos['pase_dosdias']['precio']);

    $camisas = (int) $camisas;
    if($camisas > 0) {
        $total_boletos['camisas']['cantidad'] = $camisas;
    }
    $etiquetas = (int) $etiquetas;
    if($etiquetas > 0) {
        $total_boletos['etiquetas']['cantidad'] = $etiquetas;
    }

    return json_encode($total_boletos);
}

function eventos_json(&$eventos) {
    $json = array();
    foreach($eventos as $evento) {
        $json['eventos'][] = $evento;
    }

    return json_encode($json);
}

?>