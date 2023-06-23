<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <meta http-equiv="Pragma" content="no-cache" />
    <meta http-equiv="Expires" content="0" />
    <meta name="description" content="Bitasoft - Best in Tech Analysis">
    <meta name="keywords" content="Best Free tech content, programming content, and lecture notes">
    <meta name="author" content="Sujit">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= session()->get('wtitle') ?>Bitasoft - Best in Tech Analysis</title>

    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?= session()->get('wtitle') ?>Bitasoft - Best in Tech Analysis" />
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

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i">
    <link rel="stylesheet" href="<?= base_url('assets/lander/css/prism.css?v=') . time() ?>">
    <link rel="stylesheet" href="<?= base_url('assets/lander/css/theme.css?v=') . time() ?>">
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9973004372604559"
     crossorigin="anonymous"></script>
</head>

<body class="layout-default">
    <header class="navbar navbar-toggleable-md navbar-light bg-white fixed-top mediumnavigation">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarsWow" aria-controls="navbarsWow" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa-solid fa-bars-staggered fs-2"></i>
        </button>
        <div class="container">
            <a class="navbar-brand" href="<?= base_url('/') ?>">
                 <img src="<?= base_url('assets/lander/images/logo-large.png') ?>" width="120"> 
                <!--<span class="text-white">BITA</span> <span class="text-warning">SOFT</span>-->
            </a>
            <div class="collapse navbar-collapse" id="navbarsWow">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('/') ?>"><i class="fa-solid fa-house"></i> Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#exploreTopicsModal"><i class="fa-solid fa-book-open-reader"></i> Study Material</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('blog') ?>"><i class="fa-solid fa-rss"></i> Blogpost</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#about"><i class="fa-solid fa-user"></i> About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contact"><i class="fa-solid fa-phone"></i> Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-toggle="modal" data-target="#searchModal"><i class="fa-solid fa-magnifying-glass"></i> Search</a>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Material Modal -->
    <div class="modal fade" id="exploreTopicsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Your favourite Study Material</h5>
                    <i class="fa-solid fa-xmark" role="button" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="mType">Choose Study Material Type</label>
                            <div class="mb-3">
                                <?php if (count($catagory) > 0) { ?>
                                    <select class="form-control" name="mType" id="mType" onchange="chooseSubject(this)">
                                        <option value="" selected disabled hidden>Choose Here</option>
                                        <?php foreach ($catagory as $ct) { ?>
                                            <option value="<?= $ct['cslug'] ?>"><?= $ct['cname'] ?></option>
                                        <?php } ?>
                                    </select>
                                <?php } else {
                                    print "<br><span class='text-danger'>No catagory found.</span>";
                                } ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sType">Choose Subject Type</label>
                            <div class="mb-3">
                                <select class="form-control" name="sType" id="sType">
                                    <option value="" selected disabled hidden>Choose Here</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 mt-3">Explore Topics</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Modal -->
    <div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Search your favourite</h5>
                    <i class="fa-solid fa-xmark" role="button" data-dismiss="modal" aria-label="Close"></i>
                </div>
                <div class="modal-body">
                    <form autocomplete="off">
                        <div class="form-group">
                            <label for="sTerm">Enter your search term...</label>
                            <input type="text" class="form-control" id="sTerm" name="sTerm">
                        </div>

                        <button type="submit" class="btn btn-primary w-100 mt-3">Search Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="site-content">