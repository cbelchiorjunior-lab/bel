<?php
/**
 * Template da página inicial personalizada
 * Cristologia Teológica Child Theme
 */

get_header();
?>

<!-- HERO BANNER -->
<section class="ct-hero" aria-label="Apresentação do blog">
  <div class="ct-hero__inner">
    <h1 class="ct-hero__title">Cristologia Teológica</h1>
    <p class="ct-hero__subtitle">"Quem dizeis vós que eu sou?" — Mateus 16:15</p>
    <hr class="ct-hero__divider">
    <p style="color:rgba(255,255,255,.75);font-size:1.05rem;max-width:580px;margin:0 auto 2rem;">
      Estudos aprofundados sobre a pessoa, natureza e obra de Jesus Cristo à luz das Escrituras e da tradição teológica cristã.
    </p>
    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>" class="ct-hero__cta">
      Explorar artigos
    </a>
  </div>
</section>

<!-- TÓPICOS / CATEGORIAS -->
<?php
$categories = get_categories( array(
    'orderby'    => 'count',
    'order'      => 'DESC',
    'hide_empty' => true,
    'number'     => 10,
) );

if ( $categories ) : ?>
<section class="ct-topics" aria-label="Categorias">
  <div class="ct-topics__inner">
    <p class="ct-topics__title">Explore por tema</p>
    <div class="ct-topics__grid">
      <?php foreach ( $categories as $cat ) : ?>
        <a href="<?php echo esc_url( get_category_link( $cat->term_id ) ); ?>"
           class="ct-topics__tag">
          <?php echo esc_html( $cat->name ); ?>
          <span style="color:var(--ct-muted);font-weight:400;margin-left:.3em;">(<?php echo (int) $cat->count; ?>)</span>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- POSTS RECENTES -->
<div class="ct-posts-section">
  <div class="ct-posts-section__header">
    <h2 class="ct-posts-section__title">Artigos Recentes</h2>
    <div class="ct-posts-section__line" aria-hidden="true"></div>
    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ); ?>"
       style="font-family:var(--ct-font-sans);font-size:.82rem;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:var(--ct-gold);white-space:nowrap;">
      Ver todos →
    </a>
  </div>

  <?php
  $recent = new WP_Query( array(
      'posts_per_page' => 6,
      'post_status'    => 'publish',
  ) );

  if ( $recent->have_posts() ) :
  ?>
  <div class="ct-posts-grid">
    <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
    <article class="ct-post-card" id="post-<?php the_ID(); ?>">
      <?php if ( has_post_thumbnail() ) : ?>
        <a href="<?php the_permalink(); ?>" tabindex="-1" aria-hidden="true">
          <?php the_post_thumbnail( 'ct-card', array( 'class' => 'ct-post-card__thumb', 'loading' => 'lazy' ) ); ?>
        </a>
      <?php else : ?>
        <div class="ct-post-card__thumb-placeholder" aria-hidden="true">✝</div>
      <?php endif; ?>

      <div class="ct-post-card__body">
        <?php
        $cats = get_the_category();
        if ( $cats ) :
        ?>
          <a href="<?php echo esc_url( get_category_link( $cats[0]->term_id ) ); ?>"
             class="ct-post-card__category">
            <?php echo esc_html( $cats[0]->name ); ?>
          </a>
        <?php endif; ?>

        <h3 class="ct-post-card__title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>

        <p class="ct-post-card__excerpt">
          <?php echo wp_trim_words( get_the_excerpt(), 22, '…' ); ?>
        </p>

        <div class="ct-post-card__meta">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
            <?php echo get_the_date( 'd/m/Y' ); ?>
          </time>
          <span>·</span>
          <span><?php echo ct_reading_time(); ?></span>
          <a href="<?php the_permalink(); ?>" class="ct-post-card__read-more">
            Ler →
          </a>
        </div>
      </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
  <?php endif; ?>
</div>

<!-- CITAÇÃO BÍBLICA DE DESTAQUE -->
<section style="background:var(--ct-primary);padding:4rem 1.5rem;text-align:center;margin-bottom:0;">
  <div style="max-width:700px;margin:0 auto;">
    <blockquote style="border:none;background:none;color:rgba(255,255,255,.9);font-size:1.3rem;font-style:italic;padding:0;margin:0;">
      <p style="margin-bottom:.8em;">"Ele é a imagem do Deus invisível, o primogênito de toda a criação."</p>
      <cite style="color:var(--ct-gold-light);font-size:.95rem;font-style:normal;">Colossenses 1:15</cite>
    </blockquote>
  </div>
</section>

<?php get_footer(); ?>
