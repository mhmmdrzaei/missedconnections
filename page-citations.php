<?php get_header();  ?>
<main class="pageCitations" id="pageCitations">

    


  <?php // Start the loop ?>

    <?php $args = array( 'post_type' => 'citations', 
          // 'meta_key'      => 'start_date',
          // 'orderby'      => 'meta_value',
           'order'       => 'DESC',
          // 'orderby' => array(
          //    'meta_value_num' => 'desc',
          //    'post_date' => 'desc'
          'orderby'    => array(
                'start_date' => 'DSC',
                'post_date' => 'desc'
              ),
          'posts_per_page' => -1 );
      query_posts( $args ); // hijack the main loop

      if ( ! have_posts() ) : ?>

  <article id="post-0" class="fullwidthpost" aria-label="no citations listed">
    <h2 class="entry-title">Not Found</h2>
     <section class="excerptPosts fullwidthexcerpts">
      <p>Apologies, but no results were found!</p>
    </section><!-- .entry-content -->
  </article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>
<?php // if there are posts, Start the Loop. ?>

<?php while ( have_posts() ) : the_post(); ?>
  <?php if( get_field('content_option_citations') == 'video' ) {; ?>
    <article id="post-<?php the_ID(); ?>" class="citationsPost" aria-label="citations item container">
      <section class="citationsInner">
      <div class="videoContainer">
        <?php the_field('embedded_video'); ?>
      </div>
      
      <section class="postTitle"><?php the_title(); ?></section>
    </section>
    </article>
  <?php } ?>
  <?php if( get_field('content_option_citations') == 'image' ) {; ?>
    <article id="post-<?php the_ID(); ?>" class="citationsPost" aria-label="citations item container">
      <?php if( have_rows('image_with_link_citations' ) ): ?>
          <?php while( have_rows('image_with_link_citations') ): the_row(); ?>
            
            <a href="<?php the_sub_field('link_img',) ;?>" target="_blank">
              <section class="citationsInner">
              <?php 
              $image = get_sub_field('image_imgwLink');
              if( !empty( $image ) ): ?>
                  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
              <?php endif; ?>
              <section class="postTitle"><?php the_title(); ?></section>
              </section>
            </a>
          
           <?php endwhile; ?>
         <?php endif; ?>     
    </article>
  <?php } ?>
  <?php if( get_field('content_option_citations') == 'pdfFile' ) {; ?>
    <article id="post-<?php the_ID(); ?>" class="citationsPost" aria-label="citations item container">
      <section class="citationsInner">
        <section class="pdfHolder">
          <object
            data='<?php the_field('pdf_file');?>'
            type="application/pdf"
            width="500"
            height="678"
          >

            <iframe
              src='<?php the_field('pdf_file');?>'
              width="500"
              height="678"
            >
            <p>This browser does not support PDF!</p>
            </iframe>
          </object>

        </section>
      </section>
      <section class="postTitle"><?php the_title(); ?></section>
        
    </article>
  <?php } ?>


<?php endwhile; // End the loop. Whew. ?>
   <?php wp_reset_query();?> 
 
</main>


<?php get_footer(); ?>