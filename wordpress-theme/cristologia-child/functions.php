<?php
/**
 * Cristologia Teológica Child Theme — functions.php
 * Versão 3.0 — Dados reais do autor e livro
 */

// ===================================================
// DADOS DO AUTOR E LIVRO — edite aqui
// ===================================================
function ct_author() {
    return array(
        'name'       => 'Carlos Belchior Júnior',
        'title'      => 'Economista, teólogo, apologista e escritor evangélico',
        'bio_short'  => 'Especializado em arqueologia bíblica, história da Igreja primitiva e apologética cristã. Criador do canal Cristologia Teológica no YouTube, onde desenvolve apologética baseada em fontes primárias e patrística. Colunista com mais de 130 artigos teológicos.',
        'bio_full'   => "Carlos Belchior Júnior é economista e teólogo, apologista e escritor evangélico com especialização em arqueologia bíblica, história da Igreja primitiva e apologética cristã. Estudante de pós-graduação em Teologia, Bíblia Avançada e Arqueologia, dedica sua pesquisa à interseção entre fé histórica e evidência documental, produzindo conteúdo que desafia tanto o ceticismo secular quanto a superficialidade religiosa.\n\nÉ criador do canal Cristologia Teológica no YouTube, onde desenvolve apologética evangélica baseada em fontes primárias, patrística e história documentada, alcançando cristãos que buscam uma fé intelectualmente fundamentada.\n\nColunista com mais de 130 artigos de assuntos teológicos, Carlos acredita que a fé cristã não teme o escrutínio histórico. Pelo contrário, é fortalecida por ele.",
        // Após fazer upload da foto no WordPress (Mídia → Adicionar nova),
        // cole a URL aqui:
        'photo_url'  => '',
        'photo_name' => 'carlos-belchior-junior.jpg', // nome do arquivo no tema
        'youtube'    => 'https://www.youtube.com/@cristologiateologica',
    );
}

function ct_book() {
    return array(
        'title'       => 'Roma Contra Cristo',
        'author'      => 'Carlos Belchior Júnior',
        'genre'       => 'Teologia Histórica / Apologética',
        'language'    => 'Português',
        'desc_short'  => 'O resultado de meses de estudo das perseguições romanas, das fontes que as documentaram e da teologia que sustentou a Igreja nos séculos em que o Império tentou apagá-la.',
        'desc_long'   => 'Uma obra que investiga a relação histórica e teológica entre o Império Romano e o movimento cristão primitivo, revelando como a perseguição forjou a identidade da Igreja. Roma Contra Cristo é o resultado de meses de estudo das perseguições romanas, das fontes que as documentaram e da teologia que sustentou a Igreja nos séculos em que o Império tentou apagá-la.',
        'buy_url'     => 'https://clubedeautores.com.br/livro/roma-contra-cristo',
        // Após fazer upload da capa no WordPress (Mídia → Adicionar nova),
        // cole a URL aqui:
        'cover_url'   => '',
    );
}

// Helper para foto do autor (usa arquivo local se não tiver URL do WP)
function ct_author_photo_url() {
    $author = ct_author();
    if ( ! empty( $author['photo_url'] ) ) {
        return $author['photo_url'];
    }
    // Foto local incluída no tema
    $local = get_stylesheet_directory_uri() . '/images/autor.jpg';
    return $local;
}

// ===================================================
// ENQUEUE — prioridade 999 para sobrescrever o Kadence
// ===================================================
add_action( 'wp_enqueue_scripts', 'ct_enqueue_styles', 999 );
function ct_enqueue_styles() {
    // Google Fonts (Playfair Display + Source Sans 3)
    wp_enqueue_style(
        'ct-google-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;0,900;1,400&family=Source+Sans+3:wght@400;600;700&display=swap',
        array(),
        null
    );

    // Estilo filho (depende apenas das Google Fonts, não do pai — Kadence enfileira o próprio css)
    wp_enqueue_style(
        'cristologia-child-style',
        get_stylesheet_uri(),
        array( 'ct-google-fonts' ),
        wp_get_theme()->get( 'Version' )
    );
}

// ===================================================
// SUPORTE A RECURSOS
// ===================================================
add_action( 'after_setup_theme', 'ct_theme_setup' );
function ct_theme_setup() {
    add_theme_support( 'post-thumbnails' );
    add_image_size( 'ct-card', 600, 338, true );
    add_image_size( 'ct-hero-img', 1200, 600, true );
    add_theme_support( 'title-tag' );
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
    add_theme_support( 'custom-logo', array( 'height' => 80, 'width' => 240, 'flex-height' => true, 'flex-width' => true ) );
    add_theme_support( 'editor-styles' );
    add_theme_support( 'wp-block-styles' );
    add_theme_support( 'align-wide' );
    add_theme_support( 'responsive-embeds' );

    register_nav_menus( array(
        'primary' => __( 'Menu Principal', 'cristologia-child' ),
        'footer'  => __( 'Menu Rodapé',    'cristologia-child' ),
    ) );
}

// ===================================================
// WIDGETS
// ===================================================
add_action( 'widgets_init', 'ct_widgets_init' );
function ct_widgets_init() {
    $defaults = array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    );

    register_sidebar( array_merge( $defaults, array(
        'name' => __( 'Barra Lateral', 'cristologia-child' ),
        'id'   => 'sidebar-1',
    ) ) );

    for ( $i = 1; $i <= 3; $i++ ) {
        register_sidebar( array_merge( $defaults, array(
            'name'         => sprintf( __( 'Rodapé — Coluna %d', 'cristologia-child' ), $i ),
            'id'           => "footer-{$i}",
            'before_title' => '<h4 class="widget-title">',
            'after_title'  => '</h4>',
        ) ) );
    }
}

// ===================================================
// EXCERPT
// ===================================================
add_filter( 'excerpt_length', function() { return 28; }, 999 );
add_filter( 'excerpt_more', function() {
    return '&hellip;';
} );

// ===================================================
// HELPER: TEMPO DE LEITURA
// ===================================================
function ct_reading_time( $post_id = null ) {
    $post_id    = $post_id ?: get_the_ID();
    $content    = get_post_field( 'post_content', $post_id );
    $word_count = str_word_count( wp_strip_all_tags( $content ) );
    $minutes    = max( 1, (int) ceil( $word_count / 200 ) );
    return $minutes . ' min';
}

// ===================================================
// HELPER: BREADCRUMB
// ===================================================
function ct_breadcrumb() {
    if ( is_front_page() ) {
        return;
    }
    echo '<nav class="ct-breadcrumb" aria-label="Breadcrumb">';
    echo '<a href="' . esc_url( home_url( '/' ) ) . '">Início</a>';
    if ( is_category() ) {
        echo '<span> / </span><span>' . single_cat_title( '', false ) . '</span>';
    } elseif ( is_single() ) {
        $cats = get_the_category();
        if ( $cats ) {
            echo '<span> / </span>';
            echo '<a href="' . esc_url( get_category_link( $cats[0]->term_id ) ) . '">' . esc_html( $cats[0]->name ) . '</a>';
        }
        echo '<span> / </span><span>' . get_the_title() . '</span>';
    } elseif ( is_page() ) {
        echo '<span> / </span><span>' . get_the_title() . '</span>';
    } elseif ( is_search() ) {
        echo '<span> / </span><span>Busca: ' . esc_html( get_search_query() ) . '</span>';
    }
    echo '</nav>';
}

// ===================================================
// HELPER: BOTÕES DE COMPARTILHAMENTO
// ===================================================
function ct_share_buttons() {
    $url    = urlencode( get_permalink() );
    $title  = urlencode( get_the_title() );
    $text   = urlencode( get_the_title() . ' — ' . get_permalink() );
    ?>
    <div class="ct-share">
        <p class="ct-share__label">Compartilhe este artigo</p>
        <div class="ct-share__buttons">
            <a href="https://api.whatsapp.com/send?text=<?php echo $text; ?>"
               target="_blank" rel="noopener noreferrer"
               class="ct-share__btn ct-share__btn--whatsapp">
                📱 WhatsApp
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $url; ?>"
               target="_blank" rel="noopener noreferrer"
               class="ct-share__btn ct-share__btn--facebook">
                👥 Facebook
            </a>
            <a href="https://twitter.com/intent/tweet?url=<?php echo $url; ?>&text=<?php echo $title; ?>"
               target="_blank" rel="noopener noreferrer"
               class="ct-share__btn ct-share__btn--twitter">
                🐦 Twitter
            </a>
            <button onclick="navigator.clipboard.writeText('<?php echo esc_js( get_permalink() ); ?>');this.textContent='✅ Copiado!';setTimeout(()=>this.textContent='🔗 Copiar link',2000);"
                    class="ct-share__btn ct-share__btn--copy">
                🔗 Copiar link
            </button>
        </div>
    </div>
    <?php
}

// ===================================================
// SEO — META TAGS OPEN GRAPH / TWITTER CARD
// ===================================================
add_action( 'wp_head', 'ct_seo_meta_tags', 1 );
function ct_seo_meta_tags() {
    if ( ! is_singular() ) {
        return;
    }

    global $post;
    $title       = get_the_title( $post );
    $description = '';

    if ( has_excerpt( $post ) ) {
        $description = wp_strip_all_tags( get_the_excerpt( $post ) );
    } else {
        $description = wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '' );
    }

    $image_url = '';
    if ( has_post_thumbnail( $post ) ) {
        $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'ct-hero-img' );
        $image_url = $thumb ? $thumb[0] : '';
    }
    if ( ! $image_url ) {
        $image_url = get_stylesheet_directory_uri() . '/screenshot.png';
    }

    $site_name = get_bloginfo( 'name' );
    $url       = get_permalink( $post );
    $locale    = 'pt_BR';

    // Open Graph
    echo '<meta property="og:type"        content="article" />' . "\n";
    echo '<meta property="og:title"       content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta property="og:description" content="' . esc_attr( $description ) . '" />' . "\n";
    echo '<meta property="og:url"         content="' . esc_url( $url ) . '" />' . "\n";
    echo '<meta property="og:site_name"   content="' . esc_attr( $site_name ) . '" />' . "\n";
    echo '<meta property="og:locale"      content="' . esc_attr( $locale ) . '" />' . "\n";
    if ( $image_url ) {
        echo '<meta property="og:image"   content="' . esc_url( $image_url ) . '" />' . "\n";
        echo '<meta property="og:image:width"  content="1200" />' . "\n";
        echo '<meta property="og:image:height" content="630" />' . "\n";
    }

    // Twitter Card
    echo '<meta name="twitter:card"        content="summary_large_image" />' . "\n";
    echo '<meta name="twitter:title"       content="' . esc_attr( $title ) . '" />' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr( $description ) . '" />' . "\n";
    if ( $image_url ) {
        echo '<meta name="twitter:image"   content="' . esc_url( $image_url ) . '" />' . "\n";
    }

    // Meta description padrão
    echo '<meta name="description" content="' . esc_attr( $description ) . '" />' . "\n";
}

// ===================================================
// SEO — SCHEMA.ORG PARA POSTS (JSON-LD)
// ===================================================
add_action( 'wp_footer', 'ct_schema_markup' );
function ct_schema_markup() {
    if ( ! is_singular( 'post' ) ) {
        return;
    }

    global $post;
    $author_name = get_the_author_meta( 'display_name', $post->post_author );
    $image_url   = '';
    if ( has_post_thumbnail( $post ) ) {
        $thumb     = wp_get_attachment_image_src( get_post_thumbnail_id( $post ), 'ct-hero-img' );
        $image_url = $thumb ? $thumb[0] : '';
    }

    $schema = array(
        '@context'         => 'https://schema.org',
        '@type'            => 'Article',
        'headline'         => get_the_title( $post ),
        'description'      => wp_trim_words( wp_strip_all_tags( $post->post_content ), 30, '' ),
        'datePublished'    => get_the_date( 'c', $post ),
        'dateModified'     => get_the_modified_date( 'c', $post ),
        'url'              => get_permalink( $post ),
        'inLanguage'       => 'pt-BR',
        'author'           => array(
            '@type' => 'Person',
            'name'  => $author_name,
        ),
        'publisher'        => array(
            '@type' => 'Organization',
            'name'  => get_bloginfo( 'name' ),
            'url'   => home_url(),
        ),
    );

    if ( $image_url ) {
        $schema['image'] = $image_url;
    }

    echo '<script type="application/ld+json">' . wp_json_encode( $schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES ) . '</script>' . "\n";
}

// ===================================================
// CLASSE BODY PARA POSTS
// ===================================================
add_filter( 'body_class', function( $classes ) {
    if ( is_singular( 'post' ) ) {
        $classes[] = 'ct-single-post';
    }
    return $classes;
} );

// ===================================================
// SEGURANÇA: REMOVER VERSÃO DO WORDPRESS DO HTML
// ===================================================
remove_action( 'wp_head', 'wp_generator' );
add_filter( 'the_generator', '__return_empty_string' );
