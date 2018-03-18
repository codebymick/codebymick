<?php
get_header();
 $content = explode("<!--more-->", $post->post_content);?>

<div id="links">
  <div class="container center">
    <h1>404 ERROR</h1>
    <p>you've come to a strange place.</p>
    <p>how did you get here?.</p>
    <a href="<?php bloginfo('url'); ?>">&larr; go somewhere useful &rarr;</a>

  </div>
<!-- main content END-->
</div>

<?php get_footer(); ?>
