
'use strict';

var mat4 = Marzipano.dependencies.glMatrix.mat4;
var vec3 = Marzipano.dependencies.glMatrix.vec3;

function SphericalCoordinate(lat, lon) {
    this.lat = lat;
    this.lon = lon;

    this.y = -Math.cos(lat);
    this.x = Math.sin(lon) * Math.sin(lat)
    this.z = -Math.cos(lon) * Math.sin(lat)
}

SphericalCoordinate.prototype.rotationMatrix = function () {
    var matrix = mat4.create();
    mat4.rotateY(matrix, matrix, -this.lon);
    mat4.rotateX(matrix, matrix, this.lat - Math.PI * 0.5);

    return matrix
}

SphericalCoordinate.prototype.isEqualToOtherLocation = function (otherLocation) {
    return this.lat == otherLocation.lat && this.lon == otherLocation.lon;
}

SphericalCoordinate.prototype.initialBearingTo = function (otherLocation) {
    if (this.isEqualToOtherLocation(otherLocation)) {
        return 0;
    }

    let φ1 = this.lat - Math.PI * 0.5;
    let φ2 = otherLocation.lat - Math.PI * 0.5;
    let Δλ = otherLocation.lon - this.lon;

    let y = Math.sin(Δλ) * Math.cos(φ2);
    let x = Math.cos(φ1) * Math.sin(φ2) - Math.sin(φ1) * Math.cos(φ2) * Math.cos(Δλ);
    let θ = Math.atan2(y, x);
    return (θ + Math.PI * 2) % (Math.PI * 2);
}

SphericalCoordinate.prototype.distanceTo = function (otherLocation) {
    if (this.isEqualToOtherLocation(otherLocation)) {
        return 0;
    }

    let φ1 = this.lat - Math.PI * 0.5;
    let λ1 = this.lon;
    let φ2 = otherLocation.lat - Math.PI * 0.5;
    let λ2 = otherLocation.lon;
    let Δφ = φ2 - φ1;
    let Δλ = λ2 - λ1;
    let a = Math.sin(Δφ / 2.0) * Math.sin(Δφ / 2.0) + Math.cos(φ1) * Math.cos(φ2) * Math.sin(Δλ / 2.0) * Math.sin(Δλ / 2.0);
    let c = 2.0 * Math.atan2(Math.sqrt(a), Math.sqrt(1.0 - a));

    return c
}

SphericalCoordinate.prototype.locationWith = function (bearing, distance) {
    let δ = distance;
    let θ = bearing;

    let φ1 = this.lat - Math.PI * 0.5;
    let λ1 = this.lon;

    let φ2 = Math.asin(Math.sin(φ1) * Math.cos(δ) + Math.cos(φ1) * Math.sin(δ) * Math.cos(θ));
    let x = Math.cos(δ) - Math.sin(φ1) * Math.sin(φ2);
    let y = Math.sin(θ) * Math.sin(δ) * Math.cos(φ1);
    let λ2 = λ1 + Math.atan2(y, x);

    return new SphericalCoordinate(φ2 + Math.PI * 0.5, (λ2 + Math.PI * 3) % (Math.PI * 2) - Math.PI);
}