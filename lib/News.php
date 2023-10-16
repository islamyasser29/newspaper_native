<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class News
{
    private $id;
    private $title;
    private $content;
    private $id_editor;
    private $id_category;
    private $image_name;
    private $image_tmp;
    public function __construct($title, $content,$id_editor,$id_category,$image_name, $image_tmp, $id="")
    {
        $this->title = $title;
        $this->content = $content;
        $this->id_editor = $id_editor;
        $this->id_category = $id_category;
        $this->image_name = $image_name;
        $this->image_tmp = $image_tmp;
        $this->id = $id;
    }
    public function addNews()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                    global $dbh;
                    // prepare before execute 
                    $sql = $dbh->prepare("INSERT INTO news(title, content, id_editor, id_category, main_image) VALUES('$this->title', '$this->content', '$this->id_editor', '$this->id_category', '$this->image_name')");
                    // execute sql query 
                    if($sql->execute()){
                         // return news id
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
    public static function deleteNews($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM news WHERE id='$id'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    public function updateNews()
    {
        if(is_uploaded_file($this->image_tmp)){
            // rename orignal name 
            $this->image_name = time() . $this->image_name;
            if(move_uploaded_file($this->image_tmp, "../upload/".$this->image_name)){
                // get connection
                global $dbh;
                // prepare query before execute
                $sql = $dbh->prepare("UPDATE news SET title='$this->title', content = '$this->content', id_editor = '$this->id_editor', id_category = '$this->id_category', main_image ='$this->image_name' WHERE id='$this->id'");
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
    public static function retreiveNews($id)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news WHERE id='$id'");
        // execute sql query 
        $sql->execute();
        // fetch data as associative array
        $news = $sql->fetch(PDO::FETCH_ASSOC);
        return $news;
    }
    public static function retreiveAllNews()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
    public static function retreiveAllNewsByIdDESC()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news order by id DESC");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
    public static function retreiveAllNewsForCateogryByIdDESC($id_category)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news WHERE id_category='$id_category' order by id DESC");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
    public static function retreiveNoOfNewsByIdEditor($id_editor)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT id FROM news WHERE id_editor='$id_editor'");
        $sql->execute();
        return $sql->rowCount();
    }
    public static function retreiveNoOfNewsByIdCategory($id_category)
    {
        global $dbh;
        $sql = $dbh->prepare("SELECT id FROM news WHERE id_category='$id_category'");
        $sql->execute();
        return $sql->rowCount();
    }
}