<?php
    require_once 'auth.php';
    require_once '../helper/output.php';
    require_once '../lib/Editor.php';
    require_once '../lib/Category.php';
    require_once '../lib/News.php';
    require_once '../lib/NewsImages.php';
    require_once 'template/navbar.tpl';
?>
    <article class="article my-5">
        <div class="container text-center py-4">
            <div class="main-title my-5 position-relative">
                <i class="icon fa-solid fa-newspaper mb-2"></i>
                <h2>ADD NEW NEWS</h2>
            </div>
    <?php
        if(isset($_POST['AddNews'])){
            // collect data 
            $title = $_POST['title'];
            $content = $_POST['content'];
            $id_editor = $_POST['id_editor'];
            $id_category = $_POST['id_category'];
            // data for main image
            $image_name = $_FILES['main_image']['name'];
            $image_tmp = $_FILES['main_image']['tmp_name'];
            // data for news images
            $news_images_names = $_FILES['images']['name'];
            $news_images_tmp = $_FILES['images']['tmp_name'];
            // check data valid or no 
            if($title == null){
                echo getNullMessage("News title");
            }else if($content == null){
                echo getNullMessage("News content");
            }else if($id_editor == null){
                echo getNullMessage("Written by");
            }else if(!is_numeric($id_editor)){
                echo getNonNumericMessage("Written by");
            }else if($id_category == null){
                echo getNullMessage("belong to");
            }else if(!is_numeric($id_category)){
                echo getNonNumericMessage("belong to");
            }else{
                // operations 
                $news = new News($title, $content, $id_editor, $id_category, $image_name, $image_tmp);
                // add news and get ID for this news
                $id_news = $news->addNews();
                if($id_news){
                    // add image by image 
                    for($index = 0; $index < count($news_images_names); $index++){
                        $newsImages = new NewsImages($id_news, $news_images_names[$index], $news_images_tmp[$index]);
                        $newsImages->addImage();
                    }
                    echo getSuccessMessage();
                }else{
                    echo getFailMessage();
                }
            }
        }
    ?>
                <div class="content row">
                    <div class="col-12">
                        <form action="addnews.php" method="POST" enctype="multipart/form-data">
                            <label for="NewsTitle" class="form-label">News Title</label>
                            <input
                                type="text"
                                class="form-control"
                                id="NewsTitle"
                                placeholder="Please Enter Title"
                                name="title"
                            />
                            <div class="mb-3">
                                <label for="NewsContent" class="form-label">News Content</label>
                                <textarea
                                    class="form-control"
                                    id="NewsContent"
                                    rows="3"
                                    name="content"
                                ></textarea>
                            </div>
                            <label for="WrittenBy" class="form-label">Written By</label>
                            <select
                                class="form-select"
                                aria-label="Default select example"
                                id="WrittenBy"
                                name="id_editor"
                            >
        <?php
            $allEditors = Editor::retreiveAllEditors();
            if(is_array($allEditors) && count($allEditors)>0){
                foreach ($allEditors as $editor):
                    echo '<option value="'.$editor['id'].'">'.$editor['name'].'</option>';
                endforeach;
            }else{
                echo '<option value="">no editor found</option>';
            }
        ?>
                        </select>
                        <label for="BelongTo" class="form-label">Belong To</label>
                        <select
                            class="form-select"
                            aria-label="Default select example"
                            id="BelongTo"
                            name="id_category"
                        >
            <?php
                $allCategories = Category::retreiveAllCategories();
                if(is_array($allCategories) && count($allCategories)>0){
                    foreach ($allCategories as $category):
                        echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                    endforeach;
                }else{
                    echo '<option value="">no category found</option>';
                }
            ?>
                            </select>
                            <div class="mb-3">
                                <label for="MainImage" class="form-label">Main Image </label>
                                <input
                                    class="form-control text-info"
                                    type="file"
                                    id="MainImage"
                                    name="main_image"
                                />
                            </div>
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
                            <div class="col-auto">
                                <input type="submit" class="btn btn-primary mb-3" value="Add News" name="AddNews"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </article>
<?php
require_once 'template/footer.tpl';
?>