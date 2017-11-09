angular.module('poMoodleApp').directive('lineChart', ['timeUtil', function (timeUtil) {
    return {
        restrict: 'E',
        template: '<div></div>',
        scope: {
            chartTitle: '@',
            type: '=',
            data: '='
        },
        link: function (scope, element) {
            Highcharts.chart(element[0], {
                chart: {
                    height: 500,
                    width: 950
                },
                title: {
                    text: 'Student Trends'
                },
                legend: {
                    enabled: false
                },
                xAxis: [{
                    categories: ['Activity 1', 'Activity 2', 'Activity 3', 'Activity 4', 'Activity 5', 'Activity 6', 'Activity 7', 'Activity 8'],
                    crosshair: true
                }],
                yAxis: {
                    title: {
                        text: 'minutes'
                    }
                },
                plotOptions: {
                    series: {
                        label: {
                            connectorAllowed: false
                        }
                    }
                },
                series:
                    [{
                        data: [120, 525, 571, 696, 109, 119, 137, 154]
                    }, {

                        data: [249, 240, 297, 298, 324, 302, 381, 404]
                    }, {
                        data: [117, 177, 160, 197, 201, 243, 321, 393]
                    }, {
                        data: [117, 177, 79, 121, 151, 224, 344, 342]
                    }, {
                        data: [129, 59, 81, 112, 89, 118, 182, 181]
                    }],
                tooltip: {
                    formatter: function () {
                        var formattedValue = timeUtil.formatMinutes(this.y);
                        return '<span style="color:' + this.color + '">' + this.x + '</span>: <b>' + formattedValue + '</b><br/>';
                    }
                },
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
        }
    }
}]);