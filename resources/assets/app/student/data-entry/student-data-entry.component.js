angular.module('poMoodleApp').component('studentDataEntry', {
    templateUrl: '/view/student/data-entry/student-data-entry.html',
    controller: 'studentDataEntryController',
    controllerAs: 'vm'
});

angular.module('poMoodleApp').controller('studentDataEntryController', [function () {
    var vm = this;
    vm.$onInit = function () {
        console.log("studentDataEntry");
    }
}]);