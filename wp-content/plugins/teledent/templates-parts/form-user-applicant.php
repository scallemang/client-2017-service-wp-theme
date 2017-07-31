<content 
	ng-if="formState == 'applicant'">
	<h2>Applicant Registration</h2>

	<!-- BEGIN APPLICANT DETAILS -->
	<fieldset>
		<div id="legend">
			<legend class="">Applicant Details</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-6">

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
								disabled>
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
							<input type="text" 
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
							for="secondary_phone">Secondary Phone</label>
						<div class="controls">
							<input type="type" 
								id="secondary_phone"
								ng-model="user.secondary_phone"
								required 
								name="secondary_phone" 
								placeholder="eg: (905) 555-5555" 
								class="form-control input-lg"
								tabindex="5">
							<p class="help-block">Secondary Phone is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="gender">Gender</label>
						<div class="controls">
							<select 
								id="gender"
								ng-model="user.gender"
								ng-options="gender.name for gender in genderList"
								required 
								name="gender"
								placeholder="Select gender"
								class="form-control input-lg"
								tabindex="7" />
							<p class="help-block">This field is not mandatory. We do not screen applicants based on gender or any of the other prohibited grounds listed under the Ontario Human Rights Code.</p>
						</div>
					</div>


				</div>   
			</div>
		</div>	
	</fieldset>
	<!-- END APPLICANT DETAILS -->

	<!-- BEGIN ADDRESS -->
	<fieldset>
		<div id="legend">
			<legend class="">Address</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-6">

					<div class="control-group">
						<label class="control-label" 
							for="street_name">Address</label>
						<div class="controls">
							<input type="text" 
								id="street_name"
								ng-model="user.street_name"
								required 
								name="street_name" 
								placeholder="eg: 1-123 Example St." 
								class="form-control input-lg"
								tabindex="8">
							<p class="help-block"></p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="city">City *</label>
						<div class="controls">
							<input type="text" 
								id="city"
								ng-model="user.city"
								required 
								name="city" 
								placeholder="eg: Hamilton" 
								class="form-control input-lg"
								tabindex="9">
							<p class="help-block">City is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="province">Province *</label>
						<div class="controls">
							<select 
								id="province"
								ng-model="user.province"
								ng-options="province.name for province in provList"

								required 
								name="province"
								placeholder="Select province"
								class="form-control input-lg"
								tabindex="10"/>
							<p class="help-block">Province is a required field.</p>
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
	<!-- END ADDRESS -->

	<!-- BEGIN WORK DETAILS -->
	<fieldset>
		<div id="legend">
			<legend class="">Applicant Questionnaire</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<!-- TYPE OF QUALIFICATIONS -->
					<div class="control-group">
						<label class="control-label" 
							for="locations">What type of dental professional do you consider yourself to be?</label>
						<div class="controls">
							<span ng-repeat="qualification in workTypesList"
								class="clearfix">
								<label class="control-label" 
								for="qualification_{{qualification.name}}"
								class="alignleft">{{qualification.name}}</label>
								<input type="radio" 
									id="qualification_{{qualification.name}}"
									ng-model="user.contract_type"
									value="{{qualification.name}}"
									required 
									name="contract_type" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<p class="help-block">You can only choose one option. If you consider yourself part of more than one category then pick the category in which you feel your current skills are strongest.</p>
						</div>
					</div>

					<!-- TYPE OF WORK -->
					<div class="control-group">
						<label class="control-label" 
							for="locations">What type of working are you looking for?</label>
						<div class="controls">
							<span ng-repeat="contract_type in contractTypesList"
								class="clearfix">
								<label class="control-label" 
								for="contractType_{{contract_type.name}}"
								class="alignleft">{{contract_type.name}}</label>
								<input type="checkbox" 
									id="contractType_{{contract_type.name}}"
									ng-model="user.contract_type[contract_type.name]"
									required 
									name="contract_type" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<p class="help-block">Contract type is a required field.</p>
						</div>
					</div>

					

					<div class="control-group">
						<label class="control-label" 
							for="locations">Where are you able to work?</label>
						<div class="controls">
							<span ng-repeat="location in locationList"
								class="clearfix">
								<label class="control-label" 
								for="locations_{{location.name}}"
								class="alignleft">{{location.name}}</label>
								<input type="checkbox" 
									id="locations_{{location.name}}"
									ng-model="user.locations[location.name]"
									required 
									name="street_name" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
						</div>
					</div>


					<!-- CURRENTLY WORKING -->
					<div class="control-group">
						<label class="control-label" 
							for="locations">Are you currently working?</label>
						<div class="controls">
							<span class="clearfix">
								<label class="control-label" 
								for="locations_{{location.name}}"
								class="alignleft">Yes</label>
								<input type="radio" 
									id="currently_working_true"
									ng-model="user.currently_working"
									value="true"
									required 
									name="currently_working_true" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<span class="clearfix">
								<label class="control-label" 
								for="locations_{{location.name}}"
								class="alignleft">No</label>
								<input type="radio" 
									id="currently_working_false"
									ng-model="user.currently_working"
									value="false"
									required 
									name="currently_working_false" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<p class="help-block">This is a required field.</p>
						</div>
					</div>
					
					<!-- Salary -->
					<div class="control-group">
						<label class="control-label" 
							for="postal_code">What is your salary expectation?</label>
						<div class="controls">
							$<input type="type" 
								id="salary"
								ng-model="user.salary"
								required 
								name="salary" 
								placeholder="$$" 
								class="form-control input-lg"
								tabindex="15">
								/per hour
							<p class="help-block">Salary expectation is a required field.</p>
						</div>
					</div>

					<!-- VEHICLE & VALID DRIVERS LICENSE -->
					<div class="control-group">
						<label class="control-label" 
							for="locations">How will you get to work?</label>
						<div class="controls">
							<span class="clearfix">
								<label class="control-label" 
								for="driver_true"
								class="alignleft">Driving</label>
								<input type="radio" 
									id="driver_true"
									ng-model="user.commute[true]"
									required 
									name="driver_true" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<span class="clearfix">
								<label class="control-label" 
								for="driver_false"
								class="alignleft">Public Transit</label>
								<input type="radio" 
									id="driver_false"
									ng-model="user.commute[false]"
									required 
									name="driver_false" 
									class="form-control input-lg alignleft"
									tabindex="8">
								</label>
							</span>
							<p class="help-block">This is a required field.</p>
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
				<!-- <button class="btn btn-warning"
				disabled
				ng-if="!user.email_address || !user.type">
					Complete registration
				</button> -->

				<button class="btn btn-success"
				ng-click="actionApplicant(user)"
				>
					Complete registration
				</button>
			</div>
		</div>
	</fieldset>
</content>
