<div ng-controller="RegistrationController"
	ng-cloak
	class="container">
  
 	<div class="row">
  		<div class="col-sm-12">
    
        	<form novalidate 
        		class="form-horizontal">
         		
            <!-- INITIAL State, core account details (email and usertype) -->
        		<ng-include 
              src="'/wp-content/plugins/teledent/templates/form-registration.php'">
            </ng-include>

            <!-- APPLICANT State, further account details -->
				    <ng-include 
              src="'/wp-content/plugins/teledent/templates/form-user-applicant.php'">
            </ng-include>

        	</form>
    	</div> 
  	</div>

	<pre>user = {{user | json}}</pre>
	<pre>master = {{master | json}}</pre>
</div>