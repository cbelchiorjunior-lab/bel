<?php
/**
 * Template de arquivo/categoria — Cristologia Teológica
 */
get_header();

// Título e descrição do arquivo
$arch_title = '';
$arch_desc  = '';
$arch_label = 'Arquivo';

if ( is_category() ) {
    $arch_label = 'Categoria';
    $arch_title = single_cat_title( '', false );
    $arch_desc  = category_description();
} elseif ( is_tag() ) {
    $arch_label = 'Tag';
    $arch_title = single_tag_title( '', false );
    $arch_desc  = tag_description();
} elseif ( is_author() ) {
    $arch_label = 'Autor';
    $arch_title = get_the_author();
    $arch_desc  = get_the_author_meta( 'description' );
} elseif ( is_year() ) {
    $arch_label = 'Ano';
    $arch_title = get_the_date( 'Y' );
} elseif ( is_month() ) {
    $arch_label = 'Mês';
    $arch_title = get_the_date( 'F \d\e Y' );
} elseif ( is_search() ) {
    $arch_label = 'Busca';
    $arch_title = get_search_query();
}
?>

<!-- CABEÇALHO DO ARQUIVO -->
<div class="ct-archive-header">
  <div class="ct-archive-header__inner">
    <p class="ct-archive-header__label"><?php echo esc_html( $arch_label ); ?></p>
    <h1 class="ct-archive-header__title"><?php echo esc_html( $arch_title ); ?></h1>
    <?php if ( $arch_desc ) : ?>
      <p class="ct-archive-header__desc"><?php echo wp_kses_post( $arch_desc ); ?></p>
    <?php endif; ?>
  </div>
</div>

<div class="ct-posts-section">
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
    <div style="text-align:center;padding:4rem 1.5rem;">
      <p style="font-size:1.1rem;color:var(--ct-muted);">Nenhum artigo encontrado.</p>
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>"
         style="display:inline-block;margin-top:1rem;background:var(--ct-primary);color:#fff!important;padding:.75rem 1.8rem;border-radius:4px;font-family:var(--ct-font-sans);font-weight:700;">
        ← Voltar ao início
      </a>
    </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
