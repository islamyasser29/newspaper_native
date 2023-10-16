<?php
    require_once 'auth.php';
    require_once '../helper/output.php';
    require_once '../lib/Editor.php';
    require_once 'template/navbar.tpl';
    require_once '../lib/EditorImages.php';
?>
<article class="article my-5">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-newspaper mb-2"></i>
            <h2>Add New Editor</h2>
        </div>
<?php
    if(isset($_POST['addEditor'])){
        // collect data 
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
            $editor = new Editor($name, $salary,$image_name, $image_tmp);
            $id_editor = $editor->addEditor();
            if($id_editor){
                            // add image by image 
                            $editorImages = new EditorImages($id_editor, $image_name,$image_tmp);
                            $editorImages->addImage();
                            echo getSuccessMessage();
                        }else{
                            echo getFailMessage();
                        }
        }
    }
?>
        <div class="content row">
            <div class="col-12">
                <form action="addeditor.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="EditorName" class="form-label">Editor Name</label>
                        <input
                            type="text"
                            class="form-control"
                            id="EditorName"
                            placeholder="Please Enter Your Name"
                            name="name"
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
                        />
                    </div>
                    <div class="mb-3">
                        <label for="profile" class="form-label">Profile</label>
                        <input
                            class="form-control text-info"
                            type="file"
                            id="profile"
                            name="main_profile"
                        />
                    </div>
                    <div class="col-auto">
                        <input type="submit" class="btn btn-primary mb-3" name="addEditor" value="Add Editors"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</article>
<?php
require_once 'template/footer.tpl';
?>
