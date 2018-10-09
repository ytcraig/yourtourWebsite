  <footer>
    <div class="footer__tour">

      <div class="container-main">

        <div class="footer-content__container">

          <div class="footer__logo">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/icon-feet.svg">
          </div>

          <div class="footer__left-content">
            <div class="footer-left-content__links">
              <a href="<?php echo get_permalink( 64 ); ?>" target="_blank">Help</a>
              <a href="<?php echo get_permalink( 5 ); ?>" target="_blank">Privacy</a>
              <a href="<?php echo get_permalink( 106 ); ?>" target="_blank">Terms</a>
            </div>
            <div class="footer-left-content__address">
              <p>YourTour&copy; 2018, Kemp House,<br>152-160 City Road, London EC1V 2NX</p>
            </div>
          </div>

          <div class="footer__right-content">

            <div class="footer-right-content__social-accounts">
              <a class="fb" href="https://www.facebook.com/goyourtour/"></a>
              <a class="tw" href="https://twitter.com/GoYourTour"></a>
              <a class="inst" href="https://www.instagram.com/goyourtour/"></a>
              <a class="li" href="https://www.linkedin.com/company/18453059/"></a>
            </div>

            <a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
              <img class="footer-right-content__ios-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.svg">
            </a>
          </div>

        </div>

      </div>
    </div>
  </footer>
<?php wp_footer(); ?>
</html>
