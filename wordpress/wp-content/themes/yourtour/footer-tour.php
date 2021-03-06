  <footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/paginate.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/scripts.js"></script>
    <!-- <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script> -->
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/slick.min.js"></script>
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

  </body>

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
              <p>YourTour&copy; 2019, Kemp House,<br>152-160 City Road, London EC1V 2NX</p>
            </div>
          </div>

          <div class="footer__right-content">

            <div class="footer-right-content__social-accounts">
              <a class="fb" href="https://www.facebook.com/goyourtour/"></a>
              <a class="tw" href="https://twitter.com/GoYourTour"></a>
              <a class="inst" href="https://www.instagram.com/goyourtour/"></a>
              <a class="li" href="https://www.linkedin.com/company/18453059/"></a>
            </div>

            <div class="footer-right-content__store-badges">
              <a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
                <img class="footer-right-content__ios-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.svg">
              </a>

              <a href="https://play.google.com/store/apps/details?id=com.goyourtour.yourtour" target="_blank">
                <img class="footer-right-content__ios-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/google_play_badge.png">
              </a>
            </div>
          </div>

        </div>

      </div>
    </div>
  </footer>
<?php wp_footer(); ?>
</html>
