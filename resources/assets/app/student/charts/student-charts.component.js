angular.module('poMoodleApp').component('studentCharts', {
    templateUrl: '/view/student/charts/student-charts.html',
    controller: 'studentChartsController',
    controllerAs: 'vm'
});

angular.module('poMoodleApp').controller('studentChartsController', [function () {
    var vm = this;
    vm.$onInit = function () {
        console.log("studentCharts");
    }
}]);