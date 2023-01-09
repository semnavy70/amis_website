var ProductionChartContainer = (function() {
    'use strict';


    //maximum number of lines enabled when the graph loads
    //can be overriden by the container DOM settings
    var MAX_GRAPH_LINES = 6;
    //pagination size of the data table
    var TABLE_PAGINATION_LIMIT = 10;

    //Initialize the page with the different events
    //Loads the chart
    var init = function() {
        ProductionChartContainer.load();
        $( '#end,#start,#type, #crop, #province').change( function() {

            var container = $('#ProductionChartContainer');
            container.data($(this)[0].id,$(this).val());
            ProductionChartContainer.load();
        });


    }



    //Loads the chart data
    var load = function() {
        var container = $('#ProductionChartContainer');
        var url = container.data('url');
        var province = container.data('province');
        var crop = container.data('crop');
        var type = container.data('type');
        var start = container.data('start');
        var end = container.data('end');

        url += '?province=' + province + '&crop=' + crop + '&type=' + type+ '&start=' + start + '&end=' + end;

        console.log(url);

        $.ajax({
            url: url,
        })
            .done(function(data) {
                console.log(data);
                var graphSeries = convertDataToGraphSeries(data);
                loadChart(graphSeries);
            });

    };

    //converts the data from backend to the series acceptable
    //to highcharts. Each element of the array is in the form
    // {
    //    name:
    //    data: [
    //      [date, price],
    //    ]
    // }
    var convertDataToGraphSeries = function(data) {
        var graphSeries = new Array();
        var graphData = new Array();
        for( var j=0; j<data.data.length; j++) {
            var graphValue = new Array(
                data.data[j].date,
                parseFloat(data.data[j].value),
            );
            graphData.push(graphValue);
        }

        var name = data.name;
        var unit = data.unit;


        graphSeries.push(
            {
                'name': name,
                'unit': unit,
                'data': graphData,
                'visible': true
            }
        );

        return graphSeries;
    };

    //Loads the highchart using specified series
    var loadChart = function(series) {

        console.log(series);
        var highChart = $( '#high-chart' );
        var header =  series[0].name;


        highChart.highcharts( {

            chart: {
                type: 'column',
                zoomType: 'x',
                events: {
                    load: function () {
                        //only load the data table after the chart of fully loaded
                        ProductionChartContainer.loadDataTable();
                    }
                }
            },

            title: {
                text:header,
            },
            xAxis: {
                type: 'date',
                labels: {
                    formatter: function() {
                        return this.value;
                    },
                }
            },

            yAxis: {
                title: {
                    text: series[0].unit //'Price (riel)'
                }
            },

            tooltip: {
                formatter: function () {
                    var s = '<b> ឆ្នាំ ' +this.x + '</b>';
                    s += '<br/>' + this.y + ' '+series[0].unit;
                    s += '<br/>' + series[0].name;
                    return s;
                }
            },

            plotOptions: {
                line: {
                    //when a legend item is shown or hiddden, reload data table
                    events: {
                        hide: function () {
                            ProductionChartContainer.loadDataTable();
                        },
                        show: function () {
                            ProductionChartContainer.loadDataTable();
                        }
                    }
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                console.log("events click");

                            }
                        }
                    }
                }
            },

            series: series

        });

    };

    //Loads the data table based on the series of the current chart
    var loadDataTable = function() {

    }

    return {
        init : init,
        loadDataTable: loadDataTable,
        load : load
    };
}());

window.load = ProductionChartContainer.init();