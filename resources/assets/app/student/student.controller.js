angular.module('poMoodleApp').controller('StudentController', ['chartFactory', function (chartFactory) {
    var vm = this;
    vm.$onInit = function () {
        vm.state = 'home';
        vm.chart = {
            type: 'column',
            data: chartFactory.getMockSeriesAndDrilldownData()
        };
    }
}]);