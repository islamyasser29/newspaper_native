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
            <i class="icon fa-solid fa-eye mb-2"></i>
            <h2>SHOW ALL News</h2>
        </div>
    <?php
        if(isset($_GET['action'], $_GET['id'])){
            // collect data 
            $action = $_GET['action']; // may be delete or edit
            $id = $_GET['id'];
            switch($action){
                case 'delete':
                    if(News::deleteNews($id)){
                        echo getSuccessMessage();
                    }else{
                        echo getFailMessage();
                    }
                    break;
                case 'edit':
                    $news = News::retreiveNews($id);
                    if(is_array($news)){
                        echo '<div class="content row">
                                <div class="col-12">
                                    <form action="editnews.php" method="POST" enctype="multipart/form-data">
                                        <label for="NewsTitle" class="form-label">News Title</label>
                                        <input
                                            type="text"
                                            class="form-control"
                                            id="NewsTitle"
                                            value="'.$news['title'].'"
                                            name="title"
                                        />
                                        <div class="mb-3">
                                            <label for="NewsContent" class="form-label">News Content</label>
                                            <textarea
                                                class="form-control"
                                                id="NewsContent"
                                                rows="3"
                                                name="content"
                                            >'.$news['content'].'</textarea>
                                        </div>
                                        <label for="WrittenBy" class="form-label">Written By</label>
                                        <select
                                            class="form-select"
                                            aria-label="Default select example"
                                            id="WrittenBy"
                                            name="id_editor"
                                        >';
                                    $allEditors = Editor::retreiveAllEditors();
                                        if(is_array($allEditors) && count($allEditors)>0){
                                            foreach ($allEditors as $editor):
                                                if($editor['id'] == $news['id_editor']){
                                                    echo '<option selected="selected" value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                }else{
                                                    echo '<option value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                }
                                            endforeach;
                                        }else{
                                            echo '<option value="">no editor found</option>';
                                        }
                                    echo '</select>
                                        <label for="BelongTo" class="form-label">Belong To</label>
                                        <select
                                            class="form-select"
                                            aria-label="Default select example"
                                            id="BelongTo"
                                            name="id_category"
                                        >';
                                        $allCategories = Category::retreiveAllCategories();
                                        if(is_array($allCategories) && count($allCategories)>0){
                                            foreach ($allCategories as $category):
                                                if($category['id'] == $news['id_category']){
                                                    echo '<option selected="selected" value="'.$category['id'].'">'.$category['name'].'</option>';
                                                }else{
                                                    echo '<option value="'.$category['id'].'">'.$category['name'].'</option>';
                                                }
                                            endforeach;
                                        }else{
                                            echo '<option value="">no category found</option>';
                                        }
                                    echo'</select>
                                        <div class="mb-3">
                                            <label for="MainImage" class="form-label">Main Image </label>
                                                <img style="  width: 100px;
                                                    height: 100px;
                                                    display: block;
                                                    margin: auto;
                                                    border: #0dcaf0 solid 2px;
                                                    border-radius: 50%;   margin-bottom:10px;" src="../upload/'.$news['main_image'].'" alt=""/>
                                                        <input
                                                            class="form-control text-info"
                                                            type="file"
                                                            id="MainImage"
                                                            name="main_image"
                                                />
                                        </div>
                                        <input type="hidden" name="id" value="'.$news['id'].'"/>
                                        <div class="col-auto">
                                            <input type="submit" class="btn btn-primary mb-3" value="Update News" name="updateNews"/>
                                        </div>
                                    </form>';
                        }else{
                            echo getMessage("no news found");
                        }
                        break;
                        case 'showimages':
                            echo '<a class="btn btn-success my-4" href="addimages.php?id_news='.$id.'">add images to news</a>
                                <div class="content row">
                                    <div class="col-12 text-center">
                                        <table class="table table-info table-striped text-center editor">
                                            <tr>
                                                <th class="id_table"><i class="fa-solid fa-tag"></i>ID NEWS</th>
                                                <th><i class="fa-solid fa-image mx-2"></i>Image</th>
                                                <th class="delete_edit">
                                                    <i class="fa-solid fa-trash mx-2"></i>Delete
                                                </th>
                                            </tr>';
                                // get news images 
                                $allImages = NewsImages::retreiveAllImagesForSpecficNews($id);
                                if(is_array($allImages) and count($allImages) >0){
                                    foreach ($allImages as $image_news){
                                        echo '<tr>
                                                <td>'.$image_news['id_news'].'</td>
                                                <td><img src="../upload/'.$image_news['image_name'].'"/></td>
                                                <td><a  class="btn btn-danger" href="?action=deleteimage&id='.$image_news['id_news'].'&imagename='.$image_news['image_name'].'">delete</a></td>
                                            </tr>';
                                        
                                    }
                                }else{
                                    echo    '<tr>
                                                <td colspan="3"  class="alert text-danger">No Images Found</td>
                                            </tr>';
                                }
                                echo '</table>';
                                break;
                                case 'deleteimage':
                                    // collect data 
                                    $image_name = $_GET['imagename'];
                                    $newsImages = new NewsImages($id, $image_name);
                                    if($newsImages->deleteImage()){
                                        // redirect show images page
                                        header("Location: editnews.php?action=showimages&id=".$id);
                                        // for security exit
                                        exit();
                                    }else{
                                        echo getFailMessage();
                                    }
                                    break;
                                    default:
                                    echo getMessage("invalid action");
                }
            }

                    if(isset($_POST['updateNews'])){
                         // collect data 
                        $title = $_POST['title'];
                        $content = $_POST['content'];
                        $id_editor = $_POST['id_editor'];
                        $id_category = $_POST['id_category'];
                        $id = $_POST['id'];
                        // data for main image
                        $image_name = $_FILES['main_image']['name'];
                        $image_tmp = $_FILES['main_image']['tmp_name'];
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
                            $news = new News($title, $content, $id_editor, $id_category,$image_name, $image_tmp, $id);
                            if($news->updateNews()){
                                echo getSuccessMessage();
                            }else{
                                echo getFailMessage();
                            }
                        }
                    }
                ?>
        <div class="content row">
            <div class="col-12 text-center">
                <table class="table table-info table-striped text-center editor">
                    <tr>
                        <th class="id_table"><i class="fa-solid fa-tag  mx-2"></i>ID</th>
                        <th><i class="fa-solid fa-ticket mx-2"></i>Title</th>
                        <th><i class="fa-solid fa-image mx-2"></i>Main Image</th>
                        <th><i class="fa-solid fa-file-pen mx-2"></i>Written By</th>
                        <th>
                            <i class="fa-brands fa-square-x-twitter mx-2"></i>Belong To
                        </th>
                        <th class="delete_edit">
                            <i class="fa-solid fa-trash mx-2"></i>Delete
                        </th>
                        <th class="delete_edit">
                            <i class="fa-solid fa-pencil mx-2"></i>Edit
                        </th>
                        <th><i class="fa-regular fa-images mx-2"></i>Show Images</th>
                    </tr>
        <?php
            $allNews = News::retreiveAllNews();
            if(is_array($allNews) && count($allNews)>0){
                foreach ($allNews as $news):
                    echo '<tr>
                                <td>'.$news['id'].'</td>
                                <td>'.$news['title'].'</td>
                                <td>
                                    <img src="../upload/'.$news['main_image'].'"/>
                                </td>
                                <td>'.Editor::retreiveEditorName($news['id_editor']).'</td>
                                <td>'.Category::retreiveCategoryName($news['id_category']).'</td>
                                <td>
                                    <a class="btn btn-danger" href="?action=delete&id='.$news['id'].'">Delete</a>
                                </td>
                                <td><a class="btn btn-info" href="?action=edit&id='.$news['id'].'">Edit</a></td>
                                <td>
                                    <a class="btn btn-success" href="?action=showimages&id='.$news['id'].'">Show Images</a>
                                </td>
                        </tr>';
                endforeach;
            }else{
                echo '<tr>
                        <td colspan="8" class="alert text-danger">no news found</td>
                    </tr>';
            }
        ?>
                </table>
            </div>
        </div>
    </div>
</article>
<?php
require_once 'template/footer.tpl';
?>