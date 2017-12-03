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

    vm.updateTime = updateTime;


    vm.$onInit = function () {
        vm.module = vm.resolve.module;
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

    function updateTime() {
        $timeout(function () {
            vm.close();
        }, 1000);
    }

}]);