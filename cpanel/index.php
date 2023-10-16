<?php
    require_once 'auth.php';
    require_once '../lib/Statstics.php';
    require_once 'template/navbar.tpl';
?>
<article class="article my-5">
    <div class="container text-center py-4">
        <div class="main-title my-5 position-relative">
            <i class="icon fa-solid fa-repeat mb-2"></i>
            <h2>STATSTICS</h2>
        </div>
        <div class="content row">
            <div class="col-12 text-center">
                <table class="table table-info table-striped text-center index_table">
                    <tr>
                        <th class="sm-th">
                            <i class="fa-solid fa-list-ol mx-2"></i>No.Of Editors
                        </th>
                        <td><?php echo Statstics::getNoOfItems("editor"); ?></td>
                    </tr>
                    <tr>
                        <th class="sm-th">
                            <i class="fa-solid fa-list-ol mx-2"></i>No.Of Categories
                        </th>
                        <td><?php echo Statstics::getNoOfItems("category"); ?></td>
                    </tr>
                    <tr>
                        <th class="sm-th">
                            <i class="fa-solid fa-list-ol mx-2"></i>No.of News
                        </th>
                        <td><?php echo Statstics::getNoOfItems("news"); ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</article>
<?php
    require_once 'template/footer.tpl';
?>