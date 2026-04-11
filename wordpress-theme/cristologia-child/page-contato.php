<?php
/**
 * Template Name: Página Contato
 * Template Post Type: page
 *
 * Cristologia Teológica — Página de Contato
 */
get_header();
?>

<!-- BANNER -->
<div style="background:linear-gradient(135deg,var(--ct-dark),var(--ct-primary));padding:4rem 1.5rem 3rem;text-align:center;">
  <div style="max-width:600px;margin:0 auto;">
    <p style="font-family:var(--ct-font-sans);font-size:.75rem;font-weight:700;letter-spacing:.14em;text-transform:uppercase;color:var(--ct-gold-light);margin-bottom:.8rem;">Fale conosco</p>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);color:#fff;margin-bottom:.5rem;">Contato</h1>
    <p style="color:rgba(255,255,255,.65);">Tem uma dúvida, sugestão ou quer convidar para um evento? Entre em contato.</p>
  </div>
</div>

<div style="max-width:900px;margin:0 auto;padding:4rem 1.5rem;">
  <div class="ct-contact-layout">

    <!-- FORMULÁRIO -->
    <div class="ct-contact-form-col">
      <h2 style="font-size:1.4rem;color:var(--ct-primary);margin-bottom:1.5rem;">Envie uma mensagem</h2>

      <?php
      // Se tiver Contact Form 7 instalado, use o shortcode do formulário
      // [contact-form-7 id="..." title="Contato"]
      // Caso contrário, exibe formulário nativo simples
      if ( function_exists( 'wpcf7' ) ) :
        // Usuário deve trocar pelo ID do formulário CF7 dele
        echo do_shortcode( '[contact-form-7 id="1" title="Contato"]' );
      else :
      ?>
      <form class="ct-contact-form" method="post" action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>">
        <?php wp_nonce_field( 'ct_contact_form', 'ct_contact_nonce' ); ?>
        <input type="hidden" name="action" value="ct_contact_form">

        <div class="ct-contact-form__row">
          <div class="ct-contact-form__group">
            <label class="ct-contact-form__label" for="ct-name">Nome *</label>
            <input type="text" id="ct-name" name="ct_name" class="ct-contact-form__input"
                   placeholder="Seu nome completo" required>
          </div>
          <div class="ct-contact-form__group">
            <label class="ct-contact-form__label" for="ct-email">E-mail *</label>
            <input type="email" id="ct-email" name="ct_email" class="ct-contact-form__input"
                   placeholder="seu@email.com.br" required autocomplete="email">
          </div>
        </div>

        <div class="ct-contact-form__group">
          <label class="ct-contact-form__label" for="ct-subject">Assunto *</label>
          <select id="ct-subject" name="ct_subject" class="ct-contact-form__input" required>
            <option value="">Selecione um assunto…</option>
            <option value="duvida">Dúvida teológica</option>
            <option value="convite">Convite para evento / palestra</option>
            <option value="livro">Sobre o livro</option>
            <option value="parceria">Parceria / colaboração</option>
            <option value="outro">Outro</option>
          </select>
        </div>

        <div class="ct-contact-form__group">
          <label class="ct-contact-form__label" for="ct-message">Mensagem *</label>
          <textarea id="ct-message" name="ct_message" class="ct-contact-form__textarea"
                    rows="6" placeholder="Escreva sua mensagem aqui…" required></textarea>
        </div>

        <button type="submit" class="ct-contact-form__submit">Enviar mensagem ✉️</button>
      </form>
      <?php endif; ?>

      <p style="margin-top:1rem;font-family:var(--ct-font-sans);font-size:.78rem;color:var(--ct-muted);">
        💡 Dica: para um formulário mais completo, instale o plugin <strong>Contact Form 7</strong> e substitua pelo shortcode.
      </p>
    </div>

    <!-- INFORMAÇÕES -->
    <div class="ct-contact-info-col">
      <h2 style="font-size:1.2rem;color:var(--ct-primary);margin-bottom:1.5rem;">Outras formas de contato</h2>

      <div class="ct-contact-info__item">
        <div class="ct-contact-info__icon">✉️</div>
        <div>
          <strong class="ct-contact-info__label">E-mail</strong>
          <p class="ct-contact-info__value">
            <?php echo esc_html( get_theme_mod( 'ct_contact_email', get_option( 'admin_email' ) ) ); ?>
          </p>
        </div>
      </div>

      <?php $instagram = get_theme_mod( 'ct_instagram_url', '' ); if ( $instagram ) : ?>
      <div class="ct-contact-info__item">
        <div class="ct-contact-info__icon">📷</div>
        <div>
          <strong class="ct-contact-info__label">Instagram</strong>
          <p class="ct-contact-info__value">
            <a href="<?php echo esc_url( $instagram ); ?>" target="_blank" rel="noopener">
              @<?php echo esc_html( ltrim( parse_url( $instagram, PHP_URL_PATH ), '/' ) ); ?>
            </a>
          </p>
        </div>
      </div>
      <?php endif; ?>

      <?php $youtube = get_theme_mod( 'ct_youtube_url', '' ); if ( $youtube ) : ?>
      <div class="ct-contact-info__item">
        <div class="ct-contact-info__icon">▶️</div>
        <div>
          <strong class="ct-contact-info__label">YouTube</strong>
          <p class="ct-contact-info__value">
            <a href="<?php echo esc_url( $youtube ); ?>" target="_blank" rel="noopener">Canal no YouTube</a>
          </p>
        </div>
      </div>
      <?php endif; ?>

      <div style="margin-top:2rem;padding:1.5rem;background:var(--ct-bg);border:1px solid var(--ct-border);border-radius:4px;">
        <p style="font-family:var(--ct-font-sans);font-size:.85rem;color:var(--ct-muted);margin:0;line-height:1.6;">
          📬 Respondo mensagens em até <strong>3 dias úteis</strong>. Para questões urgentes, prefira o e-mail direto.
        </p>
      </div>

      <!-- Material Grátis -->
      <div style="margin-top:1.5rem;padding:1.5rem;background:var(--ct-primary);border-radius:4px;text-align:center;">
        <p style="font-family:var(--ct-font-sans);font-size:.82rem;color:rgba(255,255,255,.7);margin-bottom:.6rem;">Que tal receber conteúdo gratuito?</p>
        <a href="<?php echo esc_url( get_page_link( get_page_by_path( 'material-gratis' ) ) ); ?>"
           style="display:inline-block;background:var(--ct-gold);color:var(--ct-dark)!important;padding:.65rem 1.4rem;border-radius:2px;font-family:var(--ct-font-sans);font-weight:700;font-size:.85rem;">
          📥 Ver material grátis
        </a>
      </div>
    </div>

  </div>
</div>

<?php get_footer(); ?>
