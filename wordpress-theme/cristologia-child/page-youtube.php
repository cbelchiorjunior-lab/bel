<?php
/**
 * Template Name: Página YouTube
 * Template Post Type: page
 *
 * Cristologia Teológica — Canal YouTube
 */
get_header();

$author      = ct_author();
$youtube_url = $author['youtube']; // https://www.youtube.com/@cristologiateologica

// IDs de vídeos configuráveis em Aparência → Personalizar → Canal YouTube
$video_ids = array_filter( array(
    get_theme_mod( 'ct_youtube_video_1', '' ),
    get_theme_mod( 'ct_youtube_video_2', '' ),
    get_theme_mod( 'ct_youtube_video_3', '' ),
    get_theme_mod( 'ct_youtube_video_4', '' ),
    get_theme_mod( 'ct_youtube_video_5', '' ),
    get_theme_mod( 'ct_youtube_video_6', '' ),
) );
?>

<!-- ======= BANNER ======= -->
<div class="ct-yt-banner">
  <div class="ct-yt-banner__inner">
    <p class="ct-yt-banner__label">Canal no YouTube</p>
    <h1 class="ct-yt-banner__title">Cristologia Teológica</h1>
    <p class="ct-yt-banner__subtitle">Apologética evangélica baseada em fontes primárias, patrística e história documentada</p>
    <a href="<?php echo esc_url( $youtube_url ); ?>"
       target="_blank" rel="noopener noreferrer"
       class="ct-yt-banner__subscribe">
      <span class="ct-yt-banner__yt-icon">▶</span>
      Inscrever-se no canal
    </a>
  </div>
</div>

<div style="max-width:1100px;margin:0 auto;padding:4rem 1.5rem;">

  <!-- ======= SOBRE O CANAL ======= -->
  <div class="ct-yt-about">
    <div class="ct-yt-about__text">
      <p class="ct-yt-about__eyebrow">Sobre o canal</p>
      <h2 class="ct-yt-about__title">Fé que não teme o escrutínio histórico</h2>
      <p>O canal <strong>Cristologia Teológica</strong> é dedicado à apologética evangélica séria — conteúdo que desafia tanto o ceticismo secular quanto a superficialidade religiosa, com base em fontes primárias, patrística e documentação histórica.</p>
      <p>Aqui você encontra análises do Novo Testamento, da Igreja primitiva, das perseguições romanas e das grandes questões sobre a pessoa e obra de Jesus Cristo.</p>
      <div class="ct-yt-about__pillars">
        <div class="ct-yt-about__pillar">
          <span class="ct-yt-about__pillar-icon">📜</span>
          <div>
            <strong>Fontes Primárias</strong>
            <p>Documentos históricos, patrística e literatura do período</p>
          </div>
        </div>
        <div class="ct-yt-about__pillar">
          <span class="ct-yt-about__pillar-icon">⛪</span>
          <div>
            <strong>Igreja Primitiva</strong>
            <p>Perseguições romanas, formação do cânon e tradição apostólica</p>
          </div>
        </div>
        <div class="ct-yt-about__pillar">
          <span class="ct-yt-about__pillar-icon">✝</span>
          <div>
            <strong>Cristologia</strong>
            <p>A pessoa, natureza e obra de Jesus à luz das Escrituras</p>
          </div>
        </div>
        <div class="ct-yt-about__pillar">
          <span class="ct-yt-about__pillar-icon">🎓</span>
          <div>
            <strong>Apologética</strong>
            <p>Resposta fundamentada às objeções ao cristianismo histórico</p>
          </div>
        </div>
      </div>
    </div>
    <div class="ct-yt-about__cta-box">
      <div class="ct-yt-about__channel-preview">
        <div class="ct-yt-about__channel-avatar">C</div>
        <div class="ct-yt-about__channel-info">
          <strong><?php echo esc_html( $author['name'] ); ?></strong>
          <span>@cristologiateologica</span>
        </div>
      </div>
      <p style="font-family:var(--ct-font-sans);font-size:.92rem;color:var(--ct-muted);margin:1rem 0 1.5rem;line-height:1.6;">
        <?php echo esc_html( $author['bio_short'] ); ?>
      </p>
      <a href="<?php echo esc_url( $youtube_url ); ?>"
         target="_blank" rel="noopener noreferrer"
         class="ct-yt-about__btn-subscribe">
        ▶ Acessar o canal
      </a>
    </div>
  </div>

  <!-- ======= VÍDEOS EM DESTAQUE ======= -->
  <div style="margin-top:5rem;">
    <div class="ct-section-header" style="margin-bottom:2rem;">
      <h2 class="ct-section-title">Vídeos em Destaque</h2>
      <div class="ct-section-line" aria-hidden="true"></div>
      <a href="<?php echo esc_url( $youtube_url ); ?>"
         target="_blank" rel="noopener noreferrer"
         class="ct-section-more">Ver todos →</a>
    </div>

    <?php if ( ! empty( $video_ids ) ) : ?>
    <div class="ct-yt-videos-grid">
      <?php foreach ( $video_ids as $vid_id ) : ?>
        <div class="ct-yt-video-embed">
          <iframe
            src="https://www.youtube.com/embed/<?php echo esc_attr( $vid_id ); ?>?rel=0&modestbranding=1"
            title="Vídeo do canal Cristologia Teológica"
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
            allowfullscreen
            loading="lazy">
          </iframe>
        </div>
      <?php endforeach; ?>
    </div>

    <?php else : ?>
    <!-- Placeholder enquanto vídeos não são configurados -->
    <div class="ct-yt-empty">
      <div class="ct-yt-empty__icon">▶</div>
      <h3 class="ct-yt-empty__title">Configure os vídeos em destaque</h3>
      <p class="ct-yt-empty__desc">
        Acesse <strong>Aparência → Personalizar → Canal YouTube</strong> e cole os IDs dos vídeos que deseja exibir aqui.
        O ID de um vídeo é a parte após <code>?v=</code> na URL do YouTube.
      </p>
      <a href="<?php echo esc_url( $youtube_url ); ?>"
         target="_blank" rel="noopener noreferrer"
         class="ct-yt-empty__btn">
        ▶ Ir para o canal enquanto isso
      </a>
    </div>
    <?php endif; ?>
  </div>

  <!-- ======= TEMAS ABORDADOS ======= -->
  <div class="ct-yt-topics">
    <p class="ct-yt-topics__label">Conteúdo do canal</p>
    <h2 class="ct-yt-topics__title">O que você vai encontrar</h2>
    <div class="ct-yt-topics__grid">
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">🏛️</span>
        <h3>Roma e o Cristianismo</h3>
        <p>As perseguições do Império Romano e como a Igreja sobreviveu e cresceu sob opressão.</p>
      </div>
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">📖</span>
        <h3>Formação do Cânon</h3>
        <p>Como os livros do Novo Testamento foram reconhecidos pela Igreja primitiva.</p>
      </div>
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">✝</span>
        <h3>A Pessoa de Cristo</h3>
        <p>Quem é Jesus? Estudo aprofundado da cristologia bíblica e patrística.</p>
      </div>
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">🗿</span>
        <h3>Arqueologia Bíblica</h3>
        <p>Evidências arqueológicas que corroboram os relatos das Escrituras Sagradas.</p>
      </div>
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">🔍</span>
        <h3>Apologética Histórica</h3>
        <p>Resposta às principais objeções ao cristianismo usando documentação histórica.</p>
      </div>
      <div class="ct-yt-topics__card">
        <span class="ct-yt-topics__icon">📜</span>
        <h3>Patrística</h3>
        <p>O que os Pais da Igreja escreveram sobre Cristo, a fé e a vida cristã primitiva.</p>
      </div>
    </div>
  </div>

  <!-- ======= CTA FINAL ======= -->
  <div class="ct-yt-cta-final">
    <h2 class="ct-yt-cta-final__title">Junte-se à comunidade</h2>
    <p class="ct-yt-cta-final__desc">
      Inscreva-se no canal e ative as notificações para ser avisado sempre que um novo vídeo for publicado.
      Uma fé intelectualmente fundamentada começa aqui.
    </p>
    <a href="<?php echo esc_url( $youtube_url ); ?>"
       target="_blank" rel="noopener noreferrer"
       class="ct-yt-cta-final__btn">
      ▶ Inscrever-se agora — é grátis
    </a>
    <p style="font-family:var(--ct-font-sans);font-size:.8rem;color:var(--ct-muted);margin-top:.8rem;">
      Sem custos. Cancele quando quiser.
    </p>
  </div>

</div>

<?php get_footer(); ?>
