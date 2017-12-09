angular.module('poMoodleApp').directive('lineChart', ['timeUtil', function (timeUtil) {
    return {
        restrict: 'E',
        template: '<div></div>',
        scope: {
            chartTitle: '=',
            categories: '=',
            series: '='
        },
        link: function (scope, element) {
            scope.$watch('[categories, series]', function () {
                drawChart();
            });

            function drawChart() {
                Highcharts.chart(element[0], {
                    chart: {
                        height: 500,
                        width: 950
                    },
                    title: {
                        text: scope.chartTitle
                    },
                    legend: {
                        enabled: false
                    },
                    xAxis: [{
                        categories: scope.categories,
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
                    series: scope.series,
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
    }
}]);