<?php
if(!defined('APP')) exit();

/** @var $this Application */
include_once $this->getPath() . 'business/number.php';

$number = new Number($this->getDb());
$result = $number->update_list($_POST['number']);
$this->redirect('index.php');
