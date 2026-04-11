<?php
/**
 * Template de post individual — Cristologia Teológica
 */
get_header();
?>
<div class="site-content" style="max-width:820px;margin:0 auto;padding:2.5rem 1.5rem;">

  <?php while ( have_posts() ) : the_post(); ?>

  <?php ct_breadcrumb(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class( 'ct-article' ); ?>>

    <!-- CABEÇALHO -->
    <header style="margin-bottom:2rem;padding-bottom:1.5rem;border-bottom:1px solid var(--ct-border);">
      <?php
      $cats = get_the_category();
      if ( $cats ) :
      ?>
        <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
           style="font-family:var(--ct-font-sans);font-size:.72rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--ct-gold);display:block;margin-bottom:.75rem;text-decoration:none;">
          <?php echo esc_html( $cats[0]->name ); ?>
        </a>
      <?php endif; ?>

      <h1 class="entry-title"><?php the_title(); ?></h1>

      <div class="ct-article-meta">
        <span class="author-name"><?php the_author(); ?></span>
        <span>·</span>
        <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
          <?php echo get_the_date( 'd \d\e F \d\e Y' ); ?>
        </time>
        <span>·</span>
        <span><?php echo ct_reading_time(); ?> de leitura</span>
        <?php if ( get_comments_number() > 0 ) : ?>
          <span>·</span>
          <a href="#comments" style="color:var(--ct-muted);">
            <?php echo get_comments_number(); ?> comentário<?php echo get_comments_number() !== 1 ? 's' : ''; ?>
          </a>
        <?php endif; ?>
      </div>
    </header>

    <!-- IMAGEM DESTACADA -->
    <?php if ( has_post_thumbnail() ) : ?>
      <figure class="post-thumbnail" style="margin:0 0 2.5rem;">
        <?php the_post_thumbnail( 'ct-hero-img', array( 'style' => 'width:100%;height:auto;border-radius:4px;box-shadow:0 8px 32px rgba(0,0,0,.12);', 'alt' => esc_attr( get_the_title() ) ) ); ?>
      </figure>
    <?php endif; ?>

    <!-- CONTEÚDO -->
    <div class="entry-content">
      <?php
      the_content( __( 'Continuar lendo', 'cristologia-child' ) );
      wp_link_pages( array(
          'before' => '<div class="page-links" style="margin:2rem 0;font-family:var(--ct-font-sans);">' . __( 'Páginas:', 'cristologia-child' ),
          'after'  => '</div>',
      ) );
      ?>
    </div>

    <!-- RODAPÉ DO POST -->
    <footer style="margin-top:2.5rem;">
      <!-- Tags -->
      <?php if ( has_tag() ) : ?>
        <div class="tags-links" style="margin-bottom:1.5rem;">
          <span style="font-family:var(--ct-font-sans);font-size:.78rem;font-weight:700;color:var(--ct-muted);margin-right:.4rem;">Tags:</span>
          <?php the_tags( '', ' ', '' ); ?>
        </div>
      <?php endif; ?>

      <!-- Compartilhamento -->
      <?php ct_share_buttons(); ?>
    </footer>

  </article>

  <!-- NAVEGAÇÃO PREV / NEXT -->
  <?php
  $prev = get_previous_post();
  $next = get_next_post();
  if ( $prev || $next ) :
  ?>
  <nav class="ct-post-nav" aria-label="Navegação entre posts">
    <?php if ( $prev ) : ?>
      <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>" class="ct-post-nav__item">
        <span class="ct-post-nav__dir">← Artigo anterior</span>
        <span class="ct-post-nav__title"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
      </a>
    <?php endif; ?>
    <?php if ( $next ) : ?>
      <a href="<?php echo esc_url( get_permalink( $next ) ); ?>" class="ct-post-nav__item" style="text-align:right;">
        <span class="ct-post-nav__dir">Próximo artigo →</span>
        <span class="ct-post-nav__title"><?php echo esc_html( get_the_title( $next ) ); ?></span>
      </a>
    <?php endif; ?>
  </nav>
  <?php endif; ?>

  <!-- POSTS RELACIONADOS -->
  <?php
  $cats = get_the_category();
  if ( $cats ) :
    $related = new WP_Query( array(
        'category__in'   => array( $cats[0]->term_id ),
        'posts_per_page' => 3,
        'post__not_in'   => array( get_the_ID() ),
        'post_status'    => 'publish',
        'orderby'        => 'rand',
    ) );
    if ( $related->have_posts() ) :
  ?>
  <section style="margin-top:3rem;padding:2rem;background:var(--ct-white);border:1px solid var(--ct-border);border-radius:4px;">
    <h3 style="font-size:1rem;margin-bottom:1.5rem;padding-bottom:.75rem;border-bottom:2px solid var(--ct-gold);display:inline-block;">
      Leia também
    </h3>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:1.2rem;">
      <?php while ( $related->have_posts() ) : $related->the_post(); ?>
        <a href="<?php the_permalink(); ?>"
           style="display:block;padding:.9rem;background:var(--ct-bg);border:1px solid var(--ct-border);border-radius:4px;color:var(--ct-primary)!important;font-size:.92rem;font-weight:bold;line-height:1.4;text-decoration:none;transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)'"
           onmouseout="this.style.boxShadow='none'">
          <?php the_title(); ?>
        </a>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>
  </section>
  <?php endif; endif; ?>

  <!-- COMENTÁRIOS -->
  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div id="comments" style="margin-top:3rem;">
      <?php comments_template(); ?>
    </div>
  <?php endif; ?>

  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
