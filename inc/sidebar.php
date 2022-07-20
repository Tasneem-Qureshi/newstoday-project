<div class="sidebar">
	<!-- widget about -->
	<div class="widget rounded">
		<div class="widget-about data-bg-image text-center" data-bg-image="images/map-bg.png">
			<img src="images/logo.svg" alt="logo" class="mb-4" />
			<p class="mb-4">Hello, We’re content writer who is fascinated by content fashion, celebrity and lifestyle. We helps clients bring the right content to the right people.</p>
			<ul class="social-icons list-unstyled list-inline mb-0">
				<li class="list-inline-item"><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-twitter"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-instagram"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-pinterest"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-medium"></i></a></li>
				<li class="list-inline-item"><a href="#"><i class="fab fa-youtube"></i></a></li>
			</ul>
		</div>
	</div>
	<!-- widget popular posts -->
	<div class="widget rounded">
		<div class="widget-header text-center">
			<h3 class="widget-title">Popular Posts</h3>
			<img src="images/wave.svg" class="wave" alt="wave" />
		</div>
		<div class="widget-content">
			<?php
			$post_sql = "SELECT * FROM posts WHERE p_status = '1' AND post_type = '1' ORDER BY p_id DESC LIMIT 3";
			$post_res =  mysqli_query($db,$post_sql);
			$serial=0;
			while($row = mysqli_fetch_assoc($post_res)){
			$p_id         = $row['p_id'];
			$p_title      = $row['p_title'];
			$p_desc       = $row['p_desc'];
			$p_thumbnail  = $row['p_thumbnail'];
			$p_tags       = $row['p_tags'];
			$p_category   = $row['p_category'];
			$p_author     = $row['p_author'];
			$p_date       = $row['p_date'];
			$p_comment    = $row['p_comment'];
			$p_status     = $row['p_status'];
			$serial++;
			?>
			<!-- post -->
			<div class="post post-list-sm circle">
				<div class="thumb circle">
					<span class="number"><?php echo $serial;?></span>
					<a href="blog-single.html">
						<div class="">
							<img src="admin/images/posts/<?php echo $p_thumbnail;?>" alt="post-title" />
						</div>
					</a>
				</div>
				<div class="details clearfix">
					<h6 class="post-title my-0"><a href="blog-single.html"><?php echo $p_title;?></a></h6>
					<ul class="meta list-inline mt-1 mb-0">
						<li class="list-inline-item"><?php echo $p_date;?></li>
					</ul>
				</div>
			</div>
			<?php
			}
			?>
		</div>
	</div>
	<!-- widget categories -->
	<div class="widget rounded">
		<div class="widget-header text-center">
			<h3 class="widget-title">Explore Topics</h3>
			<img src="images/wave.svg" class="wave" alt="wave" />
		</div>
		<div class="widget-content">
			<ul class="list">
				<li><a href="#">Lifestyle</a><span>(5)</span></li>
				<li><a href="#">Inspiration</a><span>(2)</span></li>
				<li><a href="#">Fashion</a><span>(4)</span></li>
				<li><a href="#">Politic</a><span>(1)</span></li>
				<li><a href="#">Trending</a><span>(7)</span></li>
				<li><a href="#">Culture</a><span>(3)</span></li>
			</ul>
		</div>
		
	</div>
	<!-- widget newsletter -->
	<div class="widget rounded">
		<div class="widget-header text-center">
			<h3 class="widget-title">Newsletter</h3>
			<img src="images/wave.svg" class="wave" alt="wave" />
		</div>
		<div class="widget-content">
			<span class="newsletter-headline text-center mb-3">Join 70,000 subscribers!</span>
			<form>
				<div class="mb-2">
					<input class="form-control w-100 text-center" placeholder="Email address…" type="email">
				</div>
				<button class="btn btn-default btn-full" type="submit">Sign Up</button>
			</form>
			<span class="newsletter-privacy text-center mt-3">By signing up, you agree to our <a href="#">Privacy Policy</a></span>
		</div>
	</div>
	<!-- widget post carousel -->
	<div class="widget rounded">
		<div class="widget-header text-center">
			<h3 class="widget-title">Celebration</h3>
			<img src="images/wave.svg" class="wave" alt="wave" />
		</div>
		<div class="widget-content">
			<div class="post-carousel-widget">
				<!-- post -->
				<div class="post post-carousel">
					<div class="thumb rounded">
						<a href="category.html" class="category-badge position-absolute">How to</a>
						<a href="blog-single.html">
							<div class="inner">
								<img src="images/widgets/widget-carousel-1.jpg" alt="post-title" />
							</div>
						</a>
					</div>
					<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
					<ul class="meta list-inline mt-2 mb-0">
						<li class="list-inline-item"><a href="#">Katen Doe</a></li>
						<li class="list-inline-item">29 March 2021</li>
					</ul>
				</div>
				<!-- post -->
				<div class="post post-carousel">
					<div class="thumb rounded">
						<a href="category.html" class="category-badge position-absolute">Trending</a>
						<a href="blog-single.html">
							<div class="inner">
								<img src="images/widgets/widget-carousel-2.jpg" alt="post-title" />
							</div>
						</a>
					</div>
					<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">Master The Art Of Nature With These 7 Tips</a></h5>
					<ul class="meta list-inline mt-2 mb-0">
						<li class="list-inline-item"><a href="#">Katen Doe</a></li>
						<li class="list-inline-item">29 March 2021</li>
					</ul>
				</div>
				<!-- post -->
				<div class="post post-carousel">
					<div class="thumb rounded">
						<a href="category.html" class="category-badge position-absolute">How to</a>
						<a href="blog-single.html">
							<div class="inner">
								<img src="images/widgets/widget-carousel-1.jpg" alt="post-title" />
							</div>
						</a>
					</div>
					<h5 class="post-title mb-0 mt-4"><a href="blog-single.html">5 Easy Ways You Can Turn Future Into Success</a></h5>
					<ul class="meta list-inline mt-2 mb-0">
						<li class="list-inline-item"><a href="#">Katen Doe</a></li>
						<li class="list-inline-item">29 March 2021</li>
					</ul>
				</div>
			</div>
			<!-- carousel arrows -->
			<div class="slick-arrows-bot">
				<button type="button" data-role="none" class="carousel-botNav-prev slick-custom-buttons" aria-label="Previous"><i class="icon-arrow-left"></i></button>
				<button type="button" data-role="none" class="carousel-botNav-next slick-custom-buttons" aria-label="Next"><i class="icon-arrow-right"></i></button>
			</div>
		</div>
	</div>
	<!-- widget advertisement -->
	<div class="widget no-container rounded text-md-center">
		<span class="ads-title">- Sponsored Ad -</span>
		<a href="#" class="widget-ads">
			<img src="images/ads/ad-360.png" alt="Advertisement" />
		</a>
	</div>
	<!-- widget tags -->
	<div class="widget rounded">
		<div class="widget-header text-center">
			<h3 class="widget-title">Tag Clouds</h3>
			<img src="images/wave.svg" class="wave" alt="wave" />
		</div>
		<div class="widget-content">
			<a href="#" class="tag">#Trending</a>
			<a href="#" class="tag">#Video</a>
			<a href="#" class="tag">#Featured</a>
			<a href="#" class="tag">#Gallery</a>
			<a href="#" class="tag">#Celebrities</a>
		</div>
	</div>
</div>