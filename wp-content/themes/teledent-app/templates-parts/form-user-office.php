<content 
	ng-if="formState == 'office'">
	<h2>Office Registration</h2>

	<!-- BEGIN APPLICANT DETAILS -->
	<fieldset>
		<div id="legend">
			<legend class="">Office Details</legend>
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
							for="office_name">Office Name</label>
						<div class="controls">
							<input type="text" 
								id="office_name"
								ng-model="user.office_name"
								required 
								name="office_name" 
								placeholder="What is your office name?" 
								class="form-control input-lg"
								tabindex="2">
							<p class="help-block">Office Name is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="contact_name">Contact Name</label>
						<div class="controls">
							<input type="text" 
								id="contact_name"
								ng-model="user.contact_name"
								required 
								name="contact_name" 
								placeholder="Who can we contact?" 
								class="form-control input-lg"
								tabindex="3">
							<p class="help-block">A contact name is a required field.</p>
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
							for="secondary_phone">Secondary Phone</label>
						<div class="controls">
							<input type="tel" 
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
				<div class="col-md-12">

					<div class="control-group">
						<label class="control-label" 
							for="address">Address</label>
						<div class="controls">
							<input type="text" 
								id="address"
								ng-model="user.address"
								required 
								name="address" 
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
			<legend class="">Office Questionnaire</legend>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-md-12">

					<!-- TYPE OF QUALIFICATIONS -->
					<div class="form-group">
					  <label for="locations" 
					  	class="form-label col-sm-12">What type of dental professional do you need to hire?</label>
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
						<p class="help-block">You can only choose one option.</p>
					  </div>
					</div>

					<!-- TYPE OF WORK -->
					<div class="form-group">
					  <label for="contract_type" 
					  	class="col-sm-12">What type of working are you position are you filling?</label>
					  <div class=" col-sm-12 required">
					    <div class="checkbox"
					    	ng-repeat="contract_type in contractTypesList">
					      <label class="radio-custom clearfix" 
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

					<!-- Salary -->
					<div class="control-group clearfix">
						<label class="control-label" 
							for="salary">What hourly rate of pay do you expect to pay?</label>
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

				<hr />

				<button class="btn btn-warning"
					disabled
					ng-if="teledent-registration.$invalid">
					Complete registration
				</button>

				<button class="btn btn-success"
					ng-click="createOffice(user)">
					Complete registration
				</button>
			</div>
		</div>
	</fieldset>
</content>
