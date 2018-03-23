<!DOCTYPE html>
<html>
<head>

    <link href="jquery.datetimepicker.min.css" rel="stylesheet" />

    <style>
       #map {
        height: 400px;
        width: 100%;
       }
    </style>
  </head>
  <body>
    <h3 id="tit">Design</h3>
    <h4 >DatePicker</h4>
  <p>Date: <input type="text" id="datetime">
  <button  id ="submitbutton">Send limits</button>

  <p>Date: <input type="text" id="datetime1">
  <!-- <button  id ="submitbutton1">Send second limit</button> -->
  <p><button  id ="real_time_button">Real Time</button>


    <div id="map"></div>
      <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
        <script src="jquery.datetimepicker.full.min.js"></script>

      <script>
      $("#datetime").datetimepicker({
    format:'y-m-d H:m'
});
      </script>
      <script>
      $("#datetime1").datetimepicker({
    format:'y-m-d H:m'
});
      </script>


<script>
//Historical data------------------------------------------------------------------------------
$(document).on("click","#submitbutton",function(){
          myFunction();
        function myFunction() {
          marker2 =null;
          pos2=null;
             tm= $("#datetime").val();
             date1=20+tm

              alert(date1);
             tm1= $("#datetime1").val();
             date2=20+tm1

              alert(date2);
        }
            //  console.log(date1)
            //  console.log(date2)

                //Obtención de datos y envio a Historical_data.php
                // myJavascriptFunction();
                // function myJavascriptFunction() {

                // window.location.href = "historical_data.php?date_1=" + date1;
                // }
                // myJavascriptFunction2();
                // function myJavascriptFunction2() {

                //         window.location.href = "historical_data.php?date_2=" + date2;
                //         }
  marker2 =null;
  pos2=null;
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
  var theurl="historical_data.php?date_2=" + date2+ '&&'+"date_1=" + date1 ;
  var client = new HttpClient();
  client.get(theurl, function(response) {
   response1 = JSON.parse(response);
    array_historicos=[];
   response1.forEach(function(response) {
    lati=parseFloat(response.lat);
    lng=parseFloat(response.lng);
    tm=(response.Time1);
    pos2 = {lat: lati, lng: lng};
    console.log(response);
    array_historicos.push(pos2);
   });
   var flightPath = new google.maps.Polyline({
          path: array_historicos,
          geodesic: true,
          strokeColor: '#000000',
          strokeOpacity: 1.0,
          strokeWeight: 2
        });

      flightPath.setMap(map);

  });


    });
</script>


    <div id="map"></div>
<script>

//--------------------------------------------------------------------------------------------------
//Real Time

$(document).on("click","#real_time_button",function(){
          myFunction();
        function myFunction() {

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
  var theurl='php.php';
  var client = new HttpClient();
  client.get(theurl, function(response) {
   response1 = JSON.parse(response);
  lati=parseFloat(response1[0].lat);
  lng=parseFloat(response1[0].lng);
  tm=(response1[00].Time);
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
ps1=pos2;
console.log(ps1)
};
}
});

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
