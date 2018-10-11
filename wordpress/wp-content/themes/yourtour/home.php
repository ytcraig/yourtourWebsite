<?php /* Template Name: Home */ ?>

  <?php get_header(); ?>

    <div class="c-hero hero">

        <div class="container-main">

          <div class="c-hero__nav">
            <a class="container-logo" href="#">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo.svg">
            </a>
            <div class="hero__nav-items">
              <a class="hero__nav-item" href="<?php echo get_permalink( 339 ); ?>">Explore the tours</a></li>
              <a class="hero__nav-item" href="<?php echo get_permalink( 64 ); ?>" target="_blank">Help</a></li>
              <button id="modal-button__contact" class="o-button o-button__white">Get in touch</button>

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
                  <li><a href="<?php echo get_permalink( 339 ); ?>">Explore the Tours</a></li>
                  <li><a href="<?php echo get_permalink( 64 ); ?>">Help</a></li>
                  <li class="mobile-nav__btn"><button id="modal-button-mob__contact" class="o-button o-button__green">Get in touch</button></li>
                </ul>
              </div>

          </div>

          <div class="hero-text-container">
            <h1 class="hero-heading">Explore like never before</h1>
            <h3 class="hero-sub-heading">Create and share engaging, self-guided audio walks for the world to enjoy.</h3>
            <button id="modal-button__creator" class="o-button o-button__green">Create a tour for free</button>
          </div>
        </div>

    </div>

    <div id="modal-creator" class="o-modal">
      <div class="modal-creator-content">
        <div class="modal-form">
          <span id="modal-close-creator">x</span>
          <!--[if lte IE 8]>
          <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2-legacy.js"></script>
          <![endif]-->
          <script charset="utf-8" type="text/javascript" src="//js.hsforms.net/forms/v2.js"></script>
          <script>
            hbspt.forms.create({
          	portalId: "4733551",
          	formId: "8bf51496-f32d-4b96-a1ac-3a13ab4c92e4",
          	css: ""
          });
          </script>
        </div>

      </div>
    </div>

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

    <div class="section-one__container">
      <div class="section-one__lines-left">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-one-lines-one.svg">
      </div>

      <div class="container-main">
        <div class="section-content__container">

          <div class="section-phone__container">
            <!-- <video src="<?php echo get_bloginfo('template_directory'); ?>/video/YT_App_Animation_without_Hand.mp4" type="video/mp4" autoplay loop>
            </video> -->
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-one-phone.png">
          </div>
          <div class="section-text__container">
            <h2 class="section-heading">Create. Engage. Amaze.</h2>
            <p class="intro-copy">Creating a YourTour is fun, easy and simple. Whether you're an organisation wishing to attract and engage visitors, or an individual looking to monetise your knowledge, the YourTour platform enables you to bring the world to life via unique GPS-guided audio walks by the person who knows them best – you.</p>
            <button id="modal-button__creator__2" class="o-button o-button__purple">Create a tour for free</button>
          </div>

        </div>
      </div>
    </div>

    <div class="section-two__container">
      <div class="section-two__lines-right">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-two-lines-right.svg">
      </div>
      <div class="section-two__lines-left">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-two-lines-left.svg">
      </div>

      <div class="container-main">
        <div class="section-content__container reverse">

          <div class="section-phones__container">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-two-phone.png">
          </div>
          <div class="section-text__container">
            <h2 class="section-heading">Let users explore <i>their</i> way</h2>
            <div class="section-two-features__container">

              <div class="section-two-feature__container">
                <img class="section-two-feature__icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/pace-icon.svg"></img>
                <p class="section-two-feature__text">At their own pace, in their own time and in their own language.</p>
              </div>

              <div class="section-two-feature__container">
                <img class="section-two-feature__icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/sync-icon.svg"></img>
                <p class="section-two-feature__text">Solo or synced with friends and family for a shared experience.</p>
              </div>

              <div class="section-two-feature__container">
                <img class="section-two-feature__icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/timeline-icon.svg"></img>
                <p class="section-two-feature__text">Personalised, shareable timeline with photos, distance walked and calories burned.</p>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>


    <div class="section-three__container">
      <div class="section-three__lines-right">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-lines-right.svg">
      </div>

      <div class="container-main">

        <div class="section-content-centered__container">

          <div class="section-text__container">
            <h2 class="section-heading">See what others have been creating…</h2>
          </div>

          <div class="explore__tours-outer-container">

            <div class="explore__tours-inner-container">

              <div class="explore__single-tour-outer-container">
                <div class="explore__single-tour-padding-container">
                  <div class="explore__single-tour-inner-container">
                    <a href="<?php echo get_permalink( 306 ); ?>">
                    <div class="section-tour-example-text__container">
                      <p class="section-tour-example__title">A Breif History of Buckingham Palace</p>
                      <!-- <p class="section-tour-example__categories">Major Sights, Family-friendly, History</p> -->
                      <div class="section-tour-example-reviews__container">
                        <img class="section-tour-example__review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-stars.svg">
                        <p class="section-tour-example_review-text">5 reviews</p>
                      </div>
                    </div>
                    <div class="section-tour-example__gradient"></div>
                    <img class="section-tour-example__img" src="<?php echo get_bloginfo('template_directory'); ?>/img/bucks-pal-hero.jpg">
                  </a>
                  </div>
                </div>
              </div>

              <div class="explore__single-tour-outer-container">
                <div class="explore__single-tour-padding-container">
                  <div class="explore__single-tour-inner-container">
                    <a href="<?php echo get_permalink( 312 ); ?>">
                    <div class="section-tour-example-text__container">
                      <p class="section-tour-example__title">A Monastic Tour of Croxden Abbey</p>
                      <!-- <p class="section-tour-example__categories">Major Sights, Family-friendly, History</p> -->
                      <div class="section-tour-example-reviews__container">
                        <img class="section-tour-example__review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-stars.svg">
                        <p class="section-tour-example_review-text">5 reviews</p>
                      </div>
                    </div>
                    <div class="section-tour-example__gradient"></div>
                    <img class="section-tour-example__img" src="<?php echo get_bloginfo('template_directory'); ?>/img/croxden.jpg">
                  </a>
                  </div>
                </div>
              </div>

              <div class="explore__single-tour-outer-container">
                <div class="explore__single-tour-padding-container">
                  <div class="explore__single-tour-inner-container">
                    <a href="<?php echo get_permalink( 320 ); ?>">
                    <div class="section-tour-example-text__container">
                      <p class="section-tour-example__title">Quorn - Exploring Meeting Street of Yesterday</p>
                      <!-- <p class="section-tour-example__categories">Major Sights, Family-friendly, History</p> -->
                      <div class="section-tour-example-reviews__container">
                        <img class="section-tour-example__review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-stars.svg">
                        <p class="section-tour-example_review-text">5 reviews</p>
                      </div>
                    </div>
                    <div class="section-tour-example__gradient"></div>
                    <img class="section-tour-example__img" src="<?php echo get_bloginfo('template_directory'); ?>/img/quorn-2.jpg">
                  </a>
                  </div>
                </div>
              </div>

              <div class="explore__single-tour-outer-container">
                <div class="explore__single-tour-padding-container">
                  <div class="explore__single-tour-inner-container">
                    <a href="<?php echo get_permalink( 328 ); ?>">
                    <div class="section-tour-example-text__container">
                      <p class="section-tour-example__title">Discover Brighton's Cultural Quarter</p>
                      <!-- <p class="section-tour-example__categories">Major Sights, Family-friendly, History</p> -->
                      <div class="section-tour-example-reviews__container">
                        <img class="section-tour-example__review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-stars.svg">
                        <p class="section-tour-example_review-text">5 reviews</p>
                      </div>
                    </div>
                    <div class="section-tour-example__gradient"></div>
                    <img class="section-tour-example__img" src="<?php echo get_bloginfo('template_directory'); ?>/img/brighton.jpg">
                  </a>
                  </div>
                </div>
              </div>

          </div>
          </div>

          <div class="section-content__button-centered">
            <a class="o-button o-button__green" href="<?php echo get_permalink( 339 ); ?>">See more tours</a>
          </div>

        </div>

      </div>
    </div>

    <div class="section-cta__container">

      <div class="container-main">

        <div class="section-content-centered__container">

          <div class="section-text__container">
            <h2 class="section-heading white-text">Start creating your tour for free</h2>
          </div>
          <div class="section-content__button-centered no-margin">
            <button id="modal-button-bottom__creator" class="o-button o-button__white purple-text">Get started</button>
          </div>

        </div>

      </div>

    </div>

    </div>
  </body>
  <?php get_footer(); ?>
