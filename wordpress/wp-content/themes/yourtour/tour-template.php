<?php /* Template Name: Tour Template */ ?>

  <?php get_header('tour'); ?>

  <!-- Get Images -->

  <?php $tourId = get_field("tour_id"); ?>

  <?php
    $request = wp_remote_get( "https://yourtourservice.azurewebsites.net/api/tour/$tourId/public" );
    if( is_wp_error( $request ) ) {
      return false; // Bail early
    }
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );

    $reviewsRequest = wp_remote_get( "https://yourtourservice.azurewebsites.net/api/reviews/tour/$data->id" );
    if( is_wp_error( $reviewsRequest ) ) {
      return false; // Bail early
    }
    $reviewsBody = wp_remote_retrieve_body( $reviewsRequest );
    $reviewsData = json_decode( $reviewsBody );
  ?>

  <?php function current_url () {
    $url = "https://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    $validURL = str_replace("&","&amp;",$url);

    return $validURL;
  }?>

  <?php function get_initials ($fname) {
      $words = explode(" ", $fname);
      $initials = "";

      if (count($words) > 0) {
        $initials .= $words[0][0];
      }
      if (count($words) > 1) {
        $initials .= $words[count($words)-1][0];
      }

      return $initials;
  }?>

  <meta property="fb:app_id"             content="289085771609196" />
  <meta property="og:title"              content="<?php echo $data->name ?>" />
  <meta property="og:description"        content="<?php echo $data->description?>" />
  <meta property="og:image"              content="https://yourtourservice.azurewebsites.net/api/image/<?php echo $data->cover->imageId;?>" />

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
  <header>
    <div class="container-main">

      <div class="nav">
        <a href="<?php echo get_permalink( 56 ); ?>">
          <img src="<?php echo get_bloginfo('template_directory'); ?>/img/logo-black.png">
        </a>
        <div class="global-nav-items__container">
          <a class="global-nav-item" href="<?php echo get_permalink( 339 ); ?>">Explore the tours</a></li>
          <a class="global-nav-item" href="<?php echo get_permalink( 64 ); ?>" target="_blank">Help</a></li>
          <button class="o-button o-button__green contact-button-modal">Get in touch</button>
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
              <li class="mobile-nav__btn"><button class="o-button o-button__green contact-button-modal">Get in touch</button></li>
            </ul>
          </div>

      </div>
    </div>

    </header>

  <body>

  <div id="modal-share-tour" class="o-modal">
      <div class="modal-share-tour">

        <div class="modal-share-tour--content">
          <span id="modal-close-share-tour">x</span>
          <h3 class="modal-heading">Share via...</h3>

          <div class="modal-share-tour--link-container">
            <div class="modal-share-tour--link share-fb">
              <div class="modal-share-tour--link-icon share-fb-icon"></div>
              <div class="fb-share-button modal-share-tour--link-text--container" data-href="<?php echo current_url();?>" data-layout="button_count" data-size="small" data-mobile-iframe="true"><a class="fb-share modal-share-tour--link-text" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo current_url();?>";src="sdkpreparse" class="fb-xfbml-parse-ignore">Facebook</a></div>
              <div class="modal-share-tour--chevron share-fb-chevron"></div>
            </div>
          </div>

          <div class="modal-share-tour--link-container">
            <div class="modal-share-tour--link share-tw" href="#">
              <div class="modal-share-tour--link-icon share-tw-icon"></div>
              <a class="modal-share-tour--link-text" href="https://twitter.com/intent/tweet?text=Check%20out%20<?php $authorName = $data->authorProfile->name; echo $authorName?>&apos;s%20awesome%20YourTour!:&url=<?php echo current_url();?>&hashtags=goyourtour%2Cexplorelikeneverbefore">Twitter</a>
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

  <div class="popup-cta__container">
    <div class="popup-cta__button-container">
      <a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8"><button type="button" class="o-button--listen">Listen for free on the App</button></a>
    </div>
  </div>

  <section class="c-hero--tour">

    <div class="c-hero-tour--share">
      <div class="container-main">
        <div class="c-hero-tour--share-btn share-button-modal">Share tour</div>
      </div>
    </div>

    <div class="c-hero-tour--text">
      <div class="container-main">

        <h1 class="c-hero-tour--heading"><?php echo $data->name ?></h1>

        <div class="c-hero-tour--details">

          <div class="c-hero-tour--reviews">
            <div class="c-hero-tour--review-stars">
              <?php $avgRating = is_null($data->averageRating) ? 0 : $data->averageRating; echo do_shortcode("[usr $avgRating]"); ?>
            </div>
            <p class="c-hero-tour--review-count"><?php $reviewCount = is_null($data->numberOfReviews) ? 0 : $data->numberOfReviews; echo $reviewCount ?></p>
          </div>

          <div class="c-hero-tour--time">
            <img class="c-hero-tour--time-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/time-icon.svg"></img>
            <p class="c-hero-tour--time-count"><?php $mins = intval($data->tourDuration / 60); echo $mins?> mins</p>
          </div>

          <div class="c-hero-tour--distance">
            <img class="c-hero-tour--distance-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/distance-icon.svg"></img>
            <p class="c-hero-tour--distance-count"><?php $km = number_format($data->distance / 1000, 1, '.', ''); echo $km?> km</p>
          </div>

        </div>
      </div>
    </div>

    <div class="c-hero-tour--creator-details">
      <div class="container-main">
        <div class="creator-details__container">
          <div class="c-hero-tour--creator-image" style="background-image: url('https://yourtourservice.azurewebsites.net/api/image/<?php echo $data->authorProfile->headshotId;?>')"></div>
          <div class="c-hero-tour--creator-name">By <?php $authorName = $data->authorProfile->name; echo $authorName?></div>
        </div>
      </div>
    </div>


    <div class="c-hero-tour--overlay-solid"></div>
    <div class="c-hero-tour--overlay-gradient"></div>
    <div class="c-hero-tour--image" style="background-image: url('https://yourtourservice.azurewebsites.net/api/image/<?php echo $data->cover->imageId;?>')"></div>

  </section>

  <section class="tour__content-container container-main__no-mobile">

    <div class="tour__content-left">

        <div class="c-content-tour--upper">

          <p class="c-content-tour--description"><?php echo $data->description?></p>

        </div>

      <div class="c-content-tour--info">

          <div class="c-content-tour--key-details">
            <div class="c-content-tour--stops">
              <img class="c-content-tour--stop-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/stop-count-icon.svg"></img>
              <p class="c-content-tour--stop-count"><?php echo count($data->stops)?> stops</p>
            </div>

            <div class="c-content-tour--time">
              <img class="c-content-tour--time-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/time-icon-red.svg"></img>
              <p class="c-content-tour--time-count"><?php $mins = intval($data->tourDuration / 60); echo $mins?> mins</p>
            </div>

            <div class="c-content-tour--distance">
              <img class="c-content-tour--distance-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/distance-icon-red.svg"></img>
              <p class="c-content-tour--distance-count"><?php $km = number_format($data->distance / 1000, 1, '.', ''); echo $km?> km</p>
            </div>
          </div>

          <div class="c-content-tour--tags-container">

              <img class="c-content-tour--tags-icon" src="<?php echo get_bloginfo('template_directory'); ?>/img/tags-icon.svg"></img>

            <div class="c-content-tour--tags-wrapper">

                <?php

                foreach ($data->tags as $value) {
                  echo "<p class=\"c-content-tour--tag\">$value->name</p>";
                }

                ?>

            </div>

          </div>

          <div class="relative-container">

            <div class="c-stop-slider--arrows-container"></div>

            <div class="c-content-tour--map-container">

            <div class="c-content-tour--map-white-gradient-overlay"></div>

            <div class="c-content-tour--map-visual" id="map"></div>
            <script>
              var map;
              function initMap() {
                var styledMapType = new google.maps.StyledMapType(
                  [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#6195a0"}]},{"featureType":"administrative.province","elementType":"geometry.stroke","stylers":[{"visibility":"off"}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f2"},{"saturation":"0"},{"lightness":"0"},{"gamma":"1"}]},{"featureType":"landscape.man_made","stylers":[{"lightness":"-3"},{"gamma":"1.00"}]},{"featureType":"landscape.natural.terrain","stylers":[{"visibility":"off"}]},{"featureType":"poi","stylers":[{"saturation":"-100"}]},{"featureType":"poi.attraction","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"poi.business","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"poi.government","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"poi.medical","elementType":"labels","stylers":[{"visibility":"on"}]},{"featureType":"poi.park","elementType":"geometry.fill","stylers":[{"color":"#bae5ce"},{"visibility":"on"}]},{"featureType":"poi.place_of_worship","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.school","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"poi.sports_complex","elementType":"geometry","stylers":[{"visibility":"on"}]},{"featureType":"road","stylers":[{"saturation":-100},{"lightness":45},{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"labels.text.fill","stylers":[{"color":"#787878"}]},{"featureType":"road.highway","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#fac9a9"},{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"color":"#4e4e4e"}]},{"featureType":"transit","stylers":[{"visibility":"simplified"}]},{"featureType":"transit.station.airport","elementType":"labels.icon","stylers":[{"hue":"#0a00ff"},{"saturation":"-77"},{"lightness":"0"},{"gamma":"0.57"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"hue":"#ff6c00"},{"saturation":"-68"},{"lightness":"4"},{"gamma":"0.75"}]},{"featureType":"transit.station.rail","elementType":"labels.text.fill","stylers":[{"color":"#43321e"}]},{"featureType":"water","stylers":[{"color":"#eaf6f8"},{"visibility":"on"}]},{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#c7eced"}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"saturation":"-53"},{"lightness":"-49"},{"gamma":"0.79"}]}], {name: 'Styled Map'});

                var stopLatLng = new google.maps.LatLng({lat: parseFloat(<?php echo $data->stops[0]->latitude?>), lng: parseFloat(<?php echo $data->stops[0]->longitude?>)});
                map = new google.maps.Map(document.getElementById('map'), {
                  center: stopLatLng,
                  zoom: 16,
                  disableDefaultUI: true,
                  mapTypeControlOptions: {
                  mapTypeIds: ['styled_map']
                  }
                });

                var bounds = new google.maps.LatLngBounds();

                map.mapTypes.set('styled_map', styledMapType);
                map.setMapTypeId('styled_map');

                <?php $i=0; while ($i<count($data->stops)): $stop = $data->stops[$i]; $i++; ?>

                stopLatLng = new google.maps.LatLng({lat: parseFloat(<?php echo $stop->latitude?>), lng: parseFloat(<?php echo $stop->longitude?>)});

                bounds.extend(stopLatLng);

                var marker = new google.maps.Marker({
                  position: stopLatLng,
                  map: map,
                  icon: "<?php echo get_bloginfo('template_directory'); ?>/img/pins/pin<?php echo $i;?>.svg",
                  title: '<?php echo addslashes($stop->name)?>'
                });

                <?php endwhile;?>

                map.fitBounds(bounds, {top:20, bottom:220, right:20,left:20});

                <?php $i=0; while ($i<count($data->walks)): $walk = $data->walks[$i]; $i++; ?>

                var decodedPath = google.maps.geometry.encoding.decodePath('<?php echo addslashes($walk->encodedPolyline)?>');
                var path = new google.maps.Polyline({
                  path: decodedPath,
                  strokeColor: "#9384AF",
                  strokeOpacity: 1.0,
                  strokeWeight: 8,
                  map: map
                });

                <?php endwhile;?>
              }
            </script>
            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCaT5xMKjXBGYi8vAKZO8qkxMPHY0CDTFk&libraries=geometry&callback=initMap"
            async defer></script>

                <?php

                // check if the repeater field has rows of data
                if( count($data->stops) > 0 ):?>

                  <ul class="c-stop-slider--container">

                  <?php $i=0; while ($i<count($data->stops)): $stop = $data->stops[$i]; $i++; ?>

                      <li class="c-stop-slider--stop js-slide-single">

                      <div class="c-stop-slider--stop-image-container">
                        <div class="c-stop-slider--stop-details">
                          <div class="c-stop-slider--stop-number--container">
                            <div class="c-stop-slider--stop-number"><?php echo $i;?></div>
                            <div class="c-stop-slider--stop-number-circle"></div>
                          </div>
                          <div class="c-stop-slider--stop-name"><?php echo $stop->name;?></div>
                        </div>

                        <div class="c-hero-tour--overlay-gradient"></div>

                        <img class="c-stop-slider--stop-image" src="https://yourtourservice.azurewebsites.net/api/image/<?php echo $stop->cover->imageId;?>"/>

                      </div>

                      <div class="c-stop-slider--stop-summary"><?php echo $stop->description;?></div>

                      </li>

                    <?php endwhile;

                else :

                    // no rows found

                endif;

                ?>
            </ul>

          </div>

      </div>

      </div>

      <div class="c-content-tour--reviews">

          <div class="c-content-tour--reviews-container">

            <div class="c-content-tour--reviews-heading--container">
              <h4 class="c-content-tour--reviews-heading">Reviews</h4>
              <div class="c-content-tour--reviews">
                <div class="c-hero-tour--review-stars">
                  <?php echo do_shortcode("[usr $avgRating]"); ?>
                </div>
                <div class="c-content-tour--review-count"><?php $reviewCount = is_null($data->numberOfReviews) ? 0 : $data->numberOfReviews; echo $reviewCount ?> reviews</div>
              </div>
            </div>

            <?php

                // check if the repeater field has rows of data
                if( count($reviewsData) > 0 ):?>

                  <div class="c-tour--user-reviews">

                  <?php $i=0; while ($i<count($reviewsData)): $review = $reviewsData[$i]; $i++; ?>

                  <div class="c-tour--single-user-review">

                  <div class="c-single-user-review--info">
                    <?php if( $review->reviewer->headshot ):?>
                      <img class="c-single-user-review--reviewer-profile-image" src="https://yourtourservice.azurewebsites.net/api/image/<?php echo $review->reviewer->headshot;?>"/>
                    <?php else :?>
                      <div class="c-single-user-review--reviewer-profile-image--default" style="background-color: #22BFB3;">
                        <div class="c-single-user-review--reviewer-initials--default"><?php echo get_initials($review->reviewer->name)?></div>
                        </div>

                    <?php endif;?>
                    <div class="c-single-user-review--details">
                      <div class="c-single-user-review--reviewer-name"><?php echo $review->reviewer->name?></div>

                      <?php $date=date_create_from_format("Y-m-d?G:i:s.u?", $review->created);?>
                      <div class="c-single-user-review--review-date"><?php echo date_format($date, "d M Y")?></div>
                    </div>
                  </div>

                  <div class="c-single-user-review--review-stars">
                    <?php echo do_shortcode("[usr $review->ratingOverall]"); ?>
                  </div>

                  <p class="c-single-user-review--review"><?php echo $review->description?></p>

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

      <div class="c-content-tour--copyright-credits">

          <div class="c-content-tour--copyright-credits-container">

            <?php if ( $data->credits ): ?>

              <h4 class="c-content-tour-credits-heading">Copyright Credits</h4>

            <?php else: // field_name returned false ?>

            <?php endif; // end of if field_name logic ?>

            <div class="c-content-tour-credits"><?php echo $data->credits?></div>

          </div>

      </div>

    </div>

    <div class="tour__content-right">

      <div id="tour-page-sticky-cta" class="c-content-tour--right-container">

        <div class="c-content-tour--right">
          <!-- <button type="button" class="o-button--preview">Preview the first three Stops</button> -->

          <div id='tour__sticky-content__info'>
            <h3 id="tour__sticky-content__name"><?php echo $data->name ?></h3>
            <div class="tour__sticky-content__reviews">
              <div class="tour__sticky-content__review-stars">
                <?php $avgRating = is_null($data->averageRating) ? 0 : $data->averageRating; echo do_shortcode("[usr $avgRating]");?>
              </div>
              <div class="tour__sticky-content__review-count"><?php $reviewCount = is_null($data->numberOfReviews) ? 0 : $data->numberOfReviews; echo $reviewCount ?></div>
            </div>
          </div>
          <div class="tour__sticky-content__button-container">
            <a href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8" target="_blank"><button type="button" class="o-button--listen">Listen for free on the App</button></a>
          </div>
          <div class="app-store-lockup margin-top-20">
            <!-- <img class="app-icon-explorer--lockup" src="<?php echo get_bloginfo('template_directory'); ?>/img/explorer-app-icon.png"></img> -->
            <a class="o-link--app-store--lockup" href="https://itunes.apple.com/us/app/yourtour-amazing-audio-tours/id1338979433?ls=1&mt=8"><img src="<?php echo get_bloginfo('template_directory'); ?>/img/ios-app-store-badge.svg"></img></a>
          </div>
        </div>

      </div>

    </div>

  </section>

  </body>

  <?php get_footer('tour'); ?>
