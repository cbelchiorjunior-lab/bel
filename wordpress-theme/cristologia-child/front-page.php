<?php
/**
 * Template da página inicial — Cristologia Teológica
 */
get_header();
?>

<!-- ======= HERO ======= -->
<section class="ct-hero" aria-label="Apresentação">
  <div class="ct-hero__inner">
    <h1 class="ct-hero__title">Cristologia Teológica</h1>
    <p class="ct-hero__subtitle">"Quem dizeis vós que eu sou?" — Mateus 16:15</p>
    <hr class="ct-hero__divider">
    <p class="ct-hero__desc">
      Estudos aprofundados sobre a pessoa, natureza e obra de Jesus Cristo à luz das Escrituras Sagradas e da tradição teológica cristã.
    </p>
    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
       class="ct-hero__cta">
      Explorar artigos
    </a>
  </div>
</section>

<!-- ======= MISSÃO ======= -->
<section class="ct-mission" aria-label="Missão do blog">
  <div class="ct-mission__inner">
    <p class="ct-mission__label">Nossa missão</p>
    <h2 class="ct-mission__title">Aprofundando o conhecimento de Cristo</h2>
    <p class="ct-mission__text">
      Acreditamos que o estudo sério e sistemático da cristologia é essencial para a fé cristã. Aqui você encontra artigos, reflexões e análises que conectam as grandes questões teológicas com a vida prática e a devoção pessoal.
    </p>
    <div class="ct-mission__pillars">
      <div class="ct-mission__pillar">
        <span class="ct-mission__pillar-icon">📖</span>
        <div class="ct-mission__pillar-title">Bíblico</div>
        <p class="ct-mission__pillar-desc">Fundamentado nas Escrituras, o texto sagrado como autoridade suprema.</p>
      </div>
      <div class="ct-mission__pillar">
        <span class="ct-mission__pillar-icon">✝</span>
        <div class="ct-mission__pillar-title">Cristocêntrico</div>
        <p class="ct-mission__pillar-desc">Jesus Cristo no centro de toda reflexão teológica e vida cristã.</p>
      </div>
      <div class="ct-mission__pillar">
        <span class="ct-mission__pillar-icon">🎓</span>
        <div class="ct-mission__pillar-title">Rigoroso</div>
        <p class="ct-mission__pillar-desc">Pesquisa séria, fontes confiáveis e argumentação cuidadosa.</p>
      </div>
      <div class="ct-mission__pillar">
        <span class="ct-mission__pillar-icon">🙏</span>
        <div class="ct-mission__pillar-title">Devocional</div>
        <p class="ct-mission__pillar-desc">Teologia que alimenta a alma e aprofunda a relação com Deus.</p>
      </div>
    </div>
  </div>
</section>

<!-- ======= CATEGORIAS ======= -->
<?php
$categories = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true, 'number' => 10 ) );
if ( $categories ) :
?>
<section class="ct-topics" aria-label="Tópicos">
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

<!-- ======= POSTS RECENTES ======= -->
<?php
$recent = new WP_Query( array( 'posts_per_page' => 6, 'post_status' => 'publish' ) );
if ( $recent->have_posts() ) :
?>
<section class="ct-posts-section" aria-label="Artigos recentes">
  <div class="ct-section-header">
    <h2 class="ct-section-title">Artigos Recentes</h2>
    <div class="ct-section-line" aria-hidden="true"></div>
    <a href="<?php echo esc_url( get_permalink( get_option( 'page_for_posts' ) ) ?: home_url( '/blog/' ) ); ?>"
       class="ct-section-more">Ver todos →</a>
  </div>
  <div class="ct-posts-grid">
    <?php while ( $recent->have_posts() ) : $recent->the_post(); ?>
    <article class="ct-post-card">
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

        <h3 class="ct-post-card__title">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h3>
        <p class="ct-post-card__excerpt"><?php echo wp_trim_words( get_the_excerpt(), 20, '…' ); ?></p>
        <div class="ct-post-card__meta">
          <time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo get_the_date( 'd/m/Y' ); ?></time>
          <span>·</span>
          <span><?php echo ct_reading_time(); ?></span>
          <a href="<?php the_permalink(); ?>" class="ct-post-card__read-more">Ler →</a>
        </div>
      </div>
    </article>
    <?php endwhile; wp_reset_postdata(); ?>
  </div>
</section>
<?php endif; ?>

<!-- ======= LIVRO EM DESTAQUE ======= -->
<section class="ct-book-feature" aria-label="Livro em destaque">
  <div class="ct-book-feature__inner">

    <!-- Livro principal -->
    <div class="ct-book-feature__main">
      <div class="ct-book-feature__cover-wrap">
        <?php
        $book_cover = get_theme_mod( 'ct_book_cover_url', '' );
        if ( $book_cover ) :
        ?>
          <img src="<?php echo esc_url( $book_cover ); ?>"
               alt="Roma Contra Cristo"
               class="ct-book-feature__cover">
        <?php else : ?>
          <div class="ct-book-feature__cover-placeholder">
            <span>📖</span>
            <small>Roma<br>Contra<br>Cristo</small>
          </div>
        <?php endif; ?>
        <div class="ct-book-feature__badge">Disponível agora</div>
      </div>

      <div class="ct-book-feature__info">
        <p class="ct-book-feature__label">Livro em destaque</p>
        <h2 class="ct-book-feature__title">Roma Contra Cristo</h2>
        <p class="ct-book-feature__author">por <?php bloginfo( 'name' ); ?></p>
        <p class="ct-book-feature__desc">
          <?php echo esc_html( get_theme_mod( 'ct_book_desc', 'Uma obra que investiga a relação histórica e teológica entre o Império Romano e o movimento cristão primitivo, revelando como a perseguição forjou a identidade da Igreja.' ) ); ?>
        </p>
        <div class="ct-book-feature__actions">
          <?php
          $buy_link = get_theme_mod( 'ct_book_buy_url', '#' );
          ?>
          <a href="<?php echo esc_url( $buy_link ); ?>"
             class="ct-book-feature__btn-buy"
             target="_blank" rel="noopener">
            🛒 Comprar agora
          </a>
          <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'livros' ) ) ); ?>"
             class="ct-book-feature__btn-more">
            Ver todos os livros →
          </a>
        </div>
      </div>
    </div>

    <!-- Próximos lançamentos -->
    <div class="ct-book-feature__upcoming">
      <p class="ct-book-upcoming__label">Próximos lançamentos</p>
      <div class="ct-book-upcoming__grid">
        <div class="ct-book-upcoming__item">
          <div class="ct-book-upcoming__cover">📖</div>
          <div class="ct-book-upcoming__info">
            <span class="ct-book-upcoming__date">Julho 2025</span>
            <p class="ct-book-upcoming__title">Em breve…</p>
            <p class="ct-book-upcoming__hint">Cadastre seu e-mail para ser avisado</p>
          </div>
        </div>
        <div class="ct-book-upcoming__item">
          <div class="ct-book-upcoming__cover">📖</div>
          <div class="ct-book-upcoming__info">
            <span class="ct-book-upcoming__date">Dezembro 2025</span>
            <p class="ct-book-upcoming__title">Em breve…</p>
            <p class="ct-book-upcoming__hint">Cadastre seu e-mail para ser avisado</p>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ======= AUTOR ======= -->
<section class="ct-author-home" aria-label="Sobre o autor">
  <div class="ct-author-home__inner">
    <div class="ct-author-home__photo-wrap">
      <?php
      $author_photo = get_theme_mod( 'ct_author_photo_url', '' );
      if ( $author_photo ) :
      ?>
        <img src="<?php echo esc_url( $author_photo ); ?>"
             alt="Foto do autor"
             class="ct-author-home__photo">
      <?php else : ?>
        <div class="ct-author-home__photo-placeholder">👤</div>
      <?php endif; ?>
    </div>
    <div class="ct-author-home__content">
      <p class="ct-author-home__label">Sobre o autor</p>
      <h2 class="ct-author-home__name"><?php echo esc_html( get_theme_mod( 'ct_author_name', get_bloginfo( 'name' ) ) ); ?></h2>
      <p class="ct-author-home__title"><?php echo esc_html( get_theme_mod( 'ct_author_title', 'Teólogo, escritor e pesquisador de cristologia' ) ); ?></p>
      <p class="ct-author-home__bio">
        <?php echo esc_html( get_theme_mod( 'ct_author_bio_short', 'Estudioso da teologia cristã com foco em cristologia e história da Igreja primitiva. Autor de obras que conectam a fé cristã às suas raízes históricas e bíblicas, tornando o estudo teológico acessível a todos.' ) ); ?>
      </p>
      <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'sobre' ) ) ); ?>"
         class="ct-author-home__link">
        Conhecer biografia completa →
      </a>
    </div>
  </div>
</section>

<!-- ======= SÉRIES TEOLÓGICAS ======= -->
<section class="ct-series" aria-label="Séries teológicas">
  <div class="ct-series__inner">
    <p class="ct-series__label">Aprofunde-se</p>
    <h2 class="ct-series__title">Séries de Estudo</h2>
    <div class="ct-series__grid">
      <?php
      // Busca categorias principais para usar como séries
      $series_cats = get_categories( array( 'orderby' => 'count', 'order' => 'DESC', 'hide_empty' => true, 'number' => 4 ) );
      $icons = array( '✝', '📖', '🎓', '🙏', '⛪', '🕊️' );
      $i = 0;
      foreach ( $series_cats as $sc ) :
        $icon = $icons[ $i % count( $icons ) ];
        $i++;
      ?>
        <a href="<?php echo esc_url( get_category_link( $sc->term_id ) ); ?>"
           class="ct-series__card">
          <span class="ct-series__card-icon"><?php echo $icon; ?></span>
          <div class="ct-series__card-title"><?php echo esc_html( $sc->name ); ?></div>
          <p class="ct-series__card-desc">
            <?php echo $sc->description ? esc_html( wp_trim_words( $sc->description, 15, '…' ) ) : (int) $sc->count . ' artigos publicados'; ?>
          </p>
        </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ======= VERSÍCULO ======= -->
<section class="ct-verse" aria-label="Versículo">
  <div class="ct-verse__inner">
    <blockquote>
      <p>"Ele é a imagem do Deus invisível, o primogênito de toda a criação; porque nele foram criadas todas as coisas."</p>
      <cite>Colossenses 1:15-16</cite>
    </blockquote>
  </div>
</section>

<!-- ======= NEWSLETTER ======= -->
<section class="ct-newsletter" aria-label="Newsletter">
  <div class="ct-newsletter__inner">
    <h2 class="ct-newsletter__title">Receba novos artigos</h2>
    <p class="ct-newsletter__desc">Inscreva-se e seja notificado quando publicarmos novos estudos sobre cristologia e teologia.</p>
    <?php if ( function_exists( 'mc4wp_form' ) ) : ?>
      <?php mc4wp_form(); ?>
    <?php else : ?>
    <form class="ct-newsletter__form"
          action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>"
          method="post">
      <?php wp_nonce_field( 'ct_newsletter', 'ct_newsletter_nonce' ); ?>
      <input type="hidden" name="action" value="ct_newsletter_signup">
      <input type="email"
             name="email"
             class="ct-newsletter__input"
             placeholder="seu@email.com.br"
             required
             autocomplete="email">
      <button type="submit" class="ct-newsletter__btn">Inscrever-se</button>
    </form>
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;color:var(--ct-muted);margin-top:.8rem;">
      Sem spam. Cancele quando quiser.
    </p>
    <?php endif; ?>
  </div>
</section>

<?php get_footer(); ?>
