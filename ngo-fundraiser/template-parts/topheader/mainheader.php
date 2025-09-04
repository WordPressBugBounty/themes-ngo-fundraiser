<?php
/**
 * Displays main header
 *
 * @package NGO Fundraiser
 */
?>

<div class="main-header text-center text-md-start">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-5 col-sm-5 col-12 logo-box ps-0">
                <div class="navbar-brand ">
                    <?php if ( has_custom_logo() ) : ?>
                        <div class="site-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <?php $ngo_fundraiser_blog_info = get_bloginfo( 'name' ); ?>
                        <?php if ( ! empty( $ngo_fundraiser_blog_info ) ) : ?>
                            <?php if ( is_front_page() && is_home() ) : ?>
                                <?php if( get_theme_mod('ngo_fundraiser_logo_title_text',true) != ''){ ?>
                                    <h1 class="site-title pt-2"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php } ?>
                            <?php else : ?>
                                <?php if( get_theme_mod('ngo_fundraiser_logo_title_text',true) != ''){ ?>
                                    <p class="site-title "><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                                <?php } ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php
                            $ngo_fundraiser_description = get_bloginfo( 'description', 'display' );
                            if ( $ngo_fundraiser_description || is_customize_preview() ) :
                        ?>
                        <?php if( get_theme_mod('ngo_fundraiser_theme_description',false) != ''){ ?>
                            <p class="site-description pb-2"><?php echo esc_html($ngo_fundraiser_description); ?></p>
                        <?php } ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="col-lg-5 col-md-3 col-sm-3 col-5 align-self-center header-box">
                <?php get_template_part('template-parts/navigation/nav'); ?>
            </div>
            <div class="col-lg-1 col-md-2 col-sm-2 col-2 align-self-center text-lg-center text-md-center">
                <?php if(get_theme_mod('ngo_fundraiser_search_setting',false) != ''){ ?>
                    <span class="head-search">
                        <div class="header-search-wrapper">
                            <span class="search-main">
                                <i class="fa fa-search"></i>
                            </span>
                            <div class="search-form-main clearfix">
                                <form method="get" class="search-form">
                                  <label>
                                    <input type="search" class="search-field form-control" placeholder="Search …" value="" name="s">
                                  </label>
                                  <input type="submit" class="search-submit btn btn-primary mt-3" value="Search">
                                </form>
                            </div>
                        </div>
                    </span>
                <?php }?>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-2 col-5 align-self-center text-lg-start text-md-end head-btn">
                <?php if(get_theme_mod('ngo_fundraiser_header_button_url') != ''|| get_theme_mod('ngo_fundraiser_header_button_text') != ''){ ?>
                    <a href="<?php echo esc_url(get_theme_mod('ngo_fundraiser_header_button_url','')); ?>"class="header-btn"><?php echo esc_html(get_theme_mod('ngo_fundraiser_header_button_text','')); ?></a>
                <?php }?>
            </div>
        </div>
    </div>
</div>
