<?php
session_start();
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Simple Marker</title>
    <!-- The callback parameter is required, so we use console.debug as a noop -->
    <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBpj9mhqC5Vd2Wn6FXPqEr5crupY0FRKXg&callback=console.debug&libraries=maps,marker&v=beta">
    </script>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      gmp-map {
        height: 95%;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
  </head>
  <body>
  <gmpx-api-loader key="AIzaSyBpj9mhqC5Vd2Wn6FXPqEr5crupY0FRKXg" solution-channel="GMP_GE_placepicker_v2">
    </gmpx-api-loader>
    <div id="place-picker-box">
      <div id="place-picker-container">
        <gmpx-place-picker placeholder="Enter an address"></gmpx-place-picker>
      </div>
    </div>
    <?=$_SESSION["lat"]?>,<?=$_SESSION["lng"]?>
<BR>
    <gmp-map center="<?=$_SESSION["lat"]?>,<?=$_SESSION["lng"]?>" zoom="4" map-id="DEMO_MAP_ID">
      <gmp-advanced-marker position="<?=$_SESSION["lat"]?>,<?=$_SESSION["lng"]?>" title="My location"></gmp-advanced-marker>
    </gmp-map>
  </body>
</html>
<!--
아래 주소를 통해서 API 구현 ( 검색 )
https://console.cloud.google.com/google/maps-apis/home;onboard=true?project=pject-447806&hl=ko&inv=1&invt=AbmzMA -->