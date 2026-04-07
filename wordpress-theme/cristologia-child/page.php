<?php
/**
 * Template de página estática — Cristologia Teológica
 */
get_header();
?>

<div class="site-content" style="max-width:820px;margin:0 auto;padding:3rem 1.5rem;">
  <?php while ( have_posts() ) : the_post(); ?>

  <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header style="margin-bottom:2.5rem;padding-bottom:1.5rem;border-bottom:1px solid var(--ct-border);">
      <h1 style="font-size:clamp(1.6rem,4vw,2.5rem);color:var(--ct-primary);margin-bottom:0;">
        <?php the_title(); ?>
      </h1>
    </header>

    <?php if ( has_post_thumbnail() ) : ?>
      <figure style="margin:0 0 2.5rem;">
        <?php the_post_thumbnail( 'ct-hero-img', array( 'style' => 'width:100%;border-radius:4px;box-shadow:0 8px 32px rgba(0,0,0,.12);', 'alt' => esc_attr( get_the_title() ) ) ); ?>
      </figure>
    <?php endif; ?>

    <div class="entry-content">
      <?php
      the_content();
      wp_link_pages( array(
          'before' => '<div class="page-links" style="margin:2rem 0;font-family:var(--ct-font-sans);">' . __( 'Páginas:', 'cristologia-child' ),
          'after'  => '</div>',
      ) );
      ?>
    </div>
  </article>

  <?php if ( comments_open() || get_comments_number() ) : ?>
    <div style="margin-top:3rem;"><?php comments_template(); ?></div>
  <?php endif; ?>

  <?php endwhile; ?>
</div>

<?php get_footer(); ?>
