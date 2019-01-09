var map;
var markers = [];

function initMap() {
    // Create the map.

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -33.866, lng: 151.196},
        zoom: 14
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('submit').addEventListener('click', function() {
        deleteMarkers();
        geocodeAddress(geocoder, map);
    });

}
// Sets the map on all markers in the array.
function setMapOnAll(map) {
    for (var i = 0; i < markers.length; i++) {
        markers[i].setMap(map);
    }
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
    setMapOnAll(null);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
    clearMarkers();
    markers = [];
}
function geocodeAddress(geocoder, resultsMap) {

    var address = document.getElementById('address').value;
    geocoder.geocode({'address': address}, function (results, status) {
        if (status === 'OK') {
            resultsMap.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
                map: resultsMap,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: results[0].geometry.location,
                title: 'KIJ7464'
            });
            markers.push(marker);

            var marker = new google.maps.Marker({
                map: resultsMap,
                draggable: true,
                animation: google.maps.Animation.DROP,
                position: results[0].geometry.location,
                title: 'KIJ7464'
            });
            markers.push(marker);

            var pyrmont = results[0].geometry.location;

            // Create the places service.
            var service = new google.maps.places.PlacesService(map);
            var getNextPage = null;
            var moreButton = document.getElementById('more');
            moreButton.onclick = function() {
                moreButton.disabled = true;
                if (getNextPage) getNextPage();
            };
            service.nearbySearch(
                {location: pyrmont, radius: 500, type: ['markers']},
                function(results, status, pagination) {
                    if (status !== 'OK') return;

                    createMarkers(results);
                    moreButton.disabled = !pagination.hasNextPage;
                    getNextPage = pagination.hasNextPage && function() {
                        pagination.nextPage();
                    };
                });
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function createMarkers(places) {
    var bounds = new google.maps.LatLngBounds();
    var placesList = document.getElementById('places');
    placesList.innerHTML = "";
    for (var i = 0, place; place = places[i]; i++) {

        var li = document.createElement('li');
        li.textContent = place.name;
        placesList.appendChild(li);

        bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
}