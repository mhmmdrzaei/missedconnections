<?php get_header();  ?>
<main class="homepageContainer">
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <section class="homepageText">
      <?php the_content(); ?>
   </section>
   <?php endwhile; // end the loop?>
   <section class="newsHome">
      <?php $args = array( 'post_type' => 'events_announcements', 'order' => 'DCS', 'posts_per_page' => 5 );
        query_posts( $args ); while ( have_posts() ) : the_post(); ?>
        <section class="postEach">
          <figure>
            
          </figure>
          <section class="postInformation">
            <a  class="updateTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            <section class="postExcerpt">
              <?php the_sub_field('event_description'); ?>
            </section>
          </section>
        </section>
      <div class="update">
       <a  class="updateTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <div class="entry-content">
          <?php
          the_excerpt();
          ?>
            
          </div>
        </div>
         <?php
        endwhile;
        ?>
        <?php
        wp_reset_query();
        ?> 
      </div> 
      <?php endwhile; // end the loop?>
 

   </section>

   <section class="artistsHome">
     
   </section>
</main>


<?php get_footer(); ?>