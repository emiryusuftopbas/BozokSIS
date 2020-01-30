<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/app/views/assets/css/bulma.min.css">
		<link rel="stylesheet" href="<?php echo SITE_URL ?>/app/views/assets/css/main.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo SITE_URL ?>/app/views/assets/css/jquery-ui.min.css">

		<!-- <link rel="stylesheet" href="app/views/css/debug.css"> -->
		
	</head>

<body>
		<div class="background"></div>
        <nav class="navbar is-transparent">
            <div class="container">
                <div class="navbar-brand">
                    <a class="navbar-item brand-text has-text-weight-semibold" 
                    href="<?php echo SITE_URL?>">
                        Bozok University Student Information System
                    </a>
                    <div class="navbar-burger burger" data-target="navbar-menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
                <div id="navbar-menu" class="navbar-menu">
                    <div class="navbar-end">
                    	<a class="navbar-item" href="<?php echo SITE_URL.'/settings' ?>">
                            Settings
                        </a>
                        <a class="navbar-item" href="<?php echo SITE_URL.'/signout' ?>">
                            Sign Out
                        </a>
                    </div>
                </div>
            </div>
        </nav>
        

        <div class="container">
            <div class="columns">
                
                <?php 
                    switch ($userRole) {
                        case 'student':
                            require 'DashboardNavigation/StudentNavigation.php';
                            break;
                        case 'academician':
                            require 'DashboardNavigation/AcademicianNavigation.php';
                            break;
                        case 'admin':
                            require 'DashboardNavigation/AdminNavigation.php';
                            break;
                    }
                ?>
                
                 <?php 
                    if (empty(@$page)) {
                        switch ($userRole) {
                            case 'student':
                                require 'DashboardPages/Student/Welcome.php';
                                break;
                            case 'academician':
                                require 'DashboardPages/Academician/Welcome.php';
                                break;
                            case 'admin':
                                require 'DashboardPages/Admin/Welcome.php';
                                break;
                        }
                    }else{
                        if (file_exists(realpath('.').'/app/Views/'.'DashboardPages/'.ucfirst($userRole).'/'.ucfirst(@$page).'.php')) {
                            require 'DashboardPages/'.ucfirst($userRole).'/'.ucfirst(@$page).'.php';
                        }else{
                           echo '
                           <div class="column is-8 is-centered">
                            <article class="message is-danger" id="error-messagebox">
                              <div class="message-header">
                                <p>Error</p>
                                <button class="delete" aria-label="delete" id="error-messagebox-close-button"></button>
                              </div>
                              <div class="message-body">
                                No such page or you do not have access to this page
                              </div>
                            </article>
                            </div>
                           ';
                        }
                    }

                ?>
            </div>
        </div>
		
	    <script src="<?php echo SITE_URL ?>/app/views/assets/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo SITE_URL ?>/app/views/assets/js/jquery-ui.min.js" type="text/javascript"></script>
		<script src="<?php echo SITE_URL ?>/app/views/assets/js/sweetalert.min.js" type="text/javascript"></script>
        <script src="<?php echo SITE_URL ?>/app/views/assets/js/main.js" type="text/javascript"></script>

</body>

</html>