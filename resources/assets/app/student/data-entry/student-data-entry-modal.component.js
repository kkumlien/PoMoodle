angular.module('poMoodleApp').component('studentDataEntryModal', {
    templateUrl: '/view/student/data-entry/student-data-entry-modal.html',
    controller: 'studentDataEntryModalController',
    controllerAs: 'vm',
    bindings: {
        resolve: '<',
        close: '&',
        dismiss: '&'
    }
});

angular.module('poMoodleApp').controller('studentDataEntryModalController', ['$scope', '$timeout', 'timeUtil', function ($scope, $timeout, timeUtil) {
    var vm = this;

    vm.$onInit = function () {
        vm.activity = {
            time: 30
        };
        vm.slider = {
            options: {
                floor: 0,
                ceil: 360,
                step: 30,
                translate: function (value) {
                    return timeUtil.formatMinutes(value);
                }
            }
        };
        calculateSliderViewDimensions();
    };

    function calculateSliderViewDimensions() {
        $timeout(function () {
            $scope.$broadcast('reCalcViewDimensions');
        }, 1);
    }


    /**
     * Closes the dialog after a delay of a half second
     */
    vm.closeWithDelay = function () {
        $timeout(function () {
            vm.close();
        }, 500);
    };

    vm.ok = function () {
        vm.close();
    };

}]);