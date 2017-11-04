angular.module('poMoodleApp').component('studentHome', {
    templateUrl: '/view/student/home/student-home.html',
    controller: 'studentHomeController',
    controllerAs: 'vm'
});

angular.module('poMoodleApp').controller('studentHomeController', ['$uibModal', function ($uibModal) {
    var vm = this;

    vm.$onInit = function () {
        console.log("studentHome");
    };

    vm.openModal = function () {
        $uibModal.open({
            component: 'studentDataEntryModal'
        });
    };

}]);