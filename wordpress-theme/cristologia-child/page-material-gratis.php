<?php
/**
 * Template Name: Material Grátis
 * Template Post Type: page
 *
 * Cristologia Teológica — E-books e materiais gratuitos (captura de e-mail)
 */
get_header();

// Lista de materiais disponíveis (editável via Customizer ou diretamente aqui)
$materials = array(
    array(
        'icon'  => '📖',
        'title' => 'Introdução à Cristologia',
        'desc'  => 'Um guia introdutório sobre a pessoa e natureza de Jesus Cristo, ideal para quem está começando no estudo teológico.',
        'pages' => '32 páginas',
    ),
    array(
        'icon'  => '✝',
        'title' => 'Os Concílios Cristológicos',
        'desc'  => 'Resumo dos principais concílios da Igreja que definiram a doutrina sobre Cristo: Niceia, Éfeso e Calcedônia.',
        'pages' => '24 páginas',
    ),
    array(
        'icon'  => '📜',
        'title' => 'Guia de Estudo Bíblico',
        'desc'  => 'Método prático para estudar a Bíblia com profundidade, com foco nos textos cristológicos do Novo Testamento.',
        'pages' => '18 páginas',
    ),
);
?>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--ct-dark),var(--ct-primary));padding:4rem 1.5rem 3rem;text-align:center;position:relative;overflow:hidden;">
  <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);font-size:20rem;color:rgba(255,255,255,.02);pointer-events:none;">📥</div>
  <div style="position:relative;max-width:700px;margin:0 auto;">
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ct-gold-light);margin-bottom:.8rem;">100% gratuito</p>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:.75rem;">Material Grátis</h1>
    <p style="color:rgba(255,255,255,.7);font-size:1.05rem;">E-books, guias e materiais teológicos exclusivos.<br>Cadastre seu e-mail e receba tudo gratuitamente.</p>
  </div>
</div>

<div style="max-width:1000px;margin:0 auto;padding:4rem 1.5rem;">

  <!-- FORMULÁRIO DE CAPTURA — destaque -->
  <div class="ct-freematerial-cta">
    <div class="ct-freematerial-cta__text">
      <h2 class="ct-freematerial-cta__title">Acesse todos os materiais</h2>
      <p class="ct-freematerial-cta__desc">
        Cadastre seu e-mail abaixo e ganhe acesso imediato a todos os e-books e materiais gratuitos. Você também será o primeiro a saber sobre novos lançamentos.
      </p>
      <ul class="ct-freematerial-cta__benefits">
        <li>✅ E-books em PDF para download imediato</li>
        <li>✅ Atualizações quando novos materiais forem adicionados</li>
        <li>✅ Aviso antecipado sobre novos livros</li>
        <li>✅ Sem spam — apenas conteúdo de valor</li>
      </ul>
    </div>
    <div class="ct-freematerial-cta__form-col">
      <?php if ( function_exists( 'mc4wp_form' ) ) : ?>
        <?php mc4wp_form(); ?>
      <?php else : ?>
      <form class="ct-freematerial-form"
            method="post"
            action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'ct_freematerial', 'ct_freematerial_nonce' ); ?>
        <input type="hidden" name="action" value="ct_freematerial_signup">

        <label class="ct-freematerial-form__label" for="fm-name">Seu nome</label>
        <input type="text"
               id="fm-name"
               name="fm_name"
               class="ct-freematerial-form__input"
               placeholder="Como posso te chamar?"
               required>

        <label class="ct-freematerial-form__label" for="fm-email">Seu melhor e-mail *</label>
        <input type="email"
               id="fm-email"
               name="fm_email"
               class="ct-freematerial-form__input"
               placeholder="seu@email.com.br"
               required
               autocomplete="email">

        <button type="submit" class="ct-freematerial-form__btn">
          📥 Quero receber gratuitamente
        </button>

        <p class="ct-freematerial-form__privacy">
          🔒 Seus dados estão seguros. Cancele quando quiser.
        </p>
      </form>

      <p style="margin-top:1rem;font-family:var(--ct-font-sans);font-size:.75rem;color:var(--ct-muted);text-align:center;">
        💡 Para integrar com Mailchimp ou outra plataforma, instale o plugin <strong>MailChimp for WP</strong>.
      </p>
      <?php endif; ?>
    </div>
  </div>

  <!-- MATERIAIS DISPONÍVEIS -->
  <div style="margin-top:4rem;">
    <div style="display:flex;align-items:center;gap:1rem;margin-bottom:2rem;">
      <h2 style="font-size:1.35rem;color:var(--ct-primary);margin:0;white-space:nowrap;">O que você vai receber</h2>
      <div style="flex:1;height:1px;background:var(--ct-border);"></div>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(280px,1fr));gap:1.5rem;">
      <?php foreach ( $materials as $mat ) : ?>
      <div class="ct-material-card">
        <div class="ct-material-card__icon"><?php echo $mat['icon']; ?></div>
        <div class="ct-material-card__body">
          <h3 class="ct-material-card__title"><?php echo esc_html( $mat['title'] ); ?></h3>
          <p class="ct-material-card__desc"><?php echo esc_html( $mat['desc'] ); ?></p>
          <span class="ct-material-card__pages"><?php echo esc_html( $mat['pages'] ); ?></span>
        </div>
        <div class="ct-material-card__footer">
          <span class="ct-material-card__free">GRÁTIS</span>
          <span class="ct-material-card__action">↓ Cadastre-se acima</span>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </div>

  <!-- CTA FINAL -->
  <div style="margin-top:4rem;text-align:center;padding:3rem;background:var(--ct-primary);border-radius:4px;">
    <h3 style="color:#fff;font-size:1.4rem;margin-bottom:.75rem;">Pronto para aprofundar seu estudo?</h3>
    <p style="color:rgba(255,255,255,.7);margin-bottom:2rem;">Cadastre-se agora e receba todos os materiais gratuitos.</p>
    <a href="#fm-email"
       style="display:inline-block;background:var(--ct-gold);color:var(--ct-dark)!important;padding:.9rem 2.2rem;border-radius:2px;font-family:var(--ct-font-sans);font-weight:700;font-size:.95rem;letter-spacing:.06em;text-transform:uppercase;">
      📥 Quero o material grátis
    </a>
  </div>

</div>

<?php get_footer(); ?>
