var $salesChart = $('#sales-chart');
var salesChart  = new Chart($salesChart, {
    type   : 'bar',
    data   : {
        labels  : @json($Monthly['weeksDate']),
        datasets: [
            {
                backgroundColor: '#3c8dbc',
                borderColor    : '#3c8dbc',
                data           :  @json($Monthly['In'])
            },
            {
                backgroundColor: '#d81b60',
                borderColor    : '#d81b60',
                data           :  @json($Monthly['Out'])
            },
            {
                backgroundColor: '#3d9970',
                borderColor    : '#3d9970',
                data           :  @json($Monthly['Dis'])
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        tooltips : {
            mode : mode,
            intersect: intersect
        },
        hover : {
            mode : mode,
            intersect: intersect
        },
        legend : {
            display: false
        },
        scales : {
            yAxes: [{
                //display: true,
                gridLines: {
                    display      : true
                },
                ticks : $.extend({
                    beginAtZero: true,

                    // Include a dollar sign in the ticks
                    callback: function (value, index, values) {
                        if (value >= 1000) {
                            value /= 1000;
                            value += 'k';
                        }
                        return '$' + value;
                    }
                }, ticksStyle)
            }],
            xAxes: [{
                display  : true,
                gridLines: {
                    display: true
                },
                ticks    : ticksStyle
            }]
        }
    }
});


{{-- @dd($Monthly['weeksDate']) --}}