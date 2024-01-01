var map_data;
var map;
var infoWindow;
map_data = jQuery.parseJSON(fetchmarker());


function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: { lat: 8.654694, lng: 124.808361 },
    zoom: 18,
    mapId: '4c3a2990a9d5267d'
  });

  infoWindow = new google.maps.InfoWindow();
  for (var i = 0; i < map_data.length; i++) {
    var data = map_data[i];

    var input = data['coordinates'].replace('(', '');
    var latlngStr = input.split(",", 2);
    var lat = parseFloat(latlngStr[0]);
    var lng = parseFloat(latlngStr[1]);
    var latLng = new google.maps.LatLng(lat, lng);
    var marker = new google.maps.Marker({
      position: latLng,
      map: map,
      title: data.name
    });
    var houseno = data['houseno'];
    (function (marker, houseno) {
      google.maps.event.addListener(marker, "click", function (e) {
        var xhttps = new XMLHttpRequest();
        xhttps.onreadystatechange = function () {
          if (this.readyState == 4 && this.status == 200) {
            infoWindow.setContent(this.responseText);

          }
        };
        xhttps.open("GET", "fetchcontent.php?houseno=" + houseno.houseno);
        xhttps.send();
        infoWindow.open(map, marker);
      });
    })(marker, data);

    (function (marker, houseno) {
      google.maps.event.addListener(marker, "dblclick", function (e) {
        window.open("showfamily.php?houseno=" + houseno.houseno);

      });
    })(marker, data);
  }

  map.addListener("click", (e) => {
    if (document.getElementById("addhousecheckbox").checked) {
      placeMarkerAndPanTo(e.latLng, map);
      showcustommodal(e.latLng);

    }
  });

  document.getElementById("controlbar").addEventListener("click", () => {
    if (document.getElementById("addhousecheckbox").checked) {
      document.getElementById("addhousecheckbox").checked = false;
      document.getElementById("addhouseimg").src = "img/addhouse.png";
      map.setOptions({ draggableCursor: 'auto' });


    } else {
      document.getElementById("addhousecheckbox").checked = true;
      document.getElementById("addhouseimg").src = "img/addhouse1.png";
      map.setOptions({ draggableCursor: 'crosshair' });



    }
  });


}

function placeMarkerAndPanTo(latLng, map) {
  new google.maps.Marker({
    position: latLng,
    map: map,
  });
}


function fetchmarker() {
  var response = '';
  $.ajax({
    type: "GET",
    url: "map_data.php",
    async: false,
    success: function (text) {
      response = text;
    }
  });
  return response;
}

function fetchcontent(houseno) {
  var content;
  var xhttps = new XMLHttpRequest();
  xhttps.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      content = this.responseText;
    }
  };
  xhttps.open("GET", "fetchcontent.php?houseno=" + houseno);
  xhttps.send();
  return content;
}

$(document).ready(function () {
  $(window).scroll(function () {
      if ($(window).scrollTop() > 50) {
          $('.navsection').addClass('scrolled');
      } else {
          $('.navsection').removeClass('scrolled');
      };
  });
});
