<?php
require('../createTab.php');

$arr = array("userName"=>"Jack","passWord"=>"123456","email"=>"15155555@qq.com");

$database->insertRowSingle('user',$arr);
?>