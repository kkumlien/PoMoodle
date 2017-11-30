angular.module('poMoodleApp').controller('StudentCoursesController', ['$uibModal', function ($uibModal) {
    var vm = this;

    vm.openModal = function () {
        $uibModal.open({
            component: 'studentDataEntryModal'
        });
    };

}]);