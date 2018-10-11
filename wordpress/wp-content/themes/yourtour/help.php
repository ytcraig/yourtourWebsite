<?php /* Template Name: Help Center */ ?>

<?php get_header('help'); ?>

      <div id="modal-contact" class="o-modal">
        <div class="modal-contact-content">
          <div class="modal-form">
            <span id="modal-close-contact">x</span>
            <!--[if lte IE 8]>
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
            <![endif]-->
            <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
            <script>
              hbspt.forms.create({
              portalId: "4733551",
              formId: "2b9a8f5e-d282-43df-9e7f-c5d1ed876f42"
            });
            </script>
          </div>

        </div>
      </div>
    
      <div class="help-center__content-container">

        <div class="container-main">

          <div class="help-center__text-container">

            <h1 class="help-center__heading">Hello! How can we help?</h1>
            <p class="help-center__intro-text">Welcome to the YourTour Help Center, where you’ll find answers to commonly asked questions.
            To get started, simple select which app you'd like help with:</p>

            <div class="help-center__app-buttons">

              <a class="help-center__creator-button" href="<?php echo get_permalink( 52 ); ?>">
                <img src="<?php echo get_bloginfo('template_directory'); ?>/img/icon-feet-black.svg">
                <p>Creator App</p>
              </a>

              <a class="help-center__explorer-button" href="<?php echo get_permalink( 39 ); ?>">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/icon-feet.svg">
              <p>Explorer App</p>
              </a>
            </div>

          </div>

          <!-- <p class="help-center__or">OR</p>

          <a class="help-center__email-button" href="mailto:hello@goyourtour.com">
          <img src="<?php echo get_bloginfo('template_directory'); ?>/img/email-icon.svg">
          <p>Send us an email</p>
          </a> -->

        </div>

      </div>
    </section>

  </body>

  <?php get_footer(); ?>
