<?php /* Template Name: FAQ Selection */ ?>

<?php get_header('alt'); ?>

    <section class="faq-selection-section">
      <div class="container-main">

        <div class="faq-selection-content">

          <h3 class="help-sub-header">Which app would you like help with?</h3>

          <div class="faq-sections">

              <a class="faq-builder-btn" href="<?php echo get_permalink( 52 ); ?>">Creator App</a>
              <a class="faq-explorer-btn" href="<?php echo get_permalink( 39 ); ?>">Explorer App</a>

          </div>

        </div>

      </div>
    </section>

  </body>

  <?php get_footer('faq'); ?>
