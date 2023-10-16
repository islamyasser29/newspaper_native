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
            <h2>SHOW ALL EDITORS</h2>
        </div>
<?php
        if(isset($_GET['action'], $_GET['id'])){
            // collect data 
            $action = $_GET['action']; // may be delete or edit
            $id = $_GET['id'];
            switch($action){
                case 'delete':
                    if(Editor::deleteEditor($id)){
                        echo getSuccessMessage();
                    }else{
                        echo getFailMessage();
                    }
                    break;
                case 'edit':
                    $editor = Editor::retreiveEditor($id);
                        if(is_array($editor)){
                            echo '<div class="content row">
                                        <div class="col-12">
                                            <form action="editeditor.php" method="POST" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <img style="  width: 100px;
                                                        height: 100px;
                                                        display: block;
                                                        margin: auto;
                                                        border: #0dcaf0 solid 2px;
                                                        border-radius: 50%;   margin-bottom:10px;" src="../upload/'.$editor['main_profile'].'" alt=""
                                                    />
                                                    <input
                                                        type="hidden"
                                                        class="form-control"
                                                        name="id"
                                                        value="'.$editor['id'].'"
                                                    />
                                                    <label for="EditorName" class="form-label">Editor Name</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="EditorName"
                                                        placeholder="Please Enter Your Name"
                                                        name="name"
                                                        value="'.$editor['name'].'"
                                                    />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="EditorSalary" class="form-label">Editor Salary</label>
                                                    <input
                                                        type="text"
                                                        class="form-control"
                                                        id="EditorSalary"
                                                        placeholder="Please Enter Your Salary"
                                                        name="salary"
                                                        value="'.$editor['salary'].'"
                                                    />
                                                </div>
                                                <div class="mb-3">
                                                    <label for="MainImage" class="form-label">Change Profile</label>
                                                    <input
                                                        class="form-control text-info"
                                                        type="file"
                                                        id="MainImage"
                                                        name="main_profile"
                                                    />
                                                </div>
                                                <div class="col-auto">
                                                    <input type="submit" class="btn btn-primary mb-3" name="updateEditor" value="Update Editors"/>
                                                </div>
                                            </form>
                                        </div>
                                    </div>';
                                            }else{
                                                echo getMessage("no editor found");
                                            }   
                                            break;
                                            default:
                                                echo getMessage("invalid action");
                }
            }
        
        if(isset($_POST['updateEditor'])){
            // collect data 
            $id = $_POST['id'];
            $name = $_POST['name'];
            $salary = $_POST['salary'];

            $image_name = $_FILES['main_profile']['name'];
            $image_tmp = $_FILES['main_profile']['tmp_name'];
            // check data valid or no 
            if($name == null){
                echo getNullMessage("editor name");
            }else if($salary == null){
                echo getNullMessage("editor salary");
            }else if(!is_numeric($salary)){
                echo getNonNumericMessage("editor salary");
            }else{
                // operations 
                $editor = new Editor($name, $salary,$image_name, $image_tmp, $id);
                if($editor->updateEditor()){
                    echo getSuccessMessage();
                }else{
                    echo getFailMessage();
                }
            }
        }
    ?>
        <div class="content row">
            <div class="col-12 text-center">
            <table class="table table-info table-striped text-center editor mb-5">
                <tr>
                    <th class="id_table"><i class="fa-solid fa-tag mx-2"></i>ID</th>
                    <th><i class="fa-solid fa-star mx-2"></i>Name</th>
                    <th><i class="fa-solid fa-image mx-2"></i>Profile</th>
                    <th><i class="fa-solid fa-user-ninja mx-2"></i>Manager In</th>
                    <th><i class="fa-solid fa-list-ol mx-2"></i>No Of News</th>
                    <th class="delete_edit">
                        <i class="fa-solid fa-trash mx-2"></i>Delete
                    </th>
                    <th class="delete_edit">
                        <i class="fa-solid fa-pencil mx-2"></i>Edit
                    </th>
                </tr>

                <?php
                    $allEditors = Editor::retreiveAllEditors();
                    if(is_array($allEditors) && count($allEditors)>0){
                        foreach ($allEditors as $editor):
                            echo   '<tr>
                                        <td>'.$editor['id'].'</td>
                                        <td>'.$editor['name'].'</td>
                                        <td>
                                            <img src="../upload/'.$editor['main_profile'].'"/>
                                        </td>
                                        <td>'. implode(", ", Category::retreiveAllCategoriesNamesByManagerid($editor['id'])).'</td>
                                        <td>'.News::retreiveNoOfNewsByIdEditor($editor['id']).'</td>
                                        <td><a class="btn btn-danger" href="?action=delete&id='.$editor['id'].'">Delete</a></td>
                                        <td><a class="btn btn-info" href="?action=edit&id='.$editor['id'].'">Edit</a></td>
                                    </tr>';
                        endforeach;
                        }else{
                            echo    '<tr>
                                        <td colspan="5" class="alert alert-danger" role="alert">no editor found</td>
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