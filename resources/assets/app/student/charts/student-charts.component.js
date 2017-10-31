angular.module('poMoodleApp').component('studentCharts', {
    templateUrl: '/view/student/charts/student-charts.html',
    controller: 'studentChartsController',
    controllerAs: 'vm'
});

angular.module('poMoodleApp').controller('studentChartsController', ['chartFactory', function (chartFactory) {
    var vm = this;
    vm.$onInit = function () {
        vm.chart = {
            type: 'column',
            data: chartFactory.getMockSeriesAndDrilldownData()
        };
    }
}]);