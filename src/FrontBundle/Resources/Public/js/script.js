function drawChart() {
    // Define the chart to be drawn.
    var data = new google.visualization.DataTable();
    data.addColumn('number', 'année');
    data.addColumn('number', 'Equipages');
    data.addRows([
        [1998,3],
        [1999,8],
        [2000,15],
        [2001,45],
        [2002,100],
        [2003,180],
        [2004,270],
        [2005,450],
        [2006,672],
        [2007,1000],
        [2010,1200],
        [2011,1250],
        [2012,1375],
        [2013,1444],
        [2014,1500],
        [2015,1350],
        [2016,1629]
    ]);

    var options = {'title':'Nombre d\'équipages par an depuis la création',
        'width':1000,
        'height':600
    };

    // Instantiate and draw the chart.
    var chart = new google.visualization.LineChart(document.getElementById('dataviz'));
    chart.draw(data, options);
};