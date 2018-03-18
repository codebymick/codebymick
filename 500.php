<?php
get_header();
 $content = explode("<!--more-->", $post->post_content);?>

<div id="links">
  <div class="container center">
    <h1>500 ERROR</h1>
    <p>you're not really allowed to be here!</p>
    <a href="<?php bloginfo('url'); ?>">&larr; GO HOME! &rarr;</a>

  </div>
<!-- main content END-->
</div>

<?php get_footer(); ?>
