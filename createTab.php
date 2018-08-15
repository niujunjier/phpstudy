<?php
header("Content-type:text/html;charset=utf-8;");
class Database
{
    public $dbhost;
    public $dbuser;
    public $dbpass;
    public $table;

    public function __construct($table)
    {
        $this->dbhost = 'localhost';
        $this->dbuser = 'root';
        $this->dbpass = '';
        $this->table = $table;
    }

    public function createTable($sql)
    {
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
        if (!$conn) {
            die('连接错误: ' . mysqli_error($conn));
        }
        mysqli_select_db($conn, $this->table);
        if ($conn->query($sql) === true) {
            echo "Table MyGuests created successfully";
        } else {
            echo json_encode($conn->error);
        }
        $conn->close();
    }

    public function insertRowSingle($table, $param)
    {
        $keyArr = array_keys($param);
        $valArr = array_values($param);
        $keyStr = implode("`, `", $keyArr);
        $valStr = implode("', '", $valArr);
        $sql = "INSERT INTO ". $table;
        $sql .= "(`$keyStr`) values('$valStr')";
        echo $sql,'<br />';
        $conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass);
        if (!$conn) {
            die('连接错误: ' . mysqli_error($conn));
        }
        mysqli_select_db($conn, $this->table);
        if ($conn->query($sql) === true) {
            echo "插入成功";
        } else {
            echo json_encode($conn->error);
        }
        $conn->close();
    }
}

$database = new Database('mydb');

// $sql = 'create table if not exists user(
//     uid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
//     userName VARCHAR(30) NOT NULL,
//     passWord VARCHAR(30) NOT NULL,
//     email VARCHAR(50),
//     createDate TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP 
// ) ENGINE=InnoDB DEFAULT CHARSET=gb2312';

// $arr = array("userName"=>"Jack","passWord"=>"123456","email"=>"15155555@qq.com");

// $database->insertRowSingle('user',$arr);
// $database->createTable($sql);
?>