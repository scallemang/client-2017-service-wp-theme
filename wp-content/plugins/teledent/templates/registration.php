<div 
  ng-app="teledentRegister"
  class="container teledent-app form"
  id="registration"
  ng-controller="RegistrationController"
	ng-cloak>
  
 	<div class="row">
  		<div class="col-sm-12">
    
        	<form novalidate 
        		class="form-horizontal"
            name="teledent-registration">
         		
            <!-- INITIAL State, core account details (email and usertype) -->
        		<ng-include 
              src="'/wp-content/plugins/teledent/templates-parts/form-registration.php'">
            </ng-include>

            <!-- APPLICANT State, further account details -->
				    <ng-include 
              src="'/wp-content/plugins/teledent/templates-parts/form-user-applicant.php'">
            </ng-include>

            <!-- OFFICE State, further account details -->
            <ng-include 
              src="'/wp-content/plugins/teledent/templates-parts/form-user-office.php'">
            </ng-include>

        	</form>
    	</div> 
  	</div>

	<pre>user = {{user | json}}</pre>
	<pre>master = {{master | json}}</pre>
</div>