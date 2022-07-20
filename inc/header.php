<?php
include "admin/inc/connection.php";
include "admin/inc/functions.php";
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<title>Katen - Minimal Blog & Magazine HTML Theme</title>
	<meta name="description" content="Katen - Minimal Blog & Magazine HTML Theme">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">

	<!-- STYLES -->
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/all.min.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/slick.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/simple-line-icons.css" type="text/css" media="all">
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all">

</head>

<body>

<!-- preloader -->
<div id="preloader">
	<div class="book">
		<div class="inner">
			<div class="left"></div>
			<div class="middle"></div>
			<div class="right"></div>
		</div>
		<ul>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>

<!-- site wrapper -->
<div class="site-wrapper">

	<div class="main-overlay"></div>

	<!-- header -->
	<header class="header-default">
		<nav class="navbar navbar-expand-lg">
			<div class="container-xl">
				<!-- site logo -->
				<a class="navbar-brand" href="index.html"><img src="images/logo.svg" alt="logo" /></a> 

				<div class="collapse navbar-collapse">
					<!-- menus -->
					<ul class="navbar-nav mr-auto">
						<!-- <li class="nav-item dropdown active">
							<a class="nav-link dropdown-toggle" href="index.html">Home</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="index.html">Magazine</a></li>
								<li><a class="dropdown-item" href="personal.html">Personal</a></li>
								<li><a class="dropdown-item" href="personal-alt.html">Personal Alt</a></li>
								<li><a class="dropdown-item" href="minimal.html">Minimal</a></li>
								<li><a class="dropdown-item" href="classic.html">Classic</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="category.html">Lifestyle</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="category.html">Inspiration</a>
						</li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#">Pages</a>
							<ul class="dropdown-menu">
								<li><a class="dropdown-item" href="category.html">Category</a></li>
								<li><a class="dropdown-item" href="blog-single.html">Blog Single</a></li>
								<li><a class="dropdown-item" href="blog-single-alt.html">Blog Single Alt</a></li>
								<li><a class="dropdown-item" href="about.html">About</a></li>
								<li><a class="dropdown-item" href="contact.html">Contact</a></li>
							</ul>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="contact.html">Contact</a>
						</li> -->
						<?php

					$cat_sql = "SELECT * FROM category WHERE c_status = '1' AND is_sub ='0'";
					$cat_res = mysqli_query($db,$cat_sql);

					while($row = mysqli_fetch_assoc($cat_res)){
							$c_id  		= $row['c_id'];
							$c_name  	= $row['c_name'];
							$c_image  	= $row['c_image'];
							$is_sub  	= $row['is_sub'];

							$child_no = has_child($c_id);

							?>
						<li class="nav-item <?php if($child_no == 1) echo'dropdown'; ?>">
							<a class="nav-link <?php if($child_no == 1) echo'dropdown-toggle'; ?>" href=""><?php echo $c_name;?></a>
							<!-- drop down -->
							<?php menu_sub_category($c_id);?>
						</li>
							<?php


							
					}
						 ?>


					</ul>
				</div>

				<!-- header right section -->
				<div class="header-right">
					<!-- social icons -->
					<ul class="social-icons list-unstyled list-inline mb-0">
						<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
						<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
					</ul>
					<!-- header buttons -->
					<div class="header-buttons">
						<button class="search icon-button">
							<i class="icon-magnifier"></i>
						</button>
						<button class="burger-menu icon-button">
							<span class="burger-icon"></span>
						</button>
					</div>
				</div>
			</div>
		</nav>
	</header>