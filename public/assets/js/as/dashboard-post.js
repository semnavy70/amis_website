as.dashboard = {};

as.dashboard.initChart = function () {
    let data = {
        labels: months,
        datasets: [
            {
                label: trans.chartLabel,
                backgroundColor: "transparent",
                borderColor: "#14A2B8",
                pointBackgroundColor: "#14A2B8",
                data: posts
            }
        ]
    };

    let ctx = document.getElementById("postChart").getContext("2d");
    let myLineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        color: "#f6f6f6",
                        zeroLineColor: '#f6f6f6',
                        drawBorder: false
                    },
                    ticks: {
                        beginAtZero: true,
                        callback: function (value) {
                            if (value % 1 === 0) {
                                return value;
                            }
                        }
                    }
                }]
            },
            responsive: true,
            legend: {
                display: false
            },
            maintainAspectRatio: false,
            tooltips: {
                titleMarginBottom: 15,
                callbacks: {
                    label: function (tooltipItem, data) {
                        let value = tooltipItem.yLabel,
                            suffix = (value == 1 ? trans.post : trans.posts) + trans.new ;

                        return " " + value + " " + suffix;
                    }
                }
            }
        }
    })
};

$(document).ready(function () {
    as.dashboard.initChart();
});
