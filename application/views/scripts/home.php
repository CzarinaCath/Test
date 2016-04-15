<script type='text/javascript'>

   $(window).scroll(function(){
      $("#nav-links").stop().animate({"marginTop": (($(window).scrollTop() - 130) > 0 ? $(window).scrollTop() - 130 : 0) + "px", "marginLeft":($(window).scrollLeft()) + "px"}, "slow" );
   });

   function getMonth(m){
      var month = Array();

      month[0] = 'Jan';
      month[1] = 'Feb';
      month[2] = 'Mar';
      month[3] = 'Apr';
      month[4] = 'May';
      month[5] = 'Jun';
      month[6] = 'Jul';
      month[7] = 'Aug';
      month[8] = 'Sep';
      month[9] = 'Oct';
      month[10]= 'Nov';
      month[11]= 'Dec';

      return month[m];
   }

   var chart = AmCharts.makeChart("walbro-chart", {
    "type": "serial",
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 1,
        "hideBulletsCount": 50,
        "lineThickness": 1,
        "lineColor": "#337AB7",
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "value",
        "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#DDD",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#337AB7",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider": [<?php foreach($historicalgraphdata as $key => $value){
      echo '{'
         .'"date" : "'.$key.'","value" : '.number_format($value, 2).'
      },';
   }?>]
});

chart.addListener("rendered", zoomChart);

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}

function convert(elmnt){
   html2canvas($(elmnt), {
      onrendered: function(canvas) {
          theCanvas = canvas;
          var myImage = canvas.toDataURL("image/jpg");
          window.open(myImage);
          //Canvas2Image.saveAsPNG(canvas);
          //$("#"+this.dataset.out).append(canvas);
          // Clean up
          //document.body.removeChild(canvas);
      },
      allowTaint: false,
      letterRendering: false,

  });
}
</script>
