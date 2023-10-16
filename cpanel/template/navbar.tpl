<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>DASHBOARD</title>
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
        <a class="navbar-brand logo" href="index.php">DASHBOARD</a>
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
              <a
                class="nav-link active"
                aria-current="page"
                href="addeditor.php"
                >add editor</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4">
              <a
                class="nav-link active"
                aria-current="page"
                href="editeditor.php"
                >edit editor</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4">
              <a
                class="nav-link active"
                aria-current="page"
                href="addcategory.php"
                >add category</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4">
              <a
                class="nav-link active"
                aria-current="page"
                href="editcategory.php"
                >edit category</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4">
              <a class="nav-link active" aria-current="page" href="addnews.php"
                >add news</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4">
              <a
                class="nav-link active"
                aria-current="page"
                href="editnews.php"
                >edit news</a
              >
            </li>
            <li class="nav-item p-2 px-lg-4"><a class="btn btn-light text-danger" href="logout.php"
          >logout<i class="fa-solid fa-arrow-right-to-bracket mx-1"></i
        ></a></li>
          </ul>
        </div>
        
      </div>
    </nav>