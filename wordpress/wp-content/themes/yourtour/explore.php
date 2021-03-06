<?php /* Template Name: Explore */ ?>

  <?php get_header('explore'); ?>

  <?php
    $request = wp_remote_get( "https://yourtourservice.azurewebsites.net/api/tour/discover-web?range=50000" );
    if( is_wp_error( $request ) ) {
      return false; // Bail early
    }
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );
  ?>

    <div class="explore__hero-container">

        <div class="container-main">

          <div class="explore-hero__title">
              <div class="explore-hero__text-container">
                <div class="explore-hero__typed-container">
                  <h1 class="explore-hero__heading">Discover and explore</h1>
                  <h1 class="explore-hero__typed-element"></h1>
                </div>
                <h3 class="explore-hero__sub-heading">With tours live in the UK and across Europe and dozens more currently being created, there’s already lots to explore on the YourTour platform.</h3>
              </div>
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
      <div class="modal__outside-click"></div>
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
      <div class="modal__outside-click"></div>
    </div>

    <div class="explore__all-tours-container">

      <div class="explore__lines-left">
        <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-two-lines-left.svg">
      </div>

      <div class="container-main">

        <?php $tours = $data->tours; ?>
        <?php $i=0; while ($i<count($data->sections)): $section = $data->sections[$i]; $i++; ?>

          <h3 class="explore__tour-category"><?php echo $section->title;?></h3>
            <div class="explore__tours-outer-container">
              <div class="explore__tours-inner-container">

                <?php $j=0; while ($j<count($section->tourVersionIds)): $tourId = $section->tourVersionIds[$j]; $j++; ?>
                  <?php $key = array_search($tourId, array_column($tours, 'id')); $tour = $tours[$key]; ?>
                  <div class="explore__single-tour-outer-container">
                    <div class="explore__single-tour-padding-container">
                      <div class="explore__single-tour-inner-container">
                        <a href="https://goyourtour.com/<?php echo $tour->slug;?>">
                        <div class="section-tour-example-text__container">
                          <p class="section-tour-example__title"><?php echo $tour->name;?></p>
                          <!-- <p class="section-tour-example__categories">Major Sights, Family-friendly, History</p> -->
                          <div class="section-tour-example-reviews__container">
                            <div class="section-tour-example__review-stars">
                              <?php $avgRating = is_null($tour->averageRating) ? 0 : $tour->averageRating; echo do_shortcode("[usr $avgRating]"); ?>
                            </div>
                            <p class="section-tour-example_review-text"><?php $reviewCount = is_null($tour->numberOfReviews) ? 0 : $tour->numberOfReviews; echo $reviewCount ?> reviews</p>
                          </div>
                        </div>
                        <div class="section-tour-example__gradient"></div>
							<?php 
								$coverId = null;
								$key = "coverid=";
								foreach ($tour->cover->cropSizes as $cropSize) {
									$coverId = $cropSize->coverId;
								}
								if (is_null($coverId)) {
									$key = "id=";
									$coverId = $tour->cover->imageId;
								}
							?>
                        <img class="section-tour-example__img" src="https://yourtourservice.azurewebsites.net/api/image/resize?<?php echo $key.$coverId;?>&maxWidth=400&cropkey=Header">
                      </a>
                      </div>
                  </div>
                </div>
                    <?php endwhile;?>
              </div>
            </div>
            <?php if( $i == 2 ):?>
      </div>

            </div>
          </div>
          <div class="explore__create-cta__container">
            <div class="container-main">
              <div class="text-container">
                <h3 class="white-text">Want to create a tour of your own?</h3>
                <p class="white-text">Creating a YourTour is fun, easy and simple. Register for free for exclusive access to the Creator app.</p>
              </div>
              <div class="section-content__button-centered no-margin">
                <button class="creator-button-modal o-button o-button__white purple-text">Get started</button>
              </div>
            </div>
          </div>


          <div class="explore__all-tours-container overflow-hidden extra-padding-btm__40">
            <div class="explore__lines-right">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/section-three-lines-right.svg">
            </div>
            <div class="container-main">
            <?php endif; ?>

          <?php endwhile;?>
          </div>
        </div>


    <div class="explore__download-cta__container">

      <div class="container-main">

        <div class="explore__download-cta-content__contaner">

          <div class="text-container">
            <h2 class="white-text">Ready to start exploring?</h2>
            <p class="white-text">Simply download the YourTour Explorer App from the iOS App Store, choose a tour near you and get exploring!</p>
            <a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank">
              <img src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.svg">
            </a>
          </div>

          <div class="explore__phones-container">
            <img src="<?php echo get_bloginfo('template_directory'); ?>/img/explore-two-phones.png">
          </div>

        </div>

      </div>

    </div>

  <?php get_footer(); ?>
