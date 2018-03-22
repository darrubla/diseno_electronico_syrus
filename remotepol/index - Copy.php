<!DOCTYPE html>
<html>
  <head>
    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3 id="tit">Design</h3>
    <div id="map"></div>
    <script>


setInterval(polo22,1000);

marker2 =null;
pos2=null;
savelocation=[];
function polo22(){

  var HttpClient = function() {
  this.get = function(aUrl, aCallback) {
  var anHttpRequest = new XMLHttpRequest();
  anHttpRequest.onreadystatechange = function() {
  if (anHttpRequest.readyState == 4 && anHttpRequest.status == 200)
  aCallback(anHttpRequest.responseText);
  }
  anHttpRequest.open( "GET", aUrl, true );
  anHttpRequest.send( null );
  }
  }
  var theurl='Darrubla.php';
  var client = new HttpClient();
  client.get(theurl, function(response) {
   response1 = JSON.parse(response);
  lati=parseFloat(response1[0].lat);
  lng=parseFloat(response1[0].lng);
  tm=(response1[0].Time1);
   pos2 = {lat: lati, lng: lng};
   savelocation.push(pos2);
   //SE MUESTRAN LOS VALORES EN LA PAGINA SOBRE EL MAPA
   test=document.getElementById('tit');
   test.textContent = lati+"  "+lng + "  "+ tm;
  if (marker2!=null) {
    marker2.setPosition(pos2)
  }else {
    marker2 = new google.maps.Marker({
     position: pos2,
     map: map
    });
  }
  });
  var flightPath = new google.maps.Polyline({
          path: savelocation,
          geodesic: true,
          strokeColor: '#FF0000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

        flightPath.setMap(map);

};
ps1=pos2;
console.log(ps1)
   //---------
      function initMap() {

        var uluru = {lat: 11.0194794, lng: -74.8526006};
         map = new google.maps.Map(document.getElementById('map'), {
          zoom: 17,
          center: uluru
        });
      }
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDGIDk3Mifck_bsY5wqXxhW0YmNlIn-7iI&callback=initMap">
    </script>
  </body>
</html>
