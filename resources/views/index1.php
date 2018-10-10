<html lang="en-US" ng-app="employeeRecords">
    <head>
        <title>Laravel 5 AngularJS CRUD Example</title>
     
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" />
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://code.angularjs.org/1.7.4/angular.min.js"></script>
        <script src="https://code.angularjs.org/1.7.4/angular-route.min.js"></script>
        <script src="https://code.angularjs.org/1.7.4/angular-animate.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <script data-require="angular-ui-bootstrap@0.3.0" data-semver="0.3.0" src="http://angular-ui.github.io/bootstrap/ui-bootstrap-tpls-0.3.0.min.js"></script>
      
        
        
        
        
        

    </head>
    <body   ng-controller="employeesController">
    <div class="container" >
        <button   routerLink="about" class="btn btn-primary">Menu 1</button>
        <button routerLink="contacts" class="btn btn-primary">Menu 2</button>
        <button routerLink="gallery" class="btn btn-primary">Menu 1</button>
        <router-outlet></router-outlet>


        <div>

            <!-- Table-to-load-the-data Part -->
            
            <table  id="articles" class="display nowrap"  data-order='[[ 1, "desc" ]]' data-page-length='10'>
                
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Contact No</th>
                        <th>Position</th>
                        <th><button id="btn-add" class="btn btn-primary btn-xs" ng-click="toggle('add', 0)">Add New Employee</button></th>
                    </tr>
                </thead>
                <tbody>
                   
                       
                    
                </tbody>
            </table>
            {{pagination}}
            <!-- End of Table-to-load-the-data Part -->
            <!-- Modal (Pop up when detail button clicked) -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content panel panel-primary">
                        <div class="modal-header panel-heading">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" align="left"><font color=white>X</font></span></button>
                            <h4 class="modal-title" id="myModalLabel">{{ form_title }}</h4>
                        </div>
                        <div class="modal-body">
                            <form name="frmEmployees" class="form-horizontal" novalidate="">

                                <div class="form-group error">
                              
                                    <label for="inputEmail3" class="col-sm-3 control-label">Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="{{ employee.name }}" 
                                        ng-model="employee.name" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.name.$invalid && frmEmployees.name.$touched">Name field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{employee.email}}" 
                                        ng-model="employee.email" ng-required="true">
                                        <span class="help-inline" 
                                        ng-show="frmEmployees.email.$invalid && frmEmployees.email.$touched">Valid Email field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="contact_number" name="contact_number" placeholder="Contact Number" value="{{employee.contact_number}}" 
                                        ng-model="employee.contact_number" ng-required="true">
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.contact_number.$invalid && frmEmployees.contact_number.$touched">Contact number field is required</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="inputEmail3" class="col-sm-3 control-label">Position</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="position" name="position" placeholder="Position" value="{{employee.position}}" 
                                        ng-model="employee.position" ng-required="true">
                                    <span class="help-inline" 
                                        ng-show="frmEmployees.position.$invalid && frmEmployees.position.$touched">Position field is required</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, employee.id)" ng-disabled="frmEmployees.$invalid">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
        <!-- <script src="<?= asset('app/lib/angular/angular.min.js') ?>"></script>
        <script src="<?= asset('js/jquery.min.js') ?>"></script>
        <script src="<?= asset('js/bootstrap.min.js') ?>"></script> -->
        
        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/controllers/employees.js') ?>"></script>
   
<script >
    var edit ="edit";
    var id=0;
   
      $('#articles').DataTable( {
       
        "lengthChange": true,
        
        "bInfo": false,
        "ajax": {
             "url":'http://127.0.0.1:8000/api/api/v1/employees',
             "dataSrc": ""
             },
        "language": {
           "loadingRecords": "Please wait - loading..."
               },
        "columns": [
            { data: 'id', name: 'id'},
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'contact_number', name: 'Contacte No' },
            { data: 'position', name: 'Position' },
            {"defaultContent": '<button class=\"btn btn-default btn-xs btn-detail\"  ng-click=\"toggle(edit,14)\">Edit</button> <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(14)">Delete</button>' }
        ]
       
    } );
    

  
</script>


 </body>
</html>

<script>
function envoyer(edit,id){
    alert(id);
    alert(edit);
   
  
    //employeesController.confirmDelete(id);
    //console.log(angular.element(document.getElementById('employeesController')).injector().toggle(edit,id));
  //  $('[ng-controller="employeesController"]').injector().toggle(edit,id);
    $('[ng-controller="employeesController"]').injector().$apply();
   
}
</script>


