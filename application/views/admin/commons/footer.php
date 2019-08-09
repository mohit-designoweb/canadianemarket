<script src='<?php echo base_url('public/js/pace.min.js') ?>'></script>
<script src='<?php echo base_url('public/js/demo.js') ?>'></script>

<!--page specific scripts for demo-->

<!-- Global site tag (gtag.js) - Google Analytics -->
<!--<script async src="https://www.googletagmanager.com/gtag/js?id=UA-66116118-3"></script> -->
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());
    gtag('config', 'UA-66116118-3');
</script>

<!--Additional Page includes-->
<script src='<?php echo base_url('public/js/apexcharts.min.js') ?>'></script>
<!--chart data for current dashboard-->
<?php if (!empty($table)) {
    ?>
    <script src='<?php echo base_url('public/js/datatable.js') ?>'></script>
<?php }
?>
<?php if (!empty($map)) {
    ?>
    <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQdch5IcgcQaKNG76sbMQv1MEBEKLeQ-8&callback=initMap"></script>-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCda3VpSiUTaG60fI3sH4Ch2L1ch0Fo06A"></script>
    <script>
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    var map;
    var endMarker;

    function initialize() {
        directionsDisplay = new google.maps.DirectionsRenderer();
        var latitude = document.getElementById('latitude').value;
        var longitude = document.getElementById('longitude').value;

        if (latitude !== '' && longitude !== '') {
            india = new google.maps.LatLng(latitude, longitude);
        } else {
            india = new google.maps.LatLng(49.89377299321406, -97.13936336669917);
        }

        var mapOptions = {
            zoom: 18,
            center: india
        }
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        directionsDisplay.setMap(map);
        endMarker = new google.maps.Marker({
            position: map.getCenter(),
            map: map,
            draggable: true,
        });

        google.maps.event.addListener(endMarker, 'dragend', function () {
            var lat = endMarker.getPosition().lat();
            var lng = endMarker.getPosition().lng();
            $('#latitude').val(lat);
            $('#longitude').val(lng);

            lat = parseFloat(lat);
            lng = parseFloat(lng);
            var latlng = new google.maps.LatLng(lat, lng);
            var geocoder = geocoder = new google.maps.Geocoder();
            geocoder.geocode({'latLng': latlng}, function (results, status) {
                if (status === google.maps.GeocoderStatus.OK) {
                    if (results[1]) {
                        $('#address').val(results[1].formatted_address);
                    }
                }
            });
        });

    }
    google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <?php }
?>
<?php if (!empty($editor)){?>

<script src="<?php echo base_url('public/ckeditor/ckeditor.js'); ?>" ></script>
<script>
CKEDITOR.replace( 'description' );
</script>
<?php }?>
<script src='<?php echo base_url('public/js/event.js') ?>'></script>

</body>

</html>