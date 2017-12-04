angular.module('poMoodleApp').factory('httpService', ['$http', function ($http) {
    return {
        updateActivityDuration: updateActivityDuration
    };


    function updateActivityDuration(activityId, duration) {
        return http('GET', '/data-entry?activityId=' + activityId + '&duration=' + duration);
    }


    function http(method, url) {
        return $http({
            method: method,
            url: url
        })
    }

}]);