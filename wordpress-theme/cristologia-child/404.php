<?php
/**
 * Template 404 — Cristologia Teológica
 */
get_header();
?>

<div class="ct-404">
  <div class="ct-404__icon">✝</div>
  <h1 class="ct-404__title">Página não encontrada</h1>
  <p class="ct-404__desc">
    "Busca e encontrarás" — mas esta página não existe mais, ou o endereço foi digitado incorretamente.
  </p>

  <?php get_search_form(); ?>

  <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="ct-404__btn" style="margin-top:1.5rem;display:inline-block;">
    ← Voltar ao início
  </a>

  <?php
  // Mostrar últimos posts como sugestão
  $recent = new WP_Query( array( 'posts_per_page' => 4, 'post_status' => 'publish' ) );
  if ( $recent->have_posts() ) :
  ?>
  <div style="margin-top:3rem;text-align:left;">
    <h2 style="font-size:1.1rem;color:var(--ct-primary);margin-bottom:1.2rem;">Artigos recentes</h2>
    <ul style="list-style:none;margin:0;padding:0;">
      <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
        <li style="padding:.55rem 0;border-bottom:1px solid var(--ct-border);">
          <a href="<?php the_permalink(); ?>"
             style="color:var(--ct-text);font-size:.95rem;">
            <?php the_title(); ?>
          </a>
        </li>
      <?php endwhile; wp_reset_postdata(); ?>
    </ul>
  </div>
  <?php endif; ?>
</div>

<?php get_footer(); ?>
