<?php /* Template Name: VR VideoTour Template */ ?>

<meta charset="utf-8" />
  <meta name="description" content="A VR Tour by YourTour" />
  <meta name="viewport"
    content="target-densitydpi=device-dpi, width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, minimal-ui" />
  <style>
    @-ms-viewport {
      width: device-width;
    }
  </style>

  <link rel="stylesheet" href="/vr/css/style.css">
  <link rel="stylesheet" href="/vr/css/tooltip.css">

  <script>
    let baseURL = '<?php echo get_field("base_url"); ?>'
  </script>
</head>

<body onload="loadTourDetails()">

  <div id="pano"></div>

  <div id="compass" style="opacity: 0.0;">
    <svg width="42px" height="42px" viewBox="0 0 42 42" version="1.1" xmlns="http://www.w3.org/2000/svg"
      xmlns:xlink="http://www.w3.org/1999/xlink">
      <path stroke="#22BFB3" stroke-width="2" fill="none"
        d="M20.413677,10.4026033 L12.071638,28.943731 C11.8048843,29.535641 12.328987,30.1836066 12.8872888,29.9517831 L20.7702036,26.6815519 C20.9181151,26.6197957 21.0814163,26.6197957 21.2293278,26.6815519 L29.1130976,29.9517831 C29.6705445,30.1836066 30.1946472,29.535641 29.9287484,28.943731 L21.5867094,10.4026033 C21.3447501,9.86579891 20.6547813,9.86579891 20.413677,10.4026033 Z"
        id="Arrow"></path>
    </svg>
  </div>

  <div class="video-footer" id="video-footer">
    <div id="panel-tour-begin">
      <button class="start-btn" id="begin-tour-btn"> <img class="play-icon" />Begin tour</button>
    </div>
    <div id="panel-tour-continue" style="display:none">
      <button class="start-btn" id="cont-tour-btn"> Continue</button>
    </div>
    <div id="panel-tour-during" style="display:none">
      <div id="control-container" class="control-container">
        <img class="rewind-btn" id="rewind-btn" src="/vr/img/skip-back-15.svg" />
        <img class="play-btn paused" />
        <img class="skip-btn" id="skip-btn" src="/vr/img/skip-forward.svg" />

      </div>
      <div class="stops-container-wrap">
        <div class="stops-container" id="stops-container">
            
        </div>
      </div>

    </div>
  </div>

  <div id="hotspot-details" style="display:none">
    <div id="hotspot-image-container">
      <img id="hotspot-full-image" src="">
    </div>
    <div id="hotspot-details-container">
      <h1 id="hotspot-details-title"></h1>
      <p id="hotspot-details-description"></p>
      <button id="hotspot-details-close-button" onclick="closeHotspot()"><img src="/vr/img/close-button.svg"></button>
    </div>
  </div>

  <div id="loading-overlay">
    <!-- <div id="loading-image-container"> -->
      <!-- <img id="loading-image" src="vr/img/arc.svg" /> -->
    <!-- </div> -->
    <p id="loading-text">Loading tour...</p>
  </div>

  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="/vr/js/marzipano.js"></script>
  <script src="/vr/js/VideoAsset.js"></script>
  <script src="/vr/js/DeviceOrientationControlMethod.js"></script>
  <script src="/vr/js/tourLoader.js"></script>
  <script src="/vr/js/generic.js"></script>
  <script src="/vr/js/SphericalCoordinate.js"></script>

</body>
