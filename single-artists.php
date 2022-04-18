<?php get_header(); ?>
<main class="artistsmain">
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <?php if( get_field('language_options') == 'Single Language' ) {; ?>
    <section class="openingTitle">
      <figure>
        <?php the_post_thumbnail('large');?>
      </figure>
      <section class="openingDesc">
        <h1><?php the_title(); ?></h1>
        <section class="openingDesciption">
          <?php the_field('page_description'); ?>
        </section>
      </section>
    </section>
    <?php if( have_rows('single_language_fields') ): ?>
        <?php while( have_rows('single_language_fields') ): the_row(); ?>

          <?php if( get_row_layout() == 'single_large_image_with_description' ): ?>
            <?php if( have_rows('image_with_description_containter') ): ?>
                <?php while( have_rows('image_with_description_containter') ): the_row(); ?>
                  <section class="single_large_image_desc">
                    <figure>
                      <?php 
                      $image = get_sub_field('image_file_imagewText');
                      if( !empty( $image ) ): ?>
                          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      <?php endif; ?>
                    </figure>
                    <section class="single_large_desc">
                      <?php the_sub_field('image_text_information_image_with_text'); ?>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'pdf_reader' ): ?>
            <?php if( have_rows('pdf_reader_container') ): ?>
                <?php while( have_rows('pdf_reader_container') ): the_row(); ?>
                  <section class="pdfReaderContainer">
                    <section class="pdfReaderInformation">
                      <h2><?php the_sub_field('pdf_title'); ?></h2>
                      <p><?php the_sub_field('pdf_subtitle'); ?></p>
                    </section>
                    <section class="pdfHolder">
                      <object
                        data='<?php the_sub_field('pdf_file');?>'
                        type="application/pdf"
                        width="500"
                        height="678"
                      >

                        <iframe
                          src='<?php the_sub_field('pdf_file');?>'
                          width="500"
                          height="678"
                        >
                        <p>This browser does not support PDF!</p>
                        </iframe>
                      </object>

                    </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'multiple_large_images_with_text' ): ?>
            <?php if( have_rows('mliwtx_single') ): ?>
                <?php while( have_rows('mliwtx_single') ): the_row(); ?>
                  <section class="single_large_image_desc">
                    <section class="singleLargeTextGallery">
                      <?php 
                      $images = get_sub_field('images_mliwtx_single');
                      if( $images ): ?>
                        <?php foreach( $images as $image ): ?>
                          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                          <p><?php echo esc_html($image['caption']); ?></p>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </section>
                    <section class="single_large_desc">
                      <?php the_sub_field('text_mliwtx_single'); ?>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'videos_sections' ): ?> 
            <?php if( have_rows('video_repeater_container') ): ?>
                <?php while( have_rows('video_repeater_container') ): the_row(); ?>
                  <section class="videoRepContainer">
                    <section class="videoContainerEach">
                      <section class="videoInformation">
                        <h2><?php the_sub_field('video_title') ?></h2>
                        <p><?php the_sub_field('video_description') ?></p>
                      </section>
                      <section class="videoContainer">
                        <?php the_sub_field('video_link_artists') ?>
                      </section>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'embedded_content' ): ?> 
            <?php if( have_rows('embedded_content_container') ): ?>
                <?php while( have_rows('embedded_content_container') ): the_row(); ?>
                  <section class="embeddedContainer">
                      <section class="embeddedInformation">
                        <h2><?php the_sub_field('embedded_content_title') ?></h2>
                        <p><?php the_sub_field('embedded_content_description') ?></p>
                      </section>
                      <section class="videoContainer">
                        <?php the_sub_field('embedded_content_link') ?>
                      </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'readings' ): ?> 
            <section class="readingsContainer">
              <h2>Pedagogical Readings</h2>
            <?php if( have_rows('readings_repeater_container') ): ?>
                <?php while( have_rows('readings_repeater_container') ): the_row(); ?>
                    <section class="readingsEachContainer">
                      <section class="readingsEach">
                        <h4><?php the_sub_field('reading_author'); ?></h4>
                        <a href="<?php the_sub_field('reading_file') ?>" target="_blank"><?php the_sub_field('reading_title') ?></a>

                      </section>
                    </section>
                 
                <?php endwhile; ?>
            <?php endif; ?> 
             </section>
          <?php elseif( get_row_layout() == 'tagged_events' ): ?> 
            <?php if( have_rows('tagged_event_repeater_container') ): ?>
                <?php while( have_rows('tagged_event_repeater_container') ): the_row(); ?>
                  <section class="taggedEventContainer">
                    <h2>Events</h2>
                    <section class="taggedEventEachContainer">
                      <section class="taggedEventEach">
                        <?php $featured_posts = get_sub_field('event_post_tagged_events_copy');
                        ?>
                          <?php   if( $featured_posts ) {
                              $post = $featured_posts;
                              setup_postdata($post);
                           ?>
                           <section class="eventDate">
                             <?php 
                                 $startDate = get_field('event_date_start');
                                 $endDate = get_field('event_date_end');
                                 if( !empty( $endDate ) ): ?>
                                    <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
                                 <?php else: ; ?>
                                  <?php the_field('event_date_start');?></br>
                                 <?php endif; ?>
                           </section>
                           <section class="eventTitletitle">
                             <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
                               <?php the_title(); ?>
                             </a>
                           </section>
                            <?php  wp_reset_postdata(); ?> 
                          <?php  } ?>
                      </section>
                      
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

            

          <?php elseif( get_row_layout() == 'cta_button' ): ?> 
            <?php if( have_rows('button_information_container') ): ?>
                <?php while( have_rows('button_information_container') ): the_row(); ?>
                  <a class="ctaButton"href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_label'); ?></a>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'contributors_list' ): ?> 
            <?php if( have_rows('contributors_repeater_container') ): ?>
                <?php while( have_rows('contributors_repeater_container') ): the_row(); ?>
                  <section class="contributorsContainer">
                    <h2>Artists and Collaborators</h2>
                    <section class="contributorEachContainer">
                      <section class="contributorEach">
                        <figure>
                          <?php 
                          $imageCont = get_sub_field('contributor_image');
                          if( !empty( $imageCont ) ): ?>
                              <img src="<?php echo esc_url($imageCont['url']); ?>" alt="<?php echo esc_attr($imageCont['alt']); ?>" />
                          <?php endif; ?>
                        </figure>
                        <section class="contributorInformation">
                          <h3><?php the_sub_field('contributor_name') ?></h3>
                          <section class="contributorBio">
                            <?php the_sub_field('contributor_bio') ?>
                          </section>
                        </section>
                      </section>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
  

  <?php }; ?>

<!-- multi language  -->

  <?php if( get_field('language_options') == 'Multi-Language' ) {; ?>

    <?php if( have_rows('multi_language_fields') ): ?>
        <?php while( have_rows('multi_language_fields') ): the_row(); ?>
      <section class="languageChoiceContainer">
       <section class="languageChoiceEach">
         <?php the_sub_field('language_label'); ?>
       </section>
     </section>
      <section class="languageChoiceContent">
        <section class="openingTitle">
          <figure>
            <?php the_post_thumbnail('large');?>
          </figure>
          <section class="openingDesc">
            <h1><?php the_title(); ?></h1>
            <section class="openingDesciption">
              <?php the_sub_field('page_description_multi'); ?>
            </section>
          </section>
        </section>
        <!-- start of multi flex  -->

        <?php if( have_rows('multi_language_fields_content') ): ?>
            <?php while( have_rows('multi_language_fields_content') ): the_row(); ?>

              <?php if( get_row_layout() == 'single_large_image_with_description' ): ?>
                <?php if( have_rows('image_with_description_containter') ): ?>
                    <?php while( have_rows('image_with_description_containter') ): the_row(); ?>
                      <section class="single_large_image_desc">
                        <figure>
                          <?php 
                          $image = get_sub_field('image_file_imagewText');
                          if( !empty( $image ) ): ?>
                              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                          <?php endif; ?>
                        </figure>
                        <section class="single_large_desc">
                          <?php the_sub_field('image_text_information_image_with_text'); ?>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'pdf_reader' ): ?>
                <?php if( have_rows('pdf_reader_container') ): ?>
                    <?php while( have_rows('pdf_reader_container') ): the_row(); ?>
                      <section class="pdfReaderContainer">
                        <section class="pdfReaderInformation">
                          <h2><?php the_sub_field('pdf_title'); ?></h2>
                          <p><?php the_sub_field('pdf_subtitle'); ?></p>
                        </section>
                        <section class="pdfHolder">
                          <object
                            data='<?php the_sub_field('pdf_file');?>'
                            type="application/pdf"
                            width="500"
                            height="678"
                          >

                            <iframe
                              src='<?php the_sub_field('pdf_file');?>'
                              width="500"
                              height="678"
                            >
                            <p>This browser does not support PDF!</p>
                            </iframe>
                          </object>

                        </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'multiple_large_images_with_text' ): ?>
                <?php if( have_rows('mliwtx_single') ): ?>
                    <?php while( have_rows('mliwtx_single') ): the_row(); ?>
                      <section class="single_large_image_desc">
                        <section class="singleLargeTextGallery">
                          <?php 
                          $images = get_sub_field('images_mliwtx_single');
                          if( $images ): ?>
                            <?php foreach( $images as $image ): ?>
                              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                              <p><?php echo esc_html($image['caption']); ?></p>
                            <?php endforeach; ?>
                          <?php endif; ?>
                        </section>
                        <section class="single_large_desc">
                          <?php the_sub_field('text_mliwtx_single'); ?>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'videos_sections' ): ?> 
                <?php if( have_rows('video_repeater_container') ): ?>
                    <?php while( have_rows('video_repeater_container') ): the_row(); ?>
                      <section class="videoRepContainer">
                        <section class="videoContainerEach">
                          <section class="videoInformation">
                            <h2><?php the_sub_field('video_title') ?></h2>
                            <p><?php the_sub_field('video_description') ?></p>
                          </section>
                          <section class="videoContainer">
                            <?php the_sub_field('video_link_artists') ?>
                          </section>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'embedded_content' ): ?> 
                <?php if( have_rows('embedded_content_container') ): ?>
                    <?php while( have_rows('embedded_content_container') ): the_row(); ?>
                      <section class="embeddedContainer">
                          <section class="embeddedInformation">
                            <h2><?php the_sub_field('embedded_content_title') ?></h2>
                            <p><?php the_sub_field('embedded_content_description') ?></p>
                          </section>
                          <section class="videoContainer">
                            <?php the_sub_field('embedded_content_link') ?>
                          </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'readings' ): ?> 
                <section class="readingsContainer">
                  <h2>Pedagogical Readings</h2>
                <?php if( have_rows('readings_repeater_container') ): ?>
                    <?php while( have_rows('readings_repeater_container') ): the_row(); ?>
                        <section class="readingsEachContainer">
                          <section class="readingsEach">
                            <h4><?php the_sub_field('reading_author'); ?></h4>
                            <a href="<?php the_sub_field('reading_file') ?>" target="_blank"><?php the_sub_field('reading_title') ?></a>

                          </section>
                        </section>
                     
                    <?php endwhile; ?>
                <?php endif; ?> 
                 </section>
              <?php elseif( get_row_layout() == 'tagged_events' ): ?> 
                <?php if( have_rows('tagged_event_repeater_container') ): ?>
                    <?php while( have_rows('tagged_event_repeater_container') ): the_row(); ?>
                      <section class="taggedEventContainer">
                        <h2>Events</h2>
                        <section class="taggedEventEachContainer">
                          <section class="taggedEventEach">
                            <?php $featured_posts = get_sub_field('event_post_tagged_events_copy');
                            ?>
                              <?php   if( $featured_posts ) {
                                  $post = $featured_posts;
                                  setup_postdata($post);
                               ?>
                               <section class="eventDate">
                                 <?php 
                                     $startDate = get_field('event_date_start');
                                     $endDate = get_field('event_date_end');
                                     if( !empty( $endDate ) ): ?>
                                        <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
                                     <?php else: ; ?>
                                      <?php the_field('event_date_start');?></br>
                                     <?php endif; ?>
                               </section>
                               <section class="eventTitletitle">
                                 <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
                                   <?php the_title(); ?>
                                 </a>
                               </section>
                                <?php  wp_reset_postdata(); ?> 
                              <?php  } ?>
                          </section>
                          
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

                

              <?php elseif( get_row_layout() == 'cta_button' ): ?> 
                <?php if( have_rows('button_information_container') ): ?>
                    <?php while( have_rows('button_information_container') ): the_row(); ?>
                      <a class="ctaButton"href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_label'); ?></a>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'contributors_list' ): ?> 
                <?php if( have_rows('contributors_repeater_container') ): ?>
                    <?php while( have_rows('contributors_repeater_container') ): the_row(); ?>
                      <section class="contributorsContainer">
                        <h2>Artists and Collaborators</h2>
                        <section class="contributorEachContainer">
                          <section class="contributorEach">
                            <figure>
                              <?php 
                              $imageCont = get_sub_field('contributor_image');
                              if( !empty( $imageCont ) ): ?>
                                  <img src="<?php echo esc_url($imageCont['url']); ?>" alt="<?php echo esc_attr($imageCont['alt']); ?>" />
                              <?php endif; ?>
                            </figure>
                            <section class="contributorInformation">
                              <h3><?php the_sub_field('contributor_name') ?></h3>
                              <section class="contributorBio">
                                <?php the_sub_field('contributor_bio') ?>
                              </section>
                            </section>
                          </section>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 
              </section>    
              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
         </section>
       
     </section>   
        <?php endwhile; ?>
    <?php endif; ?> 

          
  



  <?php }; ?>
  
</main>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>