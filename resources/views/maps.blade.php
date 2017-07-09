
<link rel="stylesheet" type="text/css" href="{{asset('css/jquery-gmaps-latlon-picker.css')}}"/>
<script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>
<script src="{{asset('js/jquery-2.1.1.min.js')}}"></script>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAkDSAlkb23u606YO23TezU84YDzYXEat8"></script>

{{--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAkDSAlkb23u606YO23TezU84YDzYXEat8" async defer></script>--}}
<script>
    $.gMapsLatLonPickerNoAutoInit = 1;
</script>
<script src="{{asset('js/jquery-gmaps-latlon-picker.js')}}"></script>
<fieldset class="gllpLatlonPicker">
    <input type="text" class="gllpSearchField">
    <input type="button" class="gllpSearchButton" value="search">
    <div class="gllpMap"></div>
    <input type="text" class="gllpLatitude" value="20"/>
    <input type="text" class="gllpLongitude" value="20"/>
    <input type="hidden" class="gllpZoom" value="3"/>
</fieldset>

<script>
    $(document).ready(function() {
        // Copy the init code from "jquery-gmaps-latlon-picker.js" and extend it here
        $(".gllpLatlonPicker").each(function() {
            $obj = $(document).gMapsLatLonPicker();

            $obj.params.strings.markerText = "Drag this Marker (example edit)";

            $obj.params.displayError = function(message) {
                console.log("MAPS ERROR: " + message); // instead of alert()
            };

            $obj.init( $(this) );
        });
    });
</script>