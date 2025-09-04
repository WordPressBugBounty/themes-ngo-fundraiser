<?php
/**
 * Template Name: Home Template
 */

get_header(); ?>

<main id="skip-content">
  <section id="top-slider" >
    <div class="slide-left-box">
      <div class="row mail-box">
        <?php if ( get_theme_mod('ngo_fundraiser_slider_mail_text') != "" ) {?>
          <div class="col-lg-8 col-md-8 col-sm-8 col-12 mail ps-0">
            <p class="contact text-center m-0"><i class="fas fa-envelope"></i><a href="mailto:<?php echo esc_attr(get_theme_mod('ngo_fundraiser_slider_mail_text')); ?>"><?php echo esc_html(get_theme_mod('ngo_fundraiser_slider_mail_text')); ?></a></p>  
          </div>
        <?php }?>
        <div class="col-lg-4 col-md-4 col-sm-4 col-12 social-link ps-0">
          <div class="contact">
            <?php if(get_theme_mod('ngo_fundraiser_facebook_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_facebook_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('ngo_fundraiser_facebook_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('ngo_fundraiser_twitter_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_twitter_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('ngo_fundraiser_twitter_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('ngo_fundraiser_intagram_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_intagram_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('ngo_fundraiser_intagram_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('ngo_fundraiser_linkedin_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_linkedin_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('ngo_fundraiser_linkedin_icon') ); ?>"></i></a>
            <?php }?>
            <?php if(get_theme_mod('ngo_fundraiser_pintrest_url') != ''){ ?>
              <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_pintrest_url','')); ?>"><i class="<?php echo esc_attr( get_theme_mod('ngo_fundraiser_pintrest_icon') ); ?>"></i></a>
            <?php }?>
          </div>
        </div>
      </div>
    </div>
    <div class="slier-main-box">
      <?php $ngo_fundraiser_slide_pages = array();
        for ( $ngo_fundraiser_count = 1; $ngo_fundraiser_count <= 3; $ngo_fundraiser_count++ ) {
          $ngo_fundraiser_mod = intval( get_theme_mod( 'ngo_fundraiser_top_slider_page' . $ngo_fundraiser_count ));
          if ( 'page-none-selected' != $ngo_fundraiser_mod ) {
            $ngo_fundraiser_slide_pages[] = $ngo_fundraiser_mod;
          }
        }
        if( !empty($ngo_fundraiser_slide_pages) ) :
          $ngo_fundraiser_args = array(
            'post_type' => 'page',
            'post__in' => $ngo_fundraiser_slide_pages,
            'orderby' => 'post__in'
          );
          $ngo_fundraiser_query = new WP_Query( $ngo_fundraiser_args );
          if ( $ngo_fundraiser_query->have_posts() ) :
            $i = 1;
      ?>
      <div class="owl-carousel" role="listbox">
        <?php  while ( $ngo_fundraiser_query->have_posts() ) : $ngo_fundraiser_query->the_post(); ?>
          <div class="slide-box">
            <div class="slide-half"></div>
              <?php if(has_post_thumbnail()){
                the_post_thumbnail();
                } else{?>
                <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/images/slider.png" alt="" />
              <?php } ?>
              <div class="slider-inner-box align-self-center">
                <h4><?php echo esc_html(get_theme_mod('ngo_fundraiser_slider_short_heading')); ?></h4>
                <h3 class="mt-2"><?php the_title(); ?></h3>
                <p class="content mt-3 mb-4 pb-2"><?php echo esc_html( wp_trim_words( get_the_content(),esc_attr(get_theme_mod('ngo_fundraiser_slider_excerpt_length', 20)) )); ?></p>
                <div class="slide-btn">
                  <a href="<?php the_permalink(); ?>"><?php esc_html_e('Request Fund Rise','ngo-fundraiser'); ?></a>
                </div>
              </div>
          </div>
        <?php $i++; endwhile;
        wp_reset_postdata();?>
      </div>
      <?php else : ?>
        <div class="no-postfound"></div>
      <?php endif;
      endif;?>
    </div>
  </section>
  <section class="featured py-5">
    <div class="container">
      <div class="ser-heading text-center mb-4">
        <?php if(get_theme_mod('ngo_fundraiser_about_us_heading') != ''){ ?>
          <h3 class="main-heading "><?php echo esc_html(get_theme_mod('ngo_fundraiser_about_us_heading')); ?></h3>
        <?php }?>
        <?php if(get_theme_mod('ngo_fundraiser_about_us_content') != ''){ ?>
          <p class="main-heading m-0"><?php echo esc_html(get_theme_mod('ngo_fundraiser_about_us_content')); ?></p>
        <?php }?>
      </div>
      <div class="row ">
        <?php
          $ngo_fundraiser_services_cat = get_theme_mod('ngo_fundraiser_popular_causes_category','services');
          if($ngo_fundraiser_services_cat){
            $ngo_fundraiser_page_query5 = new WP_Query(array( 'category_name' => esc_html($ngo_fundraiser_services_cat,'ngo-fundraiser'),'posts_per_page' => 6));
            $i=1;
            while( $ngo_fundraiser_page_query5->have_posts() ) : $ngo_fundraiser_page_query5->the_post(); ?>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="feature-box mb-4 m-0">
                  <div class="feature-img">
                    <?php if (has_post_thumbnail()) { ?><img src="<?php the_post_thumbnail_url('full'); ?>" /><?php } else { ?><div class="project-bg"></div> <?php } ?>
                  </div>
                  <div class="ser-content">
                    <h4 class="mt-2 mb-3 text-start"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                    <p class="content mt-3"><?php echo esc_html( wp_trim_words( get_the_content(),20 )); ?></p>
                    <?php
                    // Retrieve and sanitize raised amount from post meta
                    $ngo_fundraiser_raised = esc_html(get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true));

                    // Check if raised amount is available
                    if (get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true)) {
                      // Extract numerical value from the formatted currency
                      $ngo_fundraiser_raised_val = explode('$', $ngo_fundraiser_raised);
                      $ngo_fundraiser_i = $ngo_fundraiser_raised_val[count($ngo_fundraiser_raised_val) - 1];
                    } else {
                      // Default to 1 if raised amount is not available
                      $ngo_fundraiser_i = 1;
                    }

                    // Retrieve and sanitize goal amount from post meta
                    $ngo_fundraiser_goal = esc_html(get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true));

                    // Check if goal amount is available
                    if (get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true)) {
                      // Extract numerical value from the formatted currency
                      $ngo_fundraiser_goal_val = explode('$', $ngo_fundraiser_goal);
                      $ngo_fundraiser_g = $ngo_fundraiser_goal_val[count($ngo_fundraiser_goal_val) - 1];
                    } else {
                      // Default to 1 if goal amount is not available
                      $ngo_fundraiser_g = 1;
                    }

                    // Calculate the percentage of raised amount over the goal amount
                    $ngo_fundraiser_percent = $ngo_fundraiser_i / $ngo_fundraiser_g * 100;
                    ?>

                    <?php if (get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true) && get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true)) { ?>
                    <div class="bar-main-box">
                      <div class="bar-box">
                        <div class="progress">
                          <!-- Display the progress bar with dynamic width based on the percentage -->
                          <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo $ngo_fundraiser_percent ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ngo_fundraiser_percent ?>%;">
                          </div>
                        </div>
                        <?php if (get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true) && get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true)) { ?>
                            <!-- Display the percentage label at the right position on the progress bar -->
                            <span class="percent float-end" style="left: <?php echo $ngo_fundraiser_percent ?>%;"><?php echo $ngo_fundraiser_percent ?>%</span>
                        <?php } ?>
                      </div>
                      <div class="row mt-2">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-start bar-text-box">
                          <?php if (get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true)) { ?>
                            <!-- Display the raised amount with label -->
                            <span class="text-box"><?php esc_html_e('Raised: ', 'ngo-fundraiser'); ?></span><?php echo esc_html(get_post_meta($post->ID, 'ngo_fundraiser_popular_raised_amount', true)); ?>
                          <?php } ?>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 text-end bar-text-box">
                          <?php if (get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true)) { ?>
                            <!-- Display the goal amount with label -->
                            <span class="text-box"><?php esc_html_e('Goal: ', 'ngo-fundraiser'); ?></span><?php echo esc_html(get_post_meta($post->ID, 'ngo_fundraiser_popular_goal_amount', true)); ?>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                    <?php } ?>
                  </div>
                </div>
              </div>
            <?php $i++; endwhile;
          wp_reset_postdata();
        } ?>
      </div>
    </div>
  </section>
  <section id="page-content">
    <div class="container">
      <div class="py-5">
        <?php
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
              the_content();
            endwhile;
          endif;
        ?>
      </div>
    </div>
  </section>
</main>

<?php get_footer(); ?>