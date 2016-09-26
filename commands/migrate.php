<?php
if(!defined('APP')) exit();

/** @var $this Application */
include_once $this->getPath() . 'business/number.php';

$number = new Number($this->getDb());
if($number->install()){
    echo 'DB installed';
}else{
    echo 'DB install error';
}

