angular.module('poMoodleApp').factory('httpService', ['$http', function ($http) {
    return {
        updateActivityDuration: updateActivityDuration
    };


    function updateActivityDuration(cmId, duration) {
        return http('GET', '/data-entry?cmId=' + cmId + '&duration=' + duration);
    }


    function http(method, url) {
        return $http({
            method: method,
            url: url
        })
    }

}]);