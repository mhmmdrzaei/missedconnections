<?php get_header();  ?>

<main class="homepageContainer">
<!--   <?php require 'backgrounds/bg.php'; ?> -->
   <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
   <section class="homepageText">
      <?php the_content(); ?>
      <a href="#newsHome" >
      <div class="arrowDown"></div>
      </a>
   </section>
   <?php endwhile; // end the loop?>
   <section class="newsHome" id="newsHome">
      <?php $args = array( 'post_type' => 'events_announcements', 'order' => 'DCS', 'posts_per_page' => 5 );
        query_posts( $args ); while ( have_posts() ) : the_post(); ?>
        <section class="postEach">
          <figure>
            
          </figure>
          <section class="postInformation">
            <figure>
              <?php the_post_thumbnail('large');?>
            </figure>
            <section class="postInfoText">
              <a  class="updateTitle" href="<?php the_permalink(); ?>">
              <h3><?php the_title(); ?></h3></a>
              <?php 
                  $startDate = get_field('event_date_start');
                  $endDate = get_field('event_date_end');
                  if( !empty( $endDate ) ): ?>
                     <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
                  <?php elseif( !empty( $startDate ) ): ?>>
                   <?php the_field('event_date_start');?></br>
                  <?php endif; ?>
              <?php 
                $eventTime = get_field('event_time');
                if ( !empty($eventTime)): ?>
                  <?php the_field('event_time'); ?>
              <?php endif; ?>

              <section class="postExcerpt">
                <?php 
                  $project_desc = get_field( 'event_description' );
                  if( !empty( $project_desc ) ):
                      $trimmed_text = wp_trim_excerpt_modified( $project_desc, 100 );
                      $last_space = strrpos( $trimmed_text, ' ' );
                      $modified_trimmed_text = substr( $trimmed_text, 0, $last_space );
                      echo $modified_trimmed_text . '... <br><a href="'. get_permalink() . '"><b>More Information <span class="meta-nav">&rarr;</span></b></a>';;
                  endif; 


                 ?>

              </section>

            </section>

          </section>
        </section>

         <?php endwhile; ?>
        <?php wp_reset_query(); ?> 
      </div> 

 

   </section>

   <section class="artistsHome" id="artists">
     <?php $args = array( 'post_type' => 'artists', 'order' => 'DCS', 'posts_per_page' => -1 );
       query_posts( $args ); while ( have_posts() ) : the_post(); ?>

       <section class="artistEach">
         <?php if( get_field('language_options') == 'Single Language' ) {; ?>
             <figure>
               <?php the_post_thumbnail('large');?>
             </figure>
             <section class="openingDesc">
               <h1><?php the_title(); ?></h1>
               <section class="openingDesciption">
                 <?php the_field('page_description'); ?>
               </section>
             </section>
          <?php } ?>
            <?php if( get_field('language_options') == 'Multi-Language' ) {; ?>
              <figure>
                <?php the_post_thumbnail('large');?>
               </figure>
               <section class="openingDesc">
                 <h1><?php the_title(); ?></h1>
                  <?php if( have_rows('multi_language_fields') ): ?>
                  <?php while( have_rows('multi_language_fields') ): the_row(); ?>
                      <section class="openingDesciption">
                        <?php the_sub_field('page_description_multi'); ?>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 
              </section>
            <?php } ?>
       </section>
       <?php endwhile; ?>
      <?php wp_reset_query(); ?> 

   </section>
</main>


<?php get_footer(); ?>