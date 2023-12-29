<?php
get_header(); ?>
<style>
	.zak-container{
	background-image: url(https://demo.lion-themes.net/agota/wp-content/uploads/2020/07/banner-404.jpg);
		min-height:100vh;
		background-position:center center;
		background-repeat: no-repeat;
		background-size:cover;
		background-attachment: fixed;
		display: flex;
		justify-content: center;
		margin: 0;
		max-width: 100vw;
	}
	.content-404{
		display:flex;
	}
	.content-404 > div {
		display:flex;
		flex-direction:column;
		align-items:center;
		justify-content:center;
		color:#fff;
	}
	.content-404 .elementor-button:hover{
		background-color: transparent;
	}
	h1,h4{
		color:#fff;
	}
	h1{
		font-size: 140px;
	}
	h4{
		font-size: 40px;
	}
</style>
<section class="content-404">
	<div>
	<h1>
		404
		</h1>
		<h4>Page Not Found!</h4>
		<p>
			Sorry for the inconvenience, Go to our homepage.
		</p>
		<div class="elementor-element elementor-align-center str-btn elementor-widget elementor-widget-button" data-element_type="widget" data-widget_type="button.default">
				<div class="elementor-widget-container">
					<div class="elementor-button-wrapper">
			<a class="elementor-button elementor-button-link elementor-size-md" href="/">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-text">Back to Homepage</span>
		</span>
					</a>
		</div>
				</div>
				</div>
	</div>
</section>
<?php
get_footer();