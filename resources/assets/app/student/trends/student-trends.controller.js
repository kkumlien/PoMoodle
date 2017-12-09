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
                // data.push(module.completionStatus.duration_in_minutes);//TODO - use this when data is populated from the database
                data.push(10);
            })
        });

        var series = [];

        series.push({data: data});

        vm.series = series;
        vm.categories = categories;
        vm.chartTitle = course.fullname;
    }
}]);