<?php get_header(); ?>
<main class="artistsmain" aria-label="the artist content filled out in the page">
<!--   <section class="blob">
    <img src="<?php bloginfo('template_directory'); ?>/images/menuitems.png" alt="Navigation menu for page">
 -->   

  </section>
  <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
  <?php if( get_field('language_options') == 'Single Language' ) {; ?>
    <a href="#description" class="navLink">Description</a>
    <section class="openingTitle" id="description" aria-label="Artist name, an artist avatar designed specifically for this project and a breif description">
      <figure>
        <?php the_post_thumbnail('large');?>
      </figure>
      <section class="openingDesc gs_reveal">
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
                  <section class="single_large_image_desc" id="singleImage" aria-label="an image with a title">
                    <figure class="gs_reveal gs_reveal_fromLeft">
                      <?php 
                      $image = get_sub_field('image_file_imagewText');
                      if( !empty( $image ) ): ?>
                          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                      <?php endif; ?>
                    </figure>
                    <section class="single_large_desc gs_reveal" aria-label="accompanying image title">
                      <?php the_sub_field('image_text_information_image_with_text'); ?>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'pdf_reader' ): ?>
            <?php if( have_rows('pdf_reader_container') ): ?>
                <?php while( have_rows('pdf_reader_container') ): the_row(); ?>
                  <section class="pdfReaderContainer" id="pdfItem" aria-label="a pdf file embedded onto the page with the option to be downloaded below">
                    <section class="pdfReaderInformation gs_reveal gs_reveal_fromLeft">
                      <h1><?php the_sub_field('pdf_title'); ?></h1>
                      <h2><?php the_sub_field('pdf_subtitle'); ?></h2>
                    </section>
                    <section class="pdfHolder gs_reveal gs_reveal_fromRight">
                        <object
                          data='<?php the_sub_field('pdf_file');?>'
                          type="application/pdf"
                          width="350"
                          height="450"
                        >

                          <iframe
                            src='<?php the_sub_field('pdf_file');?>'
                            width="350"
                            height="450"
                          >
                          <p>This browser does not support PDF!</p>
                        </iframe>
                      </object>
                      <br><a href="<?php the_sub_field('pdf_file');?>" target="_blank"><?php the_sub_field('pdf_subtitle'); ?> <i class="fa-solid fa-file-pdf"></i></a>
                    </section>
                <?php endwhile; ?>
            <?php endif; ?> 
                  </section>
          <?php elseif( get_row_layout() == 'multiple_large_images_with_text' ): ?>
            <?php if( have_rows('mliwtx_single') ): ?>
                <?php while( have_rows('mliwtx_single') ): the_row(); ?>
                  <section class="multi_large_image_desc" id="multiImageText">
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
                    <section class="multi_large_desc gs_reveal">
                      <?php the_sub_field('text_mliwtx_single'); ?>
                    </section>
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'two_column_text' ): ?>
            <section class="twoColumnText gs_reveal gs_reveal_fromLeft" >
            <?php if( have_rows('column_details') ): ?>
                <?php while( have_rows('column_details') ): the_row(); ?>
                <?php $columnWidth = get_sub_field('column_widths');
                if( $columnWidth == '20% / 80%' ) { ?>
                  <section class="twoColumn">
                    <div class="twenty">
                      <?php the_sub_field('left_column'); ?>
                    </div>
                    <div class="eighty">
                      <?php the_sub_field('right_column'); ?>
                    </div>
                  </section>  
                <?php } ?> 

                <?php if( $columnWidth == '50 % / 50%' ) { ?>
                  <section class="twoColumn twoColumnFifty">
                    <div class="fifty">
                      <?php the_sub_field('left_column'); ?>
                    </div>
                    <div class="fifty">
                      <?php the_sub_field('right_column'); ?>
                    </div>
                  </section>  
                <?php } ?>  
            
                  
                <?php endwhile; ?>
            <?php endif; ?> 
            </section>

          <?php elseif( get_row_layout() == 'zig_zag_text' ): ?>
            <section class="zigZagTexts gs_reveal" >
            <?php if( have_rows('zig_zag_fields_container') ): ?>
                <?php while( have_rows('zig_zag_fields_container') ): the_row(); ?>
                <?php $zigWidth = get_sub_field('left_align_or_right_align');
                if( $zigWidth == 'Left Align' ) { ?>
                  <section class="leftAlignZig ">
                      <?php the_sub_field('zig_zag_text'); ?>
                  </section>  
                <?php } ?> 
                <?php if( $zigWidth == 'Right Align' ) { ?>
                  <section class="rightAlignZig">
              
                      <?php the_sub_field('zig_zag_text'); ?>
                  </section>  
                <?php } ?>  
            
                  
                <?php endwhile; ?>
            <?php endif; ?> 
            </section>

          <?php elseif( get_row_layout() == 'videos_sections' ): ?> 
            <section class="videoRepContainer" id="videos" aria-label="section with embedded videos">
            <?php if( have_rows('video_repeater_container') ): ?>
                <?php while( have_rows('video_repeater_container') ): the_row(); ?>
                
                    <section class="videoContainerEach">
                      <section class="videoInformation gs_reveal gs_reveal_fromLeft" aria-label="information about the video">
                        <h2><?php the_sub_field('video_title') ?></h2>
                        <p><?php the_sub_field('video_description') ?></p>
                      </section>
                      <section class="videoOuter gs_reveal gs_reveal_fromRight">
                        <section class="videoContainer">
                          <?php the_sub_field('video_link_artists') ?>
                        </section>
                        
                      </section>
                    </section>
                 
                <?php endwhile; ?>
            <?php endif; ?> 
             </section>
          <?php elseif( get_row_layout() == 'embedded_content' ): ?> 
            <?php if( have_rows('embedded_content_container') ): ?>
                <?php while( have_rows('embedded_content_container') ): the_row(); ?>
                  <section class="embeddedContainer" id="embedContent">
                      <section class="videoOuter gs_reveal gs_reveal_fromLeft">
                        <section class="videoContainer">
                        <?php the_sub_field('embedded_content_link') ?>
                      </section>
                      </section>
                      <section class="embeddedInformation gs_reveal" aria-label="information about the embedded content">
                        <h2><?php the_sub_field('embedded_content_title') ?></h2>
                        <p><?php the_sub_field('embedded_content_description') ?></p>
                      </section>
                      
                  </section>
                <?php endwhile; ?>
            <?php endif; ?> 

          <?php elseif( get_row_layout() == 'readings' ): ?> 
            <a href="#readings" class="navLink">Pedagogical Readings</a>
            <section class="readingsContainer" id="readings" aria-label="Pedagogical Readings container">
              <h2 class="gs_reveal gs_reveal_fromLeft">Pedagogical Readings</h2>
              <section class="readingsEachContainer gs_reveal">
            <?php if( have_rows('readings_repeater_container') ): ?>
                <?php while( have_rows('readings_repeater_container') ): the_row(); ?>
                    
                      <section class="readingsEach" aria-label="a reading pdf file with title of the pdf mentioned">
                        <h4><?php the_sub_field('reading_author'); ?></h4>
                        <section class="pdftitleLink">
                          <a href="<?php the_sub_field('reading_file') ?>" target="_blank"><?php the_sub_field('reading_title') ?> <i class="fa-solid fa-file-pdf"></i></a>
                        </section>
                      </section>
                    
                 
                <?php endwhile; ?>
            <?php endif; ?>
            </section>
             </section>
          <?php elseif( get_row_layout() == 'tagged_events' ): ?> 
            <a href="#events" class="navLink"><?php the_sub_field('event_title'); ?></a>
            <section class="taggedEventContainer" id="events" aria-label="events associated with project">
              <h2 class="gs_reveal gs_reveal_fromLeft"><?php the_sub_field('event_title'); ?></h2>
              <section class="taggedEventEachContainer gs_reveal">
            <?php if( have_rows('tagged_event_repeater_container') ): ?>
                <?php while( have_rows('tagged_event_repeater_container') ): the_row(); ?>
                    
                      
                        <?php $featured_posts = get_sub_field('event_post_tagged_events_copy');
                        ?>
                          <?php   if( $featured_posts ) {
                              $post = $featured_posts;
                              setup_postdata($post);
                           ?>
                          <section class="taggedEventEach">
                           <section class="eventDate" aria-label="event date">
                             <?php 
                                 $startDate = get_field('event_date_start');
                                 $endDate = get_field('event_date_end');
                                 if( !empty( $endDate ) ): ?>
                                    <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
                                 <?php else: ; ?>
                                  <?php the_field('event_date_start');?></br>
                                 <?php endif; ?>
                           </section>
                           <section class="eventTitletitle" aria-label="title of the event">
                             <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
                               <?php the_title(); ?>
                             </a>
                           </section>

                            <?php  wp_reset_postdata(); ?> 
                          <?php  } ?>
                        </section>
                <?php endwhile; ?>
            <?php endif; ?> 
             </section>
           </section>
            

          <?php elseif( get_row_layout() == 'cta_button' ): ?> 
            <?php if( have_rows('button_information_container') ): ?>
                <?php while( have_rows('button_information_container') ): the_row(); ?>
                  <a href="#button" class="navLink"><?php the_sub_field('button_label'); ?></a>
                  <a class="ctaButton gs_reveal" id="button" href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_label'); ?></a>
                <?php endwhile; ?>
            <?php endif; ?> 


          <?php elseif( get_row_layout() == 'full_width_text' ): ?> 
            <section class="textFullWidth gs_reveal" aria-label="long form text">
              <?php the_sub_field('full_width_text_content'); ?>
            </section>

          <?php elseif( get_row_layout() == 'full_width_image' ): ?> 
            <figure class="fullwidthImg ">
              <?php 
              $imagesFull = get_sub_field('full_width_image_selection');
              if( $imagesFull ): ?>
                  <img loading="lazy" src="<?php echo esc_url($imagesFull['url']); ?>" alt="<?php echo esc_attr($imagesFull['alt']); ?>">
                  <span><?php echo esc_attr($imagesFull['caption']); ?></span>
              <?php endif; ?>
            </figure>

          <?php elseif( get_row_layout() == 'full_width_video_upload' ): ?> 
             <section class="htmlvideoContainer" aria-label="video with play button, with no other controls">
              <video
                  id="my-video"
                  class="video-js medium  vjs-layout-medium vjs-16-9"
                  preload="auto"
                  controls="play"
                  width="750"
                  height="422"
                  poster="<?php the_sub_field('placeholder_image') ?>"
                  data-setup="{'fluid': true}"
                >
                  <source src="<?php the_sub_field('uploaded_video_file'); ?>" type="video/mp4" />
                  <p class="vjs-no-js">
                    To view this video please enable JavaScript, and consider upgrading to a
                    web browser that
                    <a href="https://videojs.com/html5-video-support/" target="_blank"
                      >supports HTML5 video</a
                    >
                  </p>
                </video>
            </section>

          <?php elseif( get_row_layout() == 'google_map_points' ): ?> 
            <?php if( have_rows('google_map_container') ): ?>
                <div class="acf-map artistMap gs_reveal gs_reveal_fromLeft" data-zoom="16" id="map">
                    <?php while ( have_rows('google_map_container') ) : the_row(); 

                        // Load sub field values.
                        $location = get_sub_field('point_location');
                        $title = get_sub_field('point_title');
                        $description = get_sub_field('point_description');
                        ?>
                        <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>">
                          <section class="innerInfoWindow">
                            <h3><?php echo esc_html( $title ); ?></h3>
                            <p><em><?php echo esc_html( $location['address'] ); ?></em></p>
                            <p><?php echo esc_html( $description ); ?></p>
                          </section>
                            
                        </div>
                <?php endwhile; ?>
                </div>
            <?php endif; ?>

          <?php elseif( get_row_layout() == 'contributors_list' ): ?> 
            <a href="#contributors" class="navLink"><?php the_sub_field('contributors_label'); ?></a>
              <section class="contributorsContainer" id="contributors" aria-label="list of people involved in creating this project">
                <section class="contributorsTitle gs_reveal gs_reveal_fromLeft">
                  <h2 class=""><?php the_sub_field('contributors_label'); ?></h2>
                </section>
              <section class="contributorEachContainer ">
            <?php if( have_rows('contributors_repeater_container') ): ?>
                <?php while( have_rows('contributors_repeater_container') ): the_row(); ?>
                      
                        <section class="contributorInformation gs_reveal gs_reveal_fromRight">
                          <h3><?php the_sub_field('contributor_name') ?></h3>
                          <section class="contributorBio">
                            <?php the_sub_field('contributor_bio') ?>
                          </section>
                        
                      </section>
                    
                <?php endwhile; ?>
            <?php endif; ?> 
            </section>
          </section>
          <?php endif; ?>
        <?php endwhile; ?>
      <?php endif; ?>
  

  <?php }; ?>

<!-- multi language  -->

  <?php if( get_field('language_options') == 'Multi-Language' ) {; ?>
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
    <?php if( have_rows('multi_language_fields') ): ?>
        <?php while( have_rows('multi_language_fields') ): the_row(); ?>
       <section class="languageChoiceEach" aria-label="navigating this link will switch the language of the page" >
         <?php the_sub_field('language_label'); ?>
       </section>
  <section class="languageChoiceContent">

         <a href="#description" class="navLink">Description</a>
        <section class="openingTitle" id="description" aria-label="brief description of the artist, an avatar created for the artist and a brief description of the work">
          <figure>
            <?php the_post_thumbnail('large');?>
          </figure>
          <section class="openingDesc gs_reveal">
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
                      <section class="single_large_image_desc " id="image">
                        <figure class="gs_reveal gs_reveal_fromLeft">
                          <?php 
                          $image = get_sub_field('image_file_imagewText');
                          if( !empty( $image ) ): ?>
                              <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                          <?php endif; ?>
                        </figure>
                        <section class="single_large_desc gs_reveal gs_reveal_fromRight">
                          <?php the_sub_field('image_text_information_image_with_text'); ?>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'pdf_reader' ): ?>
                <?php if( have_rows('pdf_reader_container') ): ?>
                    <?php while( have_rows('pdf_reader_container') ): the_row(); ?>
                      <section class="pdfReaderContainer" id="pdfItem" aria-label="a pdf embedded on to the page, with the option to be downloaded as a file">
                        <section class="pdfReaderInformation gs_reveal gs_reveal_fromLeft">
                          <h1><?php the_sub_field('pdf_title'); ?></h1>
                          <h2><?php the_sub_field('pdf_subtitle'); ?></h2>
                        </section>
                        <section class="pdfHolder gs_reveal gs_reveal_fromRight">
                          <object
                            data='<?php the_sub_field('pdf_file');?>'
                            type="application/pdf"
                            width="350"
                            height="450"
                          >

                            <iframe
                              src='<?php the_sub_field('pdf_file');?>'
                              width="350"
                              height="450"
                            >
                            <p>This browser does not support PDF!</p>
                          </iframe>
                        </object>
                          <br><a href="<?php the_sub_field('pdf_file');?>" target="_blank"><?php the_sub_field('pdf_subtitle'); ?> <i class="fa-solid fa-file-pdf"></i></a>
                        </section>
                    <?php endwhile; ?>
                <?php endif; ?> 
                    </section>
              <?php elseif( get_row_layout() == 'multiple_large_images_with_text' ): ?>
                <?php if( have_rows('mliwtx_single') ): ?>
                    <?php while( have_rows('mliwtx_single') ): the_row(); ?>
                      <section class="multi_large_image_desc" id="multiImageText">
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
                        <section class="multi_large_desc gs_reveal">
                          <?php the_sub_field('text_mliwtx_single'); ?>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'videos_sections' ): ?> 
                <section class="videoRepContainer" id="videos">
                <?php if( have_rows('video_repeater_container') ): ?>
                    <?php while( have_rows('video_repeater_container') ): the_row(); ?>
                      
                        <section class="videoContainerEach">
                          <section class="videoInformation gs_reveal gs_reveal_fromLeft">
                            <h2><?php the_sub_field('video_title') ?></h2>
                            <p><?php the_sub_field('video_description') ?></p>
                          </section>
                          <section class="videoOuter gs_reveal">
                          <section class="videoContainer">
                            <?php the_sub_field('video_link_artists') ?>
                          </section>
                        </section>
                        </section>
                      
                    <?php endwhile; ?>
                <?php endif; ?> 
                </section>
              <?php elseif( get_row_layout() == 'embedded_content' ): ?> 
                <?php if( have_rows('embedded_content_container') ): ?>
                    <?php while( have_rows('embedded_content_container') ): the_row(); ?>
                      <section class="embeddedContainer" id="embedContent">
                          <section class="videoOuter gs_reveal gs_reveal_fromLeft">
                          <section class="videoContainer">
                            <?php the_sub_field('embedded_content_link') ?>
                          </section>
                        </section>
                        <section class="embeddedInformation gs_reveal gs_reveal_fromRight">
                          <h2><?php the_sub_field('embedded_content_title') ?></h2>
                          <p><?php the_sub_field('embedded_content_description') ?></p>
                        </section>
                      </section>
                    <?php endwhile; ?>
                <?php endif; ?> 

              <?php elseif( get_row_layout() == 'readings' ): ?> 
                <section class="readingsContainer" id="readings" aria-label="Pedagogical Readings">
                  <h2 class="gs_reveal gs_reveal_fromLeft">Pedagogical Readings</h2>
                  <section class="readingsEachContainer gs_reveal">
                <?php if( have_rows('readings_repeater_container') ): ?>
                    <?php while( have_rows('readings_repeater_container') ): the_row(); ?>

                          <section class="readingsEach" aria-label="reading pdf with the writer of the work, the title of the work and file to be downloaded">
                            <h4><?php the_sub_field('reading_author'); ?></h4>
                            <section class="pdftitleLink">
                               <a href="<?php the_sub_field('reading_file') ?>" target="_blank"><?php the_sub_field('reading_title') ?> <i class="fa-solid fa-file-pdf"></i></a>
                            </section>
                           

                         
                        
                    <?php endwhile; ?>
                <?php endif; ?> 
               </section>
                </section>
                     
                 </section>
              <?php elseif( get_row_layout() == 'tagged_events' ): ?> 
                <a href="#events" class="navLink"><?php the_sub_field('events_title'); ?></a>
                 <section class="taggedEventContainer" id="events" aria-label="a list of events associated with the project">
              <h2 class="gs_reveal gs_reveal_fromLeft"><?php the_sub_field('events_title'); ?></h2>
              <section class="taggedEventEachContainer gs_reveal">
            <?php if( have_rows('tagged_event_repeater_container') ): ?>
                <?php while( have_rows('tagged_event_repeater_container') ): the_row(); ?>
                    
                      
                        <?php $featured_posts = get_sub_field('event_post_tagged_events_copy');
                        ?>
                          <?php   if( $featured_posts ) {
                              $post = $featured_posts;
                              setup_postdata($post);
                           ?>
                          <section class="taggedEventEach">
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
                <?php endwhile; ?>
            <?php endif; ?> 
             </section>
           </section>

                

              <?php elseif( get_row_layout() == 'cta_button' ): ?> 
                <?php if( have_rows('button_information_container') ): ?>
                    <?php while( have_rows('button_information_container') ): the_row(); ?>
                      <a href="#button" class="navLink"><?php the_sub_field('button_label'); ?></a>
                      <a class="ctaButton gs_reveal" id="button" href="<?php the_sub_field('button_link'); ?>"><?php the_sub_field('button_label'); ?></a>
                    <?php endwhile; ?>
                <?php endif; ?> 


              <?php elseif( get_row_layout() == 'full_width_text' ): ?> 
                <section class="textFullWidth gs_reveal">
                  <?php the_sub_field('full_width_text_content'); ?>
                </section>

              <?php elseif( get_row_layout() == 'full_width_image' ): ?> 
                <figure class="fullwidthImg gs_reveal">
                  <?php 
                  $imagesFull = get_sub_field('full_width_image_selection');
                  if( $imagesFull ): ?>
                      <img src="<?php echo esc_url($imagesFull['url']); ?>" alt="<?php echo esc_attr($imagesFull['alt']); ?>">
                  <?php endif; ?>
                </figure>



                <?php elseif( get_row_layout() == 'contributors_list' ): ?> 
                  <a href="#contributors" class="navLink"><?php the_sub_field('contributors_label'); ?></a>
                  <section class="contributorsContainer" id="contributors" aria-label="a list of people involved in the project">
                    <section class="contributorsTitle">
                      <h2 class="gs_reveal gs_reveal_fromLeft"><?php the_sub_field('contributors_label'); ?></h2>
                    </section>
                    
                    <section class="contributorEachContainer">
                  <?php if( have_rows('contributors_repeater_container') ): ?>
                      <?php while( have_rows('contributors_repeater_container') ): the_row(); ?>
                              <section class="contributorInformation gs_reveal gs_reveal_fromRight">
                                <h3><?php the_sub_field('contributor_name') ?></h3>
                                <section class="contributorBio">
                                  <?php the_sub_field('contributor_bio') ?>
                                </section>
                              </section>
                           
                         
                      <?php endwhile; ?>
                  <?php endif; ?> 
                   </section>
                    </section>

  
      
              <?php endif; ?>
            <?php endwhile; ?>
          <?php endif; ?>
          </section>  
         </section>

       
     </section>   
        <?php endwhile; ?>
    <?php endif; ?> 

          
  



  <?php }; ?>
  
</main>

<?php endwhile; // end of the loop. ?>

<?php get_footer(); ?>