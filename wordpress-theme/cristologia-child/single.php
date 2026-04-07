<?php
/**
 * Template de post individual
 * Cristologia Teológica Child Theme
 */

get_header();
?>

<div class="site-content">
  <div class="content-area" style="max-width:820px;margin:0 auto;padding:3rem 1.5rem;">

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class( 'ct-article' ); ?>>

      <!-- Cabeçalho do artigo -->
      <header class="ct-article-header">
        <?php
        $cats = get_the_category();
        if ( $cats ) :
        ?>
          <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
             class="entry-category" style="font-family:var(--ct-font-sans);font-size:.78rem;font-weight:700;letter-spacing:.12em;text-transform:uppercase;color:var(--ct-gold);display:block;margin-bottom:.75rem;text-decoration:none;">
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
          <span><?php echo ct_reading_time(); ?></span>
        </div>
      </header>

      <!-- Imagem destacada -->
      <?php if ( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail" style="margin-bottom:2.5rem;border-radius:4px;overflow:hidden;box-shadow:0 8px 32px rgba(0,0,0,.12);">
          <?php the_post_thumbnail( 'ct-hero', array( 'style' => 'width:100%;height:auto;' ) ); ?>
        </div>
      <?php endif; ?>

      <!-- Conteúdo -->
      <div class="entry-content">
        <?php
        the_content( __( 'Continue lendo', 'cristologia-child' ) );
        wp_link_pages( array(
            'before' => '<div class="page-links">' . __( 'Páginas:', 'cristologia-child' ),
            'after'  => '</div>',
        ) );
        ?>
      </div>

      <!-- Tags -->
      <?php if ( has_tag() ) : ?>
        <footer class="entry-footer" style="margin-top:2rem;padding-top:1.5rem;border-top:1px solid var(--ct-border);">
          <div class="tags-links" style="font-family:var(--ct-font-sans);font-size:.82rem;color:var(--ct-muted);">
            <strong style="margin-right:.4rem;color:var(--ct-primary);">Tags:</strong>
            <?php the_tags( '', ' ', '' ); ?>
          </div>
        </footer>
      <?php endif; ?>

    </article>

    <!-- Navegação entre posts -->
    <nav class="post-navigation" style="margin-top:3rem;display:flex;gap:1rem;justify-content:space-between;flex-wrap:wrap;">
      <?php
      $prev = get_previous_post();
      $next = get_next_post();
      if ( $prev ) :
      ?>
        <a href="<?php echo esc_url( get_permalink( $prev ) ); ?>"
           style="flex:1;min-width:220px;padding:1.2rem;background:var(--ct-white);border:1px solid var(--ct-border);border-radius:4px;text-decoration:none;transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)'"
           onmouseout="this.style.boxShadow='none'">
          <span style="display:block;font-family:var(--ct-font-sans);font-size:.72rem;text-transform:uppercase;letter-spacing:.1em;color:var(--ct-muted);margin-bottom:.4rem;">← Anterior</span>
          <span style="color:var(--ct-primary);font-weight:bold;font-size:.95rem;"><?php echo esc_html( get_the_title( $prev ) ); ?></span>
        </a>
      <?php endif;
      if ( $next ) :
      ?>
        <a href="<?php echo esc_url( get_permalink( $next ) ); ?>"
           style="flex:1;min-width:220px;padding:1.2rem;background:var(--ct-white);border:1px solid var(--ct-border);border-radius:4px;text-decoration:none;text-align:right;transition:box-shadow .2s;"
           onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)'"
           onmouseout="this.style.boxShadow='none'">
          <span style="display:block;font-family:var(--ct-font-sans);font-size:.72rem;text-transform:uppercase;letter-spacing:.1em;color:var(--ct-muted);margin-bottom:.4rem;">Próximo →</span>
          <span style="color:var(--ct-primary);font-weight:bold;font-size:.95rem;"><?php echo esc_html( get_the_title( $next ) ); ?></span>
        </a>
      <?php endif; ?>
    </nav>

    <!-- Comentários -->
    <?php if ( comments_open() || get_comments_number() ) : ?>
      <div style="margin-top:3rem;">
        <?php comments_template(); ?>
      </div>
    <?php endif; ?>

    <?php endwhile; ?>

  </div>
</div>

<?php get_footer(); ?>
