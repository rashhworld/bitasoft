<!DOCTYPE HTML>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="description" content="Bitasoft - Best in Tech Analysis">
  <meta name="keywords" content="Best Free tech content, programming content, and lecture notes">
  <meta name="author" content="Sujit">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bitasoft | Best in Tech Analysis</title>

  <meta property="og:locale" content="en_US" />
  <meta property="og:type" content="website" />
  <meta property="og:title" content="Bitasoft - Best in Tech Analysis" />
  <meta property="og:site_name" content="Bitasoft.in" />
  <meta property="og:url" content="https://bitasoft.in" />
  <meta property="og:description" content="Bitasoft - Best Free tech content, programming content, and lecture notes." />
  <meta property="og:image" content="<?= base_url('assets/metaicons/android-chrome-512x512.png') ?>" />

  <link rel="canonical" href="https://bitasoft.in" />
  <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url('assets/metaicons/apple-touch-icon.png') ?>">
  <link rel="icon" type="image/png" sizes="32x32" href="<?= base_url('assets/metaicons/favicon-32x32.png') ?>">
  <link rel="icon" type="image/png" sizes="16x16" href="<?= base_url('assets/metaicons/favicon-16x16.png') ?>">
  <link rel="manifest" href="<?= base_url('assets/metaicons/site.webmanifest') ?>">
  <link rel="shortcut icon" href="<?= base_url('assets/metaicons/favicon.ico') ?>">
  <meta name="msapplication-TileColor" content="#da532c">
  <meta name="msapplication-config" content="<?= base_url('assets/metaicons/browserconfig.xml') ?>">
  <meta name="theme-color" content="#ffffff">

  <link rel="stylesheet" href="<?= base_url('assets/plugin/css/main.css?v=') . time() ?>">
  <link rel="stylesheet" href="<?= base_url('assets/lander/css/prism.css?v=') . time() ?>">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/11.4.28/sweetalert2.min.css">
</head>

<body>
  <nav class="navbar sticky-top navbar-expand-lg bg-body-tertiary bg" data-bs-theme="dark">
    <div class="container-fluid">
      <div class="dropdown">
        <a class="nav-link dropdown-toggle navbar-brand" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          BiTA<span class="text-warning">SOFT</span>
        </a>
        <ul class="dropdown-menu">
          <li>
            <a class="dropdown-item" href="<?= base_url('admin') ?>">
              <i class="fa-regular fa-eye"></i> Dashboard
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="<?= base_url('/') ?>">
              <i class="fa-regular fa-eye"></i> Homepage
            </a>
          </li>
        </ul>
      </div>
      <button class="navbar-toggler border border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fa-solid fa-bars-staggered"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-pen-to-square"></i> catagory
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#catagoryModal">
                  <i class="fa-solid fa-file-circle-plus"></i> Add catagory
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="<?= base_url('admin/catagory') ?>">
                  <i class="fa-regular fa-eye"></i> View catagory
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-pen-to-square"></i> Subject
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#subjectModal">
                  <i class="fa-solid fa-file-circle-plus"></i> Add Subject
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewSubjectModal">
                  <i class="fa-regular fa-eye"></i> View Subject
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-regular fa-pen-to-square"></i> Module
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#moduleModal">
                  <i class="fa-solid fa-file-circle-plus"></i> Add Module
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#viewModuleModal">
                  <i class="fa-regular fa-eye"></i> View Module
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-book-open-reader"></i> Study Material
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="<?= base_url('admin/material/add') ?>">
                  <i class="fa-solid fa-file-circle-plus"></i> Add Material
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="<?= base_url('admin/material') ?>">
                  <i class="fa-regular fa-eye"></i> View Material
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa-solid fa-rss"></i> BlogPost
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="<?= base_url('admin/blog/add') ?>">
                  <i class="fa-solid fa-file-circle-plus"></i> Add BlogPost
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="<?= base_url('admin/blog') ?>">
                  <i class="fa-regular fa-eye"></i> View BlogPost
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#searchModal">
              <i class="fa-solid fa-magnifying-glass"></i> Search Article
            </a>
          </li>
        </ul>
        <a class="nav-link text-warning" href="<?= base_url('admin/logout') ?>"><i class="fa-solid fa-user"></i> Logout, Admin</a>
      </div>
    </div>
  </nav>

  <!-- Catagory Modal -->
  <div class="modal fade" id="catagoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Catagory</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3">
            <div class="col-md-12">
              <label for="cname" class="form-label">Enter Catagory Name</label>
              <input type="text" class="form-control" id="cname" name="cname">
            </div>
            <div class="col-md-12">
              <label for="cimg" class="form-label">Enter Catagory Image</label>
              <input type="file" class="form-control" id="cimg" name="cimg">
            </div>
            <div class="col-md-12">
              <label for="cdesc" class="form-label">Enter Catagory Description</label>
              <textarea class="form-control" id="cdesc" name="cdesc" style="height:100px"></textarea>
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-outline-primary w-100" type="submit" onclick="addCatagory('#catagoryModal')">Add Catagory</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Subject Modal -->
  <div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Add Subject</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3">
            <div class="col-md-12">
              <label for="cid" class="form-label">Choose Catagory</label>
              <select class="form-select" name="cid" id="cid">
                <option value="" selected disabled hidden>Choose Here</option>
                <?php foreach ($catagory as $cat) { ?>
                  <option value="<?= $cat['cid'] ?>"><?= $cat['cname'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="sname" class="form-label">Enter Subject Name</label>
              <input type="text" class="form-control" id="sname" name="sname">
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-outline-primary w-100" type="submit" onclick="addSubject('#subjectModal')">Add Subject</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- View Subject Modal -->
  <div class="modal fade" id="viewSubjectModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">View Subject</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label for="cid" class="form-label">Choose Catagory</label>
              <select class="form-select" name="cid" id="cid" onchange="fetchSubject('#viewSubjectModal', this, 'update')">
                <option value="" selected disabled hidden>Choose Here</option>
                <?php foreach ($catagory as $cat) { ?>
                  <option value="<?= $cat['cid'] ?>"><?= $cat['cname'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12" id="subjectData"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Add Module Modal -->
  <div class="modal fade" id="moduleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Module</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3">
            <div class="col-md-12">
              <label for="cid" class="form-label">Choose Catagory</label>
              <select class="form-select" name="cid" id="cid" onchange="fetchSubject('#moduleModal', this)">
                <option value="" selected disabled hidden>Choose Here</option>
                <?php foreach ($catagory as $cat) { ?>
                  <option value="<?= $cat['cid'] ?>"><?= $cat['cname'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="sid" class="form-label">Choose Subject</label>
              <select class="form-select" name="sid" id="sid">
                <option value="" selected disabled hidden>Choose Here</option>
              </select>
            </div>
            <div class="col-md-12">
              <label for="mdname" class="form-label">Enter Module Name</label>
              <input type="text" class="form-control" id="mdname" name="mdname">
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-outline-primary w-100" type="submit" onclick="addModule('#moduleModal')">Add Module</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- View Module Modal -->
  <div class="modal fade" id="viewModuleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">View Module</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-12">
              <label for="cid" class="form-label">Choose Catagory</label>
              <select class="form-select" name="cid" id="cid" onchange="fetchSubject('#viewModuleModal', this)">
                <option value="" selected disabled hidden>Choose Here</option>
                <?php foreach ($catagory as $cat) { ?>
                  <option value="<?= $cat['cid'] ?>"><?= $cat['cname'] ?></option>
                <?php } ?>
              </select>
            </div>
            <div class="col-md-12">
              <label for="sid" class="form-label">Choose Subject</label>
              <select class="form-select" name="sid" id="sid" onchange="fetchModule('#viewModuleModal', this)">
                <option value="" selected disabled hidden>Choose Here</option>
              </select>
            </div>
            <div class="col-md-12" id="moduleData"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Search Article -->
  <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-l modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5">Search Article</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form class="row g-3">
            <div class="col-md-12">
              <label for="cType">Choose Search Type</label>
              <div class="mb-3">
                <select class="form-control" id="cType" name="cType">
                  <option value="" selected disabled hidden>Choose Here</option>
                  <option value="sm">Study Material</option>
                  <option value="bp">Blogpost</option>
                </select>
              </div>
            </div>
            <div class="col-md-12">
              <label for="sTerm">Enter your search term...</label>
              <input type="text" class="form-control" id="sTerm" name="sTerm">
            </div>
            <div class="col-md-12 mt-5">
              <button class="btn btn-outline-primary w-100" type="submit">Search Article</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="container-fluid my-3">