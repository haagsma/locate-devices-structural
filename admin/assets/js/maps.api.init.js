var map;
var markers = [];

function initMap() {
    // Create the map.

    map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: -23.5428363, lng: -46.6372885},
        zoom: 11
    });
    var geocoder = new google.maps.Geocoder();

    document.getElementById('submit').addEventListener('click', function() {
        deleteMarkers();
        geocodeAddress(geocoder, map);
    });
    document.getElementById('btnAlone').addEventListener('click', function() {
        deleteMarkers();
        let motorista = $("#placaAlone").val().split("&");
        console.log(motorista);
        map.setCenter({lat: Number(motorista[0]), lng: Number(motorista[1])});
        var marker = new google.maps.Marker({
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            position: {lat: Number(motorista[0]), lng: Number(motorista[1])},
            title: String(motorista[2]),
            icon: 'assets/images/logo-circle-transparent.png'
        });
        markers.push(marker);
        createMarkers(markers);
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
            var raio = $('#raio').val();
            var envia = "coords=" + results[0].geometry.location + "," + raio;
            var res;
            $.ajax({
                url:    "functions/coords.php",
                type:   "get",
                dataType:"json",
                data:   envia,
                async: false,

                success: function( data ){
                    /* aqui coloca o OBJ dentro da variavel publica*/
                    res = data;
                }
            });
            for(var i = 0; i < res.length; i++) {
                var marker = new google.maps.Marker({
                    map: resultsMap,
                    draggable: true,
                    animation: google.maps.Animation.DROP,
                    position: {lat: Number(res[i].lat), lng: Number(res[i].lng)},
                    title: String(res[i].title),
                    icon: 'assets/images/logo-circle-transparent.png'
                });
                markers.push(marker);
                createMarkers(markers);
            }
        } else {
            alert('Geocode was not successful for the following reason: ' + status);
        }
    });
}

function createMarkers(places) {
    var placesList = document.getElementById('places');
    placesList.innerHTML = "";
    for (var i = 0; i < places.length ; i++) {

        var li = document.createElement('li');
        var hr = document.createElement('hr');
        li.textContent = places[i].title;
        placesList.appendChild(li);
        placesList.appendChild(hr);

    }
}