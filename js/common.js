var msg = {

	on : function() {
		$('#msg').html("Actualizando...");
	},
	off : function() {
		$('#msg').html('');
	}

};

function CircleOverlay(bounds, map, point) {

    // Now initialize all properties.
    this.bounds_ = bounds;
    this.map_ = map;
    this.a_ = null;
    this.point_ = point;

    // Explicitly call setMap on this overlay
    this.setMap(map);
  }

CircleOverlay.prototype = new google.maps.OverlayView();

CircleOverlay.prototype.onAdd = function() {
	var width = 300;
	var a = document.createElement("a");

//	alert(this.point_.paro);
	
	
	a.innerHTML = "P:"+this.point_.paro+"<br/>O:"+this.point_.ofertas;
	a.href = this.point_.href;
	a.className = 'pto '+this.point_.styleClass;
	a = CircleOverlay.update_attributes_a(a, 20, width, this.getMap().getZoom());

	this.width_ = width;
	this.a_ = a;

	// We add an overlay to a map via one of the map's panes.
	// We'll add this overlay to the overlayImage pane.
	var panes = this.getPanes();
	panes.overlayImage.appendChild(this.a_);
};

CircleOverlay.prototype.draw = function() {

	// Size and position the overlay. We use a southwest and northeast
	// position of the overlay to peg it to the correct position and size.
	// We need to retrieve the projection from this overlay to do this.
	var overlayProjection = this.getProjection();

	// Retrieve the southwest and northeast coordinates of this overlay
	// in latlngs and convert them to pixels coordinates.
	// We'll use these coordinates to resize the DIV.
	var sw = overlayProjection.fromLatLngToDivPixel(this.bounds_.getSouthWest());
	var ne = overlayProjection.fromLatLngToDivPixel(this.bounds_.getNorthEast());

//	var zoom = this.getMap().getZoom();
//
//	if (zoom < 7) {
//		this.width_ = 75;
//		this.a_ = CircleOverlay.update_attributes_a(this.a_, 10, this.width_);
//	} else if (zoom < 8) {
//		this.width_ = 100;
//		this.a_ = CircleOverlay.update_attributes_a(this.a_, 12, this.width_);
//	} else if (zoom < 10) {
//		this.width_ = 200;
//		this.a_ = CircleOverlay.update_attributes_a(this.a_, 15, this.width_);
//	} else if (zoom < 11) {
//		this.width_ = 250;
//		this.a_ = CircleOverlay.update_attributes_a(this.a_, 18, this.width_);
//	} else if (zoom > 10) {
//		this.width_ = 300;
//		this.a_ = CircleOverlay.update_attributes_a(this.a_, 20, this.width_);
//	}

	this.a_.style.left = sw.x - (this.a_.size / 2) + 'px';
	this.a_.style.top = ne.y - (this.a_.size / 2) + 'px';
};

CircleOverlay.prototype.onRemove = function() {
	this.a_.parentNode.removeChild(this.a_);
	this.a_ = null;
};
CircleOverlay.update_attributes_a = function(a, fontSize, size, zoom) {

	size_p = a.innerHTML.length;
	size = size_p * 2.5 * (zoom * 0.15);
	a.size = size;

	this.width_ = size;
	
	a.style.width = size + "px";
	a.style.height = (size / 3) * 2 + "px";

	a.style.paddingTop = size / 3 + "px";

	a.style.fontSize = (size_p * (zoom * 0.08)) + 'px';

	return a;
}




var map = {
	map : null,
	overlays : [],
	bounds : null,
	initialize : function() {
		var myLatLng = new google.maps.LatLng(40.4172, -3.6844);
		var myOptions = {
			zoom : 7,
			center : myLatLng,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		};

		this.map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

		this.map.fitBounds(new google.maps.LatLngBounds(new google.maps.LatLng(36.91860, -7.0844), new google.maps.LatLng(42.8172, -1.0044)));

//		this.map.enableGoogleBar();
//		this.map.addControl(new google.maps.LocalSearch());

		google.maps.event.addDomListener(this.map, "zoom_changed", function() {map.bounds = null; });


//		map.updatePoints();




		google.maps.event.addDomListener(this.map, "bounds_changed", function() {
			if (map.bounds == null || map.reloadPoints(map.bounds,map.map.getBounds())) {
				map.updatePoints();
			}
		});
	},

	updatePoints : function(points) {

		if (map.bounds == null || map.reloadPoints(map.bounds,map.map.getBounds())) {

			msg.on();
	
			map.deleteOverlays();
	
			save_ne = new google.maps.LatLng(map.map.getBounds().getNorthEast().lat() + 0.3, map.map.getBounds().getNorthEast().lng() + 0.3); 
			save_se = new google.maps.LatLng(map.map.getBounds().getSouthWest() .lat() - 0.3, map.map.getBounds().getSouthWest().lng() - 0.3);
			map.bounds = new google.maps.LatLngBounds(save_se, save_ne);
	
	
			$.ajax({
				type: 'get',  
				url: url_base+'/json/points/'+
											map.bounds.getNorthEast().lat()+
											'/'+map.bounds.getNorthEast().lng()+
											'/'+map.bounds.getSouthWest().lat()+
											'/'+map.bounds.getSouthWest().lng()+
											'/'+map.map.getZoom(), 
				success: function(data) {
					try {
						points = eval(data);
	
						for(var i=0;i<points.length;i++) {
	
	//						alert('hay ptos:'+points[i].nombre);
	
							var pos_marker = new google.maps.LatLng(points[i].lat, points[i].lng); 
							var bounds = new google.maps.LatLngBounds(pos_marker, pos_marker);
							map.overlays.push(new CircleOverlay(bounds, map.map, points[i])); 			
							msg.off();
	
						}
					} catch (e) {
						alert('no hay ptos');
						msg.off();
					}
				}
			});
		}
	},

	reloadPoints : function(source_bounds, current_bounds) {

		if(map.map.getZoom()>=8) {
			if (source_bounds == null || current_bounds == null) {
				return true;
			}
	
			// Si el noroeste o el sureste del mapa actual no está contenido en el
			// mapa anterior (mas el tamaño añadido) => volvemos a recargar todos
			// los ptos
			if (!source_bounds.contains(current_bounds.getNorthEast())
					|| !source_bounds.contains(current_bounds.getSouthWest())) {
				return true;
			}
		}
		return false;
	},
	clearOverlays : function() {
		if (map.overlays) {
			for (i in map.overlays) {
				map.overlays[i].setMap(null);
			}
		}
	},
	showOverlays : function() {
		if (map.overlays) {
			for (i in map.overlays) {
				map.overlays[i].setMap(map);
			}
		}
	},
	deleteOverlays : function() {
		if (map.overlays) {
			for (i in map.overlays) {
				map.overlays[i].setMap(null);
			}
			map.overlays.length = 0;
		}
	}
};


var search = {
		
	send : function(form) {
	
	msg.on();
	
	$.ajax({
		type: form.attr('method'),  
		url: form.attr('action'),  
		data: form.serialize(),  
		success: function(data) {
			locations = eval(data);
			
			if(locations.length==1) {
				document.location.href = url_base+'c/detail/'+locations[0].id;
			} else {
			
				var address = $('#text_search').val();
			    var geocoder = new google.maps.Geocoder();
	
			    geocoder.geocode( { 'address': address+',ES'}, function(results, status) {
			      if (status == google.maps.GeocoderStatus.OK) {
			        map.map.setCenter(results[0].geometry.location);
			        map.map.setZoom(10);
			      } else {
			        alert("No hemos encontrado: "+address);
			      }
			    });
			    
			    msg.off();
			}
		}
	});
	return false;
	}
};


$(document).ready(function() {

	map.initialize();

	
	$('#search').submit(function(){
		
		search.send($(this));
		
		return false;
	});
	
});
