

app.controller('employeesController', function($scope, $http, API_URL) {
    $scope.posts = [];
    $scope.totalPages = 0;
    $scope.currentPage = 1;
    $scope.range = [];
   
    $scope.getPosts = function(pageNumber){

        if(pageNumber===undefined){
          pageNumber = '1';
        }
   
  
    $http.get(API_URL + "employees?page="+pageNumber)
            .then(function(response) {
                $scope.employees = response;
                $scope.totalPages   = response.data.total;
                $scope.currentPage  = response.data.current_page;
              
              
                console.log( $scope.employees);
                console.log($scope.currentPage);console.log( $scope.totalPages);
                var pages = [];

                for(var i=1;i<=response.data.last_page;i++) {          
                    pages.push(i);
                    }

      $scope.range = pages; 
      console.log($scope.range);
              
               });
          
            } 
            $scope.getPosts();
    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Employee";
                console.log($scope.form_title);
                break;
            case 'edit':
                $scope.form_title = "Employee Detail";
                $scope.id = id;
                $http.get(API_URL + 'employees/' + id)
                        .then(function(response) {
                            console.log($scope.form_title);
                            console.log(response);
                            $scope.employee = response['data'];
                        });
                break;
            default:
                break;
        }
        /* var modal_popup = angular.element('#myModal');
            modal_popup.modal('show');  */
        $('#myModal').modal('show'); 
        
    }
    //save new record / update existing record
    $scope.save = function(modalstate, id) {
        var url = API_URL + "employees";
        
        //append employee id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }
        
        $http({
            method: 'POST',
            url: url,
            data: $.param($scope.employee),
            headers: {'Content-Type': 'application/x-www-form-urlencoded'}
        }).then(function(response) {
            console.log(response);
            location.reload();
        }).catch(function(response) {
            console.log(response);
            alert('This is embarassing. An error has occured.');
        });
    }

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            $http({
                method: 'DELETE',
                url: API_URL + 'employees/' + id
            }).
                    then(function(data) {
                        alert('employee supprimer avec success');
                        console.log(data);
                       location.reload();
                    }).catch(function(data) {
                        console.log(data);
                        alert('Unable to delete');
                    });
        } else {
            return false;
        }
    }
});




app.directive('postsPagination', function(){  
   return{
      restrict: 'E',
      template: '<ul class="pagination">'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(1)">«</a></li>'+
        '<li ng-show="currentPage != 1"><a href="javascript:void(0)" ng-click="getPosts(currentPage-1)">‹ Prev</a></li>'+
        '<li ng-repeat="i in range" ng-class="{active : currentPage == i}">'+
            '<a href="javascript:void(0)" ng-click="getPosts(i)">{{i}}</a>'+
        '</li>'+
        '<li ng-hide="currentPage == employees.data.last_page"><a href="javascript:void(0)" ng-click="getPosts(currentPage+1)">Next ›</a></li>'+
        '<li ng-hide="currentPage ==employees.data.last_page"><a href="javascript:void(0)" ng-click="getPosts(pages)">»</a></li>'+
      '</ul>'
   };
});

