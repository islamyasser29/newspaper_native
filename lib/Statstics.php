<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Statstics{
    public static function getNoOfItems($tableName)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT id FROM $tableName");
        $sql->execute();
        return $sql->rowCount();
    }
}