@if($googlat && $googlng)
	<fieldset style="margin-left:30px;margin-top:30px;margin-right:30px;">
	<legend>LOCATION</legend>
	<div style="background:#fff;margin-bottom:15px;">
	   {{$getFlyer[0]->theMap->xIntersection}}
	</div>
	<div id="map" class="col-12">
	</div>
	</fieldset>
	<script>
	function initMap() {
	   var mapvar = {lat: parseFloat('{{$googlat}}'), lng: parseFloat('{{$googlng}}')};
	   var map = new google.maps.Map(document.getElementById('map'), {
	   zoom: 14,
	   center: mapvar
	});
	var marker = new google.maps.Marker({
	position: mapvar,
	map: map
	});
	}
	</script>
	<script async defer
	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARwZL9ddEztjI7xCQrlyfNY5bzLr4Z8Tg&callback=initMap">
	</script>
@endif
