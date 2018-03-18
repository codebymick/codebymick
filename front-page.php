<?php get_header(); $content = explode("<!--more-->", $post->post_content); ?>
		<!-- main content  start-->
		<div id="fp">
			<div class="text inner">
        <?php the_title('<h1>','</h1>');?>
        <div class="text"><?php /*if (isset($_COOKIE['beenthere'])) {
          echo ('<p>Welcome Back! </p>'); }*/ echo apply_filters('the_content', $content[0]); ?>
        </div>
			</div>
			<div class="inner">
				<?php get_template_part('modules/section', 'links'); ?>
			</div>
			<?php get_template_part('modules/section', 'cta');  get_template_part('modules/section', 'work'); ?>
    </div>
  </div>
<?php get_footer(); ?>
