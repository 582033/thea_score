<?php
require_once __DIR__ . "/vendor/autoload.php";

use Medoo\Medoo;

class data {
    public function __construct(){
        $this->db = new Medoo([
            'database_type' => 'sqlite',
            'database_file' => 'data.db',
        ]);

        $loader = new \Twig\Loader\FilesystemLoader('./views/');
        $this->twig = new \Twig\Environment($loader);
    }

    private function _getGrid(){
        $sql = "select * from grid";
        $res = $this->db->query($sql)->fetchAll();
        return $res;
    }

    private function _getList(){
        $sql = "select * from list";
        $res = $this->db->query($sql)->fetchAll();
        return $res;
    }

    private function _getWeek(){
        return [
            '星期一', '星期二', '星期三', '星期四', '星期五', '星期六', '星期天',
        ];
    }

    public function render(){
        $data = [
            'grid' => $this->_getGrid(),
            'list' => $this->_getList(),
            'week' => $this->_getWeek(),
        ];
        echo $this->twig->render('score.html', $data);
    }
}

$d = new data();
$d->render();
