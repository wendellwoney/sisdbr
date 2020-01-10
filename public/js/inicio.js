var OrdersChart = (function() {

    //
    // Variables
    //

    var $chart = $('#chart-orders');
    var $ordersSelect = $('[name="ordersSelect"]');


    //
    // Methods
    //

    // Init chart
    function initChart($chart) {
        var consulta;
        // Create chart
        $.ajax({
            type: "GET",
            url: "http://localhost/sisdbr/grafico",
            contentType: "application/json; charset=utf-8",
            data: "{}",
            dataType: "json",
            success: function(grafico) {
                var ordersChart = new Chart($chart, {
                    type: 'bar',
                    options: {
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    lineWidth: 1,
                                    color: '#dfe2e6',
                                    zeroLineColor: '#dfe2e6'
                                },
                                ticks: {
                                    callback: function(value) {
                                        if (!(value % 10)) {
                                            //return '$' + value + 'k'
                                            return value
                                        }
                                    }
                                }
                            }]
                        },
                        tooltips: {
                            callbacks: {
                                label: function(item, data) {
                                    var label = data.datasets[item.datasetIndex].label || '';
                                    var yLabel = item.yLabel;
                                    var content = '';
                                    if (data.datasets.length > 1) {
                                        content += '<span class="popover-body-label mr-auto">' + label + '</span>';
                                    }

                                    content += '<span class="popover-body-value">' + yLabel + '</span>';

                                    return content;
                                }
                            }
                        }
                    },
                    data: {
                        labels: grafico.label,
                        datasets: [{
                            label: 'Cadastros',
                            data: grafico.data
                        }]
                    }
                });
            },
            error: function(data) { FailureCallBack(data); }
        });

        // Save to jQuery object
        $chart.data('chart', ordersChart);
    }


    // Init chart
    if ($chart.length) {
        initChart($chart);
    }

})();