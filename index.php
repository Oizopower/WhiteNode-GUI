<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/Img/logo_48x48.png">
    <link rel="shortcut icon" href="/logo.ico" />

	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>WhiteNode</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />


    <!-- Bootstrap core CSS     -->
    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet" />

    <!-- Animation library for notifications   -->
    <link href="/Assets/css/animate.min.css" rel="stylesheet"/>

    <!--  WhiteNode base CSS    -->
    <link href="/Assets/css/whitenode_base.css" rel="stylesheet"/>


    <!--  CSS    -->
    <link href="/Assets/css/style.css" rel="stylesheet" />
    <link href="/Assets/css/login.css" rel="stylesheet" />

    <!--  Icons     -->
    <link href="/Assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="/Assets/css/themify-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Assets/css/datatables.min.css"/>

    <!--  jQuery UI     -->
    <link href="/Assets/css/jquery-ui.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1" />
</head>
<body>
<?php

?>
<div class="wrapper">
    <div class="sidebar" data-background-color="white" data-active-color="danger">
    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="/" class="simple-text">
                    WhiteNode
                </a>
            </div>
            <?php require_once("Snippets/Menu.php"); ?>
    	</div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default navbar-blue">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle">
                        <span class="sr-only"><?=tl("Toggle navigation")?></span>
                        <span class="icon-bar bar1"></span>
                        <span class="icon-bar bar2"></span>
                        <span class="icon-bar bar3"></span>
                    </button>
                    <a class="navbar-brand" href="#"><?=Template::$currentPage['title']?></a>
                </div>
                <div class="collapse navbar-collapse">
                    <?php require_once("Snippets/TopMenu.php"); ?>
                </div>
            </div>
        </nav>
        <div class="content">
            <?php include_once($pageData['template_file']); ?>
        </div>
        <?php include_once("Snippets/Footer.php") ?>

    </div>
</div>
<?php include_once("Snippets/Modals.php") ?>
</body>

    <!--   Core JS Files   -->
    <script src="/Assets/js/jquery-1.10.2.js" type="text/javascript"></script>
	<script src="/Assets/js/bootstrap.min.js" type="text/javascript"></script>

    <!--  Notifications Plugin    -->
    <script src="/Assets/js/bootstrap-notify.js"></script>

    <!--  jQuery UI     -->
    <script src="/Assets/js/jquery-ui.min.js" crossorigin="anonymous"></script>

    <script type="text/javascript" src="/Assets/js/datatables.min.js"></script>

    <script src="/Assets/js/menu.js"></script>
    <script src="/Assets/js/whitenode.js"></script>
</html>
