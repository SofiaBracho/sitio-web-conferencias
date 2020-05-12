<?php

function productos_json(&$boletos, &$camisas, &$etiquetas) {
    $dias = array(0 => 'pase_dia', 1 => 'pase_completo', 2 => 'pase_dosdias');
    $total_boletos = array_combine($dias, $boletos);
    $json = array();

    foreach($total_boletos as $key => $boletos) {
        if((int) $boletos['cantidad'] > 0) {
            $json[$key] = (int) $boletos['cantidad'];
        }
    }

    $camisas = (int) $camisas;
    if($camisas > 0) {
        $json['camisas'] = $camisas;
    }
    $etiquetas = (int) $etiquetas;
    if($etiquetas > 0) {
        $json['etiquetas'] = $etiquetas;
    }

    return json_encode($json);
}

function eventos_json(&$eventos) {
    $json = array();
    foreach($eventos as $evento) {
        $json['eventos'][] = $evento;
    }

    return json_encode($json);
}

?>