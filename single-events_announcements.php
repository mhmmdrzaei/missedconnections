<?php get_header(); ?>
<main>
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <section class="eventContainer">
    <h1><?php the_title(); ?></h1>
    <section class="sideImage">
      <figure>
        <?php the_post_thumbnail('large');?>
      </figure>
    </section>
    <section class="eventContent">
      <h2 class="entry-title"><?php the_title(); ?></h2>
      <?php if( get_field('does_this_post_require_date__time_and_location_fields_') == 'Yes' ) {; ?>
      <section class="dateTime">
        <?php 
            $startDate = get_field('event_date_start');
            $endDate = get_field('event_date_end');
            if( !empty( $endDate ) ): ?>
               <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
            <?php else: ; ?>
             <?php the_field('event_date_start');?></br>
            <?php endif; ?>
            <p><?php the_field('event_time'); ?></p>
      </section>
    <?php }; ?>
    <section class="evenDescription">
      <?php the_field('event_description'); ?>
    </section>
    <?php 
    $embedded = get_field('embedded_media_events');
    if( !empty( $embedded ) ):
     ?>
     <section class="embeddedContent">
       <?php the_field('embedded_media_events'); ?>
     </section>
   <?php endif; ?>

<?php 
$location = get_field('event_location');
if( $location ): ?>
    <div class="acf-map" data-zoom="16">
        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
    </div>
<?php endif; ?>


   

    </section>
  </section>
</main>

 <?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>