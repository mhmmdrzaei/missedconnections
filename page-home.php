<?php get_header();  ?>

<main class="homepageContainer">

   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <section class="homepageText gs_reveal">
      <?php the_content(); ?>
      <a href="#artists" >
      <div class="arrowDown"></div>
      </a>
   </section>
   <?php endwhile; // end the loop?>


 

   </section>

   <section class="artistsHome scenes" id="artists">
    <section class="scenes__wrap">
      <div class="scenes__items">
    <?php $args = array( 'post_type' => 'artists', 'order' => 'DCS', 'posts_per_page' => -1 );
      query_posts( $args ); while ( have_posts() ) : the_post(); ?>
        
          <article class="artistEach scene">
            <?php if( get_field('language_options') == 'Single Language' ) {; ?>
            <section class="scene__header openingDesc">
              <a  class="artistLink" href="<?php the_permalink(); ?>">
              <h1><?php the_title(); ?></h1>
              <section class="openingDesciption ">
                <?php the_field('page_description'); ?>
              </section>
            </a>
            </section>
            <?php } ?>
            <?php if( get_field('language_options') == 'Multi-Language' ) {; ?>
              <section class="scene__header openingDesc">
                <a  class="artistLink" href="<?php the_permalink(); ?>">
                <h1><?php the_title(); ?></h1>
                  <?php if( have_rows('multi_language_fields') ): ?>
                  <?php while( have_rows('multi_language_fields') ): the_row(); ?>
                      <section class="openingDesciption">
                        <?php the_sub_field('page_description_multi'); ?>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 
              </a>
              </section>
            <?php } ?>
            <figure class="scene__figure">
              <a  class="artistLink" href="<?php the_permalink(); ?>">
              <?php the_post_thumbnail('large');?>
            </a>
            </figure>
          </article>
       <?php endwhile; ?>
      <?php wp_reset_query(); ?> 
       
     </div>
   </section>
   </section>


</main>


<?php get_footer(); ?>