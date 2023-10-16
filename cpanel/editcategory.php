<?php
    require_once 'auth.php';
    require_once '../helper/output.php';
    require_once '../lib/Editor.php';
    require_once '../lib/Category.php';
    require_once '../lib/News.php';
    require_once 'template/navbar.tpl';
?>
<article class="article my-5">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-eye mb-2"></i>
            <h2>SHOW ALL CATEGORIES</h2>
        </div>
    <?php
        if(isset($_GET['action'], $_GET['id'])){
            // collect data 
            $action = $_GET['action']; // may be delete or edit
            $id = $_GET['id'];
            switch ($action){
                case 'delete':
                    if(Category::deleteCategory($id)){
                        echo getSuccessMessage();
                    }else{
                        echo getFailMessage();
                    }
                    break;
                case 'edit':
                    $category = Category::retreiveCategory($id);
                    if(is_array($category)){
                        echo '<div class="content row">
                            <div class="col-12">
                                <form action="editcategory.php" method="POST">
                                    <div class="mb-3">
                                        <label for="GategoryName" class="form-label">Category Name</label>
                                        <input type="text" class="form-control" id="EditorName" name="name" value="'.$category['name'].'"/>
                                    </div>
                                    <label for="category" class="form-label">Managed By </label>
                                    <select class="form-select mb-3" aria-label="Default select example" id="category" name="id_manager">';    
                                        $allEditors = Editor::retreiveAllEditors();
                                            if(is_array($allEditors) && count($allEditors)>0){
                                                foreach ($allEditors as $editor):
                                                    if($editor['id'] == $category['id_manager']){
                                                        echo '<option selected="selected" value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                    }else{
                                                        echo '<option value="'.$editor['id'].'">'.$editor['name'].'</option>';
                                                    }
                                                endforeach;
                                            }else{
                                                echo '<option value="">no editor found</option>';
                                            }
                                echo'</select>
                                        <input type="hidden" name="id" value="'.$category['id'].'"/>
                                        <input type="submit" class="btn btn-primary mb-3"  name="updateCategory" value="Update Category"  />
                                </form>';
                        }else{
                            echo getMessage("no category found");
                        }
                            break;
                                default:
                                    echo getMessage("invalid action");
                }
            }
            if(isset($_POST['updateCategory'])){
                // collect data 
                $name = $_POST['name'];
                $id_manager = $_POST['id_manager'];
                $id = $_POST['id'];
                // check data valid or no 
                if($name == null){
                    echo getNullMessage("Category name");
                }else if($id_manager == null){
                    echo getNullMessage("Category manager");
                }else if(!is_numeric($id_manager)){
                    echo getNonNumericMessage("Category manager");
                }else{
                    // operations 
                    $category = new Category($name, $id_manager, $id);
                    if($category->updateCategory()){
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
                        <th><i class="fa-solid fa-star mx-2"></i>name</th>
                        <th><i class="fa-solid fa-list-ol mx-2"></i>No Of News</th>
                        <th><i class="fa-solid fa-user-ninja mx-2"></i>Managed By</th>
                        <th class="delete_edit">
                        <i class="fa-solid fa-trash mx-2" ></i>Delete
                        </th>
                        <th class="delete_edit">
                        <i class="fa-solid fa-pencil mx-2"></i>Edit
                        </th>
                    </tr>
    <?php
        $allCategories = Category::retreiveAllCategories();
            if(is_array($allCategories) && count($allCategories)>0){
                foreach ($allCategories as $category):
                    echo '<tr>
                            <td>'.$category['id'].'</td>
                            <td>'.$category['name'].'</td>
                            <td>'.News::retreiveNoOfNewsByIdCategory($category['id']).'</td>
                            <td>'.Editor::retreiveEditorName($category['id_manager']).'</td>
                            <td>
                                <a class="btn btn-danger" href="?action=delete&id='.$category['id'].'">Delete</a>
                            </td>
                            <td><a class="btn btn-info" href="?action=edit&id='.$category['id'].'">Edit</a></td>
                        </tr>';
                endforeach;
            }else{
                echo '<tr>
                        <td colspan="6" class="alert text-danger">No Category Found</td>
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