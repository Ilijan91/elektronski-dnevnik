<?php

use frontend\assets\HighchartsAsset;

HighchartsAsset::register($this);
$this->title = "Highcharts Test";

?>

<div id="my-chart"></div>

<?php 
$this->registerJs("
Highcharts.chart('my-chart', {
    title: {
        text: 'Osnovna skola 8.OKTOBAR, 2018-2019'
    },

    subtitle: {
        text: 'Elektronski-Dnevik'
    },

    yAxis: {
        title: {
            text: 'Uspesnost odeljenja po predmetima'
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2018
        }
    },

    series: [{
        name: 'Skola',
        data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
    }, {
        name: 'Ucenik',
        data: [500, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
        name: 'Sales & Distribution',
        data: [50,100, 16005, 19771, 20185, 24377, 32147, 39387]
    }, {
        name: 'Project Development',
        data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
    }, {
        name: 'Other',
        data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
")
?>
