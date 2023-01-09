var PriceGraphLoader = (function() {
    'use strict';

    var USER_TYPE_AMO = 1;
    var USER_TYPE_TRADER = 2;

    //maximum number of lines enabled when the graph loads
    //can be overriden by the container DOM settings
    var MAX_GRAPH_LINES = 6;
    //pagination size of the data table
    var TABLE_PAGINATION_LIMIT = 10;

    //Initialize the page with the different events
    //Loads the chart
    var init = function() {

        //Override Variables first
        overrideVariablesFromDOM();

        $( '#Category' ).change( function() {
            PriceGraphLoader.loadCommodities(function() {
                PriceGraphLoader.load();
            });
        });
        
        $( '#Commodity,#Commodity1,#Commodity2, #AMOUserType, #TraderUserType').change( function() {
            PriceGraphLoader.load();
        });

        PriceGraphLoader.loadCategories(function() {
            PriceGraphLoader.loadCommodities(function() {
                PriceGraphLoader.load();
            });
        });

    }

    //looks at the container DOM settings and override 
    //variables if applicable
    var overrideVariablesFromDOM = function() {
        var container = $('#PriceChartContainer');
        if (container.data('maxlines') !== undefined) { 
            MAX_GRAPH_LINES = container.data('maxlines');
        }
    }

    //loads the categories into the DOM element
    //and calls the callback when done
    var loadCategories = function(callback) {
        var container = $('#Category');
        var url = container.data('url');
        var locale = container.data('locale');

        url += '?locale=' + locale;
        $.ajax({
            url: url,
        })
        .done( function(data) {

            //sort the categories by name
            data.sort(function (a, b) {
              return a.name < b.name ? -1 : 1;
            });

            //create the options amd append to the DOM element
            document.getElementById('Category').innerHTML = '';
            for (var i=0; i<data.length; i++) {
                var option = document.createElement('option');
                option.setAttribute('value', data[i].categoryCode);
                option.innerHTML = data[i].name;
                var is_default = data[i].is_default;
                if (is_default==true) option.setAttribute('selected', 'selected');
                document.getElementById('Category').appendChild(option);
            }
            callback(data);
        });
    }

    //loads the commodities into the DOM element
    //and calls the callback when done
    var loadCommodities = function(callback) {
        var container = $('#Commodity');
        var url = container.data('url');
        var locale = container.data('locale');

        url += '?locale=' + locale + '&categoryCode=' + $('#Category option:selected').val();

        $.ajax({
            url: url,
        })
        .done( function(data) {
            //sort the commodities by name
            data.sort(function (a, b) {
              return a.name < b.name ? -1 : 1;
            });

            //create the options amd append to the DOM element
            document.getElementById('Commodity').innerHTML = '';
            for (var i=0; i<data.length; i++) {
                var option = document.createElement('option');
                option.setAttribute('value', data[i].commodityCode);
                option.innerHTML = data[i].name;
                //console.log("is_default:"+data[i].is_default);
                var is_default = data[i].is_default;
                if (is_default==true) option.setAttribute('selected', 'selected');
                document.getElementById('Commodity').appendChild(option);


            }
            if(document.getElementById('Commodity1')!=null){
                document.getElementById('Commodity1').innerHTML = document.getElementById('Commodity').innerHTML;
                var option = document.createElement("option");
                option.text = "----------";
                option.value = 0;
                document.getElementById('Commodity1').add(option,0);
                document.getElementById('Commodity1').selectedIndex = 0;
            }
            if(document.getElementById('Commodity2')!=null){
                document.getElementById('Commodity2').innerHTML = document.getElementById('Commodity').innerHTML;
                var option = document.createElement("option");
                option.text = "----------";
                option.value = 0;
                document.getElementById('Commodity2').add(option,0);
                document.getElementById('Commodity2').selectedIndex = 0;
            }

                callback(data);
        });
    }

    //Loads the chart data
    var load = function() {        
        var container = $('#PriceChartContainer');
        var url = container.data('url');
        var locale = container.data('locale');

        if (url.indexOf('?') === -1) {
            url += '?';
        }
        url += 'locale=' + locale + '&commodityCode=' + $('#Commodity option:selected').val();
        if(document.getElementById('Commodity1')!=null){
            url += "&commodityCode1="+ $('#Commodity1 option:selected').val();
        }
        if(document.getElementById('Commodity2')!=null){
            url += "&commodityCode2="+ $('#Commodity2 option:selected').val();
        }

        if($("input:checkbox[name='dataseries1'][checked]").val()!=null){

            $("#loader1").show();
            url += "&dataseries="+ serial;
        }


        //Force selection of a user type if at least one DOM element is present
        if (
            document.getElementById('AMOUserType') !== null &&
            ! document.getElementById('AMOUserType').checked &&
            ! document.getElementById('TraderUserType').checked
        ) {
            $('#UserTypeError').show();
            return;
        }
        $('#UserTypeError').hide();

        if (document.getElementById('AMOUserType') !== null && document.getElementById('AMOUserType').checked) {
            url += '&userType[]=' + document.getElementById('AMOUserType').value;
        }
        if (document.getElementById('TraderUserType') !== null && document.getElementById('TraderUserType').checked) {
            url += '&userType[]=' + document.getElementById('TraderUserType').value;
        }
        console.log(url);

        $.ajax({
            url: url,
        })
        .done(function(data) {

            var graphSeries = convertDataToGraphSeries(data);
            //console.log(graphSeries);
            loadChart(graphSeries);
            $("#loader1").hide();

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
        for (var i=0; i<data.length; i++) {

            if (data[i].prices.length === 0) {
                continue;
            }

            var graphData = new Array();
            for( var j=0; j<data[i].prices.length; j++) {
                var graphValue = new Array(
                    new Date(data[i].prices[j].date).getTime(),
                    parseFloat(data[i].prices[j].price),
                    data[i].prices[j].id,
                );
                graphData.push(graphValue);
            }

            var name = data[i].name;

            if (data[i].userType == USER_TYPE_AMO) {
                name += ' (A)';
            } else if (data[i].userType == USER_TYPE_TRADER) {
                name += ' (T)';
            }

            graphSeries.push(
                {
                    'name': name,
                    'data': graphData,
                    'visible': (i > MAX_GRAPH_LINES ? false : true)
                }
            );
        }

        return graphSeries;
    };

    //Loads the highchart using specified series
    var loadChart = function(series) {

        var highChart = $( '#high-chart' );
        var header =  $('#wsale').val(); //"Wholesale Prices"
        if((serial=="RP")){
            header = $('#rprice').val();//"Retail Prices";
        }
            
        highChart.highcharts( {
            
            chart: {
                type: 'line',
                zoomType: 'x',
                events: {
                    load: function () {
                        //only load the data table after the chart of fully loaded
                        PriceGraphLoader.loadDataTable();
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
                        return Highcharts.dateFormat('%b %Y', this.value);
                    },
                }
            },
            
            yAxis: {
                title: {
                    text: $('#price').val() //'Price (riel)'
                }
            },
            
            tooltip: {
                formatter: function () {
                    var s = '<b>' + Highcharts.dateFormat('%d %b %Y', this.x) + '</b>';
                    s += '<br/>' + this.y + ' riel';
                    s += '<br/>' + this.series.name;

                    return s;
                }
            },
            
            plotOptions: {
                line: {
                    //when a legend item is shown or hiddden, reload data table
                    events: {
                        hide: function () {
                            PriceGraphLoader.loadDataTable();
                        },
                        show: function () {
                            PriceGraphLoader.loadDataTable();
                        }                        
                    }
                },
                series: {
                    cursor: 'pointer',
                    point: {
                        events: {
                            click: function () {
                                console.log($("#canEdit").val());
                                if($("#canEdit").val()==1){
                                    window.open("https://amis.org.kh/admin/amisdata/"+series[0].data[this.index][2]+"/edit","_blank");
                                }

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

        if ($("#PriceDataTable").length === 0) {
            return;
        }

        var data = $('#high-chart').highcharts().series;

        var container = $("#PriceDataTable");

        //flatten the data arrays
        var flatData = new Array();
        for (var i = 0; i < data.length; i++) {
            if (data[i].visible === false) {
                continue;
            }

            for (var j=0; j < data[i].data.length; j++) {

                flatData.push({
                    'name': data[i].name,
                    'date': new Date(data[i].data[j].x),
                    'price': data[i].data[j].y
                });
            }
        }

        //sort by date
        flatData.sort(function (a, b) {
          return a.date < b.date ? 1 : -1;
        });

        //handle pagination
        var start = container.data('start');
        if (start === undefined) {
            start = 0;
        }

        var html = '';

        for (var i = start; i < start + TABLE_PAGINATION_LIMIT && i < flatData.length; i++) {

            html +=  '<tr>';
            html += '<td>' + flatData[i].name + '</td>';
            html += '<td>' + formatDate(flatData[i].date) + '</td>';
            html += '<td>' + flatData[i].price + ' riel';
            html += '</tr>';   

        }

        //Hide or show navigation links depending on if we have reached the end/start
        if (start === 0) {
            container.find('#PriceDataTablePrevious').hide();
        } else {
            container.find('#PriceDataTablePrevious').show();
        }

        if (start + TABLE_PAGINATION_LIMIT > flatData.length) {
            container.find('#PriceDataTableNext').hide();
        } else {
            container.find('#PriceDataTableNext').show();
        }

        container.find('tbody').html(html);

    };

    //loads the next rows of the data table
    var loadNextDataTable = function() {
        $("#PriceDataTable").data('start', $("#PriceDataTable").data('start') + TABLE_PAGINATION_LIMIT);
        loadDataTable();
    };

    //loads the previous rows of the data table
    var loadPreviousDataTable = function() {
        $("#PriceDataTable").data('start', $("#PriceDataTable").data('start') - TABLE_PAGINATION_LIMIT);
        loadDataTable();
    };

    //formats the date to human readeable
    var formatDate = function(date) {
        var year = date.getFullYear();
        var month = date.getMonth() + 1;
        var day = date.getDate() + 1;

        if (month <=9 ) month = '0' + month;
        if (day <=9 ) day = '0' + day;
        return year + '-' + month + '-' + day;
    };

    return {
        init : init,
        loadCategories : loadCategories,
        loadCommodities : loadCommodities,
        loadDataTable: loadDataTable,
        loadNextDataTable: loadNextDataTable,
        loadPreviousDataTable: loadPreviousDataTable,
        load : load
    };
}());

window.load = PriceGraphLoader.init();