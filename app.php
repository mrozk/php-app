<?php

class Application
{

    public $config;

    public $action = 'main';

    private $db;


    public function getPath()
    {
        return __DIR__ . DIRECTORY_SEPARATOR;
    }

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function getDb()
    {
        if (!$this->db) {

            $this->db = new mysqli(
                $this->config['host'],
                $this->config['user'],
                $this->config['password'],
                $this->config['db']
            );
            if ($this->db->connect_errno) {
                echo 'DB not available';
                exit(0);
            }

        }

        return $this->db;
    }

    public function redirect($location)
    {
        header('Location: ' . $location);
    }

    public function run()
    {
        if (isset($_REQUEST['action'])) {
            $this->action = $_REQUEST['action'];
        }

        $actionPath = 'commands/' . $this->action . '.php';
        if (!file_exists($actionPath)) {
            echo 'Action not found';
            exit;
        }

        ob_start();
        require_once $actionPath;
        $content = ob_get_contents();
        ob_end_clean();

        echo $content;
    }

}
