					<fieldset
         			ng-show="formState == 'register'">
            		<div id="legend">
              			<legend class="">Create your Teledent account</legend>
            		</div>

					<!-- USER TYPE -->
					<div class="form-group">
					  <label for="radios" 
					  	class="col-sm-12">What services are you looking for?</label>
					  <div class=" col-sm-12 required">
					    <div class="radio">
					      <label class="radio-custom" 
					      	data-initialize="radio" 
					      	id="radios-applicant">
					        <input type="radio" 
								ng-model="user.user_type" 
								value="applicant"/>
					        <span class="radio-label">I am an Applicant. </span>
					      </label>
					      <p class="help-block">I am looking for temporary or permanent work in the dental field.</p>
					    </div>
					    <div class="radio">
					      <label class="radio-custom" 
					      	data-initialize="radio" 
					      	id="radios-office">
					        <input type="radio" 
								ng-model="user.user_type" 
								value="office"/>
					        <span class="radio-label">I work at a Dental Office. </span>
					      </label>
					      <p class="help-block">I am looking to hire someone to work in our office.</p>
					    </div>
					  </div>
					</div>

					<!-- USER EMAIL -->
					<div class="control-group">
						<label class="control-label" 
							for="email_address">E-mail</label>
						<div class="controls">
							<input type="email" 
								id="email_address"
								ng-model="user.email_address"
								required 
								name="email_address" 
								placeholder="example@email.com" 
								class="form-control input-lg"
								ng-change="emailCheck(user)">
							<p class="help-block">Email is our primary contact method. <span class="alert-warning"
								ng-if="!emailIsUnique">This email is already registered. | <a href="#">Reset password</a> </p></p>
							
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
          		</fieldset>