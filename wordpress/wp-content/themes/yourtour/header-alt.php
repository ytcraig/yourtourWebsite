<!DOCTYPE html>
<html>
  <head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TVTMZ9R');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700,700i" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2/dist/clipboard.min.js"></script>
    <meta name="google-site-verification" content="qw2vwBKtJOm8Ix-FxGo8DP4jCP4YdoW_-C7Wvm6Jk30" />
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-123171584-1"></script>
    <!-- Hotjar Tracking Code for https://goyourtour.com -->
    <script>
        (function(h,o,t,j,a,r){
            h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
            h._hjSettings={hjid:981152,hjsv:6};
            a=o.getElementsByTagName('head')[0];
            r=o.createElement('script');r.async=1;
            r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
            a.appendChild(r);
        })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
    </script>
    <script>
      window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

            gtag('config', 'UA-123171584-1');
    </script>

    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v3.1';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <meta name="viewport" content="width=device-width">
    <meta name="description" content="YourTour brings the world around you to life by turning your mobile into a personal interactive tour guide">
    <meta name="keywords" content="tours, mobile tours, interactive tours">
    <title>YourTour - Explore like never before.</title>
    <link href="<?php echo get_bloginfo('template_directory'); ?>/css/style.css" rel="stylesheet">
    <link href="<?php echo get_bloginfo('template_directory'); ?>/css/slick.css" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" src="<?php echo get_bloginfo('template_directory'); ?>/img/explorer-app-icon.png">
    <?php wp_head();?>
  </head>
  <body>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TVTMZ9R"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo get_bloginfo('template_directory'); ?>/js/slick.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.9"></script> -->
    <header>
      <div class="container-main">

        <div class="nav">
          <a href="<?php echo get_permalink( 56 ); ?>">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo-black.png">
          </a>
          <div class="global-nav-items__container">
            <a class="global-nav-item" href="<?php echo get_permalink( 254 ); ?>">Explore the tours</a></li>
            <a class="global-nav-item" href="<?php echo get_permalink( 64 ); ?>" target="_blank">Help</a></li>
            <button id="modal-button__contact" class="o-button o-button__green">Get in touch</button>
          </div>

          <div class="hamburger-menu-container">
            <div class="hamburger-icon"></div>
          </div>

            <div class="menu-overlay">
              <div class="container-main">
                <a href="<?php echo get_permalink( 56 ); ?>">
                  <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo-black.png">
                </a>
              </div>
              <ul>
                <li><a href="<?php echo get_permalink( 56 ); ?>">Home</a></li>
                <li><a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">Download the App</a></li>
                <li><a href="<?php echo get_permalink( 254 ); ?>">Explore the Tours</a></li>
                <li><a href="<?php echo get_permalink( 64 ); ?>">Help</a></li>
                <li class="mobile-nav__btn"><button id="modal-button-mob__contact" class="o-button o-button__green">Get in touch</button></li>
              </ul>
            </div>

        </div>
      </div>
    </header>
