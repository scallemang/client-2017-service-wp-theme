					<fieldset
         			ng-show="formState == 'register'">

					<!-- USER EMAIL -->
					<div class="control-group">
						<label class="control-label" 
							for="email_address">Enter your e-mail address</label>
						<div class="controls">
							<input type="email" 
								id="email_address"
								ng-model="user.email_address"
								required 
								name="email_address" 
								placeholder="example@email.com" 
								class="form-control input-lg"
								ng-change="emailCheck(user)">
							
						</div>
					</div>

					<!-- LOGIN -->

					<content ng-if="!emailIsUnique">

						<div class="control-group">
							<label class="control-label" 
								for="email_address">Password</label>
							<div class="controls">
								<input type="password" 
									id="password"
									required 
									name="password" 
									class="form-control input-lg">
								<p class="help-block">Enter your Teledent account password</p>
								
							</div>
						</div>

						<!-- SIGN IN BUTTON -->
						<div class="control-group">
							<!-- Button -->
							<div class="controls">
								<button class="btn btn-warning"
								disabled
								ng-if="!user.email_address">
									Sign-in
								</button>

								<button class="btn btn-success"
								ng-click="actionSignIn(user)"
								ng-if="user.email_address">
									Sign-in
								</button>
							</div>
						</div>

					</content>


					<!-- REGISTER -->

					<content ng-if="emailIsUnique">

						<!-- USER TYPE -->
						<div class="form-group">
						  <label for="radios" 
						  	class="col-sm-12">What services are you looking for?</label>
						  <div class=" col-sm-12 required">
						    <div class="radio">
						      <input type="radio" 
									ng-model="user.user_type" 
									value="applicant"
									id="applicant" />
						      <label class="radio-custom" 
						      	data-initialize="radio" 
						      	id="radios-applicant"
						      	for="applicant" >
						        <span class="radio-label">I am an Applicant. </span>
						      </label>
						      <p class="help-block">I am looking for temporary or permanent work in the dental field.</p>
						    </div>
						    <div class="radio">
						      <input type="radio" 
									ng-model="user.user_type" 
									value="office"
									id="office" />
						      <label class="radio-custom" 
						      	data-initialize="radio" 
						      	id="radios-office"
						      	for="office">
						        <span class="radio-label">I work at a Dental Office. </span>
						      </label>
						      <p class="help-block">I am looking to hire someone to work in our office.</p>
						    </div>
						  </div>
						</div>
	         
						<!-- SIGN UP BUTTON -->
						<div class="control-group">
							<!-- Button -->
							<div class="controls">
								<button class="btn btn-warning"
								disabled
								ng-if="!user.email_address || !user.user_type || !emailIsUnique">
									Start Registration
								</button>

								<button class="btn btn-success"
								ng-click="actionRegister(user)"
								ng-if="user.email_address && user.user_type && emailIsUnique">
									Start Registration
								</button>
							</div>
						</div>
	
					</content>
					
          		</fieldset>