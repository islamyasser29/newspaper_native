<?php
require_once 'helper/output.php';
require_once 'lib/Category.php';
require_once 'lib/News.php';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Newspaper</title>
    <link rel="stylesheet" href="template/css/bootstrap.min.css" />
    <link rel="stylesheet" href="template/css/all.min.css" />
    <link rel="stylesheet" href="template/css/bace.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Assistant:wght@300;400;500;600;700&family=Roboto:wght@100;300;400;500;700;900&family=Ubuntu:wght@300;400;500;700&family=Work+Sans:wght@200;300;400;500;600;700;800&display=swap"
      rel="stylesheet"
    />
  </head>
  <body>
    <nav class="navbar navbar-expand-lg bg-info sticky-top">
      <div class="container">
        <a class="navbar-brand logo" href="index.php">Newspaper</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-end"
          id="navbarNav"
        >
          <ul class="navbar-nav">
            <li class="nav-item p-2 px-lg-4">
              <a class="nav-link active" aria-current="page" href="index.php"
                >Home</a
              >
            </li>
            <?php
            $allCategories = Category::retreiveAllCategories();
            if(is_array($allCategories) && count($allCategories)>0){
                foreach ($allCategories as $category):
                    echo '<li  class="nav-item p-2 px-lg-4"><a class="nav-link" href="category.php?id='.$category['id'].'">'.$category['name'].'</a></li>';
                endforeach;
            }
        ?>
        <li class="nav-item p-2 px-lg-4">
            <a class="btn btn-light text-info" href="cpanel/login.php"
          >login<i class="fa-solid fa-arrow-right-to-bracket mx-1"></i
        ></a>
        </li>
          </ul>
        </div>
      </div>
    </nav>