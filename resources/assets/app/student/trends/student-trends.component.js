angular.module('poMoodleApp').component('studentTrends', {
    templateUrl: '/view/student/trends/student-trends.html',
    controller: 'studentTrendsController',
    controllerAs: 'vm'
});

angular.module('poMoodleApp').controller('studentTrendsController', ['chartFactory', function (chartFactory) {
    var vm = this;
    vm.$onInit = function () {
        vm.chart = {
            type: 'column',
            data: chartFactory.getMockSeriesAndDrilldownData()
        };
    }
}]);