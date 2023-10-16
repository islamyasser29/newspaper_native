<?php
    require_once 'auth.php';
    require_once '../helper/output.php';
    require_once '../lib/NewsImages.php';
    require_once 'template/navbar.tpl';
?>
<article class="article my-5">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-image mx-2"></i>
            <h2>ADD IMAGE</h2>
        </div>
    <?php
        if(isset($_POST['addImageNews'])){
            // collect data 
            // data for news images
            $news_images_names = $_FILES['images']['name'];
            $news_images_tmp = $_FILES['images']['tmp_name'];
            $id_news = $_POST['id_news'];
            if($id_news){
                // add image by image 
                for($index = 0; $index < count($news_images_names); $index++){
                    $newsImages = new NewsImages($id_news, $news_images_names[$index], $news_images_tmp[$index]);
                    $newsImages->addImage();
                }
                 // redirect show images page
                header("Location: editnews.php?action=showimages&id=".$id_news);
                // for security exit
                exit();
            }else{
                echo getFailMessage();  
            }
        }
    ?>
            <form action="addimages.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="NewsImages" class="form-label">News Images </label>
                    <input
                        class="form-control text-info"
                        type="file"
                        id="NewsImages"
                        name="images[]"
                        multiple="multiple" 
                    />
                </div>
                    <input type="hidden" name="id_news" value='<?php echo $_GET['id_news'] ?>' />
                <div class="col-auto">
                    <input type="submit" class="btn btn-primary mb-3" value="Add Images" name="addImageNews"/>
                </div>
            </form>
        </div>
    </div>
</article>
<?php
require_once 'template/footer.tpl';
?>