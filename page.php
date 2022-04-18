<?php get_header();  ?>
<main class="singlePage">
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <h1><?php the_title(); ?></h1>
  <section class="pageContent">
    <?php the_content(); ?>
  </section>
   <?php endwhile; // end the loop?>
</main>

<?php get_footer(); ?>