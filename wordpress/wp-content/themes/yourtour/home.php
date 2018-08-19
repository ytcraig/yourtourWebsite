<?php /* Template Name: Home */ ?>

  <?php get_header(); ?>

    <div class="c-hero hero">
      <div class="c-hero__mobile-wrapper">

        <div class="c-hero__title container-text">
          <div class="container-main">
            <div class="container-logo">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo.svg">
            </div>
            <div class="hero-text-container">
              <h1 class="hero-heading"><?php the_field('tagline_1')?></h1>
              <h3 class="hero-sub-heading"><?php the_field('tagline_2')?></h3>
            </div>
          </div>
        </div>
      </div>

      <div class="c-hero__buttons">
        <div class="container-main">

          <div class="button-1-wrapper">
            <div class="explorer-app-icon"></div>
            <button id="button-1" class="o-button o-button--green"><?php the_field('home_button_1')?></button>
            <button id="button-1-mob" class="o-button o-button--green"><a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank"><?php the_field('home_button_1')?></a></button>
            <a class="ios-app-store-link" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
              <img class="ios-app-store-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.png"></img>
            </a>
          </div>

          <div class="button-2-wrapper">
            <div class="creator-app-icon"></div>
            <button id="button-2" class="o-button o-button--purple" href="<?php echo get_permalink( 120 ); ?>"><?php the_field('home_button_2')?></button>
            <p class="button-2-caption"><?php the_field('button_2_caption')?></p>
          </div>
        </div>
      </div>

      <div class="hero-down-chevron"></div>

    </div>

    <div id="modal-creator" class="o-modal">
      <div class="modal-creator-content">
        <div class="modal-form">
          <span id="modal-close-creator">x</span>
          <h3 class="modal-heading"><?php the_field('modal_creator_header')?></h3>
          <img class="modal-creator-image" src="<?php echo get_bloginfo('template_directory'); ?>/img/modal-1-img.svg"></img>
          <div class="modal-text"><?php the_field('modal_creator_text')?></div>
          <form class="js-mailchimp-form" action="https://goyourtour.us17.list-manage.com/subscribe/post-json?u=e3b5eac68ad712a594f654688&amp;id=42fe9000d4&c=?" method="GET">
            <input type="hidden" name="u" value="e3b5eac68ad712a594f654688">
            <input type="hidden" name="id" value="42fe9000d4">
            <input class="form-field" type="text" placeholder="Full name" name="MERGE1"><br>
            <input class="form-field" type="text" placeholder="Email address" name="MERGE0"><br>
            <div class="modal-form-error">Please enter both your name and a valid email address</div>
            <input class="form-button" type="submit" class="button-submit" value="Submit"><br>

          </input>
          </form>
        </div>

        <div class="thank-you-message">
          <span id="modal-close-thank-you-creator">x</span>
          <div class="thank-you-message-content">
            <img class="thank-you-tick" src="<?php echo get_bloginfo('template_directory'); ?>/img/thank-you-tick.svg"></img>
            <h2 class="thank-you-heading">Thank you</h2>
            <p class="thank-you-copy">We’re so excited to have your registered interest. You should receive a follow up email within the next few minutes with more details on what to do next.</p>
            <p class="thank-you-copy">Happy creating!</p>
          </div>
        </div>

      </div>
    </div>

    <div id="modal-explorer" class="o-modal">
      <div class="modal-2-content">
        <div class="modal-form">
          <span id="modal-close-explorer">x</span>
          <div class="explorer-app-icon icon-centered"></div>
          <h3 class="modal-heading">Download the Explorer app</h3>
          <div class="clipboard-container">
            <div class="modal-text">Simply copy the download link to your clipboard and send the link to your iPhone.</div>
            <button id="clipboard-button" class="btn--copy-explorer-app-link clipboard-button" data-clipboard-text="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8">
              Copy link to clipboard
            </button>
          </div>

          <!-- <div class="modal-separation-line"></div>

          <div class="modal-text">
            Or, you can enter your email address below and we’ll do all the hard work for you by firing over a link to your inbox.
          </div>

          <p class="modal-text-small">
            (We promise not to send you anything other than the download link!)
          </p> -->
          <!-- Create new Mailchimp form -->
          <!-- <form class="js-mailchimp-form" action="https://goyourtour.us17.list-manage.com/subscribe/post-json?u=e3b5eac68ad712a594f654688&amp;id=42fe9000d4&c=?" method="GET">
            <input type="hidden" name="u" value="e3b5eac68ad712a594f654688">
            <input type="hidden" name="id" value="42fe9000d4">
            <input class="form-field" type="text" placeholder="Email address" name="MERGE0"><br>
            <div class="modal-form-error">Please enter both your name and a valid email address</div>
            <input class="form-button" type="submit" class="button-submit" value="Email me the link"><br>
          </input>
          </form> -->
          <div class="ios-app-store-form">
            <a class="ios-app-store-link" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
              <img class="ios-app-store-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.png"></img>
            </a>
          </div>
        </div>

        <div class="thank-you-message">
          <span id="modal-close-thank-you-explorer">x</span>
          <div class="thank-you-message-content">
            <img class="thank-you-tick" src="<?php echo get_bloginfo('template_directory'); ?>/img/thank-you-tick.svg"></img>
            <h3 class="thank-you-heading">Thank you!</h3>
            <p class="thank-you-copy">We’re so excited to have your registered interest. You should receive a follow up email within the next few minutes with more details on what to do next.</p>
            <p class="thank-you-copy">Happy exploring!</p>
          </div>
        </div>

      </div>
    </div>

    <div class="intro">

      <div class="container-main">
        <div class="container-intro">
          <h2 class="intro-title"> <?php the_field('intro_title')?> </h2>
          <div class="intro-icons"></div>
          <p class="intro-copy"> <?php the_field('intro_copy')?> </p>
        </div>
      </div>

    </div>

    <div class="section-container">
      <div class="section-1-img"></div>
      <div class="section-1-text-container">
        <div class="section-1-text">
          <div class="explorer-app-icon"></div>
          <h3 class="section-header"> <?php the_field('section_1_header')?> </h3>
          <p class="section-copy"> <?php the_field('section_1_copy')?></p>
          <button id="button-1-mob" class="o-button o-button--green"><a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank"><?php the_field('home_button_1')?></a></button>
          <button id="button-1-alt" class="o-button o-button--green"><?php the_field('home_button_1')?></button>
          <a class="ios-app-store-link" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
            <img class="ios-app-store-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.png"></img>
          </a>
        </div>
      </div>
    </div>

    <div class="section-container full-length-border">
      <div class="section-2-img-above"></div>
      <div class="section-2-text-container">
        <div class="section-2-text">
          <div class="creator-app-icon"></div>
          <h3 class="section-header"> <?php the_field('section_2_header')?> </h3>
          <p class="section-copy"> <?php the_field('section_2_copy')?></p>
          <button id="button-2-alt" class="o-button o-button--purple"><?php the_field('home_button_2')?></button>
          <p class="button-2-caption"><?php the_field('button_2_caption')?></p>
        </div>
      </div>
      <div class="section-2-img"></div>
    </div>

    <div class="outro">
      <div class="container-main">
        <div class="container-outro">
          <h2 class="intro-title"> <?php the_field('outro_title')?> </h2>
          <p class="intro-copy"> <?php the_field('outro_copy')?> </p>

          <div class="alt-button-wrapper">
            <div class="button-1-alt-wrapper">
              <div class="explorer-app-icon"></div>
              <button id="button-1-bottom" id="button-1-alt" class="o-button o-button--green"><?php the_field('home_button_1')?></button>
              <button id="button-1-mob" class="o-button o-button--green"><a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank"><?php the_field('home_button_1')?></a></button>
              <a class="ios-app-store-link" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
                <img class="ios-app-store-badge" src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.png"></img>
              </a>
            </div>

            <div class="button-2-alt-wrapper">
              <div class="creator-app-icon"></div>
              <button id="button-2-bottom" id="button-2-alt" class="o-button o-button--purple"><?php the_field('home_button_2')?></button>
              <div class="button-1-caption-alt"><?php the_field('button_2_caption')?></div>
            </div>
          </div>

        </div>
      </div>
    </div>

    </div>
  </body>
  <?php get_footer('alt'); ?>
