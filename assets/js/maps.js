/*

*/


$(document).ready(function () {
	
//	initAutocomplete();
	
});



	

var Latitude = $("#latitude").val();
var Longitude = $("#longitude").val();


    function initAutocomplete() {
    	var meuCentro = new google.maps.LatLng(Latitude, Longitude);

    	var mapCanvas = document.getElementById('mapa');

        var mapOptions = {
            center: meuCentro,
            zoom: 17,
            mapTypeId: google.maps.MapTypeId.SATELLITE
        }
        mapa = new google.maps.Map(mapCanvas, mapOptions);

// Criar marcador
        var marker = new google.maps.Marker({
            position: meuCentro,
            draggable: true,
            animation: google.maps.Animation.BOUNCE,
        });

        setTimeout(function () {
            marker.setAnimation(null)
        }, 2000);

        marker.setMap(mapa);

// Zoom para 18 ao clicar no marcador
        google.maps.event.addListener(marker, 'click', function () {
            mapa.setZoom(18);
            mapa.setCenter(marker.getPosition());
        });


// Mudar a posição do marcador
        google.maps.event.addListener(mapa, "click", function (event) {
        	
            novaCordenada(event.latLng.lat(), event.latLng.lng());

            var coordenada = new google.maps.LatLng(event.latLng);


            marker.setPosition(event.latLng, event.latLng.lng());

        }); //end addListener      
    

// Create the search box and link it to the UI element.
        var input = document.getElementById('buscador');
        var searchBox = new google.maps.places.SearchBox(input);
//        autocomplete.bindTo("bounds", mapa);
//        mapa.controls[google.maps.ControlPosition.TOP_LEFT].push(input2);

// Bias the SearchBox results towards current map's viewport.
        mapa.addListener('bounds_changed', function () {
            searchBox.setBounds(mapa.getBounds());
            
        });

        var markers = [];
        
        // Listener para controlar o zoom
        var listener = google.maps.event.addListener(mapa, "idle", function() { 
        	  if (mapa.getZoom() < 14) mapa.setZoom(16); 
//        	  google.maps.event.removeListener(listener); 
        	});        
        
// Listen for the event fired when the user selects a prediction and retrieve
// more details for that place.
        searchBox.addListener('places_changed', function () {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            

// Clear out the old markers.
            markers.forEach(function (marker) {
                marker.setMap(null);
            });
            markers = [];

// For each place, get the icon, name and location.
            var bounds = new google.maps.LatLngBounds();
            places.forEach(function (place) {
                
//                var icon = {
//                    url: place.icon,
//                    size: new google.maps.Size(71, 71),
//                    origin: new google.maps.Point(0, 0),
//                    anchor: new google.maps.Point(17, 34),
//                    scaledSize: new google.maps.Size(25, 25)
//                };
            	
				var coordenadas = place.geometry.location;
				
				// Define latitude e longitude
                novaCordenada(coordenadas[0], coordenadas[1]);
                
// Create a marker for each place.
//                markers.push(new google.maps.Marker({
//                    map: mapa,
////                    icon: icon,
//                    title: place.name,
//                    position: place.geometry.location
//                }));

                if (place.geometry.viewport) {
// Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                } else {
                    bounds.extend(place.geometry.location);
                }
            });
            mapa.fitBounds(bounds);
        });
    }

    function novaCordenada(latitude, longitude) {
        $("#latitude").val(latitude);
        $("#longitude").val(longitude);
    }

    $('#alterarLocalizacao').on('shown.bs.modal', function (e) {
    	initAutocomplete();
    });
    