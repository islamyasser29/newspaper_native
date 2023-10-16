<?php
if(file_exists('../config.php')){
    require_once '../config.php';
}else{
    require_once 'config.php';
}
class NewsImages
{
    private $id_news;
    private $image_name;
    private $image_tmp;
    public function __construct($id_news, $image_name, $image_tmp="")
    {
        $this->id_news = $id_news;
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
                    $sql = $dbh->prepare("INSERT INTO news_images  (id_news,image_name) VALUES('$this->id_news', '$this->image_name')");
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
    public function deleteImage()
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("DELETE FROM news_images WHERE id_news='$this->id_news' AND image_name = '$this->image_name'");
        // execute sql queru
        if($sql->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    public static function retreiveAllImagesForSpecficNews($id_news)
    {
        // get connection
        global $dbh;
        // prepare query before execute 
        $sql = $dbh->prepare("SELECT * FROM news_images where id_news = '$id_news'");
        // execute sql query
        $sql->execute();
        // fetch data as associative array
        $allNews = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $allNews;
    }
}