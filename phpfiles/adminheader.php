<?php
$usern=array('name'=>'admin');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Law Portal</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Law Firm Website Template" name="keywords">
        <meta content="Law Firm Website Template" name="description">

        <!-- Favicon -->
        <link href="../template/img/favicon.ico" rel="icon">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:ital,wght@1,600;1,700;1,800&family=Roboto:wght@400;500&display=swap" rel="stylesheet"> 
        
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
        <link href="../template/lib/animate/animate.min.css" rel="stylesheet">
        <link href="../template/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

        <!-- Template Stylesheet -->
        <link href="../template/css/style.css" rel="stylesheet">
    </head>

    <body>
        <div class="wrapper">

            <!-- Nav Bar Start -->
            <div class="nav-bar">
                <div class="container-fluid">
                    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
                        <a href="#" class="navbar-brand">MENU</a>
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                            <div class="navbar-nav mr-auto">
                                <a href="adminhome.php" class="nav-item nav-link active">Home</a>
								
                                <a href="view_all_cases.php" class="nav-item nav-link">Cases</a>
															
                                <a href="view_all_users.php" class="nav-item nav-link">View Users</a>
								
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Advocates</a>
                                    <div class="dropdown-menu">
                                        <a href="new_advocates.php" class="dropdown-item">New Advocates</a>
                                        <a href="view_all_advocates.php" class="dropdown-item">View All</a>
                                    </div>
                                </div>
                                <div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Judges</a>
                                    <div class="dropdown-menu">
                                        <a href="add_judge.php" class="dropdown-item">Add New</a>
                                        <a href="view_judges.php" class="dropdown-item">View All</a>
                                    </div>
                                </div>
								<div class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Co_ordinator</a>
                                    <div class="dropdown-menu">
                                        <a href="add_coordinator.php" class="dropdown-item">Add New</a>
                                        <a href="view_coordinator.php" class="dropdown-item">View All</a>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="ml-auto">
                                <a class="btn" href="adminhome.php?log=1">Log Out</a>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>