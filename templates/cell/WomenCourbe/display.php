<?php

$women = $arrNbWomen;

$years  = $arrYears;



?>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {
    'packages': ['corechart']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {



    var data = google.visualization.arrayToDataTable([

      ['Year', 'NbWomen'],
      [<?php
        if (isset($years)) {
          foreach ($years as $year) {
            echo $year;

          }
        }
        ?>,
        <?php
        if (isset($women)) {
          foreach ($women as $femme) {
            echo $femme;
          }
        }
        ?>
      ],

    ]);

    var options = {
      title: 'Nombre de femme engagé dans notre société',
      curveType: 'function',
      legend: {
        position: 'bottom'
      }
    };

    var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

    chart.draw(data, options);
  }
</script>