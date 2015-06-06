<?php
try {
    $sql = 'SELECT valor FROM opciones WHERE opcion = "root"';
    $query = $db->prepare($sql);
    $query->execute();
    $root = $query->fetch(PDO::FETCH_ASSOC);
    $root = $root['valor'];
} catch (Exception $e) {
    $root = '';
}
define( 'APPURL', $root );


function getURL ($url, $echo = true){
    if ( $echo ) {
        echo APPURL . $url;
    } else {
        return APPURL . $url;
    }
}