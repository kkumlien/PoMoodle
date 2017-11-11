angular.module('poMoodleApp').controller('StudentController', ['$uibModal', 'chartFactory', function ($uibModal, chartFactory) {
    var vm = this;

    vm.openModal = function () {
        $uibModal.open({
            component: 'studentDataEntryModal'
        });
    };

    vm.$onInit = function () {
        vm.state = 'home';
        vm.chart = {
            type: 'column',
            data: chartFactory.getMockSeriesAndDrilldownData()
        };
    }
}]);