var $visitorsChart = $('#visitors-chart');
var visitorsChart  = new Chart($visitorsChart, {
    data : {
        labels  : @json($WeeklyCashFlow['Day']),
        datasets: [
            {
                type                : 'line',
                data                : @json($WeeklyCashFlow['In']),    //In Flow
                backgroundColor     : 'transparent',
                borderColor         : '#3c8dbc',
                pointBorderColor    : '#3c8dbc',
                pointBackgroundColor: '#3c8dbc',
                fill                : false
                // pointHoverBackgroundColor: '#007bff',
                // pointHoverBorderColor    : '#007bff'
            },
            {
                type                : 'line',
                data                :  @json($WeeklyCashFlow['Out']),  //Out Flow
                backgroundColor     : 'tansparent',
                borderColor         : '#d81b60',
                pointBorderColor    : '#d81b60',
                pointBackgroundColor: '#d81b60',
                fill                : false
                // pointHoverBackgroundColor: '#dc3545',
                // pointHoverBorderColor    : '#dc3545'
            },
            {
                type                : 'line',
                data                : @json($WeeklyCashFlow['Dis']),  //Out Flow
                backgroundColor     : 'tansparent',
                borderColor         : '#3d9970',
                pointBorderColor    : '#3d9970',
                pointBackgroundColor: '#3d9970',
                fill                : false
                // pointHoverBackgroundColor: '#28a745',
                // pointHoverBorderColor    : '#28a745'
            }
        ]
    },
    options: {
        maintainAspectRatio: false,
        tooltips           : {
            mode     : mode,
            intersect: intersect
        },
        hover              : {
            mode     : mode,
            intersect: intersect
        },
        legend             : {
            display: false
        },
        scales             : {
            yAxes: [{
                // display: false,
                gridLines: {
                    display      : true
                    //lineWidth    : '4px',
                    //color        : 'rgba(0, 0, 0, .2)',
                    //zeroLineColor: 'transparent'
                },
                ticks  : $.extend({
                        beginAtZero : true,
                        suggestedMax: 200
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
