angular.module('poMoodleApp').controller('StudentController', [function () {
    var vm = this;
    vm.$onInit = function () {
        vm.state = 'home';
        console.log("studentView");
    }
}]);