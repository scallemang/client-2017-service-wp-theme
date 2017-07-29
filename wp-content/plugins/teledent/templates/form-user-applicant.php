<content 
	ng-if="formState == 'applicant'">
	<h2>Applicant Registration</h2>

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
							for="street_name">Street Name</label>
						<div class="controls">
							<input type="text" 
								id="street_name"
								ng-model="user.street_name"
								required 
								name="street_name" 
								placeholder="eg: Ontario St." 
								class="form-control input-lg">
							<p class="help-block">Street Name is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="street_number">Street Number</label>
						<div class="controls">
							<input type="text" 
								id="street_number"
								ng-model="user.street_number"
								required 
								name="street_number" 
								placeholder="eg: 123" 
								class="form-control input-lg"
								maxlength="7">
							<p class="help-block">Street Number is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="unit_number">Unit Number</label>
						<div class="controls">
							<input type="text" 
								id="unit_number"
								ng-model="user.unit_number"
								required 
								name="unit_number" 
								placeholder="eg: 44" 
								class="form-control input-lg"
								maxlength="7">
							<p class="help-block">Unit Number is a required field.</p>
						</div>
					</div>

				</div>
				<div class="col-md-6">


					<div class="control-group">
						<label class="control-label" 
							for="city">City</label>
						<div class="controls">
							<input type="text" 
								id="city"
								ng-model="user.city"
								required 
								name="city" 
								placeholder="eg: Hamilton" 
								class="form-control input-lg">
							<p class="help-block">City is a required field.</p>
						</div>
					</div>
					<div class="control-group">
						<label class="control-label" 
							for="province">Province</label>
						<div class="controls">
							<select 
								id="province"
								ng-model="user.province"
								ng-options="province.name for province in provList"
								required 
								name="province"
								placeholder="Select province"
								class="form-control input-lg"/>

							<p class="help-block">Province is a required field.</p>
						</div>
					</div>

					<div class="control-group">
						<label class="control-label" 
							for="postal_code">Postal Code</label>
						<div class="controls">
							<input type="type" 
								id="postal_code"
								ng-model="user.unit_number"
								required 
								name="postal_code" 
								placeholder="eg: A1A 1A1" 
								class="form-control input-lg"
								maxlength="7">
							<p class="help-block">Postal Code is a required field.</p>
						</div>
					</div>

				</div>   
			</div>
		</div>	
	</fieldset>
	<!-- END ADDRESS -->

	<fieldset>
		<div id="legend">
			<legend class="">Address</legend>
		</div>

		<div class="control-group">
			<!-- Button -->
			<div class="controls">
				<button class="btn btn-warning"
				disabled
				ng-if="!user.email_address || !user.type">
					Register
				</button>

				<button class="btn btn-success"
				ng-click="actionApplicant(user)"
				ng-if="user.email_address && user.type">
					Register
				</button>
			</div>
		</div>
	</fieldset>
</content>
