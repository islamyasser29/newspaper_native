<?php
    require_once 'template/navbar.tpl';
?>
<article class="article">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-newspaper mb-6"></i>
            <h2>LATEST NEWS</h2>
        </div>
        <div class="content row">
            
<?php
    $allNews = News::retreiveAllNewsByIdDESC();
        if(is_array($allNews) && count($allNews)>0){
            foreach ($allNews as $news):
                echo'<div class="col-sm-12 col-md-6 col-lg-3 mb-4 text-center">
                        <div class="card card_control" style="width: 18rem;">
                            <img
                                style="height: 250px;"
                                src="upload/'.$news['main_image'].'" 
                                class="card-img-top images"
                                alt=""
                            />
                            <div class="card-body bg-info card_title" style="height: 70px" >
                                <a href="news.php?id='.$news['id'].'" class="btn btn-light text-info">'.$news['title'].'</a>
                            </div>
                        </div>
                    </div>';
            endforeach;
            }else{
                echo getMessage("no news found");
            }
?>
        </div>
    </div>
</article>
<?php
    require_once 'template/footer.tpl';
?>