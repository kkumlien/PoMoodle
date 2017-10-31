angular.module('poMoodleApp').factory('chartFactory', [function () {
    return {
        getMockSeriesAndDrilldownData: getMockSeriesAndDrilldownData
    };

    function getMockSeriesAndDrilldownData() {
      return {
          series: [{
              name: 'Courses',
              colorByPoint: true,
              data: [{
                  name: 'Advanced Databases',
                  y: 100,
                  drilldown: 'Advanced Databases'
              }, {
                  name: 'Team Project',
                  y: 80,
                  drilldown: 'Team Project'
              }, {
                  name: 'Advanced Internet Technologies',
                  y: 60,
                  drilldown: 'Advanced Internet Technologies'
              }, {
                  name: 'Wireless Networking',
                  y: 10
              }, {
                  name: 'Advanced Programming',
                  y: 20
              }
              ]
          }],
          drilldown: {
              drillUpButton: {
                  position: {
                      align: 'left',
                      verticalAlign: 'top',
                      x: 10,
                      y: -40
                  },
                  relativeTo: 'plotBox',
                  theme: undefined
              },
              series: [{
                  id: 'Advanced Databases',
                  name: 'Advanced Databases',
                  data: [{
                      name: 'Week 1',
                      y: 40,
                      drilldown: 'Advanced Databases Week 1'
                  }, {
                      name: 'Week 2',
                      y: 44,
                      drilldown: 'Advanced Databases Week 2'
                  }, {
                      name: 'Week 3',
                      y: 60,
                      drilldown: 'Advanced Databases Week 3'
                  }, {
                      name: 'Week 4',
                      y: 35,
                      drilldown: 'Advanced Databases Week 4'
                  }, {
                      name: 'Week 5',
                      y: 10,
                      drilldown: 'Advanced Databases Week 5'
                  }]
              }, {
                  id: 'Team Project',
                  name: 'Team Project',
                  data: [{
                      name: 'Week 1',
                      y: 4,
                      drilldown: 'Team Project Week 1'
                  }, {
                      name: 'Week 2',
                      y: 5,
                      drilldown: 'Team Project Week 2'
                  }, {
                      name: 'Week 3',
                      y: 6,
                      drilldown: 'Team Project Week 3'
                  }, {
                      name: 'Week 4',
                      y: 10,
                      drilldown: 'Team Project Week 4'
                  }, {
                      name: 'Week 5',
                      y: 4,
                      drilldown: 'Team Project Week 5'
                  }]
              }, {
                  id: 'Advanced Internet Technologies',
                  name: 'Advanced Internet Technologies',
                  data: [{
                      name: 'Week 1',
                      y: 40,
                      drilldown: 'Advanced Internet Technologies Week 1'
                  }, {
                      name: 'Week 2',
                      y: 20,
                      drilldown: 'Advanced Internet Technologies Week 2'
                  }, {
                      name: 'Week 3',
                      y: 14,
                      drilldown: 'Advanced Internet Technologies Week 3'
                  }, {
                      name: 'Week 4',
                      y: 13,
                      drilldown: 'Advanced Internet Technologies Week 4'
                  }, {
                      name: 'Week 5',
                      y: 30,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 6',
                      y: 30,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 7',
                      y: 40,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 8',
                      y: 10,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 9',
                      y: 30,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 10',
                      y: 60,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 11',
                      y: 50,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }, {
                      name: 'Week 12',
                      y: 20,
                      drilldown: 'Advanced Internet Technologies Week 5'
                  }]
              }, {

                  id: 'Advanced Databases Week 1',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Databases Week 2',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Databases Week 3',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Databases Week 4',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Databases Week 5',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Team Project Week 1',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Team Project Week 2',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Team Project Week 3',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Team Project Week 4',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Team Project Week 5',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Internet Technologies Week 1',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Internet Technologies Week 2',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Internet Technologies Week 3',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Internet Technologies Week 4',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }, {

                  id: 'Advanced Internet Technologies Week 5',
                  data: [
                      {
                          name: 'Activity 1',
                          y: 2
                      }, {
                          name: 'Activity 2',
                          y: 5
                      }, {
                          name: 'Activity 3',
                          y: 4
                      }, {
                          name: 'Activity 4',
                          y: 6
                      }
                  ]
              }]
          }
      }
    }
}]);