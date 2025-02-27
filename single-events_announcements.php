<?php get_header(); ?>
<main>
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <section class="eventContainer">
    <section class="sideImage" aria-label="an image associated with the event">
      <figure>
        <?php the_post_thumbnail('large');?>
      </figure>
    </section>
    <section class="eventContent">
      <h2 class="entry-title" aria-label="event title"><?php the_title(); ?></h2>
      <?php if( get_field('does_this_post_require_date__time_and_location_fields_') == 'Yes' ) {; ?>
      <section class="dateTime" aria-label="event date and time">
        <?php 
            $startDate = get_field('event_date_start');
            $endDate = get_field('event_date_end');
            if( !empty( $endDate ) ): ?>
               <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
            <?php else: ; ?>
             <?php the_field('event_date_start');?><br>
            <?php endif; ?>
            <?php the_field('event_time'); ?>
      </section>
    <?php }; ?>
    <section class="evenDescription" aria-label="description details of the event">
      <?php echo get_field('event_description'); ?>
    </section>

    <?php 
    $embedded = get_field('embedded_media_events');
    if( !empty( $embedded ) ):
     ?>
     <section class="videoContainer">
       <?php the_field('embedded_media_events'); ?>
     </section>
   <?php endif; ?>

<?php 
$location = get_field('event_location');
if( $location ): ?>
    <div class="acf-map" data-zoom="16" aria-label="location of the event on a map">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif; ?>


   

    </section>
  </section>
</main>

 <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>