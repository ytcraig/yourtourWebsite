'use strict';

var tourJSON;
var vrJSON;

function loadTourDetails() {

    var urlParams = new URLSearchParams(window.location.search);
    var id = urlParams.get('id')
    // get tour details
    $.getJSON(baseURL + "api/tour/" + id, function(result, status){
        if (status == "success") {
            tourJSON = result;
            if (vrJSON) {
                setupWithTour();
            }
        }
    });

    // get tour VR Supplement
    $.getJSON(baseURL + "api/vr/" + id, function(result, status){
        if (status == "success") {
            vrJSON = result;
            if (tourJSON) {
                setupWithTour();
            }
        }
    });
}

var stopImageNames = [];
var videoNames = [];
var audioNames = [];
var hotspots = [];
var guidePointTimes = [];
var circleTimesArray = [];
var cowlSize = 400;

var stopSpacer;

function getCircleTimes(index) {
    let videoId = videoNames[index];
    $.getJSON(baseURL + "api/video/" + videoId + "/details", function(result, status){
        if (status == "success") {
            let cowl = JSON.parse(result.cowlAsString);
            if (cowl != null) {
                let placements = cowl.Placements
                let keys = Object.keys(placements);
                let intKeys = keys.map(key => parseInt(key));
                intKeys.sort(function order(key1, key2) { 
                    if (key1 < key2) return -1; 
                    else if (key1 > key2) return +1; 
                    else return 0; 
                });

                var circleTimes = [];
                for (let index = 0; index < intKeys.length; index++) {
                    const key = intKeys[index];
                    let values = placements[key.toString()];
                    circleTimes.push([key * 0.001, values[0], values[1]]);
                }
                if (circleTimes.length > 0) {
                    circleTimesArray[index] = circleTimes
                }

                if (index == 0) {
                    if (cowl.DefaultRadius) {
                        cowlSize = cowl.DefaultRadius;
                    }
                }
            }
            // checkCircleTimes();
        }

        if (index == 0) {
            tryLoad();
            for (let i = 1; i < videoNames.length; i++) {
                getCircleTimes(i);
            }
        }
    });
}

function setupWithTour() {

    if (tourJSON.stops instanceof Array && tourJSON.walks instanceof Array && vrJSON.walks instanceof Array) {
        var sortedWalks = [];
        tourJSON.stops.forEach(stop => {
            audioNames.push(stop.audioId);

            var nextWalk = tourJSON.walks.find(function (walk) {
                return walk.commenceStopId == this;
            }, stop.id);
            if (nextWalk) {
                sortedWalks.push(nextWalk);
            }
        });
        tourJSON.walks = sortedWalks;

        sortedWalks.forEach(walk => {
            var guidePoints = []
            if (walk.geoPoints instanceof Array) {
                walk.geoPoints.forEach(geoPoint => {
                    guidePoints.push({time: 1, audioName: geoPoint.audioId});
                });
            }
            guidePointTimes.push(guidePoints);

            var vrWalk = vrJSON.walks.find(function (walk) {
                return walk.id == this;
            }, walk.id)
            
            if (vrWalk != null) {
                videoNames.push(vrWalk.vrSupplement.videoId);
                circleTimesArray.push([[0.0, 0.0, Math.PI]]);
            }
        });
    }

    // if (vrJSON.walks instanceof Array) {
    //     vrJSON.walks.forEach(walk => {
    //         videoNames.push(walk.vrSupplement.videoId);

    //         circleTimesArray.push([[0.0, 0.0, Math.PI]]);
    //     });
    // }

    if (vrJSON.stops instanceof Array) {
        vrJSON.stops.forEach(stop => {
            if (stop.major != false) {
                var vrSupp = stop.vrSupplement
                if (vrSupp.hotspots) {
                    hotspots.push(vrSupp.hotspots);
                } else {
                    hotspots.push([]);
                }
                
                stopImageNames.push(vrSupp.imageId);
            }
        });
    }

    loadStopControlPanel();

    getCircleTimes(0);
}

function loadStopControlPanel() {
    if (tourJSON.stops instanceof Array && vrJSON.stops instanceof Array) {
        var stopsContainer = document.getElementById('stops-container');

        var parser = new DOMParser();
        for (let i = 0; i < tourJSON.stops.length; i++) {
            var stop = tourJSON.stops[i];
            var vrSupp = vrJSON.stops[i].vrSupplement

            var stopId = 'stop' + i
            var imageURL = baseURL + 'api/image/resize/?id=' + vrSupp.imageId + '&maxWidth=200&x1=0.41&y1=0.32&x2=0.18&y2=0.36' 
            var walkClass = i == 0 ? 'stop active' : 'stop'
            var domString = '<div id="' + stopId + '" class="' + walkClass + '" style="background-image: url(' + imageURL + ');"><p>' + stop.name + '</p></div>'
            var html = parser.parseFromString(domString, 'text/html');

            stopsContainer.appendChild(html.body.firstChild)

            if (i < tourJSON.stops.length - 1) {
                var walkId = 'walk' + i
                domString = '<div id="' + walkId + '" class="walk"></div>'
                html = parser.parseFromString(domString, 'text/html');
            
                stopsContainer.appendChild(html.body.firstChild)
            }
        }

        var domString = '<div class="stop-spacer""></div>'
        var html = parser.parseFromString(domString, 'text/html');
        stopSpacer = html.body.firstChild;
        stopsContainer.appendChild(stopSpacer)
    }
}