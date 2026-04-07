<?php
/**
 * Template de resultados de busca — Cristologia Teológica
 */
get_header();
?>

<!-- CABEÇALHO DA BUSCA -->
<div class="ct-archive-header">
  <div class="ct-archive-header__inner">
    <p class="ct-archive-header__label">Resultado da busca</p>
    <h1 class="ct-archive-header__title">
      "<?php echo esc_html( get_search_query() ); ?>"
    </h1>
    <p class="ct-archive-header__desc">
      <?php
      global $wp_query;
      echo (int) $wp_query->found_posts;
      echo $wp_query->found_posts === 1 ? ' artigo encontrado' : ' artigos encontrados';
      ?>
    </p>
  </div>
</div>

<div class="ct-posts-section">
  <!-- Caixa de nova busca -->
  <div style="max-width:480px;margin-bottom:2.5rem;">
    <?php get_search_form(); ?>
  </div>

  <?php if ( have_posts() ) : ?>
    <div class="ct-posts-grid">
      <?php while ( have_posts() ) : the_post(); ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class( 'ct-post-card' ); ?>>
          <?php if ( has_post_thumbnail() ) : ?>
            <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
              <?php the_post_thumbnail( 'ct-card', array( 'class' => 'ct-post-card__thumb', 'loading' => 'lazy', 'alt' => esc_attr( get_the_title() ) ) ); ?>
            </a>
          <?php else : ?>
            <div class="ct-post-card__thumb-placeholder" aria-hidden="true">✝</div>
          <?php endif; ?>

          <div class="ct-post-card__body">
            <?php $cats = get_the_category(); if ( $cats ) : ?>
              <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
                 class="ct-post-card__category"><?php echo esc_html( $cats[0]->name ); ?></a>
            <?php endif; ?>

            <h2 class="ct-post-card__title">
              <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </h2>
            <p class="ct-post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>
            <div class="ct-post-card__meta">
              <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'd/m/Y' ); ?></time>
              <span>·</span>
              <span><?php echo ct_reading_time(); ?></span>
              <a href="<?php the_permalink(); ?>" class="ct-post-card__read-more">Ler →</a>
            </div>
          </div>
        </article>
      <?php endwhile; ?>
    </div>

    <?php the_posts_pagination( array(
        'prev_text' => '← Anterior',
        'next_text' => 'Próxima →',
    ) ); ?>

  <?php else : ?>
    <div style="text-align:center;padding:3rem 1.5rem;">
      <p style="font-size:1.1rem;color:var(--ct-muted);margin-bottom:1.5rem;">
        Nenhum resultado para "<strong><?php echo esc_html( get_search_query() ); ?></strong>".
      </p>
      <p style="color:var(--ct-muted);font-size:.95rem;">Tente palavras como: cristologia, encarnação, trindade, soteriologia…</p>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
