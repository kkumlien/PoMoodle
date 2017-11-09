angular.module('poMoodleApp').directive('chart', ['timeUtil', function (timeUtil) {
    return {
        restrict: 'E',
        template: '<div></div>',
        scope: {
            chartTitle: '@',
            type: '=',
            data: '='
        },
        link: function (scope, element) {
            scope.$watch('[type, data]', function () {
                drawChart();
            });

            function drawChart() {
                Highcharts.chart(element[0], {
                    chart: {
                        type: scope.type,
                        height: 500,
                        width: 950,
                        events: {
                            drilldown: function (e) {
                                this.setTitle({text: e.point.name});

                            },
                            drillup: function (e) {
                                this.setTitle({text: e.seriesOptions.name});
                            }
                        }
                    },
                    legend: {
                        enabled: false
                    },
                    title: {
                        text: scope.chartTitle
                    },
                    tooltip: {
                        enabled: scope.type === 'pie',
                        headerFormat: '',
                        pointFormatter: function () {
                            var formattedValue = timeUtil.formatMinutes(this.y);
                            return '<span style="color:' + this.color + '">' + this.name + '</span>: <b>' + formattedValue + '</b><br/>';
                        }
                    },
                    xAxis: {
                        type: 'category'
                    },
                    yAxis: {
                        title: {
                            text: 'minutes'
                        }
                    },
                    plotOptions: {
                        series: {
                            dataLabels: {
                                enabled: true,
                                formatter: function () {
                                    if (scope.type === 'pie') {
                                        return this.point.name;
                                    }
                                    return timeUtil.formatMinutes(this.y);
                                }
                            }
                        }
                    },
                    series: scope.data.series,
                    drilldown: scope.data.drilldown
                });

            }
        }
    };
}]);