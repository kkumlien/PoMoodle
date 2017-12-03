angular.module('poMoodleApp').controller('StudentCoursesController', ['$uibModal', '$window', '$timeout', function ($uibModal, $window, $timeout) {
    var vm = this;

    vm.openModal = openModal;

    function openModal(id, name, timeSpent) {
        var module = {
            id: id,
            name: name,
            timeSpent: timeSpent
        };

        var modalInstance = $uibModal.open({
            component: 'studentDataEntryModal',
            resolve: {
                module: function () {
                    return module;
                }
            }
        });

        modalInstance.result.then(function () {
            $timeout(function () {
                $window.location.reload();
            }, 500);
        });
    }

}]);