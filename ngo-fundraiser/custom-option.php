<?php

    $ngo_fundraiser_theme_css= "";

    /*--------------------------- Scroll to top positions -------------------*/

    $ngo_fundraiser_scroll_position = get_theme_mod( 'ngo_fundraiser_scroll_top_position','Right');
    if($ngo_fundraiser_scroll_position == 'Right'){
        $ngo_fundraiser_theme_css .='#button{';
            $ngo_fundraiser_theme_css .='right: 20px;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_scroll_position == 'Left'){
        $ngo_fundraiser_theme_css .='#button{';
            $ngo_fundraiser_theme_css .='left: 20px;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_scroll_position == 'Center'){
        $ngo_fundraiser_theme_css .='#button{';
            $ngo_fundraiser_theme_css .='right: 50%;left: 50%;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Single Post Page Image Box Shadow -------------------*/
    
    $ngo_fundraiser_single_post_page_image_box_shadow = get_theme_mod('ngo_fundraiser_single_post_page_image_box_shadow',0);
    if($ngo_fundraiser_single_post_page_image_box_shadow != false){
        $ngo_fundraiser_theme_css .='.single-post .entry-header img{';
            $ngo_fundraiser_theme_css .='box-shadow: '.esc_attr($ngo_fundraiser_single_post_page_image_box_shadow).'px '.esc_attr($ngo_fundraiser_single_post_page_image_box_shadow).'px '.esc_attr($ngo_fundraiser_single_post_page_image_box_shadow).'px #cccccc;';
        $ngo_fundraiser_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Border Radius -------------------*/

    $ngo_fundraiser_single_post_page_image_border_radius = get_theme_mod('ngo_fundraiser_single_post_page_image_border_radius', 0);
    if($ngo_fundraiser_single_post_page_image_border_radius != false){
        $ngo_fundraiser_theme_css .='.single-post .entry-header img{';
            $ngo_fundraiser_theme_css .='border-radius: '.esc_attr($ngo_fundraiser_single_post_page_image_border_radius).'px;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $ngo_fundraiser_footer_bg_image = get_theme_mod('ngo_fundraiser_footer_bg_image');
    if($ngo_fundraiser_footer_bg_image != false){
        $ngo_fundraiser_theme_css .='#colophon{';
            $ngo_fundraiser_theme_css .='background: url('.esc_attr($ngo_fundraiser_footer_bg_image).')!important;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Footer Background Image Position -------------------*/

    $ngo_fundraiser_footer_bg_image_position = get_theme_mod( 'ngo_fundraiser_footer_bg_image_position','scroll');
    if($ngo_fundraiser_footer_bg_image_position == 'fixed'){
        $ngo_fundraiser_theme_css .='#colophon{';
            $ngo_fundraiser_theme_css .='background-attachment: fixed !important; background-position: center !important;';
        $ngo_fundraiser_theme_css .='}';
    }elseif ($ngo_fundraiser_footer_bg_image_position == 'scroll'){
        $ngo_fundraiser_theme_css .='#colophon{';
            $ngo_fundraiser_theme_css .='background-attachment: scroll !important; background-position: center !important;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Footer Widget Heading Alignment -------------------*/

    $ngo_fundraiser_footer_widget_heading_alignment = get_theme_mod( 'ngo_fundraiser_footer_widget_heading_alignment','Left');
    if($ngo_fundraiser_footer_widget_heading_alignment == 'Left'){
        $ngo_fundraiser_theme_css .='#colophon h5, h5.footer-column-widget-title{';
        $ngo_fundraiser_theme_css .='text-align: left;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_footer_widget_heading_alignment == 'Center'){
        $ngo_fundraiser_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $ngo_fundraiser_theme_css .='text-align: center;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_footer_widget_heading_alignment == 'Right'){
        $ngo_fundraiser_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $ngo_fundraiser_theme_css .='text-align: right;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $ngo_fundraiser_footer_widget_content_alignment = get_theme_mod( 'ngo_fundraiser_footer_widget_content_alignment','Left');
    if($ngo_fundraiser_footer_widget_content_alignment == 'Left'){
        $ngo_fundraiser_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $ngo_fundraiser_theme_css .='text-align: left;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_footer_widget_content_alignment == 'Center'){
        $ngo_fundraiser_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $ngo_fundraiser_theme_css .='text-align: center;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_footer_widget_content_alignment == 'Right'){
        $ngo_fundraiser_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $ngo_fundraiser_theme_css .='text-align: right;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $ngo_fundraiser_copyright_content_alignment = get_theme_mod( 'ngo_fundraiser_copyright_content_alignment','Center');
    if($ngo_fundraiser_copyright_content_alignment == 'Left'){
        $ngo_fundraiser_theme_css .='.footer-menu-left{';
        $ngo_fundraiser_theme_css .='text-align: left;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_copyright_content_alignment == 'Center'){
        $ngo_fundraiser_theme_css .='.footer-menu-left{';
            $ngo_fundraiser_theme_css .='text-align: center;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_copyright_content_alignment == 'Right'){
        $ngo_fundraiser_theme_css .='.footer-menu-left{';
            $ngo_fundraiser_theme_css .='text-align: right;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*---------------------------Width Layout -------------------*/

    $ngo_fundraiser_width_option = get_theme_mod( 'ngo_fundraiser_width_option','Full Width');
    if($ngo_fundraiser_width_option == 'Boxed Width'){
        $ngo_fundraiser_theme_css .='body{';
            $ngo_fundraiser_theme_css .='max-width: 1140px; width: 100%; padding-right: 15px; padding-left: 15px; margin-right: auto; margin-left: auto;';
        $ngo_fundraiser_theme_css .='}';
        $ngo_fundraiser_theme_css .='.scrollup i{';
            $ngo_fundraiser_theme_css .='right: 100px;';
        $ngo_fundraiser_theme_css .='}';
        $ngo_fundraiser_theme_css .='.page-template-custom-home-page .home-page-header{';
            $ngo_fundraiser_theme_css .='padding: 0px 40px 0 10px;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_width_option == 'Wide Width'){
        $ngo_fundraiser_theme_css .='body{';
            $ngo_fundraiser_theme_css .='width: 100%;padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;';
        $ngo_fundraiser_theme_css .='}';
        $ngo_fundraiser_theme_css .='.scrollup i{';
            $ngo_fundraiser_theme_css .='right: 30px;';
        $ngo_fundraiser_theme_css .='}';
    }else if($ngo_fundraiser_width_option == 'Full Width'){
        $ngo_fundraiser_theme_css .='body{';
            $ngo_fundraiser_theme_css .='max-width: 100%;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*------------------ Nav Menus -------------------*/

    $ngo_fundraiser_nav_menu = get_theme_mod( 'ngo_fundraiser_nav_menu_text_transform','Capitalize');
    if($ngo_fundraiser_nav_menu == 'Capitalize'){
        $ngo_fundraiser_theme_css .='.main-navigation .menu > li > a{';
            $ngo_fundraiser_theme_css .='text-transform:Capitalize;';
        $ngo_fundraiser_theme_css .='}';
    }
    if($ngo_fundraiser_nav_menu == 'Lowercase'){
        $ngo_fundraiser_theme_css .='.main-navigation .menu > li > a{';
            $ngo_fundraiser_theme_css .='text-transform:Lowercase;';
        $ngo_fundraiser_theme_css .='}';
    }
    if($ngo_fundraiser_nav_menu == 'Uppercase'){
        $ngo_fundraiser_theme_css .='.main-navigation .menu > li > a{';
            $ngo_fundraiser_theme_css .='text-transform:Uppercase;';
        $ngo_fundraiser_theme_css .='}';
    }

    $ngo_fundraiser_menu_font_size = get_theme_mod( 'ngo_fundraiser_menu_font_size');
    if($ngo_fundraiser_menu_font_size != ''){
        $ngo_fundraiser_theme_css .='.main-navigation .menu > li > a{';
            $ngo_fundraiser_theme_css .='font-size: '.esc_attr($ngo_fundraiser_menu_font_size).'px;';
        $ngo_fundraiser_theme_css .='}';
    }

    $ngo_fundraiser_nav_menu_font_weight = get_theme_mod( 'ngo_fundraiser_nav_menu_font_weight',700);
    if($ngo_fundraiser_menu_font_size != ''){
        $ngo_fundraiser_theme_css .='.main-navigation .menu > li > a{';
            $ngo_fundraiser_theme_css .='font-weight: '.esc_attr($ngo_fundraiser_nav_menu_font_weight).';';
        $ngo_fundraiser_theme_css .='}';
    }

    /*-------------------- Global First Color -------------------*/

    $ngo_fundraiser_global_color = get_theme_mod('ngo_fundraiser_global_color');

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='#button, .navbar-brand, .main-header a.header-btn, .search-form-main input.search-submit, #top-slider .slider-inner-box h4, #top-slider .owl-nav button.owl-prev, #top-slider .slide-btn a:hover, #top-slider .contact, .feature-img, .percent::after, .percent, .main-navigation .menu ul.children, .main-navigation .sub-menu, .main-navigation .sub-menu > li > a:hover, .main-navigation .sub-menu > li > a:focus 

        .sidebar input[type="submit"], .sidebar button[type="submit"], a.btn-text, span.onsale, .pro-button a, .woocommerce:where(body:not(.woocommerce-block-theme-has-button-styles)) button.button.alt.disabled, .woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button, .woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce input.button.alt,.woocommerce a.added_to_cart, .woocommerce ul.products li.product .onsale, .woocommerce span.onsale, .woocommerce .woocommerce-ordering select, .woocommerce-account .woocommerce-MyAccount-navigation ul li, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .navigation.pagination .nav-links a.current, .navigation.pagination .nav-links a:hover, .navigation.pagination .nav-links span.current, .navigation.pagination .nav-links span:hover, .comment-respond input#submit, #colophon, .sidebar h5, .sidebar .tagcloud a:hover, p.wp-block-tag-cloud a:hover{';
            $ngo_fundraiser_theme_css .='background-color: '.esc_attr($ngo_fundraiser_global_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='.modal-content{';
            $ngo_fundraiser_theme_css .='background-color: '.esc_attr($ngo_fundraiser_global_color).'!important;';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='#site-navigation .menu ul li a:hover, .main-navigation .menu > li > a:hover, .article-box h3 a, p.price, .woocommerce ul.products li.product .price, .woocommerce div.product p.price, .woocommerce div.product span.price, .woocommerce-message::before, .woocommerce-info::before, .widget a:hover, .widget a:focus, .sidebar ul li a:hover{';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_global_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='.postcat-name{';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_global_color).' !important;';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='.product-image img, .post-navigation .nav-previous a:hover, .post-navigation .nav-next a:hover, .posts-navigation .nav-previous a:hover, .posts-navigation .nav-next a:hover, .navigation.pagination .nav-links a.current, .navigation.pagination .nav-links a:hover, .navigation.pagination .nav-links span.current, .navigation.pagination .nav-links span:hover{';
            $ngo_fundraiser_theme_css .='border-color: '.esc_attr($ngo_fundraiser_global_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='.header-search-wrapper .search-form-main, .woocommerce-message, .woocommerce-info{';
            $ngo_fundraiser_theme_css .='border-top-color: '.esc_attr($ngo_fundraiser_global_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    if($ngo_fundraiser_global_color != false){
        $ngo_fundraiser_theme_css .='.header-search-wrapper .search-form-main:before{';
            $ngo_fundraiser_theme_css .='border-bottom-color: '.esc_attr($ngo_fundraiser_global_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    $ngo_fundraiser_theme_css .='@media screen and (max-width:1000px) {';
        if($ngo_fundraiser_global_color != false){
            $ngo_fundraiser_theme_css .='.toggle-nav i, .sidenav .closebtn{
            background: '.esc_attr($ngo_fundraiser_global_color).';
            }';
        }
    $ngo_fundraiser_theme_css .='}';

    /*-------------------- Heading typography -------------------*/

    $ngo_fundraiser_heading_color = get_theme_mod('ngo_fundraiser_heading_color');
    $ngo_fundraiser_heading_font_family = get_theme_mod('ngo_fundraiser_heading_font_family');
    $ngo_fundraiser_heading_font_size = get_theme_mod('ngo_fundraiser_heading_font_size');
    if($ngo_fundraiser_heading_color != false || $ngo_fundraiser_heading_font_family != false || $ngo_fundraiser_heading_font_size != false){
        $ngo_fundraiser_theme_css .='h1, h2, h3, h4, h5, h6, .navbar-brand h1.site-title, h2.entry-title, h1.entry-title, h2.page-title, #latest_post h2, h2.woocommerce-loop-product__title, #colophon h5, .sidebar h5, .article-box h3.entry-title, #top-slider .slider-inner-box h3, .about h3.main-heading, #top-slider .slider-inner-box h4, .ser-content h4 a{';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_heading_color).'!important; 
            font-family: '.esc_attr($ngo_fundraiser_heading_font_family).'!important;
            font-size: '.esc_attr($ngo_fundraiser_heading_font_size).'px !important;';
        $ngo_fundraiser_theme_css .='}';
    }

    $ngo_fundraiser_paragraph_color = get_theme_mod('ngo_fundraiser_paragraph_color');
    $ngo_fundraiser_paragraph_font_family = get_theme_mod('ngo_fundraiser_paragraph_font_family');
    $ngo_fundraiser_paragraph_font_size = get_theme_mod('ngo_fundraiser_paragraph_font_size');
    if($ngo_fundraiser_paragraph_color != false || $ngo_fundraiser_paragraph_font_family != false || $ngo_fundraiser_paragraph_font_size != false){
        $ngo_fundraiser_theme_css .='p, p.site-title, span, .article-box p, ul, li{';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_paragraph_color).'!important; 
            font-family: '.esc_attr($ngo_fundraiser_paragraph_font_family).'!important;
            font-size: '.esc_attr($ngo_fundraiser_paragraph_font_size).'px !important;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*---------------- Logo CSS ----------------------*/
    $ngo_fundraiser_logo_title_font_size = get_theme_mod( 'ngo_fundraiser_logo_title_font_size');
    $ngo_fundraiser_logo_tagline_font_size = get_theme_mod( 'ngo_fundraiser_logo_tagline_font_size');
    if( $ngo_fundraiser_logo_title_font_size != '') {
        $ngo_fundraiser_theme_css .='#masthead .navbar-brand a{';
            $ngo_fundraiser_theme_css .='font-size: '. $ngo_fundraiser_logo_title_font_size. 'px;';
        $ngo_fundraiser_theme_css .='}';
    }
    if( $ngo_fundraiser_logo_tagline_font_size != '') {
        $ngo_fundraiser_theme_css .='#masthead .navbar-brand p{';
            $ngo_fundraiser_theme_css .='font-size: '. $ngo_fundraiser_logo_tagline_font_size. 'px;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*------------------ Slider CSS -------------------*/

    $ngo_fundraiser_slider_content_layout = get_theme_mod( 'ngo_fundraiser_slider_content_layout','Left');
    if($ngo_fundraiser_slider_content_layout == 'Left'){
        $ngo_fundraiser_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $ngo_fundraiser_theme_css .='text-align : left;';
        $ngo_fundraiser_theme_css .='}';
    }
    if($ngo_fundraiser_slider_content_layout == 'Center'){
        $ngo_fundraiser_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $ngo_fundraiser_theme_css .='text-align : center;';
        $ngo_fundraiser_theme_css .='}';
    }
    if($ngo_fundraiser_slider_content_layout == 'Right'){
        $ngo_fundraiser_theme_css .='.slider-inner-box, #top-slider .slider-inner-box p{';
            $ngo_fundraiser_theme_css .='text-align : right;';
        $ngo_fundraiser_theme_css .='}';
    }

    /*------------------ Footer CSS -------------------*/
    $ngo_fundraiser_footer_bg_color = get_theme_mod( 'ngo_fundraiser_footer_bg_color');
    if($ngo_fundraiser_footer_bg_color != '' ){
        $ngo_fundraiser_theme_css .='#colophon {';
            $ngo_fundraiser_theme_css .='background-color: '.esc_attr($ngo_fundraiser_footer_bg_color).'; ';
        $ngo_fundraiser_theme_css .='}';
    }

    $ngo_fundraiser_footer_content_color = get_theme_mod( 'ngo_fundraiser_footer_content_color');
    if($ngo_fundraiser_footer_content_color != ''){
        $ngo_fundraiser_theme_css .='#colophon, #colophon a, #colophon h5, #colophon .widget #wp-calendar caption {';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_footer_content_color).';';
        $ngo_fundraiser_theme_css .='}';
    }

    /*------------------ Copyright CSS -------------------*/
    $ngo_fundraiser_copyright_text_color = get_theme_mod( 'ngo_fundraiser_copyright_text_color');
    if($ngo_fundraiser_copyright_text_color != ''){
        $ngo_fundraiser_theme_css .='#colophon .site-info a, #colophon .site-info span {';
            $ngo_fundraiser_theme_css .='color: '.esc_attr($ngo_fundraiser_copyright_text_color).';';
        $ngo_fundraiser_theme_css .='}';
    }