<?php

class Number
{
    public $db;

    public function __construct(mysqli $db)
    {
        $this->db = $db;
    }

    public function install()
    {

        $query = 'DROP TABLE IF EXISTS `numbers`';
        $this->db->query($query);

        $query = 'CREATE TABLE IF NOT EXISTS `numbers` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `value` int(11) DEFAULT NULL,
            PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=utf8';
        $this->db->query($query);

        $data = [];
        for ($i = 0; $i < 100; $i++) {
            $data[] = rand(1, 99999);
        }
        $this->update_list($data);
        return true;

    }

    public function update_list($data)
    {

        $list = $this->get_list();

        $deleted = 0;
        $updated = 0;
        $inserted = 0;

        foreach ($data as $key => $item) {

            $id = $key + 1;
            $value = (int)$item;

            if (isset($list[$id])) {

                if (($value < 1) || ($value > 99999)) {
                    $query = 'DELETE FROM numbers WHERE id = ' . $id;
                    if ($this->db->query($query)) {
                        $deleted++;
                    }
                } else {
                    if ($list[$id]['value'] != $value) {
                        $query = 'UPDATE numbers SET `value`=' . $value . ' WHERE id = ' . $id;
                        if ($this->db->query($query)) {
                            $updated++;
                        }
                    }
                }
            } else {

                if (($value > 1) && ($value < 99999)) {
                    $query = 'INSERT INTO numbers(id, `value`) VALUES (' . $id . ', ' . $value . ')';
                    if ($this->db->query($query)) {
                        $inserted++;
                    }
                }
            }
        }

        return [
            'deleted' => $deleted,
            'updated' => $updated,
            'inserted' => $inserted
        ];
    }

    public function get_list()
    {

        $res = $this->db->query('SELECT * FROM numbers LIMIT 10000');
        $result = [];

        if(!$res){
            echo 'Db not found';
            exit();
        }

        while ($row = $res->fetch_assoc()) {
            $result[$row['id']] = $row;
        }

        return $result;
    }

}
