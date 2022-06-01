<?php get_header();  ?>
<main class="singlePage">
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <section class="pageTitlePage">
     <h1><?php the_title(); ?></h1>
   </section>
  <section class="pageContent gs_reveal gs_reveal_fromRight">
    <?php the_content(); ?>
  </section>
   <?php endwhile; // end the loop?>
</main>

<?php get_footer(); ?>