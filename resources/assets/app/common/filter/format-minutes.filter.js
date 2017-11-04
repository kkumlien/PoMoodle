angular.module('poMoodleApp').filter('formatMinutes', ['timeUtil', function (timeUtil) {

    function formatMinutes(minutes) {
        return timeUtil.formatMinutes(minutes);
    }

    formatMinutes.$stateful = true;

    return formatMinutes;
}]);