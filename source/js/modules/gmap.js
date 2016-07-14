var map;

function init(map_id, lat, lng, zoom) {
	var mapOptions = {
		center: new google.maps.LatLng(lat,lng),
		zoom: zoom,
		zoomControl: false,
		disableDoubleClickZoom: false,
		mapTypeControl: false,
		scaleControl: false,
		panControl: false,
		streetViewControl: false,
		draggable : true,
		overviewMapControl: false,
		overviewMapControlOptions: {
			opened: false,
		},
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		styles: [
		{
			"featureType": "administrative",
			"elementType": "labels.text.fill",
			"stylers": [
			{
				"color": "#444444"
			}
			]
		},
		{
			"featureType": "landscape",
			"elementType": "all",
			"stylers": [
			{
				"color": "#f2f2f2"
			}
			]
		},
		{
			"featureType": "road",
			"elementType": "all",
			"stylers": [
			{
				"saturation": -100
			},
			{
				"lightness": 45
			}
			]
		},
		{
			"featureType": "road.highway",
			"elementType": "all",
			"stylers": [
			{
				"visibility": "simplified"
			}
			]
		},
		// {
		// 	"featureType": "road.arterial",
		// 	"elementType": "labels.icon",
		// 	"stylers": [
		// 	{
		// 		"visibility": "off"
		// 	}
		// 	]
		// },
		{
			"featureType": "transit",
			"elementType": "all",
			"stylers": [
			{
				"visibility": "off"
			}
			]
		},
		{
			"featureType": "water",
			"elementType": "all",
			"stylers": [
			{
				"color": "#455a64"
			},
			{
				"visibility": "on"
			}
			]
		}
		],
	}
	var mapElement = document.getElementById(map_id),
	map = new google.maps.Map(mapElement, mapOptions),
	locations = [
	['hm_', 'undefined', 'undefined', 'undefined', 'undefined', 61.77816170000001, 34.36403960000007, 'https://mapbuildr.com/assets/img/markers/ellipse-green.png']
	];

	for (i = 0; i < locations.length; i++) {
		if (locations[i][1] =='undefined') {
			description ='';
		} else {
			description = locations[i][1];
		}

		if (locations[i][2] =='undefined') {
			telephone ='';
		} else {
			telephone = locations[i][2];
		}
		if (locations[i][3] =='undefined') {
			email ='';
		} else {
			email = locations[i][3];
		}

		if (locations[i][4] =='undefined') {
			web ='';
		} else {
			web = locations[i][4];
		}

		if (locations[i][7] =='undefined') {
			markericon ='';
		} else {
			markericon = locations[i][7];
		}

		marker = new google.maps.Marker({
			icon: markericon,
			position: new google.maps.LatLng(locations[i][5], locations[i][6]),
			map: map,
			title: locations[i][0],
			desc: description,
			tel: telephone,
			email: email,
			web: web
		});
		link = '';
	}
}

module.exports ={
	init : init
};