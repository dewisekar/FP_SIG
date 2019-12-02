<!DOCTYPE html>
<html>

<head>
  <!-- untuk meta description, keywords, dan author bisa gantu dan di sesuaikan tapi yang meta charset sama viewport jangan di ganti -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name='description' content='WebGIS info-geospasial.com menyajikan berbagai konten spasial ke dalam bentuk Website' />
  <meta name='keywords' content='WebGIS, WebGIS info-geospasial, WebGIS Indoensia' />
  <meta name='Author' content='Egi Septiana' />
  <title>WebGIS Info-Geospasial</title> <!-- title bisa di sesuaikan dengan nama judul WebGIS yang di inginkan -->
  <link rel="stylesheet" href="leaflet/leaflet.css" /> <!-- memanggil css di folder leaflet -->
  <link rel="stylesheet" href="css/style.css" /> <!-- memanggil css style -->
  <script src="leaflet/leaflet.js"></script> <!-- memanggil leaflet.js di folder leaflet -->
  <script src="js/jquery-3.4.1.min.js"></script> <!-- memanggil jquery di folder js -->
  <script src="leaflet/leaflet-ajax-gh-pages/dist/leaflet.ajax.js"></script>
  <script src="leaflet/leaflet-providers-master/leaflet-providers.js"></script> <!-- memanggil leaflet-providers.js di folder leaflet provider -->
</head>

<body>
  <div id="map">
    <!-- ini id="map" bisa di ganti dengan nama yang di inginkan -->
    <script>
      // MENGATUR TITIK KOORDINAT TITIK TENGAN & LEVEL ZOOM PADA BASEMAP
      var map = L.map('map').setView([-7.4498, 112.7015], 10);
      var peta = new L.LayerGroup();
      // MENAMPILKAN SKALA
      L.control.scale({
        imperial: false
      }).addTo(map);
      
      var layer_landmask = new L.GeoJSON.AJAX("layer/landmask.php", {
        style: function(feature) {
          var fillColor; // ini style yang akan digunakan
          var total = feature.properties.total; // perwarnaan objek polygon berdasarkan total kabupaten di dalam file gseojson
          if (total > 18) fillColor = "#fcfdbf";
          else if (total == 18) fillColor = "#fed395";
          else if (total == 17) fillColor = "#fea872";
          else if (total == 16) fillColor = "#fa7c5d";
          else if (total == 14) fillColor = "#ea5562";
          else if (total == 13) fillColor = "#c93d72";
          else if (total == 12) fillColor = "#a3307e";
          else if (total == 10) fillColor = "#7d2381";
          else if (total == 9) fillColor = "#59157e";
          else if (total == 5) fillColor = "#15247e";
          else if (total == 0) fillColor = "#155d7e";
          // console.log(fillColor);
          return {
            color: "#000000",
            fillColor: fillColor,
            weight: 1,
            opacity: 0.3,
            fillOpacity: 0.8,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>Score Pembobotan: " + feature.properties.total + "</center>");
          layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

                info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                layer_landmask.resetStyle(e.target); // isi dengan nama variabel dari layer
                info.update();
            });
        }
      }).addTo(peta);

      var layer_rumah_sakit = new L.GeoJSON.AJAX("layer/RS.php", {
        style: function(feature) {
          // console.log(fillColor);
          return {
            color: "#000000",
            weight: 1,
            opacity: 0.3,
            fillOpacity: 0.8,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>" + feature.properties.nama + "</center>")
        }
      }).addTo(peta);
      
      var layer_jalan = new L.GeoJSON.AJAX("layer/jalan.php", {
        style: function(feature) {
          return {
            color: "#FFFFFF",
            fillColor: "#FFFFFF",
            weight: 1,
            opacity: 1,
            fillOpacity: 1,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>" + feature.properties.nama + "</center>")
        }
      }).addTo(peta);
      
      var layer_danau = new L.GeoJSON.AJAX("layer/danau.php", {
        style: function(feature) {
          return {
            color: "#9CDDE6",
            fillColor: "#9CDDE6",
            weight: 1,
            opacity: 1,
            fillOpacity: 1,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>Danau</center>");
          layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

                info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                layer_landmask.resetStyle(e.target); // isi dengan nama variabel dari layer
                info.update();
            });
        }
      }).addTo(peta);

      var layer_sungai = new L.GeoJSON.AJAX("layer/sungai.php", {
        style: function(feature) {
          return {
            color: "#EB6D38",
            fillColor: "#EB6D38",
            weight: 1,
            opacity: 1,
            fillOpacity: 1,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>" + feature.properties.nama + "</center>")
        }
      }).addTo(peta);

      var layer_rawa = new L.GeoJSON.AJAX("layer/rawa.php", {
        style: function(feature) {
          return {
            color: "#E89BC8",
            fillColor: "#E89BC8",
            weight: 1,
            opacity: 1,
            fillOpacity: 1,
          }; // ini adalah style yang akan digunakan
        },
        onEachFeature: function(feature, layer) {
          layer.bindPopup("<center>Rawa</center>");
          layer.on('mouseover', function (e) {
                this.setStyle({
                weight: 2,
                color: '#72152b',
                dashArray: '',
                fillOpacity: 0.8
                });

            if (!L.Browser.ie && !L.Browser.opera) {
                layer.bringToFront();
            }

                info.update(layer.feature.properties);
            });
            layer.on('mouseout', function (e) {
                layer_landmask.resetStyle(e.target); // isi dengan nama variabel dari layer
                info.update();
            });
        }
      }).addTo(peta);

      var baseLayers = {
        'Esri.WorldTopoMap': L.tileLayer.provider('Esri.WorldTopoMap').addTo(map),
        'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
      };

      var parameterLayers = {
        'Spatial Analysis': layer_landmask,
        'Rumah Sakit': layer_rumah_sakit,
        'Jalan': layer_jalan,
        'Danau': layer_danau,
        'Sungai': layer_sungai,
        'Rawa': layer_rawa,
        // 'Esri WorldImagery': L.tileLayer.provider('Esri.WorldImagery')
      };

      // MENAMPILKAN TOOLS UNTUK MEMILIH BASEMAP
      L.control.layers(baseLayers, parameterLayers).addTo(map);
    </script>
  </div>
</body>

</html>