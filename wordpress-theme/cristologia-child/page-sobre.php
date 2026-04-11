<?php
/**
 * Template Name: Página Sobre
 * Template Post Type: page
 *
 * Cristologia Teológica — Página Sobre o Autor
 */
get_header();
$author = ct_author();
$book   = ct_book();
?>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--ct-dark),var(--ct-primary));padding:4rem 1.5rem 3rem;text-align:center;">
  <div style="max-width:700px;margin:0 auto;">
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ct-gold-light);margin-bottom:.8rem;">Conheça o autor</p>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:.5rem;"><?php echo esc_html( $author['name'] ); ?></h1>
    <p style="color:rgba(255,255,255,.65);font-size:1.05rem;"><?php echo esc_html( $author['title'] ); ?></p>
  </div>
</div>

<div style="max-width:900px;margin:0 auto;padding:4rem 1.5rem;">

  <!-- FOTO + ESTATÍSTICAS -->
  <div class="ct-author-profile">
    <div class="ct-author-profile__photo-wrap">
      <img src="<?php echo esc_url( ct_author_photo_url() ); ?>"
           alt="<?php echo esc_attr( $author['name'] ); ?>"
           class="ct-author-profile__photo"
           onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
      <div class="ct-author-profile__placeholder" style="display:none;">C</div>
    </div>
    <div class="ct-author-profile__summary">
      <p class="ct-author-profile__bio-short"><?php echo esc_html( $author['bio_short'] ); ?></p>
      <div class="ct-author-profile__stats">
        <div class="ct-author-profile__stat">
          <strong>130+</strong>
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
      <?php if ( ! empty( $author['youtube'] ) ) : ?>
      <div style="margin-top:1.5rem;">
        <a href="<?php echo esc_url( $author['youtube'] ); ?>"
           target="_blank" rel="noopener"
           style="display:inline-flex;align-items:center;gap:.5rem;background:#ff0000;color:#fff!important;padding:.6rem 1.4rem;border-radius:2px;font-family:var(--ct-font-sans);font-weight:700;font-size:.85rem;text-decoration:none;">
          ▶ Canal no YouTube
        </a>
      </div>
      <?php endif; ?>
    </div>
  </div>

  <!-- DIVIDER -->
  <hr style="border:none;border-top:1px solid var(--ct-border);margin:3rem 0;">

  <!-- BIOGRAFIA COMPLETA -->
  <div class="entry-content">
    <?php
    // Se a página tiver conteúdo editado, mostra ele. Senão, usa a bio completa do código.
    if ( have_posts() ) {
        the_post();
        $content = get_the_content();
        if ( trim( $content ) ) {
            the_content();
        } else {
            // Bio completa embutida no código
            $paragraphs = explode( "\n\n", $author['bio_full'] );
            foreach ( $paragraphs as $p ) {
                echo '<p>' . esc_html( trim( $p ) ) . '</p>';
            }
        }
    }
    ?>
  </div>

  <!-- LIVRO DO AUTOR -->
  <div style="margin-top:4rem;padding-top:2rem;border-top:1px solid var(--ct-border);">
    <h2 style="font-size:1.4rem;color:var(--ct-primary);margin-bottom:2rem;">Obra publicada</h2>
    <div style="display:flex;gap:1.5rem;align-items:flex-start;background:var(--ct-white);border:1px solid var(--ct-border);border-radius:4px;padding:2rem;box-shadow:var(--ct-shadow);">
      <?php if ( ! empty( $book['cover_url'] ) ) : ?>
        <img src="<?php echo esc_url( $book['cover_url'] ); ?>"
             alt="<?php echo esc_attr( $book['title'] ); ?>"
             style="width:100px;height:auto;border-radius:2px;box-shadow:0 4px 16px rgba(0,0,0,.18);flex-shrink:0;">
      <?php else : ?>
        <div style="width:100px;height:140px;background:linear-gradient(135deg,var(--ct-primary),#2a3f6b);border-radius:2px;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:2.5rem;flex-shrink:0;">📖</div>
      <?php endif; ?>
      <div>
        <strong style="color:var(--ct-primary);font-size:1.15rem;display:block;margin-bottom:.2rem;"><?php echo esc_html( $book['title'] ); ?></strong>
        <span style="font-family:var(--ct-font-sans);font-size:.72rem;color:var(--ct-gold);font-weight:700;text-transform:uppercase;letter-spacing:.08em;display:block;margin-bottom:.75rem;">Disponível agora · <?php echo esc_html( $book['genre'] ); ?></span>
        <p style="font-size:.92rem;color:var(--ct-muted);margin:0 0 1.2rem;line-height:1.7;"><?php echo esc_html( $book['desc_long'] ); ?></p>
        <a href="<?php echo esc_url( $book['buy_url'] ); ?>"
           target="_blank" rel="noopener"
           style="display:inline-block;background:var(--ct-gold);color:var(--ct-dark)!important;padding:.65rem 1.6rem;border-radius:2px;font-family:var(--ct-font-sans);font-size:.85rem;font-weight:700;letter-spacing:.05em;text-transform:uppercase;">
          🛒 Comprar agora
        </a>
        <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'livros' ) ) ); ?>"
           style="display:inline-block;margin-left:.8rem;font-family:var(--ct-font-sans);font-size:.85rem;font-weight:600;color:var(--ct-primary)!important;">
          Ver página do livro →
        </a>
      </div>
    </div>
  </div>

</div>

<?php get_footer(); ?>
