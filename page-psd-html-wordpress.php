<?php get_header(); $content = explode("<!--more-->", $post->post_content); ?>
  <div class="container clearfix">
    <div class="inner text">
      <div class="contentBlock">
      <?php echo apply_filters('the_content', $content[0]); ?>
    </div>
      <?php get_template_part('modules/section', 'work'); ?>
    </div>
  </div>
</div>
<?php get_template_part('modules/section', 'cta'); get_footer(); ?>
