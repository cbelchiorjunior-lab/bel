<?php
/**
 * Template Name: Página Sobre
 * Template Post Type: page
 *
 * Cristologia Teológica — Página Sobre o Autor
 */
get_header();
?>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--ct-dark),var(--ct-primary));padding:4rem 1.5rem 3rem;text-align:center;">
  <div style="max-width:700px;margin:0 auto;">
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ct-gold-light);margin-bottom:.8rem;">Conheça o autor</p>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:.5rem;"><?php echo esc_html( get_theme_mod( 'ct_author_name', get_the_title() ) ); ?></h1>
    <p style="color:rgba(255,255,255,.65);font-size:1.05rem;"><?php echo esc_html( get_theme_mod( 'ct_author_title', 'Teólogo, escritor e pesquisador de cristologia' ) ); ?></p>
  </div>
</div>

<div style="max-width:900px;margin:0 auto;padding:4rem 1.5rem;">

  <!-- FOTO + BIO CURTA -->
  <div class="ct-author-profile">
    <div class="ct-author-profile__photo-wrap">
      <?php
      $author_photo = get_theme_mod( 'ct_author_photo_url', '' );
      if ( $author_photo ) :
      ?>
        <img src="<?php echo esc_url( $author_photo ); ?>"
             alt="Foto do autor"
             class="ct-author-profile__photo">
      <?php else : ?>
        <div class="ct-author-profile__placeholder">👤</div>
      <?php endif; ?>
    </div>
    <div class="ct-author-profile__summary">
      <p class="ct-author-profile__bio-short">
        <?php echo esc_html( get_theme_mod( 'ct_author_bio_short', 'Estudioso da teologia cristã com foco em cristologia e história da Igreja primitiva.' ) ); ?>
      </p>
      <div class="ct-author-profile__stats">
        <div class="ct-author-profile__stat">
          <strong><?php echo wp_count_posts()->publish; ?></strong>
          <span>Artigos publicados</span>
        </div>
        <div class="ct-author-profile__stat">
          <strong>1</strong>
          <span>Livro publicado</span>
        </div>
        <div class="ct-author-profile__stat">
          <strong>2025</strong>
          <span>2 novos lançamentos</span>
        </div>
      </div>
    </div>
  </div>

  <!-- DIVIDER -->
  <hr style="border:none;border-top:1px solid var(--ct-border);margin:3rem 0;">

  <!-- BIOGRAFIA COMPLETA (conteúdo da página) -->
  <div class="entry-content">
    <?php
    if ( have_posts() ) {
        the_post();
        $content = get_the_content();
        if ( $content ) {
            the_content();
        } else {
            // Placeholder enquanto o usuário não edita a página
            echo '<p style="color:var(--ct-muted);font-style:italic;">[ Edite esta página no WordPress e adicione sua biografia completa aqui. ]</p>';
        }
    }
    ?>
  </div>

  <!-- LIVROS DO AUTOR -->
  <div style="margin-top:4rem;padding-top:2rem;border-top:1px solid var(--ct-border);">
    <h2 style="font-size:1.4rem;color:var(--ct-primary);margin-bottom:2rem;">Obras publicadas</h2>
    <div style="display:flex;gap:2rem;flex-wrap:wrap;align-items:flex-start;">
      <div style="display:flex;gap:1.5rem;align-items:flex-start;flex:1;min-width:280px;background:var(--ct-white);border:1px solid var(--ct-border);border-radius:4px;padding:1.5rem;">
        <?php
        $book_cover = get_theme_mod( 'ct_book_cover_url', '' );
        if ( $book_cover ) :
        ?>
          <img src="<?php echo esc_url( $book_cover ); ?>" alt="Roma Contra Cristo" style="width:80px;height:auto;border-radius:2px;box-shadow:0 4px 12px rgba(0,0,0,.15);">
        <?php else : ?>
          <div style="width:80px;height:110px;background:var(--ct-primary);border-radius:2px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:2rem;flex-shrink:0;">📖</div>
        <?php endif; ?>
        <div>
          <strong style="color:var(--ct-primary);font-size:1rem;display:block;margin-bottom:.3rem;">Roma Contra Cristo</strong>
          <span style="font-family:var(--ct-font-sans);font-size:.78rem;color:var(--ct-gold);font-weight:700;text-transform:uppercase;letter-spacing:.08em;">Disponível</span>
          <p style="font-size:.88rem;color:var(--ct-muted);margin:.5rem 0 1rem;">
            <?php echo esc_html( get_theme_mod( 'ct_book_desc', 'Uma investigação histórica e teológica sobre a relação entre o Império Romano e o movimento cristão primitivo.' ) ); ?>
          </p>
          <?php $buy = get_theme_mod( 'ct_book_buy_url', '#' ); ?>
          <a href="<?php echo esc_url( $buy ); ?>" target="_blank" rel="noopener"
             style="display:inline-block;background:var(--ct-primary);color:#fff!important;padding:.5rem 1.2rem;border-radius:2px;font-family:var(--ct-font-sans);font-size:.82rem;font-weight:700;">
            🛒 Comprar
          </a>
        </div>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
