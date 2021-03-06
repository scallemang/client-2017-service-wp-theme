<content 
	ng-show="formState == 'applicant'">
	<h2>Applicant Registration</h2>

	<!-- BEGIN APPLICANT DETAILS -->
	<fieldset>
		<div id="legend">
			<legend class="">Applicant Details</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<div class="control-group">
						<label class="control-label" 
							for="email_address_disabled">Email</label>
						<div class="controls">
							<input type="email" 
								id="email_address_disabled"
								name="email_address_disabled" 
								placeholder="{{user.email_address}}" 
								class="form-control input-lg"
								tabindex="1"
								disabled
								>
							<p class="help-block">Email is locked until account creation complete.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="first_name">First Name</label>
						<div class="controls">
							<input type="text" 
								id="first_name"
								ng-model="user.first_name"
								required 
								name="first_name" 
								placeholder="What should we call you?" 
								class="form-control input-lg"
								tabindex="2">
							<p class="help-block">First Name is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="last_name">Last Name</label>
						<div class="controls">
							<input type="text" 
								id="last_name"
								ng-model="user.last_name"
								required 
								name="last_name" 
								placeholder="Your last name" 
								class="form-control input-lg"
								tabindex="3">
							<p class="help-block">Last Name is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="primary_phone">Primary Phone</label>
						<div class="controls">
							<input type="tel" 
								id="primary_phone"
								ng-model="user.primary_phone"
								required 
								name="primary_phone" 
								placeholder="eg: (905) 555-5555" 
								class="form-control input-lg"
								tabindex="4">
							<p class="help-block">Phone Number is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="postal_code">Postal Code *</label>
						<div class="controls">
							<input type="type" 
								id="postal_code"
								ng-model="user.postal_code"
								required 
								name="postal_code" 
								placeholder="eg: A1A 1A1" 
								class="form-control input-lg"
								tabindex="11">
							<p class="help-block">Postal Code is a required field.</p>
						</div>
					</div>

				</div>   
			</div>
		</div>	
	</fieldset>
	<!-- END APPLICANT DETAILS -->

	<!-- BEGIN WORK DETAILS -->
	<fieldset>
		<div id="legend">
			<legend class="">Applicant Questionnaire</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<!-- TYPE OF QUALIFICATIONS -->
					<div class="form-group">
					  <label for="locations" 
					  	class="form-label col-sm-12">What type of dental professional do you consider yourself to be?</label>
					  <div class=" col-sm-12 required">
					    <div class="radio"
					    	ng-repeat="qualification in workTypesList">
					      <label class="radio-custom clearfix" 
					      	data-initialize="radio" 
					      	id="radio-locations">
					        <input type="radio" 
								ng-model="user.work_types"
								value="{{qualification.name}}" />
					        <span class="radio-label">{{qualification.name}}</span>
					      </label>
					    </div>
						<p class="help-block">You can only choose one option. If you consider yourself part of more than one category then pick the category in which you feel your current skills are strongest.</p>
					  </div>
					</div>

					<!-- TYPE OF WORK -->
					<div class="form-group">
					  <label for="contract_type" 
					  	class="col-sm-12">What type of working are you looking for?</label>
					  <div class=" col-sm-12 required">
					    <div class="checkbox"
					    	ng-repeat="contract_type in contractTypesList">
					      <label class="checkbox-custom clearfix" 
					      	data-initialize="checkbox" 
					      	id="checkbox-contract_type">
					        <input type="checkbox" 
								ng-model="user.contract_type[contract_type.name]" />
					        <span class="checkbox-label">{{contract_type.name}}</span>
					      </label>
					    </div>
					    <p class="help-block"></p>
					  </div>
					</div>

					<!-- VEHICLE & VALID DRIVERS LICENSE -->
					<div class="form-group">
					  <label for="commute" 
					  	class="form-label col-sm-12">How will you get to work?</label>
					  <div class=" col-sm-12 required">
					    <div class="radio">
					      <label class="radio-custom clearfix" 
					      	data-initialize="radio" 
					      	id="checkbox-commute-driving">
					        <input type="radio" 
								ng-model="user.commute"
								value="commute" />
					        <span class="radio-label">Driving</span>
					      </label>
					  	</div>
					  	<div class="radio">
					      <label class="radio-custom clearfix" 
					      	data-initialize="radio" 
					      	id="radio-commute-transit">
					        <input type="radio" 
								ng-model="user.commute"
								value="transit" />
					        <span class="radio-label">Transit</span>
					      </label>
					    </div>
						<p class="help-block"></p>
					  </div>
					</div>

					<!-- LOCATIONS -->
					<div class="form-group">
					  <label for="locations" 
					  	class="col-sm-12">Where are you able to work?</label>
					  <div class=" col-sm-12 required">
					    <div class="checkbox"
					    	ng-repeat="location in locationList">
					      <label class="radio-custom clearfix" 
					      	data-initialize="checkbox" 
					      	id="checkbox-locations">
					        <input type="checkbox" 
								ng-model="user.location[location.name]" />
					        <span class="checkbox-label">{{location.name}}</span>
					      </label>
					    </div>
					    <p class="help-block"></p>
					  </div>
					</div>

					<!-- Salary -->
					<div class="control-group clearfix">
						<label class="control-label" 
							for="salary">What hourly rate of pay do you expect to earn?</label>
						<div class="controls">
							<span class="alignleft">$</span>
							<input type="type" 
								id="salary"
								ng-model="user.salary"
								required 
								name="salary" 
								placeholder="" 
								class="form-control alignleft"
								tabindex="15"
								style="width:72px">
								<span class="alignleft">hourly</span>
							<p class="help-block"></p>
						</div>
					</div>

				</div>   
			</div>
		</div>	
	</fieldset>
	<!-- END WORK DETAILS -->

	<fieldset>
		<div id="legend">
			<legend class="">Create Account</legend>
		</div>

		<div class="control-group">
			<!-- Button -->
			<div class="controls">

				<div id="putUpload"></div>

				<hr />

				<button class="btn btn-warning"
				disabled
				ng-if="teledent-registration.$invalid">
					Complete registration
				</button>

				<button class="btn btn-success"
				ng-click="createApplicant(user)">
					Complete registration
				</button>
			</div>
		</div>
	</fieldset>
</content>
