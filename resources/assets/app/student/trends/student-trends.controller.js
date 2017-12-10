angular.module('poMoodleApp').controller('StudentTrendsController', ['chartFactory', function (chartFactory) {
    var vm = this;

    vm.$onInit = function () {

        var course = JSON.parse(vmCourse);

        var categories = [];

        course.topics.forEach(function (topic) {
            topic.modules.forEach(function (module) {
                categories.push(module.name);
            })
        });

        var data = [];

        course.topics.forEach(function (topic) {
            topic.modules.forEach(function (module) {
                if (module.completionStatus.state === 1) {
                    data.push(module.completionStatus.duration_in_minutes);
                } else {
                    data.push(null);
                }
            })
        });

        var series = [];

        series.push({data: data /*[30,null,60,30,0,120,150,360,60,90,30,15] */});

        vm.series = series;
        vm.categories = categories;
        vm.chartTitle = course.fullname;
    }
}]);