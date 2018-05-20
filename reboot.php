<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>WhiteNode</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <link href="/assets/css/font-awesome.min.css" rel="stylesheet">
    <!-- Bootstrap core CSS     -->
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />


<style>
        /* Error Page Inline Styles */
        body {
            padding-top: 20px;
        }
        /* Layout */
        .jumbotron {
            font-size: 21px;
            font-weight: 200;
            line-height: 2.1428571435;
            color: inherit;
            padding: 10px 0px;
        }
        /* Everything but the jumbotron gets side spacing for mobile-first views */
        .masthead, .body-content, {
            padding-left: 15px;
            padding-right: 15px;
        }
        /* Main marketing message and sign up button */
        .jumbotron {
            text-align: center;
            background-color: transparent;
        }
        .jumbotron .btn {
            font-size: 21px;
            padding: 14px 24px;
        }
        /* Colors */
        .green {color:#5cb85c;}
        .orange {color:#f0ad4e;}
        .red {color:#d9534f;}
    </style>
    <script type="text/javascript">
        /*function loadDomain() {
            var display = document.getElementById("display-domain");
            display.innerHTML = document.domain;
        }*/
    </script>
</head>
<body>
<!-- Error Page Content -->
<div class="container">
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1><i class="fa fa-cogs green"></i> Reboot required</h1>
        <p class="lead">Whitenode needs a reboot, this is required to get the system running optimal again.</p>
        <a href="#" class="js--doAction btn btn-default btn-lg text-center" data-action="reboot" data-title="Reboot" data-content="Are you sure you want to reboot?">
            <span class="green">Reboot WhiteNode</span>
        </a>
    </div>
</div>

<div class="container">
    <div class="body-content">
        <div class="row">
            <div class="col-md-6">
                <h2>What happened?</h2>
                <p class="lead">Some settings withing WhiteNode require a reboot to preform optimal again. So you can press the button to reboot your WhiteNode</p>
            </div>
            <div class="col-md-6">
                <h2>What can I do?</h2>
                <p class="lead">Press the button to reboot WhiteNode</p>
                <p>After pressing the button please read below</p>
                <p class="lead">Sit back and relax for 2 minutes</p>
                <p>After the restart this page will automatically reload.</p>
                <p class="lead">Grab some drinks</p>
                <p>This will soon be done, but why not grab some drinks now? :-).</p>
            </div>
        </div>
    </div>
</div>
<?php include_once("Snippets/Modals.php") ?>
</body>
<!--   Core JS Files   -->
<script src="/assets/js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="/assets/js/bootstrap.min.js" type="text/javascript"></script>
<script src="/assets/js/whitenode.js"></script>
</html>
