function drawChart() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'Année');
    data.addColumn('number', 'Equipages');
    data.addColumn({type: 'string', role:'annotationText'});
    data.addRows([
        [1998,3, "1998, 3"],
        [1999,8, "1999, 8"],
        [2000,15, "2000, 15"],
        [2001,45, "2001, 45"],
        [2002,100, "2002, 100"],
        [2003,180, "2003, 180"],
        [2004,270, "2004, 270"],
        [2005,450, "2005, 450"],
        [2006,672, "2006, 672"],
        [2007,1000, "2007, 1000"],
        [2008,1150, "2008, 1150"],
        [2010,1200, "2010, 1200"],
        [2011,1250, "2011, 1250"],
        [2012,1375, "2012, 1375"],
        [2013,1444, "2013, 1444"],
        [2014,1500, "2014, 1500"],
        [2015,1350, "2015, 1350"],
        [2016,1629, "2016, 1629"]
    ]);

    var options = {
        'title':'Nombre d\'équipages par an depuis la création',
        'width':1000,
        'height':600,
        hAxis: {
            ticks: [
                1998,
                2000,
                2002,
                2004,
                2006,
                2008,
                2010,
                2012,
                2014,
                2016
            ]
        },
        series: {
            0: {
                color: '#cb4460',
                pointSize : '10px',
                pointShape: 'circle'
            },
        },
    };

    if (route == 'front_homepage') {
         // Instantiate and draw the chart.
        var chart = new google.visualization.AreaChart(document.getElementById('dataviz'));
        chart.draw(data, options);
    }
};

$(document).ready(function(){

    // front_trip part
    if (route == 'front_trip') {

        $('.trip .progress-bar-container .progress-bar').css('width', finalStep + '%');
        $('.trip .progress-bar-container .car').css('left', finalStep + '%').css('opacity', 100);

        $('#countdown')
            .countdown(startingDate, function(event) {
                $(this).html(
                    event.strftime(
                        "<h3 class='text'> " +
                            "L'aventure de Pauline et Margaux commence dans <br>" +
                        "</h3>"+
                        "<div><span class='label label-primary'><strong>%Dj %H:%M:%S </strong></span></div>"
                    )
                );
            });

    }
});
