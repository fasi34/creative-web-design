<?php
/**
 * Template Name: Custom Home Page
 */
get_header(); ?>

<main id="content">
  <?php if( get_option('adventure_trekking_camp_services_enable', false) !== 'off'){ ?>
    <section id="home-about" class="py-5">
      <div class="container">
        <?php if( get_theme_mod('adventure_trekking_camp_activities_text') != ''){ ?>
          <h6 class="text-center"><?php echo esc_html(get_theme_mod('adventure_trekking_camp_activities_text','')); ?></h6>
        <?php }?>
        <?php if( get_theme_mod('adventure_trekking_camp_activities_heading') != ''){ ?>
          <h3 class="text-center mb-5"><?php echo esc_html(get_theme_mod('adventure_trekking_camp_activities_heading','')); ?></h3>
        <?php }?>
        <div class="row">
          <?php
          $adventure_trekking_camp_activities_category=  get_theme_mod('adventure_trekking_camp_activities_setting');
          $adventure_trekking_camp_our_activities_order = get_theme_mod('adventure_trekking_camp_our_activities_order_type','descending');
          if($adventure_trekking_camp_activities_category){
            $adventure_trekking_camp_args = array( 
              'category_name' => esc_html($adventure_trekking_camp_activities_category ,'adventure-trekking-camp'),
              'posts_per_page' => get_theme_mod('adventure_trekking_camp_service_count'),
              'order'          => 'DESC', // Default order
            );
            // Adjust ordering based on user selection
            if ($adventure_trekking_camp_our_activities_order == 'ascending') {
              $adventure_trekking_camp_args['order'] = 'ASC';
            } else if ($adventure_trekking_camp_our_activities_order == 'a-to-z') {
              $adventure_trekking_camp_args['orderby'] = 'title';
              $adventure_trekking_camp_args['order'] = 'ASC';
            } else if ($adventure_trekking_camp_our_activities_order == 'z-to-a') {
              $adventure_trekking_camp_args['orderby'] = 'title';
              $adventure_trekking_camp_args['order'] = 'DESC';
            }
            $adventure_trekking_camp_page_query = new WP_Query( $adventure_trekking_camp_args );
            while( $adventure_trekking_camp_page_query->have_posts() ) : $adventure_trekking_camp_page_query->the_post(); ?>
              <div class="col-lg-4 col-md-6 col-sm-6">
                <div class="activities-box mb-4 wow swing position-relative">
                  <?php if (has_post_thumbnail()) { 
                    the_post_thumbnail();
                  } ?>
                  <?php if( get_post_meta($post->ID, 'adventure_trekking_camp_trekking_rating', true) ) {?>
                    <div class="rating-box">
                      <h5><?php echo esc_html(get_post_meta($post->ID,'adventure_trekking_camp_trekking_rating',true)); ?></h5>
                      <p class="mb-0"><?php esc_html_e('Rating','adventure-trekking-camp'); ?></p>
                    </div>
                  <?php }?>
                  <div class="activities-inner-box">
                    <?php if( get_post_meta($post->ID, 'adventure_trekking_camp_trekking_amount', true) ) {?>
                      <h5><?php echo esc_html(get_post_meta($post->ID,'adventure_trekking_camp_trekking_amount',true)); ?></h5>
                    <?php }?>
                    <h4><a href="<?php the_permalink(); ?>"><?php the_title();?></a></h4>
                     <p class="mb-0"><?php echo wp_trim_words( get_the_content(),15 );?></p>
                  </div>
                </div>
              </div>
            <?php endwhile;
            wp_reset_postdata();
          }?>
        </div>
      </div>
    </section>
  <?php }?>
  <section id="custom-page-content" <?php if ( have_posts() && trim( get_the_content() ) !== '' ) echo 'class="pt-3"'; ?>>
    <div class="container">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php the_content(); ?>
      <?php endwhile; ?>
    </div>
  </section>
</main>

<?php get_footer(); ?>