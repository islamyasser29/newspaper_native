<?php
    require_once 'auth.php';
    require_once '../helper/output.php';
    require_once '../lib/Editor.php';
    require_once '../lib/Category.php';
    require_once 'template/navbar.tpl';
?>
<article class="article my-5">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-newspaper mb-2"></i>
            <h2>Add New CATEGORY</h2>
        </div>
<?php
    if(isset($_POST['addCategory'])){
        // collect data 
        $name = $_POST['name'];
        $id_manager = $_POST['id_manager'];
        // check data valid or no 
        if($name == null){
            echo getNullMessage("Category name");
        }else if($id_manager == null){
            echo getNullMessage("Category manager");
        }else if(!is_numeric($id_manager)){
            echo getNonNumericMessage("Category manager");
        }else{
            // operations 
            $category = new Category($name, $id_manager);
            if($category->addCategory()){
                echo getSuccessMessage();
            }else{
                echo getFailMessage();
            }
        }
    }
?>
        <div class="content row">
            <div class="col-12">
                <form action="addcategory.php" method="POST">
                    <div class="mb-3">
                        <label for="GategoryName" class="form-label">Category Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="EditorName"
                            placeholder="Please Enter Your Name"
                            name="name"
                        />
                    </div>
                    <label for="category" class="form-label">Managed By </label>
                    <select
                        class="form-select mb-3"
                        aria-label="Default select example"
                        id="category"
                        name="id_manager"
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
                    <div class="col-auto">
                        <input type="submit" class="btn btn-primary mb-3" value="Add Category" name="addCategory"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<?php
    require_once 'template/footer.tpl';
?>