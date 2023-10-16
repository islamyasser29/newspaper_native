<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class EditorImages
{
    private $id_editor;
    private $image_name;
    private $image_tmp;
    public function __construct($id_editor, $image_name, $image_tmp="")
    {
        $this->$id_editor = $id_editor;
        $this->image_name = $image_name;
        $this->image_tmp = $image_tmp;
    }
    public function addImage()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO edtor_images  (id_edtor,image_name) VALUES('$this->id_edtor', '$this->image_name')");
                    // execute sql query 
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

}