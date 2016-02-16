<?php

$opencart_path = realpath(dirname(__FILE__) . '/../') . '/';

require_once $opencart_path.'config.php';

$installed = true;

if(!$installed){
    header('Location: '.HTTPS_SERVER.'pos/install');
}else{
    header('Location: '.HTTPS_SERVER.'admin/index.php?route=pos/pos');
}

?>
