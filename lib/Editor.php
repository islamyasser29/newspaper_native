<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class Editor
{
    private $id;
    private $name;
    private $salary;
    private $image_name;
    private $image_tmp;
    public function __construct($name, $salary,$image_name, $image_tmp, $id="")
    {
        $this->name = $name;
        $this->salary = $salary;
        $this->image_name = $image_name;
        $this->image_tmp = $image_tmp;
        $this->id = $id;
    }

        public function addEditor()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO editor(name, salary, main_profile) VALUES('$this->name', '$this->salary',  '$this->image_name')");
                    // execute sql query 
                    if($sql->execute()){
                         // return $editor_images_names id
                        return $dbh->lastInsertId();
                    }else{
                        return false;
                    }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public static function deleteEditor($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM editor WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateEditor()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                global $dbh;
                // prepare query before execute
                $sql = $dbh->prepare("UPDATE editor SET name='$this->name', salary = '$this->salary', main_profile ='$this->image_name' WHERE id='$this->id'");
                // execure sql query 
                if($sql->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    public static function retreiveEditor($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM editor WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $editor = $sql->fetch(PDO::FETCH_ASSOC);
        return $editor;
    }
    public static function retreiveEditorName($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT name FROM editor WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $editor = $sql->fetch(PDO::FETCH_ASSOC);
        return $editor['name'];
    }
    public static function retreiveAllEditors()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM editor");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allEditors = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allEditors;
    }
}