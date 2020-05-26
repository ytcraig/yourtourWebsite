/*
 * Copyright 2016 Google Inc. All rights reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */
'use strict';

var useVRImages = false;
var useFullscreenButton = true;

// Create viewer.
// Video requires WebGL support.
var viewerOpts = { stageType: 'webgl' };
var pano = document.getElementById('pano');
var viewer = new Marzipano.Viewer(pano, viewerOpts);

var deviceOrientationControlMethod = new DeviceOrientationControlMethod();
registerDeviceOrientation();

function registerDeviceOrientation() {
  var controls = viewer.controls();
  controls.registerMethod('deviceOrientation', deviceOrientationControlMethod);

  deviceOrientationControlMethod.getPitch(function(err, pitch) {
    if (!err) {
      view.setPitch(pitch);
    }
  });
  controls.enableMethod('deviceOrientation');
}

window.addEventListener("message", receiveMessage, false);
function receiveMessage(event) {
    // console.debug(event.data);
    deviceOrientationControlMethod._handleData(event.data);
}

// Create asset and source.
var asset = new VideoAsset();
var source = new Marzipano.SingleAssetSource(asset);
var video = null;
var newVideo = null;
var stopImageSource;
var audio = document.createElement('audio');
var gpAudio = document.createElement('audio');

var sources = [];
var currentSrc = 0;

// Create geometry.
var geometry = new Marzipano.EquirectGeometry([{ width: 1 }]);

// Create view.
var limiter = Marzipano.RectilinearView.limit.vfov(90 * Math.PI / 180, 90 * Math.PI / 180);
var view = new Marzipano.RectilinearView({ yaw: 0, fov: Math.PI / 2 }, limiter);

var scene = viewer.createEmptyScene({
  view: view
});

var videoLayer;
var oldVideoLayer;
var stopImageLayer;
var oldStopImageLayer;

// Display scene.
scene.switchTo();

var stage = viewer.stage();

var coverCircleSource = Marzipano.ImageUrlSource.fromString(
  "/vr/img/CoverCircle.png"
);
var coverCircleGeometry = new Marzipano.PlaneGeometry({ size: 400 * 3 / 2000 }); // 20 / 3
coverCircleGeometry.rotX = -Math.PI / 2
var circleLayer = scene.createLayer({
  source: coverCircleSource,
  geometry: coverCircleGeometry,
  pinFirstLevel: true
});

var arrowSource = Marzipano.ImageUrlSource.fromString(
  "/vr/img/vr-arrow.svg"
);
var arrowGeometry = new Marzipano.PlaneGeometry({ size: 0.05 });
var arrow = scene.createLayer({
  source: arrowSource,
  geometry: arrowGeometry,
  pinFirstLevel: true
});
arrow.hidden = true;
var arrowTarget;
var arrowLocation;

var compassBackground = document.getElementById('compass');
var compass = document.getElementById('Arrow');
var hotspotDetails = document.getElementById('hotspot-details');

var fullscreenButton = document.getElementById('fullscreen');
var fullscreenIcon = document.getElementById('fullscreen-icon');

var videoFooter = document.getElementById('video-footer');
var controlContainer = document.getElementById('control-container');

// Whether playback has started.
var loaded = false;
var firstVideoLoaded = false;
var started = false;
var autoContinue = false;
var awaitingContinue = false;

const states = {
  STOP: 'stop',
  WALK: 'walk'
}
var state = states.STOP;
function setState(newState) {
  state = newState;

  switch (state) {
    case states.STOP:
      arrow.hidden = currentHotspots.length == 0;
      break;
    case states.WALK:
      arrow.hidden = _followingCameraMan;
      break;
  }
}

var videoIndex = 0;
var audioIndex = 0;

var circleTimes = [[0.0, 0.0, Math.PI]];
var currentCircleTime = 0;
var freeLookAngle = 45 * Math.PI / 180;
var _followingCameraMan = true;
function setFollowingCameraMan(following) {
  _followingCameraMan = following;

  setCompassVisibility(_followingCameraMan ? compassStates.VISIBLE : compassStates.FADED);

  if (state == states.WALK) {
    arrow.hidden = following
  }
}
var previousCameraLon = 0;
var relockAfter = 1000;
var relockTimer = null;
var resetRotation = false;

function resetRelockTimer() {
  if (relockTimer) {
    clearInterval(relockTimer);
    relockTimer = null;
  }
};

var currentGuidePoints = [];
var currentGuidePointIndex = 0;
var nextGuidePointTime = 0;
var nextGuidePointName = null;
var guidePointPlaying = false;
var videoFinished = false;

var currentHotspots = [];
var dormantHotspots = [];
var activeHotspots = [];

var paused = false;

var loadingInterval;
var loadingImg;
var loadingImgSources = ['vr/img/arc.svg', 'vr/img/art.svg', 'vr/img/ents.svg', 'vr/img/sport.svg', 'vr/img/food.svg', 'vr/img/nature.svg', 'vr/img/history.svg', 'vr/img/horror.svg', 'vr/img/scenic.svg'];
var loadingImgIndex = 0;
function fadeOutLoadingImage() {
  loadingImg.fadeOut(300, changeLoadingImage);
}

if (/iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream && window.location == window.parent.location) {
  useFullscreenButton = false;
  fullscreenButton.style.visibility = "hidden";
  fullscreenIcon.style.visibility = "hidden";
}

var clickStart;
pano.onmousedown = function (e) {
  clickStart = {x: e.pageX, y: e.pageY};
}

pano.onclick = function (e) {
  if (!arrow.hidden && Math.abs(e.pageX - clickStart.x) < 10 && Math.abs(e.pageY - clickStart.y) < 10) {
    let coords = view.screenToCoordinates({x: e.pageX, y: e.pageY});

    let latDiff = Math.abs(clampAngle(coords.pitch - arrowLocation.lat + Math.PI * 0.5));
    if (latDiff < 0.05) {
      let lonDiff = Math.abs(clampAngle(coords.yaw - arrowLocation.lon));
      if (lonDiff < 0.04) {
        switch (state) {
          case states.STOP:
            rotateTo(arrowTarget.lon);
            break;
          case states.WALK:
            rotateTo(previousCameraLon);
            break;
        }
      }
    }
  }
}

document.addEventListener('keyup', event => {
  if (event.code === 'Space') {
    console.log('Space pressed')
    togglePlay();
  }
})

// function changeLoadingImage() {
//   loadingImgIndex += 1;
//   if (loadingImgIndex == loadingImgSources.length) {
//     loadingImgIndex = 0
//   }
//   loadingImg.attr('src', loadingImgSources[loadingImgIndex]);
//   loadingImg.fadeIn(300);
// }

var playBtn;
function togglePlay() {
  playBtn.toggleClass("paused");

  if (awaitingContinue) {
    continueTour();
    return;
  }

  paused = !paused;
  if (paused) {
    video.pause();
    audio.pause();
    gpAudio.pause();
  } else {
    switch (state) {
      case states.STOP:
        audio.src == "" ? audio.onended() : audio.play();
        break;
      case states.WALK:
        video.play();
        if (guidePointPlaying) {
          gpAudio.play();
        }
        break;
    }
  }
}

function continueTour() {
  $("#panel-tour-continue").hide();
  awaitingContinue = false;
    
  // if we're not in follow mode, rotate back before starting the walk.
  if (_followingCameraMan) {
    startWalk();
    $("#panel-tour-during").show();
  } else {
    rotateTo(previousCameraLon, function () {
      startWalk();
      $("#panel-tour-during").show();
    });
  }
}

$(document).ready(function () {
  // loadingImg = $("#loading-image");
  // loadingInterval = window.setInterval(fadeOutLoadingImage, 1600);
  playBtn = $(".play-btn.paused");
  playBtn.click(function () {
    togglePlay();
    return false;
  });

  var beginBtn = $("#begin-tour-btn");
  beginBtn.click(function () {
    tryStart();
    openFullscreen(document.documentElement);
    $("#panel-tour-begin").hide();
    $("#panel-tour-during").show();
    
    if (videoFooter.className == 'video-footer') {
      stopSpacer.style.display = 'inline-block';
    }

    return false;
  });

  var contBtn = $("#cont-tour-btn");
  contBtn.click(function () {
    continueTour();
    return false;
  });

  var skipBtn = $("#skip-btn");
  skipBtn.click(function () {
    switch (state) {
      case states.STOP:
        audio.pause();
        startWalk();
        autoContinue = false;
        break;
      case states.WALK:
        video.pause();
        gpAudio.pause();
        guidePointPlaying = false;

        nextGuidePointName = null;

        videoIndex += 1;
        setState(states.STOP);
        createNewVideo();
        loadAudio();
        setActive("stop" + videoIndex);
        resetRotation = true;
        break;
    }

    return false;
  });

  var rewindBtn = $("#rewind-btn");
  rewindBtn.click(function () {
    switch (state) {
      case states.STOP:
        audio.currentTime = Math.max(audio.currentTime - 15, 0)
        break;
      case states.WALK:
        video.currentTime = Math.max(video.currentTime - 15, 0)

        if (guidePointPlaying) {
          gpAudio.currentTime = Math.max(gpAudio.currentTime - 15, 0)
        }
        currentCircleTime = 0;
        updateCircle();
        resetView();
        break;
    }

    return false;
  });

  window.onresize = onWindowResize;
  onWindowResize();
});

function setActive(id) {
  $(".walk").removeClass("active");
  $(".stop").removeClass("active");
  $("#" + id).addClass("active");
}

function removeStopImageLayer() {
  if (stopImageLayer) {
    stopImageLayer.textureStore().removeEventListener('textureLoad', stopTextureLoad);
    scene.destroyLayer(stopImageLayer);
    stopImageLayer = null;
  }
}

function removeOldStopImageLayer() {
  if (oldStopImageLayer) {
    oldStopImageLayer.textureStore().removeEventListener('textureLoad', stopTextureLoad);
    scene.destroyLayer(oldStopImageLayer);
    oldStopImageLayer = null;
  }
}

function createNewStopImage() {
  if (videoIndex >= stopImageNames.length) {
    return;
  }

  if (oldStopImageLayer) {
    removeStopImageLayer();
  } else {
    oldStopImageLayer = stopImageLayer;
  }

  var imageId = stopImageNames[videoIndex];
  stopImageSource = Marzipano.ImageUrlSource.fromString(
    baseURL + 'api/image/resize/?id=' + imageId + '&maxWidth=4096'
  );
  stopImageLayer = scene.createLayer({
    source: stopImageSource,
    geometry: geometry,
    pinFirstLevel: true
  });
  stage.moveLayer(stopImageLayer, 1);
  stopImageLayer.textureStore().addEventListener('textureLoad', stopTextureLoad);
}

function stopTextureLoad() {
  removeOldStopImageLayer();
  beginStop();
}

function textureError() {
  console.log('Texture load error!');
}

function textureInvalid() {
  console.log('Texture invalid!');
}

function videoTextureLoad() {
  removeOldStopImageLayer();
  videoLayer.textureStore().removeEventListener('textureLoad', videoTextureLoad);
  videoLayer.textureStore().removeEventListener('textureError', videoTextureError);
}

function videoTextureError() {
  console.log('Texture load error!');
}

function tryNextVideoSource() {
  currentSrc += 1;
    if (currentSrc < sources.length) {
      newVideo.removeAttribute('src');
      newVideo.load();
      newVideo.src = sources[currentSrc];
      newVideo.load();
    } else {
      console.error("all sources have errored!");
    }
}

function createNewVideo() {
  // use vr image if this is the last stop
  if (useVRImages || videoIndex == videoNames.length) {
    createNewStopImage();
  } else {
    removeStopImageLayer();
  }

  if (video) {
    asset.setVideo(null);
    video.pause();
    video.removeAttribute('src');
    video.load();
    video = null;
  }

  if (videoIndex >= videoNames.length) {
    // Last stop
    return;
  }

  newVideo = document.createElement('video');
  newVideo.playsInline = true;
  newVideo.webkitPlaysInline = true;

  newVideo.onerror = function () {    
    if (newVideo.error.code == 3) {
      if (video) {
        video.removeAttribute('src');
        video.load();
        video = null;

        setTimeout(function() { createNewVideo(); }, 500);
      } else {
        tryNextVideoSource();
      }
    } else if (newVideo.error.code == 4) {
      tryNextVideoSource();
    }
  }

  var vidId = videoNames[videoIndex];
  sources = [baseURL + "api/video/url/" + vidId, "/vr/video/" + vidId + "/3072.mp4", "/vr/video/" + vidId + "/1920.mp4"];

  if (currentSrc == 0) {
    let src = sources[currentSrc];
    $.get(src, function(result, status) {
        if (status == "success") {
          newVideo.src = result;
          newVideo.load();
        } else {
          tryNextVideoSource();
        }
    });
  } else {
    newVideo.src = sources[currentSrc];
    newVideo.load();
  }
  
  newVideo.crossOrigin = 'anonymous';
  newVideo.preload = 'auto';

  newVideo.oncanplay = function () {
    setTimeout(function() { playNewVideo(); }, 100);
  };
}

function playNewVideo() {
  oldVideoLayer = videoLayer;

  if (video) {
    video.onended = null;
  }
  
  newVideo.onerror = null;
  video = newVideo;
  newVideo = null;
  video.oncanplay = null;
  
  asset = new VideoAsset(video);
  asset.index = videoIndex;
  source = new Marzipano.SingleAssetSource(asset);

  if (videoLayer) {
    videoLayer.textureStore().removeEventListener('textureLoad', videoTextureLoad);
    videoLayer.textureStore().removeEventListener('textureError', videoTextureError);
  }

  videoLayer = scene.createLayer({
    source: source,
    geometry: geometry,
    pinFirstLevel: true
  });
  videoLayer.textureStore().addEventListener('textureLoad', videoTextureLoad);
  videoLayer.textureStore().addEventListener('textureError', videoTextureError);

  stage.moveLayer(videoLayer, 0);

  beginStop();

  if (resetRotation) {
    resetRotation = false;
    resetView();
  }

  video.onended = function () {
    if (guidePointPlaying) {
      videoFinished = true;
    } else {
      finishWalk();
    }
  };

  if (!firstVideoLoaded) {
    firstVideoLoaded = true;
    var loadingOverlay = $("#loading-overlay");
    loadingOverlay.fadeOut(500, function() {
      window.clearInterval(loadingInterval);
    });
  }
}

function finishWalk() {
  videoFinished = false;
  videoIndex += 1;
  setActive("stop" + audioIndex);
  setState(states.STOP);
  createNewVideo();
}

function checkCircleTimes() {
  
  if (circleTimesArray != null) {
    circleTimes = videoIndex == videoNames.length ? circleTimesArray[videoIndex - 1] : circleTimes = circleTimesArray[videoIndex];
  }

  if (circleTimes == null) {
    circleTimes = [[0.0, 0.0, Math.PI]];
  }

  var initialYaw = Math.PI;
  if (circleTimes.length < 2) {
    circleLayer.hidden = true;
  } else {
    circleLayer.hidden = false;
    initialYaw = videoIndex == videoNames.length ? circleTimes[circleTimes.length-1][2] : circleTimes[0][2];
  }

  if (state == states.STOP) {
    currentCircleTime = videoIndex == videoNames.length ? circleTimes.length-1 : 0;
    previousCameraLon = initialYaw;
  }

  if (!started) {
    view.setYaw(initialYaw);
  }
}

function beginStop() {
  checkCircleTimes();

  if (started) {
    audio.src == "" ? audio.onended() : audio.play();

    if (video.currentTime > 0) {
      video.currentTime = 0;
    }
  } else {
    view.setPitch(0.2);
  }

  createHotspotsForCurrentStop();
  arrow.hidden = currentHotspots.length == 0;
  updateArrowAndCompass();
}

function tryLoad() {
  if (loaded) {
    return;
  }
  loaded = true;

  var stops = $(".stop");
  stops.click(function () {
    setActive(this.id);

    var id = parseInt(this.id.substring(4));

    videoIndex = id;
    audioIndex = id;
    video.pause();
    audio.pause();
    gpAudio.pause();
    guidePointPlaying = false;

    nextGuidePointName = null;

    resetRotation = true;
    createNewVideo();
    loadAudio();

    playBtn.addClass("paused");
    paused = false;

    setState(states.STOP);

    return false;
  });

  coverCircleGeometry.size = cowlSize * 3 / 2000;
  for (var i = 0; i < coverCircleGeometry.levelList.length; i++) {
    coverCircleGeometry.levelList[i]._size = cowlSize * 3 / 2000;
  }

//   var walks = $(".walk");
//   walks.click(function () {
//     setActive(this.id);
//     return false;
//   });

  var renderloop = viewer.renderLoop();
  renderloop.addEventListener('beforeRender', beforeRender);
  renderloop.addEventListener('afterRender', afterRender);

  audio.onended = function () {
    if (autoContinue || ((currentHotspots.length == 0 && audioNames[audioIndex] != null && _followingCameraMan) || audioIndex == 0)) {
      startWalk();
      autoContinue = false;
    } else {
      $("#panel-tour-continue").show();
      $("#panel-tour-during").hide();
      awaitingContinue = true;
    }
  };

  audio.ontimeupdate = function () {
    checkForHotspotActivation();
  };

  audio.onerror = function () {
    console.error("audio error: " + audio.error.code);
  };

  gpAudio.onended = function () {
    guidePointPlaying = false;
    if (videoFinished) {
      finishWalk();
    } else {
      loadNextGPAudio();
    }
    
  };

  // const mediaConfig = {
  //   type: 'file', // or 'file'
  //   video : {
  //     contentType : "video/mp4;codecs=avc1.640034", // valid content type
  //     width : 4096,     // width of the video
  //     height : 2048,    // height of the video
  //     bitrate : 10000000, // number of bits used to encode 1s of video
  //     framerate : 30   // number of frames making up that 1s.
  //  }
  // };
  
  // navigator.mediaCapabilities.decodingInfo(mediaConfig).then(result => {
  //   console.log('This configuration is' +
  //       (result.supported ? '' : ' NOT') + ' supported,' +
  //       (result.smooth ? '' : ' NOT') + ' smooth and' +
  //       (result.powerEfficient ? '' : ' NOT') + ' power efficient.');
  // });

  loadAudio();
  createNewVideo();
}

function startWalk() {
  removeAllHotspots();
  removeStopImageLayer();
  removeOldStopImageLayer();
  setActive("walk" + videoIndex);
  setState(states.WALK);
  loadGPsForWalk();
  video.play()
  audioIndex += 1;
  loadAudio();
}

// Try to start playback.
function tryStart() {
  if (started) {
    return;
  }
  started = true;

  setCompassVisibility(_followingCameraMan ? compassStates.VISIBLE : compassStates.FADED);

  audio.src == "" ? audio.onended() : audio.play();

  if (window.location == window.parent.location) {
    if (window.DeviceOrientationEvent && typeof window.DeviceOrientationEvent.requestPermission === 'function') {
      window.DeviceOrientationEvent.requestPermission().then(response => {
        if (response == 'granted') {
          // registerDeviceOrientation();
        }
      })
      .catch(console.error)
    } else {

    }
  } else {
    // in an iFrame. Tell the parent to start updates
    window.parent.postMessage("startDeviceOrientationUpdates", "*");
  }
}

function beforeRender() {
  updateCircle();
  updateVRArrow();
  checkForGuidePointTrigger();
}

function afterRender() {
  if (oldVideoLayer) {
    scene.destroyLayer(oldVideoLayer);
    oldVideoLayer = null;
  }
}

function loadAudio() {
  let audioName = audioNames[audioIndex];
  if (audioName == null) {
    audio.removeAttribute('src');
    return;
  }

  audio.src = baseURL + "api/audio/direct/" + audioName;
  audio.load();
}

function loadGPsForWalk() {
  currentGuidePoints = guidePointTimes[videoIndex];
  currentGuidePointIndex = 0;

  loadNextGPAudio();
}

function loadNextGPAudio() {
  if (currentGuidePoints.length > currentGuidePointIndex) {
    var currentGP = currentGuidePoints[currentGuidePointIndex];
    nextGuidePointName = currentGP.audioName;
    nextGuidePointTime = currentGP.time;
    currentGuidePointIndex += 1;

    gpAudio.src = baseURL + "api/audio/direct/" + nextGuidePointName;
    gpAudio.load();
  } else {
    nextGuidePointName = null;
  }
}

function clampAngle(angle) {
  if (Math.abs(angle) > Math.PI) {
    return Math.sign(-angle) * Math.PI * 2 + angle
  }
  return angle
}

function checkForGuidePointTrigger() {
  if (nextGuidePointName == null) { return; }
  if (guidePointPlaying) { return; }

  var currentTime = video.currentTime;

  if (currentTime > nextGuidePointTime) {
    guidePointPlaying = true;
    gpAudio.play();
  }
}

function updateCircle() {
  if (video == null) {
    return;
  }
  var currentTime = video.currentTime;
  if (videoIndex == videoNames.length) {
    currentTime = circleTimes[circleTimes.length-1][0]
  }

  for (let index = currentCircleTime; index < circleTimes.length; index++) {
    const time = circleTimes[index];
    if (time[0] > currentTime) {
      currentCircleTime = index;
      break;
    }
  }

  if (currentCircleTime == 0) {
    currentCircleTime = Math.max(circleTimes.length - 1, 0);
  }

  if (currentCircleTime > 0) {
    var time = circleTimes[currentCircleTime - 1];
    var nextTime = circleTimes[currentCircleTime];
    var seconds = time[0];
    var nextSeconds = nextTime[0];
    var diff = nextSeconds - seconds;
    var proportion = (currentTime - seconds) / diff;

    var latDiff = clampAngle(nextTime[1] - time[1]);
    var lonDiff = clampAngle(nextTime[2] - time[2]);

    var lat = time[1] + latDiff * proportion;
    var lon = time[2] + lonDiff * proportion;

    coverCircleGeometry.rotX = -lat - Math.PI * 0.5;
    coverCircleGeometry.rotY = -lon;

    var current = view.yaw();
    var diff = lon - previousCameraLon;

    var yawDiff = lon - current;
    if (_followingCameraMan) {
      if (Math.abs(clampAngle(yawDiff)) > freeLookAngle) {
        setFollowingCameraMan(false);
      } else {
        view.offsetYaw(diff);
      }
    } else if (Math.abs(clampAngle(yawDiff)) < reLockAngle) {
      if (!relockTimer) {
        relockTimer = setInterval(() => {
          setFollowingCameraMan(true);
        }, relockAfter);
      }
    } else {
      if (relockTimer) {
        clearInterval(relockTimer);
        relockTimer = null;
      }
    }

    previousCameraLon = lon;

    setCompassAngle(yawDiff);

    // if (followingCameraMan) {
    //     if abs(yawDiff) > freeLookAngle {
    //         followingCameraMan = false

    //         // show arrow pointing back towards 'forwards'
    //         vrArrow = HotspotArrowRenderer.init(lat: 0, lon: heading)
    //         vrArrow?.delegate = self
    //         vrArrow?.keepLevel = true
    //         sceneRenderer?.renderList.add(vrArrow)
    //     } else {
    //         // if still following the cameraman, compare lon to last lon. Add difference to head transform.
    //         let diff = heading - previousCameraLon
    //         sceneRenderer?.add(toHeadRotationYaw: CGFloat(diff), andPitch: 0)

    //         if let fullScreen = fullScreenVC, let renderer = fullScreen.currentRenderer as? MultiButtonViewRenderer {
    //             renderer.coordinates = renderer.coordinates + SphericalCoordinate.init(lat: 0, lon: diff)
    //         }
    //     }
    // } else if state == .walk, let arrow = vrArrow {
    //     arrow.target = SphericalCoordinate.init(lat: Float.pi * 0.5, lon: heading)

    //     if abs(yawDiff) < reLockAngle {
    //         if relockBegan == nil {
    //             relockBegan = Date()
    //         } else {
    //             let elapsed = -relockBegan!.timeIntervalSinceNow
    //             if elapsed > reLockAfter {
    //                 followingCameraMan = true
    //                 relockBegan = nil
    //                 self.vrArrow = nil
    //             }
    //         }
    //     } else {
    //         relockBegan = nil
    //     }

    // }
    // previousCameraLon = heading

    // if state == .walk {
    //     followCameraCompass.setHeadings(current: current, target: previousCameraLon)
    // } else {
    //     followCameraCompass.setHeadings(current: current, target: followCameraCompass.targetHeading)
    // }

  } else if (circleTimes.length > 0) {
    var time = circleTimes[0];
    var lon = time[2]
    var current = view.yaw();
    var yawDiff = lon - current;
    previousCameraLon = lon;
    setCompassAngle(yawDiff);

    if (_followingCameraMan && Math.abs(clampAngle(yawDiff)) > freeLookAngle) {
      setFollowingCameraMan(false);
    }
  }
}

let cutoffAngle = 45 * Math.PI / 180;
let reLockAngle = 20 * Math.PI / 180;
var compassGreen = [31, 191, 179];
var compassAmber = [232, 184, 46];
var compassRed = [242, 102, 104];
var compassFaded = "#808080";
var compassAngle = 0;
const compassStates = {
  VISIBLE: 'visible',
  FADED: 'faded',
  HIDDEN: 'hidden'
}
var _compassVisibilty = compassStates.HIDDEN;
function setCompassVisibility(state) {
  if (state == _compassVisibilty) {
    return;
  }

  switch (state) {
    case compassStates.VISIBLE:
      compassBackground.style.opacity = 1;
      break;
    case compassStates.FADED:
      compassBackground.style.opacity = 0.5;
      break;
    case compassStates.HIDDEN:
      compassBackground.style.opacity = 0;
      break;

    default:
      return;
  }

  _compassVisibilty = state;
  setCompassAngle(compassAngle);
}
function setCompassAngle(angle) {
  compassAngle = angle;
  compass.style.transform = "rotate(" + angle + "rad)";

  if (_compassVisibilty != compassStates.VISIBLE) {
    compass.style.stroke = compassFaded;
    return;
  }

  var headingVal = Math.abs(clampAngle(angle)) * 2 / cutoffAngle;
  headingVal = (headingVal - 0.2) * 1.25;
  headingVal = Math.max(Math.min(headingVal, 2), 0);

  var colour1 = compassGreen;
  var colour2 = compassAmber;
  if (headingVal > 1) {
    headingVal = headingVal - 1;
    colour1 = compassAmber;
    colour2 = compassRed;
  }

  function lerp(a, b, n) {
    return (1 - n) * a + n * b;
  }

  var r = Math.floor(lerp(colour1[0], colour2[0], headingVal));
  var g = Math.floor(lerp(colour1[1], colour2[1], headingVal));
  var b = Math.floor(lerp(colour1[2], colour2[2], headingVal));

  compass.style.stroke = "rgb(" + parseFloat(r) + "," + parseFloat(g) + "," + parseFloat(b) + ")";
}

compassBackground.onclick = function () {
  rotateTo(previousCameraLon);
}

var parentFullScreen = false;
function openFullscreen(elem) {
  if (elem.requestFullscreen) {
    elem.requestFullscreen();
  } else if (elem.mozRequestFullScreen) { /* Firefox */
    elem.mozRequestFullScreen();
  } else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
    elem.webkitRequestFullscreen();
  } else if (elem.msRequestFullscreen) { /* IE/Edge */
    elem.msRequestFullscreen();
  } else if (window.location !== window.parent.location) {
    // no request fullscreen function available and we're in an iFrame. Send message requesting fullscreen to parent.
    window.parent.postMessage("requestFullscreen", "*");
    parentFullScreen = true;
  }

  fullscreenIcon.src = "/vr/img/exit-full-screen.svg";
}

function closeFullscreen() {
  if (document.exitFullscreen) {
    document.exitFullscreen();
  } else if (document.mozCancelFullScreen) { /* Firefox */
    document.mozCancelFullScreen();
  } else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
    document.webkitExitFullscreen();
  } else if (document.msExitFullscreen) { /* IE/Edge */
    document.msExitFullscreen();
  }

  fullscreenIcon.src = "/vr/img/full-screen.svg";
}

fullscreenButton.onclick = function () {
  if (parentFullScreen) {
    parentFullScreen = false;
    window.parent.postMessage("exitFullscreen", "*");
    closeFullscreen();
  } else if (document.fullscreenElement) {
    closeFullscreen();
  } else {
    openFullscreen(document.documentElement);
  }
}

var movementComplete = false;
function rotate(opts) {
  var from = opts.from;
  var to = opts.to;
  var yawDiff = clampAngle(to - from)
  var duration = opts.duration

  return function start() {

    return function step(params, currentTime) {

      var progress = currentTime / 1000 / duration;

      if (progress > 1) {
        movementComplete = true;
        return null;
      }

      params.yaw = from + yawDiff * progress;

      return params;
    };
  };
}

function resetView() {
  setFollowingCameraMan(true);
  view.setYaw(previousCameraLon);
  setCompassAngle(0);
}

function rotateTo(to, completion) {
  movementComplete = false;
  var resetAfter = to == previousCameraLon;
  scene.startMovement(rotate({
    from: view.yaw(),
    to: to,
    duration: 0.5
  }), function () {
    if (movementComplete && resetAfter) {
      resetView();
    }

    if (completion) {
      completion();
    }
  });
}

function removeAllHotspots() {
  for (var i = currentHotspots.length - 1; i >= 0; i--) {
    var hotspot = currentHotspots[i];
    scene.hotspotContainer().destroyHotspot(hotspot);

    // var elem = hotspot.domElement();
    // elem.parentNode.removeChild(elem);
  }
  currentHotspots = [];
  dormantHotspots = [];
  activeHotspots = [];
}

function createHotspotsForCurrentStop() {

  removeAllHotspots();

  var hotspotsForStop = hotspots[videoIndex];
  hotspotsForStop.sort(function (a, b) {
    return b.activate - a.activate;
  });

  for (var i = hotspotsForStop.length - 1; i >= 0; i--) {
    var info = hotspotsForStop[i];
    var parser = new DOMParser();
    var id = 'tooltip' + i;
    var domString = '<div class="tooltip" id="' + id + '" onmouseover="mouseOverTooltip(this)" ontouchstart="touchStartTooltip(this)"><div class="pulse" style="display:none"></div><div class="out"><div class="in"></div><div class="tip left up"><p>' + info.title + '</p><img src="' + baseURL + 'api/image/' + info.imageId + '"></div></div></div>';
    var html = parser.parseFromString(domString, 'text/html');

    var elem = html.body.firstChild

    function addOnClick(elem) {
      elem.onclick = function () {
        hotspotClicked(elem);
      };
      stopTouchAndScrollEventPropagation(elem);
    }
    addOnClick(elem);

    var hotspot = scene.hotspotContainer().createHotspot(elem, { yaw: info.longitude - Math.PI, pitch: Math.PI * 0.5 - info.latitude });
    hotspot.info = info;
    hotspot.elementId = id;
    currentHotspots.push(hotspot);

    if (info.activate != info.deactivate) {
      dormantHotspots.push(hotspot);
    }
  }
}

// Prevent touch and scroll events from reaching the parent element.
function stopTouchAndScrollEventPropagation(element, eventList) {
  var eventList = ['touchstart', 'touchmove', 'touchend', 'touchcancel',
    'wheel', 'mousewheel'];
  for (var i = 0; i < eventList.length; i++) {
    element.addEventListener(eventList[i], function (event) {
      event.stopPropagation();
    });
  }
}

function onWindowResize() {
  if (window.innerHeight > window.innerWidth) {
    hotspotDetails.style.flexDirection = 'column';
  } else {
    hotspotDetails.style.flexDirection = 'row';
  }

  if (window.innerHeight > 700 && window.innerWidth > 700) {
    if (videoFooter.className != 'video-footer-floating') {
      videoFooter.className = 'video-footer-floating';

      compassBackground.style.top = '30px';
      compassBackground.style.right = '30px';
      compassBackground.style.transform = "scale(1.2, 1.2)";

      fullscreenButton.style.top = '30px';
      fullscreenButton.style.left = '30px';
      fullscreenButton.style.transform = "scale(1.2, 1.2)";
      
      controlContainer.style.width = '160px';
      controlContainer.style.maxWidth = '160px';
      controlContainer.style.marginLeft = '5px';

      // stopSpacer.style.display = 'none';
    }
  } else {
    if (videoFooter.className != 'video-footer') {
      videoFooter.className = 'video-footer';

      compassBackground.style.top = '10px';
      compassBackground.style.right = '10px';
      compassBackground.style.transform = "scale(1.0, 1.0)";

      fullscreenButton.style.top = '10px';
      fullscreenButton.style.left = '10px';
      fullscreenButton.style.transform = "scale(1.0, 1.0)";

      controlContainer.style.width = '130px';
      controlContainer.style.maxWidth = '120px';
      controlContainer.style.marginLeft = '0px';

      // stopSpacer.style.display = 'inline-block';
    }
  }
}

function hotspotClicked(elem) {
  var hotspot = currentHotspots.find(function (hotspot) {
    return hotspot.elementId == this;
  }, elem.id)

  if (hotspot != null) {
    var hotspotImage = document.getElementById("hotspot-full-image");
    var src = baseURL + 'api/image/' + hotspot.info.imageId;
    hotspotImage.src = src;

    var hotspotTitle = document.getElementById("hotspot-details-title");
    hotspotTitle.innerHTML = hotspot.info.title;
    var hotspotDescription = document.getElementById("hotspot-details-description");
    hotspotDescription.innerHTML = hotspot.info.description;

    $("#hotspot-details").fadeIn(500);
    $("#video-footer").fadeOut(500);

    // set this hotspot as tapped.
    elem.className = "tooltip viewed";

    $("#" + hotspot.elementId + " .pulse").hide();

    updateArrowAndCompass();
  }
}

function closeHotspot() {
  $("#hotspot-details").fadeOut(500);
  $("#video-footer").fadeIn(500);
}

function checkForHotspotActivation() {

  if (audio == null || audio.paused == true) {
    return;
  }

  var currentTime = audio.currentTime * 1000;

  var recheckLookatHotspot = false;

  for (var i = activeHotspots.length - 1; i >= 0; i--) {
    var hotspot = activeHotspots[i];
    if (hotspot.info.deactivate && currentTime > hotspot.info.deactivate) {
      $("#" + hotspot.elementId + " .pulse").hide();
      recheckLookatHotspot = true

      activeHotspots.splice(i, 1);
      break;
    }
  }
  if (dormantHotspots.length > 0) {
    var hotspot = dormantHotspots[0];
    if (currentTime > hotspot.info.activate) {
      $("#" + hotspot.elementId + " .pulse").show();
      recheckLookatHotspot = true

      // for (let i = activeHotspots.length - 1; i >= 0; i--) {
      //   const active = activeHotspots[i];
      //   if (active.info.deactivate == null) {
      //     $("#" + active.elementId + " .pulse").hide();
      //     activeHotspots.splice(i, 1);
      //   }
      // }

      dormantHotspots.splice(0, 1);
      activeHotspots.push(hotspot);
    }
  }

  if (recheckLookatHotspot) {
      updateArrowAndCompass()
  }
}

function nextHotspotFocusFrom(hotspots) {
  var currentTime = audio.currentTime * 1000;
  var first = hotspots.find(hotspot => (hotspot.info.activate < currentTime && hotspot.info.deactivate) > currentTime || hotspot.info.activate > currentTime);
  if (first == null && hotspots.length > 0) {
    return hotspots[0];
  }
  return first;
}

function nextHotspotFocus() {
  let pending = currentHotspots.filter(hotspot => hotspot.domElement().className == "tooltip");
  var focus = nextHotspotFocusFrom(pending);

  if (focus == null) {
    focus = nextHotspotFocusFrom(currentHotspots);
  }

  return focus;
}

function updateArrowTarget(target, keepLevel) {
  var lookAt = new SphericalCoordinate(Math.PI * 0.5 + view.pitch(), view.yaw());
  if (keepLevel) {
    target = new SphericalCoordinate(lookAt.lat, target.lon);
  }

  let fov = view.fov();
  let minFov = Math.min(fov, fov * view.width() / view.height());
  let minDistance = Math.sin(minFov * 0.5);

  let bearing = lookAt.initialBearingTo(target);
  let maxDistance = lookAt.distanceTo(target);
  let arrowDistance = Math.min(maxDistance * 0.95, minDistance);
  arrowLocation = lookAt.locationWith(bearing, arrowDistance);

  let arrowBearing = arrowLocation.initialBearingTo(target);

  arrowGeometry.rotX = -arrowLocation.lat + Math.PI * 0.5;
  arrowGeometry.rotY = -arrowLocation.lon;
  arrowGeometry.rotZ = arrowBearing;

  // alpha ranges from 1 at distance greater than 0.5, to 0 at distance less than 0.3
  let opacity = Math.max(Math.min((maxDistance - 0.3) / (0.5 - 0.3), 1), 0);
  arrow.effects = function () {
    return {
      opacity: opacity
    }
  }
}

function updateArrowAndCompass() {
  let focus = nextHotspotFocus();
  if (focus) {
    arrowTarget = new SphericalCoordinate(Math.PI - focus.info.latitude, focus.info.longitude - Math.PI);
    updateArrowTarget(arrowTarget, false);
    
      // followCameraCompass.setHeadings(current: followCameraCompass.currentHeading, target: vrArrow!.target.lon)
  } else {
      arrowTarget = null;
  }

  viewer.renderLoop().renderOnNextFrame();
}

function updateVRArrow() {
  if (arrow.hidden) {
    return;
  }

  switch (state) {
    case states.STOP:
      if (arrowTarget) {
        updateArrowTarget(arrowTarget, false);
      }
      break;
    case states.WALK:
      var target = new SphericalCoordinate(0, previousCameraLon);
      updateArrowTarget(target, true);

      break;
  }
}

function mouseOverTooltip(element) {
  var tip = element.getElementsByClassName("tip")[0];
  var rect = element.getBoundingClientRect();
  
  var className = "tip ";
  className += (rect.left > window.innerWidth * 0.5) ? "right " : "left ";
  className += (rect.top > window.innerHeight * 0.5) ? "down" : "up ";

  tip.className = className;
}

function touchStartTooltip(element) {
  // if we're on a touchscreen device, hide the on hover tooltip
  var tip = element.getElementsByClassName("tip")[0];
  tip.style.display = 'none';
}