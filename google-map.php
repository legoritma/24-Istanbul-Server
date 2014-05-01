<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>
    function initialize() {
        var mapOptions = {
            zoom: 13,
            center: new google.maps.LatLng(41.005574, 28.976848),
            disableDefaultUI: true
        };
        var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
        var markersArray = [];
        google.maps.event.addListener(map, 'click', function(event) {
            for (var i = 0; i < markersArray.length; i++) {
                markersArray[i].setMap(null);
            }
            marker = new google.maps.Marker({
                position: event.latLng
            });
            marker.setMap(map);
            markersArray.push(marker);
            document.companyForm.elements.lng.value = event.latLng.A;
            document.companyForm.elements.lat.value = event.latLng.k;
        });
    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<style>
    #map-canvas {
        height: 250px;
    }
</style>