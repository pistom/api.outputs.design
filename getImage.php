<?php 
$image = 'projects/'.$_GET['image'];
header('Access-Control-Allow-Origin: *');

// TODO Add png content type.
header('Content-Type: image/jpeg');
readfile($image);
