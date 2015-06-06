<?php
//APPURL
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


//Twitter
define('CONSUMER_KEY','Fa6tpZAjnwBf5ei3Pnqcxyeph');
define('CONSUMER_SECRET','l83vTcQVSapfgo0RvwO7QlJBxY8JmIOEK7naNr4AoJWnIJFkq5');
define('OAUTH_CALLBACK','http://www.cabildear.org/');

//Obtener URL absoluta correcta
function getURL ($url, $echo = true){
    if ( $echo ) {
        echo APPURL . $url;
    } else {
        return APPURL . $url;
    }
}