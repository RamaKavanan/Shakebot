<div class="off-canvas-wrap" data-offcanvas>
			<div class="inner-wrap full-height">
				<nav class="tab-bar white">
					<section class="left-small">
						<a class="left-off-canvas-toggle" href=""><span class="fa fa-bars"></span> <?php echo $loggedInUser->fullname; ?></a>
					</section>

					<section class="middle tab-bar-section">
						<h1 class="title">Shakebot</h1>
					</section>

					<section class="right-small">
						<a class="right-off-canvas-toggle" href=""><span class="fa fa-bars"></span></a>
					</section>
				</nav>

				<aside class="left-off-canvas-menu">
					<ul class="off-canvas-list">
						<li ui-sref-active="active"><a ui-sref="home">Start</a></li>
						<li ui-sref-active="active"><a ui-sref="profile">My Profile</a></li>
						<li ui-sref-active="active"><a href="#">My Nutrition</a></li>
						<li ui-sref-active="active"><a href="/logout.php">Sign Out</a></li>
					</ul>
				</aside>

				<aside class="right-off-canvas-menu">
					<ul class="off-canvas-list">
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
						<li><a href="">Navigation Link</a></li>
					</ul>
				</aside>
