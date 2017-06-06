jQuery(document).ready(function() {
	jQuery('.wpce_event_infos').hide();
	// Default focus values
	if ( mapFocus == 'world' ) {
		var mapZoomLevel = 1;
		var mapZoomLongitude = 9.5;
		var mapZoomLatitude = 20;
	}
	if ( mapFocus == 'europe' ) {
		mapZoomLevel = 3.5;
		mapZoomLongitude = 10;
  		mapZoomLatitude = 52;
  	} 
	if ( mapFocus == 'northamerica' ) {
		mapZoomLevel = 2.5;
		mapZoomLongitude = -100;
  		mapZoomLatitude = 42;
  	} 
	var map = AmCharts.makeChart( 'wpce_map', {
		'type': 'map',
		'projection': 'miller',
		'addClassNames': true,
  		'dataProvider': {
			'map': 'worldLow',
  			'images': markers,
  			'areas': countries,
  			'zoomLevel': mapZoomLevel,
  			'zoomLongitude': mapZoomLongitude,
  			'zoomLatitude': mapZoomLatitude
  		},
  		'balloon': {
	  		'color': '#FFFFFF',
	  		'fillColor': '#36A6C6',
	  		'borderAlpha': 0,
	  		'borderColor': '#36A6C6',
	  		'borderThickness': 0,
	  		'fontSize': 16, 
  		},
		'imagesSettings': {
			'autoZoom': true,
			'rollOverScale': 1.5,
			'selectedScale': 1.5
		},
		'areasSettings': {
			'balloonText': '',
			'selectable': false,
			'autoZoom': true,
			'selectedColor': undefined,
			'color': '#D8D8D8',
			'backgroundColor': '#D8D8D8',
			'rollOverOutlineColor': '#2F4758',
			'selectedOutlineColor': '#2F4758'
		},
		'export': {
			'enabled': true,
			'position': 'bottom-right'
		},
		'ZoomControl': {
			'maxZoomLevel': 40,
			'minZoomLevel': 1,
			'zoomFactor': 4
		},
		'legend': {
			'divId': 'legenddiv',
			'marginRight': 27,
			'marginLeft': 27,
			'equalWidths': false,
			'backgroundAlpha': 1,
			'backgroundColor': "#FFFFFF",
			'borderColor': "#ffffff",
			'borderAlpha': 1,
			'position': 'absolute',
			'bottom': 0,
			'right': 0,
			'fontSize': 16,
			'horizontalGap': 10,
			'data': mapLegendDatas
		}
	});

	map.addListener('clickMapObject', function(event) {
		if (event.mapObject.eventURL.length > 0) {
			jQuery('.wpce_event_infos').slideUp(500, function(){
				jQuery('.wpce_event_name').text(event.mapObject.title);
				jQuery('.wpce_event_link').attr('href', event.mapObject.eventURL);
				jQuery('.wpce_event_infos').slideDown(500);
			});
		}
	});
});