<?php
    require_once 'template/navbar.tpl';
    require_once 'lib/NewsImages.php';
?>
<article class="article">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-newspaper mb-6"></i>
            <h2>LATEST NEWS</h2>
        </div>
        <div class="content row">
<?php
    if(isset($_GET['id'])){
        // collect data 
        $id = $_GET['id'];
        $news = News::retreiveNews($id);
        if(is_array($news)){
            echo'<div class="col-12 text-center">
                    <div class="card mb-3">
                        <img
                            style="height: 300px;max-width:1000px; margin:auto"
                            src="upload/'.$news['main_image'].'" 
                            class="card-img-top images"
                            alt=""
                        />
                        <div class="card-body border_css" style="background:#0dcaf0">
                            <h5 class="card-title"  style="border-bottom:#fff 2px solid; padding-bottom: 20px">'.$news['title'].'</h5>
                            <p class="card-text">'.$news['content'].'</p>
                        </div>
                    </div>
                </div>';
                    // get allImages
                    $allImages = NewsImages::retreiveAllImagesForSpecficNews($id);
                    if(is_array($allImages) && count($allImages)>0){
                        foreach ($allImages as $images){
                            echo '<img style="margin:5px; border:1px solid #0dcaf0; border-radius: 8px;" width="100" height="100" src="upload/'.$images['image_name'].'" />';
                        }
                    }
            }else{
                echo getMessage("no news found");
            }
        }else {
            header("Location: index.php");
                exit();
            }
?>
        </div>
    </div>
</article>
<?php
    require_once 'template/footer.tpl';
?>