<?php
if(!defined('APP')) exit();

/** @var $this Application */
include_once $this->getPath() . 'business/number.php';

$number = new Number($this->getDb());
$list = $number->get_list();
$counter = 1;
?>


<?php
$maxRows = 100;
$maxCols = 100;
?>

<form action="index.php?action=send" method="post">
    <input type="submit">
    <table>
        <? for ($i = 0; $i < $maxRows; $i++): ?>
            <tr>
                <? for ($j = 0; $j < $maxCols; $j++): ?>
                    <td>
                        <?php
                        $value = isset($list[$counter]) ? $list[$counter]['value'] : '';
                        ?>
                        <input type="text" name="number[]" value="<?= $value ?>"/>
                    </td>
                    <?php
                    $counter++;
                    ?>
                <? endfor ?>
            </tr>
        <? endfor ?>
    </table>
</form>