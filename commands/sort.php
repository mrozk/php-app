<?php
if(!defined('APP')) exit();
/** @var $this Application */
include_once $this->getPath() . 'business/sort.php';

$values = Sort::generate();

// 2.23 / Sort: 2.07, Search: 0.16 O(nlog(n)) / O(n)
Sort::var2Search($values);


// 3.54 / Sort: 2.02, Search: 1.51 O(nlog(n)) / O(nlog(n))
// Sort::var1Search($values);


// 6.33 / Sort: 5.98, Search: 0.35 O(nlog(n))/O(nlog(n))
//Sort::var3Search($values);