<?php
/**
 * Template Name: Página Livros
 * Template Post Type: page
 *
 * Cristologia Teológica — Página de Livros
 */
get_header();

$buy_url    = get_theme_mod( 'ct_book_buy_url', '#' );
$book_cover = get_theme_mod( 'ct_book_cover_url', '' );
$book_desc  = get_theme_mod( 'ct_book_desc', 'Uma investigação histórica e teológica sobre a relação entre o Império Romano e o movimento cristão primitivo, revelando como a perseguição forjou a identidade da Igreja e a fé dos primeiros cristãos.' );
?>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--ct-dark),var(--ct-primary));padding:4rem 1.5rem 3rem;text-align:center;">
  <div style="max-width:700px;margin:0 auto;">
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ct-gold-light);margin-bottom:.8rem;">Biblioteca</p>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:.5rem;">Livros</h1>
    <p style="color:rgba(255,255,255,.65);">Obras para aprofundar seu conhecimento teológico</p>
  </div>
</div>

<div style="max-width:1100px;margin:0 auto;padding:4rem 1.5rem;">

  <!-- ====== LIVRO PRINCIPAL ====== -->
  <div class="ct-book-page__featured">
    <div class="ct-book-page__cover-col">
      <?php if ( $book_cover ) : ?>
        <img src="<?php echo esc_url( $book_cover ); ?>"
             alt="Roma Contra Cristo"
             class="ct-book-page__cover">
      <?php else : ?>
        <div class="ct-book-page__cover-placeholder">
          <span>📖</span>
          <strong>Roma<br>Contra<br>Cristo</strong>
        </div>
      <?php endif; ?>
    </div>

    <div class="ct-book-page__info-col">
      <span class="ct-book-page__tag">Disponível agora</span>
      <h2 class="ct-book-page__title">Roma Contra Cristo</h2>
      <p class="ct-book-page__author">por <?php echo esc_html( get_theme_mod( 'ct_author_name', get_bloginfo( 'name' ) ) ); ?></p>
      <p class="ct-book-page__desc"><?php echo esc_html( $book_desc ); ?></p>

      <div class="ct-book-page__meta">
        <div class="ct-book-page__meta-item">
          <span class="ct-book-page__meta-label">Gênero</span>
          <span>Teologia Histórica / Apologética</span>
        </div>
        <div class="ct-book-page__meta-item">
          <span class="ct-book-page__meta-label">Idioma</span>
          <span>Português</span>
        </div>
      </div>

      <?php if ( $buy_url && $buy_url !== '#' ) : ?>
      <a href="<?php echo esc_url( $buy_url ); ?>"
         target="_blank" rel="noopener"
         class="ct-book-page__btn-buy">
        🛒 Comprar agora
      </a>
      <?php else : ?>
      <p style="font-family:var(--ct-font-sans);font-size:.85rem;color:var(--ct-muted);font-style:italic;">
        Configure o link de compra em Aparência → Personalizar → Configurações do Livro.
      </p>
      <?php endif; ?>

      <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'material-gratis' ) ) ); ?>"
         class="ct-book-page__btn-sample">
        📄 Ler amostra grátis
      </a>
    </div>
  </div>

  <!-- ====== PRÓXIMOS LANÇAMENTOS ====== -->
  <div style="margin-top:5rem;">
    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
      <h2 style="font-size:1.35rem;color:var(--ct-primary);margin:0;white-space:nowrap;">Próximos lançamentos</h2>
      <div style="flex:1;height:1px;background:var(--ct-border);"></div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">

      <!-- Julho 2025 -->
      <div class="ct-book-upcoming-card">
        <div class="ct-book-upcoming-card__cover">
          <span>📖</span>
          <div class="ct-book-upcoming-card__ribbon">Julho 2025</div>
        </div>
        <div class="ct-book-upcoming-card__body">
          <h3 class="ct-book-upcoming-card__title">Em breve…</h3>
          <p class="ct-book-upcoming-card__desc">Novo título a ser anunciado. Cadastre seu e-mail para ser o primeiro a saber quando lançar.</p>
          <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'material-gratis' ) ) ); ?>"
             class="ct-book-upcoming-card__notify">
            🔔 Me avise no lançamento
          </a>
        </div>
      </div>

      <!-- Dezembro 2025 -->
      <div class="ct-book-upcoming-card">
        <div class="ct-book-upcoming-card__cover">
          <span>📖</span>
          <div class="ct-book-upcoming-card__ribbon">Dezembro 2025</div>
        </div>
        <div class="ct-book-upcoming-card__body">
          <h3 class="ct-book-upcoming-card__title">Em breve…</h3>
          <p class="ct-book-upcoming-card__desc">Mais uma obra para aprofundar seu estudo teológico. Fique atento às novidades.</p>
          <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'material-gratis' ) ) ); ?>"
             class="ct-book-upcoming-card__notify">
            🔔 Me avise no lançamento
          </a>
        </div>
      </div>

    </div>
  </div>

</div>

<?php get_footer(); ?>
