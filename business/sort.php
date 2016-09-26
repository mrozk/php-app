<?php
/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 24.09.16
 * Time: 12:52
 */
class Sort{

    public static $max = 4294967296;
    public static $count = 1000000;
    public static $iterations = 0;
    public static $index = 0;

    public static function generate(){
        $values = [];

        for($i = 0; $i < self::$count; $i++){
            $values[$i] = mt_rand(1, self::$max);
        }

        $values = array_unique($values);
        $eqIndex1 = mt_rand(1, count($values) - 1);
        $eqIndex2 = mt_rand(1, count($values) - 1);
        $values[$eqIndex2] = $values[$eqIndex1];


        for($i = 0; $i < count($values); $i++){
            if($values[$i] == ''){
                $values[$i] =  mt_rand(1, self::$max);
            }
        }


        echo '<br />-----------<br />';
        echo 'Generated value ' . $values[$eqIndex1];
        echo '<br />-----------<br />';
        return $values;
    }


    public static function searchNeighbours(&$values)
    {

        $index = -1;
        $i = 0;

        while($index == -1){
            if($values[$i] == $values[$i+1]){
                $index = $i;
                break;
            }
            $i++;
        }

        return $index;
    }

    public static function binarySearchArr(&$values, $left, $right)
    {

        self::$iterations++;

        if($left >= $right){
            return -1;
        }

        $mid = intval((($right + $left) / 2));

        if (($values[$mid - 1] == $values[$mid]) || ($values[$mid] == $values[$mid + 1])) {
            return $mid;
        }

        $index1 = self::binarySearchArr($values, $left, $mid - 1);
        $index2 = self::binarySearchArr($values, $mid + 1, $right);

        if($index1 > 0 ){
            return $index1;
        }

        if($index2 > 0 ){
            return $index2;
        }

        return -1;
    }


    /*public static function binarySearch(&$values, $value, $continueIndex)
    {
        $left = 0;
        $right = count($values);
        $index = -1;

        while ($right >= $left) {
            $mid = intval((($right + $left) / 2));

            if (($mid != $continueIndex) && ($values[$mid] == $value)) {
                $index = $mid;
                break;
            } else {
                if ($values[$mid] <= $value) {
                    $left = $mid + 1;
                } else {
                    if ($values[$mid] > $value) {
                        $right = $mid - 1;
                    }
                }
            }
        }

        return $index;
    }*/


    public static function quickSort(&$arr, $low, $high) {
        $i = $low;
        $j = $high;
        $middle = $arr[ ( $low + $high ) / 2 ];
        do {
            while($arr[$i] < $middle) ++$i;
            while($arr[$j] > $middle) --$j;
            if($i <= $j){
                $temp = $arr[$i];
                $arr[$i] = $arr[$j];
                $arr[$j] = $temp;
                $i++; $j--;
            }
        }
        while($i < $j);

        if($low < $j){
            self::quickSort($arr, $low, $j);
        }

        if($i < $high){
            self::quickSort($arr, $i, $high);
        }
    }


    public static function var1Search(&$values){
        echo '<br />';
        $start = microtime(true);
        sort($values);
        $sortExecTime = (microtime(true) - $start);
        echo 'Sort time : ' . $sortExecTime . ' sec.';
        echo '<br />';

        $start = microtime(true);
        $index = self::binarySearchArr($values, 0, count($values));
        echo '<br />';
        echo 'Value index ' . $index . ' - ' . $values[$index] . ' : ' . $values[$index +1]  . ' - ' . $values[$index - 1];
        echo '<br />';
        $searchTime = (microtime(true) - $start);
        echo 'Search TIMiNG ' . $searchTime . ' sec.';
        echo '<br />';
        echo 'Summary Time : ' . ($searchTime + $sortExecTime);
    }



    public static function var2Search(&$values){

        echo '<br />';
        $start = microtime(true);
        sort($values);
        $sortExecTime = (microtime(true) - $start);
        echo 'Sort time : ' . $sortExecTime . ' sec.';
        echo '<br />';

        $start = microtime(true);
        $index = self::searchNeighbours($values);
        echo '<br />';
        echo 'Value index ' . $index . ' - ' . $values[$index] . ' : ' . $values[$index +1]  . ' - ' . $values[$index - 1];
        echo '<br />';
        $searchTime = (microtime(true) - $start);
        echo 'Search TIMiNG ' . $searchTime . ' sec.';
        echo '<br />';
        echo 'Summary Time : ' . ($searchTime + $sortExecTime);

    }



    public static function var3Search(&$values){

        echo '<br />';
        $start = microtime(true);
        self::quickSort($values, 0, count($values) - 1);
        $sortExecTime = (microtime(true) - $start);
        echo 'Sort time : ' . $sortExecTime . ' sec.';
        echo '<br />';

        $start = microtime(true);
        $index = self::searchNeighbours($values);
        echo '<br />';
        echo 'Value index ' . $index . ' - ' . $values[$index] . ' : ' . $values[$index +1]  . ' - ' . $values[$index - 1];
        echo '<br />';
        $searchTime = (microtime(true) - $start);
        echo 'Search TIMiNG ' . $searchTime . ' sec.';
        echo '<br />';
        echo 'Summary Time : ' . ($searchTime + $sortExecTime);

    }




}