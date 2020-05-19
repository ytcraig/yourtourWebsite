<?php /* Template Name: VR Tour Template */ ?>

  <!-- Get Images -->

  <?php $tourId = get_field("tour_id"); ?>

  <?php
    $request = wp_remote_get( "https://yourtourservice-staging.azurewebsites.net/api/tour/$tourId/public" );
    if( is_wp_error( $request ) ) {
      return false; // Bail early
    }
    $body = wp_remote_retrieve_body( $request );
    $data = json_decode( $body );

    $vrRequest = wp_remote_get( "https://yourtourservice-staging.azurewebsites.net/api/vr/$tourId" );
    if( is_wp_error( $vrRequest ) ) {
      return false; // Bail early
    }
    $vrBody = wp_remote_retrieve_body( $vrRequest );
    $vrData = json_decode( $vrBody );
  ?>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="viewport" content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
  <style> @-ms-viewport { width: device-width; } </style>
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/vr/vendor/reset.min.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/vr/style.css">
  </head>
  <body class="multiple-scenes ">

  <div id="pano"></div>

  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/es5-shim.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/eventShim.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/classList.js"></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/requestAnimationFrame.js" ></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/screenfull.min.js" ></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/bowser.min.js" ></script>
  <script src="<?php echo get_template_directory_uri(); ?>/vr/vendor/marzipano.js" ></script>

  <script>
    'use strict';

    (function() {
      var Marzipano = window.Marzipano;
      var bowser = window.bowser;
      var screenfull = window.screenfull;

      // Grab elements from DOM.
      var panoElement = document.querySelector('#pano');

      // Detect desktop or mobile mode.
      if (window.matchMedia) {
        var setMode = function() {
          if (mql.matches) {
            document.body.classList.remove('desktop');
            document.body.classList.add('mobile');
          } else {
            document.body.classList.remove('mobile');
            document.body.classList.add('desktop');
          }
        };
        var mql = matchMedia("(max-width: 500px), (max-height: 500px)");
        setMode();
        mql.addListener(setMode);
      } else {
        document.body.classList.add('desktop');
      }

      // Detect whether we are on a touch device.
      document.body.classList.add('no-touch');
      window.addEventListener('touchstart', function() {
        document.body.classList.remove('no-touch');
        document.body.classList.add('touch');
      });

      // Use tooltip fallback mode on IE < 11.
      if (bowser.msie && parseFloat(bowser.version) < 11) {
        document.body.classList.add('tooltip-fallback');
      }

      // Viewer options.
      var viewerOpts = {
        controls: {
          mouseViewMode: "drag"
        }
      };

      // Initialize viewer.
      var viewer = new Marzipano.Viewer(panoElement, viewerOpts);

      var source = Marzipano.ImageUrlSource.fromString("https://yourtourservice-staging.azurewebsites.net/api/image/<?php echo $vrData->stops[0]->vrSupplement->imageId?>");
      var levels = [{"width": 6080}]
      var geometry = new Marzipano.EquirectGeometry(levels);
      var view = new Marzipano.RectilinearView();

      var scene = viewer.createScene({
        source: source,
        geometry: geometry,
        view: view
      });

      scene.switchTo();
    })();
  </script>

  <?php echo $vrData->stops[0]->vrSupplement->imageId?>

  </body>
