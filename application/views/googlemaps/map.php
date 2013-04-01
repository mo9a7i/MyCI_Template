<h1>خرائط قوقل</h1>
<hr />
<div id="body">
	<p>حدد مكانك على الخريطة وخلنا نجيب عنوانك بدال ماتكتبه بنفسك</p>
	<div dir="ltr" id="googleMap">
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script>
		var geocoder;
		var map;
		var marker;
			
		function initialize(){
			//MAP
			var latlng = new google.maps.LatLng(24.69939283967379,46.73717402076727);
			var options = {
				zoom: 4,
				center: latlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP 
			};

			map = new google.maps.Map(document.getElementById("map_canvas"), options);

			//GEOCODER
			geocoder = new google.maps.Geocoder();

			marker = new google.maps.Marker({
				map: map,
				draggable: true,
				position: latlng,
				raiseOnDrag: false
			});

		}
		function google_hit_it() {
		geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						if (results[1]) {
							$('#address').val(results[0].address_components[3].long_name);
							$('#zoom').val(map.getZoom());
							$('#latitude').val(marker.getPosition().lat());
							$('#longitude').val(marker.getPosition().lng());
						}
					}
				});
		
		}
		$(document).ready(function() { 

			initialize();
			google_hit_it();
			//Add listener to marker for reverse geocoding
			google.maps.event.addListener(marker, 'drag', function() {
				google_hit_it();
			});
		});
	</script>
		<label>Address: </label><input id="address"  type="text"/>
		<label>Zoom: </label><input id="zoom"  type="text"/>
		<div dir="ltr" id="map_canvas" style="width:500px; height:400px"></div><br/>
		<label>latitude: </label><input id="latitude" type="text"/><br/>
		<label>longitude: </label><input id="longitude" type="text"/>
	</div>
</div>