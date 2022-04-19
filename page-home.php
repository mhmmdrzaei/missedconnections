<?php get_header();  ?>

<main class="homepageContainer">

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
              <?php the_post_thumbnail('large');?>
            </figure>
            <section class="postInfoText">
              <a  class="updateTitle" href="<?php the_permalink(); ?>">
              <?php 
                  $startDate = get_field('event_date_start');
                  $endDate = get_field('event_date_end');
                  if( !empty( $endDate ) ): ?>
                     <h3><?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?></h3>
                  <?php elseif( !empty( $startDate ) ): ?>>
                   <h3><?php the_field('event_date_start');?></h3>
                  <?php endif; ?>
              <?php 
                $eventTime = get_field('event_time');
                if ( !empty($eventTime)): ?>
                  <h3><?php the_field('event_time'); ?></h3>
              <?php endif; ?>
              <h2><?php the_title(); ?></h2></a>
              

              <section class="postExcerpt">
                <?php 
                  $project_desc = get_field( 'event_description' );
                  if( !empty( $project_desc ) ):
                      $trimmed_text = wp_trim_excerpt_modified( $project_desc, 150 );
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

             <section class="openingDesc">
               <h1><?php the_title(); ?></h1>
               <section class="openingDesciption">
                 <?php the_field('page_description'); ?>
               </section>
             </section>
             <figure>
               <?php the_post_thumbnail('large');?>
             </figure>
          <?php } ?>
            <?php if( get_field('language_options') == 'Multi-Language' ) {; ?>

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
              <figure>
                <?php the_post_thumbnail('large');?>
               </figure>
            <?php } ?>
       </section>
       <?php endwhile; ?>
      <?php wp_reset_query(); ?> 

   </section>
</main>


<?php get_footer(); ?>