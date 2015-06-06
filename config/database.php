<?php
try {
    $db = new PDO(
        'mysql:host=localhost;dbname=cabildear',
        'root',
        ''
    );
} catch(Exception $e) {
	echo '<strong>Excepción capturada:</strong><br>';
    echo '<strong>Mensaje: </strong>'.$e->getMessage().'<br>';
    echo '<strong>Código: </strong>'.$e->getCode().'<br>';
    echo '<strong>Archivo: </strong>'.$e->getFile().'<br>';
    echo '<strong>Línea: </strong>'.$e->getLine().'<br>';    
}
