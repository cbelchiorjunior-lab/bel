<?php
/**
 * Cristologia Teológica Child Theme — functions.php
 */

// Enqueue estilos pai (Kadence) + filho
add_action( 'wp_enqueue_scripts', 'ct_enqueue_styles' );
function ct_enqueue_styles() {
    wp_enqueue_style(
        'kadence-parent-style',
        get_template_directory_uri() . '/style.css'
    );
    wp_enqueue_style(
        'cristologia-child-style',
        get_stylesheet_uri(),
        array( 'kadence-parent-style' ),
        wp_get_theme()->get( 'Version' )
    );
    // Google Fonts
    wp_enqueue_style(
        'ct-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Source+Sans+3:wght@400;600&display=swap',
        array(),
        null
    );
}

// Suporte a recursos do tema
add_action( 'after_setup_theme', 'ct_theme_setup' );
function ct_theme_setup() {
    // Thumbnails
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'ct-card', 600, 338, true );
    add_image_size( 'ct-hero', 1200, 600, true );

    // Título na aba do browser
    add_theme_support( 'title-tag' );

    // HTML5
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'
    ) );

    // Suporte a logo personalizada
    add_theme_support( 'custom-logo', array(
        'height'      => 80,
        'width'       => 240,
        'flex-height' => true,
        'flex-width'  => true,
    ) );

    // Editor de largura
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );

    // Menus de navegação
    register_nav_menus( array(
        'primary'  => __( 'Menu Principal', 'cristologia-child' ),
        'footer'   => __( 'Menu Rodapé', 'cristologia-child' ),
    ) );
}

// Registrar áreas de widgets
add_action( 'widgets_init', 'ct_widgets_init' );
function ct_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Barra Lateral', 'cristologia-child' ),
        'id'            => 'sidebar-1',
        'description'   => __( 'Barra lateral do blog.', 'cristologia-child' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Rodapé — Coluna 1', 'cristologia-child' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Rodapé — Coluna 2', 'cristologia-child' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );

    register_sidebar( array(
        'name'          => __( 'Rodapé — Coluna 3', 'cristologia-child' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget footer-widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ) );
}

// Trecho de leitura — tamanho
add_filter( 'excerpt_length', function() { return 30; }, 999 );
add_filter( 'excerpt_more', function() {
    return '&hellip; <a class="read-more" href="' . get_permalink() . '">' . __( 'Leia mais', 'cristologia-child' ) . '</a>';
} );

// Helper: tempo estimado de leitura
function ct_reading_time() {
    $content    = get_post_field( 'post_content', get_the_ID() );
    $word_count = str_word_count( strip_tags( $content ) );
    $minutes    = max( 1, (int) ceil( $word_count / 200 ) );
    return $minutes . ' min de leitura';
}

// Adicionar classe ao body para posts
add_filter( 'body_class', function( $classes ) {
    if ( is_singular( 'post' ) ) {
        $classes[] = 'ct-single-post';
    }
    return $classes;
} );

// Google Fonts via Playfair Display (override nas variáveis CSS)
add_action( 'wp_head', 'ct_custom_fonts_override' );
function ct_custom_fonts_override() {
    echo '<style>
    :root {
      --ct-font-serif: "Playfair Display", Georgia, serif;
      --ct-font-sans:  "Source Sans 3", "Segoe UI", sans-serif;
    }
    </style>';
}
