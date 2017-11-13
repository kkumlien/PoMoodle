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

    vm.previousActivity = previousActivity;
    vm.nextActivity = nextActivity;
    vm.previousDisabled = previousDisabled;
    vm.nextDisabled = nextDisabled;
    vm.updateTime = updateTime;

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


    function updateTime() {
        $timeout(function () {
            if (index === activities.length - 1) {
                vm.close();
            } else {
                vm.activity = activities[++index];
            }
        }, 500);
    }


    function nextActivity() {
        vm.activity = activities[++index];
    }


    function previousActivity() {
        vm.activity = activities[--index];
    }


    function previousDisabled() {
        return index === 0;
    }


    function nextDisabled() {
        return index === activities.length - 1;
    }

}]);