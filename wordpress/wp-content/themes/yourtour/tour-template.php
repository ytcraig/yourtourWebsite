<?php /* Template Name: Tour Template */ ?>

  <?php get_header('alt'); ?>

  <!-- Get Images -->

  <?php $heroImage = get_field("hero_image"); ?>
  <?php $profileImage = get_field("profile_image"); ?>
  <?php $mapImage = get_field("map_image"); ?>

  <?php function current_url () {
    $url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $validURL = str_replace("&","&amp;",$url);

    return $validURL;
  }?>

  <div id="modal-share-tour" class="o-modal">
    <div class="modal-share-tour">

      <div class="modal-share-tour--content">
        <span id="modal-close-share-tour">x</span>
        <h3 class="modal-heading">Share via...</h3>
        <div class="modal-share-tour--top-text">Check out Brett’s awesome YourTour: The History of Quorn: Floods, Fighting and Fox Hunting</div>

        <div class="modal-share-tour--link-container">
          <div class="modal-share-tour--link share-fb">
            <div class="modal-share-tour--link-icon share-fb-icon"></div>
            <div class="fb-share-button modal-share-tour--link-text--container" data-href="<?php echo current_url();?>" data-layout="button_count" data-size="small" data-mobile-iframe="true">
              <a class="fb-share modal-share-tour--link-text" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fgoyourtour.com%2Ftour-page%2F&amp;src=sdkpreparse" class="fb-xfbml-parse-ignore">Facebook</a>
            </div>
            <div class="modal-share-tour--chevron share-fb-chevron"></div>
          </div>
        </div>

        <div class="modal-share-tour--link-container">
          <div class="modal-share-tour--link share-tw">
            <div class="modal-share-tour--link-icon share-tw-icon"></div>
            <a class="modal-share-tour--link-text" href="https://twitter.com/intent/tweet?text=Check%20out%20Brett&apos;s%20awesome%20YourTour!:&url=<?php echo current_url();?>&hashtags=goyourtour%2Cexplorelikeneverbefore">Twitter</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8" target="_blank"></script>
            <div class="modal-share-tour--chevron share-tw-chevron"></div>
          </div>
        </div>

        <div class="modal-share-tour--link-container">
          <a class="modal-share-tour--link share-em" href="mailto:?subject=Check out this awesome YourTour!&body=Hey, I found this awesome YourTour I think you might like: <?php echo current_url();?>">
            <div class="modal-share-tour--link-icon"></div>
            <p class="modal-share-tour--link-text">Email</p>
            <div class="modal-share-tour--chevron"></div>
          </a>
        </div>

        <div class="modal-share-tour--link-container">
          <div class="modal-share-tour--link share-cl">
            <div class="modal-share-tour--link-icon"></div>
            <button id="clipboard-button" class="modal-share-tour--link-button clipboard-button" data-clipboard-text="<?php echo current_url();?>">
              Copy link
            </button>
            <div class="modal-share-tour--chevron"></div>
          </div>
        </div>

      </div>

    </div>
  </div>

  <section class="c-hero--tour">

    <div class="c-hero-tour--share">
      <div class="container-main">
        <div id="share-tour-button" class="c-hero-tour--share-btn">Share tour</div>
      </div>
    </div>

    <div class="c-hero-tour--text">
      <div class="container-main">
        <h1 class="c-hero-tour--heading"><?php the_field('hero_heading')?></h1>
        <div class="c-hero-tour--details">

          <div class="c-hero-tour--reviews">
            <img class="c-hero-tour--review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/review-stars.svg"></img>
            <div class="c-hero-tour--review-count"><?php the_field('hero_review_count')?></div>
          </div>

          <div class="c-hero-tour--time">
            <img class="c-hero-tour--time-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/time-icon.svg"></img>
            <div class="c-hero-tour--time-count"><?php the_field('time_count')?> mins</div>
          </div>

          <div class="c-hero-tour--distance">
            <img class="c-hero-tour--distance-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/distance-icon.svg"></img>
            <div class="c-hero-tour--distance-count"><?php the_field('distance_count')?> km</div>
          </div>

        </div>
      </div>
    </div>

    <div class="c-hero-tour--creator-details">
      <div class="container-main">
        <div class="c-hero-tour--creator-image" style="background-image: url(<?php echo $profileImage["url"];?>)"></div>
        <div class="c-hero-tour--creator-name">By <?php the_field('creator_name')?></div>

      </div>
    </div>


    <div class="c-hero-tour--overlay-solid"></div>
    <div class="c-hero-tour--overlay-gradient"></div>
    <div class="c-hero-tour--image" style="background-image: url(<?php echo $heroImage["url"];?>)"></div>

  </section>

  <section class="c-content-tour--upper">

    <div class="container-main">
      <div class="c-content-tour--description"><?php the_field('tour_description')?></div>

      <div class="c-content-tour--right-container">

        <div id="tour-page-sticky-cta" class="c-content-tour--right">
          <button type="button" class="o-button--preview">Preview the first two Stops</button>
          <a href="#"><button type="button" class="o-button--listen">Listen for free on the App</button></a>
          <div class="app-store-lockup">
            <img class="app-icon-explorer--lockup" src="<?php echo get_bloginfo('template_directory'); ?>/img/explorer-app-icon.png"></img>
            <a class="o-link--app-store--lockup" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.svg"></img></a>
          </div>
        </div>

      </div>

    </div>

  </section>

  <section class="c-content-tour--map">

    <div class="container-main">

      <div class="c-content-tour--key-details">
        <div class="c-content-tour--stops">
          <img class="c-content-tour--stop-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/stop-count-icon.svg"></img>
          <div class="c-content-tour--stop-count"><?php the_field('stop_count')?> stops</div>
        </div>

        <div class="c-content-tour--time">
          <img class="c-content-tour--time-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/time-icon-red.svg"></img>
          <div class="c-content-tour--time-count"><?php the_field('time_count')?> mins</div>
        </div>

        <div class="c-content-tour--distance">
          <img class="c-content-tour--distance-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/distance-icon-red.svg"></img>
          <div class="c-content-tour--distance-count"><?php the_field('distance_count')?> km</div>
        </div>
      </div>

      <div class="c-content-tour--tags-container">
          <img class="c-content-tour--tags-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/tags-icon.svg"></img>
          <div class="c-content-tour--tags-wrapper">

          <?php

          // check if the repeater field has rows of data
          if( have_rows('tags') ):

           	// loop through the rows of data
              while ( have_rows('tags') ) : the_row();?>

                  <div class="c-content-tour--tag"><?php the_sub_field('single_tag');?></div>

              <?php endwhile;

          else :

              // no rows found

          endif;

          ?>

        </div>

      </div>

      <div class="c-content-tour--map-container">

        <div class="c-stop-slider--arrows-container"></div>

        <div class="c-content-tour--map-white-gradient-overlay"></div>

        <div class="c-content-tour--map-visual" style="background-image: url(<?php echo $mapImage["url"];?>)"></div>

            <?php

            // check if the repeater field has rows of data
            if( have_rows('stop_gallery') ):?>

              <ul class="c-stop-slider--container">

              <?php
              // loop through the rows of data
                while ( have_rows('stop_gallery') ) : the_row();?>

                  <?php $stopImage = get_sub_field("stop_image"); ?>

                  <li class="c-stop-slider--stop js-slide-single">

                  <div class="c-stop-slider--stop-image-container">
                    <div class="c-stop-slider--stop-details">
                      <div class="c-stop-slider--stop-number--container">
                        <div class="c-stop-slider--stop-number"><?php the_sub_field('stop_number')?></div>
                        <div class="c-stop-slider--stop-number-circle"></div>
                      </div>
                      <div class="c-stop-slider--stop-name"><?php the_sub_field('stop_name')?></div>
                    </div>

                    <div class="c-hero-tour--overlay-gradient"></div>
                    <img class="c-stop-slider--stop-image" src="<?php echo $stopImage["url"];?>"/>

                  </div>

                  <div class="c-stop-slider--stop-summary"><?php the_sub_field('stop_summary')?></div>

                  </li>

                <?php endwhile;

            else :

                // no rows found

            endif;

            ?>
        </ul>

      </div>

    </div>

  </section>

  <section class="c-content-tour--reviews">

    <div class="container-main">

      <div class="c-content-tour--reviews-container">

        <div class="c-content-tour--reviews-heading--container">
          <h4 class="c-content-tour--reviews-heading">Reviews</h4>
          <div class="c-content-tour--reviews">
            <img class="c-hero-tour--review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/review-stars.svg"></img>
            <div class="c-content-tour--review-count"><?php the_field('hero_review_count')?></div>
          </div>
        </div>

        <?php

        // check if the repeater field has rows of data
        if( have_rows('reviews') ):?>

          <div class="c-tour--user-reviews">

          <?php
          // loop through the rows of data
            while ( have_rows('reviews') ) : the_row();?>

              <?php $reviewerProfileImage = get_sub_field("reviewer_profile_image"); ?>

              <div class="c-tour--single-user-review">

              <div class="c-single-user-review--info">
                <img class="c-single-user-review--reviewer-profile-image" src="<?php echo $reviewerProfileImage["url"];?>"/>
                <div class="c-single-user-review--details">
                  <div class="c-single-user-review--reviewer-name"><?php the_sub_field('reviewer_name')?></div>
                  <div class="c-single-user-review--review-date"><?php the_sub_field('review_date')?></div>
                </div>
              </div>

              <img class="c-single-user-review--review-stars" src="<?php echo get_bloginfo('template_directory'); ?>/img/review-stars.svg"></img>

              <div class="c-single-user-review--review"><?php the_sub_field('review')?></div>

            </div>

            <?php endwhile;

            else :

            // no rows found

          endif;

          ?>

        </div>

          <div class="c-tour--reviews-pagination--container"></div>

      </div>

    </div>


  </section>

  <section class="c-content-tour--copyright-credits">

    <div class="container-main">

      <div class="c-content-tour--copyright-credits-container">

        <?php if ( get_field( 'copyright_credits' ) ): ?>

          <h4 class="c-content-tour-credits-heading">Copyright Credits</h4>

        <?php else: // field_name returned false ?>

        <?php endif; // end of if field_name logic ?>

        <div class="c-content-tour-credits"><?php the_field('copyright_credits')?></div>

      </div>

    </div>

  </section>

  </body>

  <?php get_footer('alt'); ?>
