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
    var index = 0;

    var activities = [
        {
            id: 1,
            name: 'Activity 1',
            time: 30
        },
        {
            id: 2,
            name: 'Activity 2',
            time: 0
        },
        {
            id: 3,
            name: 'Activity 3',
            time: 60
        },
        {
            id: 4,
            name: 'Activity 4',
            time: 120
        }
    ];

    vm.activity = activities[index];

    vm.$onInit = function () {
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

    vm.updateTime = function () {
        $timeout(function () {
            if (index === activities.length - 1) {
                vm.close();
            } else {
                index++;
                vm.activity = activities[index];
            }
        }, 500);

    };

}]);