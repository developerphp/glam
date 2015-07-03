<?php $this->load->view('busycms/includes/head') ?>
<?php 
                $i=0;
                $days = array_keys($report);
?>	
<script type="text/javascript">
$(function () {
    var chart;
    $(document).ready(function() {
        chart = new Highcharts.Chart({
            chart: {
                renderTo: 'container',
                type: 'area',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Google Analytics',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: Google Analytics',
                x: -20
            },
            xAxis: {
                categories: [
                    <?php 
                    foreach($report as $r) {
                   $day=substr($days[$i], 6, 8);
                   $month=substr($days[$i], 4, 2);
                   $year=substr($days[$i], 0, 4); 
                    echo "'".$day.".".$month."',";
                    $i++;
                    }
                    ?>
                ]
            },
            yAxis: {
                title: {
                    text: 'Busy Cms'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                formatter: function() {
                        return '<b>'+ this.series.name +'</b><br/>'+
                        this.x +': '+ this.y +'';
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Page Views',
                data: [<?php foreach($report as $r) { echo $r["ga:pageviews"].","; } ?>]
            },
            {
                name: 'Visits',
                data: [<?php foreach($report as $r) { echo $r["ga:visits"].","; } ?>]
            },
            {
                name: 'New Visits',
                data: [<?php foreach($report as $r) { echo $r["ga:newVisits"].","; } ?>]
            }
        ]
        });
    });
    
});
</script>
<?php 
/* [ga:pageviews] => 14
            [ga:visits] => 3
            [ga:timeOnPage] => 494.0
            [ga:entrances] => 3
            [ga:bounces] => 1
            [ga:uniquePageviews] => 11
            [ga:exits] => 3
            [ga:newVisits] => 3
     */
?>
<script src="<?php echo base_url() ?>chartjs/highcharts.js"></script>
<script src="<?php echo base_url() ?>chartjs/modules/exporting.js"></script>
</head>
<body>
    <?php $this->load->view('busycms/includes/header') ?>
    <div id="dashboard">
        <div class="scroll con">
            <div class="section padding" title="User Interface" id="ui" style="display: block;padding-bottom:1px;">
                <div id="container" style="min-width: 400px; height: 600px; margin: 0 auto"></div>
            </div>
            <div id="sezgin">
                
            </div>
        </div>
    </div>
<?php $this->load->view('busycms/includes/footer') ?>
</body>
</html>