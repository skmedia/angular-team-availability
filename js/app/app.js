angular.module('app', [
    'app.checkAbsence',
    'app.routes'
]);

angular.module('app.checkAbsence', []).filter('checkAbsence', function() {
    return function(input) {
        var chkDate = input.date.format('YYYY-MM-DD');
        for (i=0; i<input.user.absence_records.length; i++) {
            if (chkDate === input.user.absence_records[i].date) {
                return '<span title="' + input.user.absence_records[i].type + '" class="label label-important">' + input.user.absence_records[i].hours + '<span>';
            }
        }
        return '<span class="label label-success">' + 8 + '<span>';
    };
});

angular.module('app.routes', []).
  config(['$routeProvider', function($routeProvider) {
  $routeProvider.
      when('/overview', {templateUrl: 'tpl/overview.html',   controller: DetailCtrl}).
      when('/detail', {templateUrl: 'tpl/detail.html',   controller: DetailCtrl}).
      otherwise({redirectTo: '/overview'});
}]);

function DetailCtrl($scope, $http, $templateCache) {
};

function OverviewCtrl($scope, $http, $templateCache) {
    
    var setDaysInMonth = function(){
        var start    = $scope.startDay
            , end    = $scope.endDay
            , range  = moment().range(start, end)
            , rangeStep = moment().range(
                    moment("2013-07-01"),
                    moment("2013-07-02")
                )
            ;

        var dates = [] ;
        range.by(rangeStep, function(m){
           dates.push(m);
        });

        $scope.dates = dates;
    };
    
    var setYearMonths = function() {
        
        var start    = moment().format('YYYY') + '-01'
            , end    = moment().format('YYYY') + '-12'
            , range  = moment().range(start, end)
            , rangeStep = moment().range(moment("2013-07-01"), moment("2013-08-01"))
            ;

        var months = [] ;
        range.by(rangeStep, function(date){
           months[date.format('M')] = {
               date: date,
               checked: false
            };
        });
        months.shift()
        $scope.yearMonths = months;
    };
    
    var fetchTeams = function() {
        $http({method: 'GET', url: 'service.php?m=teams', cache: $templateCache})
            .success(function(data, status) {
                $scope.teams = data.data;
            });
    };
    
    var fetchTeamData = function() {
        
        setYearMonths();

        $http({method: 'GET', url: 'service.php?m=data', cache: $templateCache})
            .success(function(data, status) {
                $scope.teamData  = data.data;
                setDaysInMonth();
            })
            .error(function(data, status) {
                $scope.data = data || "Request failed";
            });
    };
    
    $scope.startDay = moment().format('YYYY-MM-') + '01';
    $scope.endDay = moment().format('YYYY-MM-') + moment().daysInMonth();
    $scope.selectedYearMonth = moment().format('M');
    $scope.teams = [];
    
    $scope.selectYearMonth = function(month){
        $scope.selectedYearMonth = month.date.format('M');
        $scope.startDay = month.date.format('YYYY-MM-') + '01';
        $scope.endDay = month.date.format('YYYY-MM-') + month.date.daysInMonth();
        setYearMonths();
        setDaysInMonth();
    };
    
    $scope.selectedYearMonthClass = function(month){
        return month.date.format('M') === $scope.selectedYearMonth ? 'active' : '';
    };
    
    $scope.dataFilter = function(teamToFilter){
        if ($scope.teams.length !== 'undefined') {
            if ($scope.teams[teamToFilter.id] !== 'undefined' && $scope.teams[teamToFilter.id].checked === true) {
                return true;
            } else {
                return false;
            }
        } else {
            return true;
        }
    };
    
    fetchTeams();
    fetchTeamData();
}   