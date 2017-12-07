angular.module('poMoodleApp').controller('StudentCoursesController', ['$uibModal', '$window', '$timeout', 'timeUtil', function ($uibModal, $window, $timeout, timeUtil) {
    var vm = this;

    vm.activity = {};

    vm.openModal = openModal;

    function openModal(cmId, name, duration_in_minutes) {
        var selectedActivity = {
            cmId: cmId,
            name: name,
            duration: duration_in_minutes
        };

        var modalInstance = $uibModal.open({
            component: 'studentDataEntryModal',
            resolve: {
                activity: selectedActivity
            }
        });

        modalInstance.result.then(function (duration) {
            $timeout(function () {
                vm.activity['_' + selectedActivity.cmId] = timeUtil.formatMinutes(duration);
            }, 500);
        });
    }

}]);