					<fieldset
         			ng-show="formState == 'register'">
            		<div id="legend">
              			<legend class="">Registrant Declaration</legend>
            		</div>

					<p>Welcome to Teledent Dental Services. Please declare whether you are an Applicant (looking for a job) or a Dental Office (looking to hire someone).</p>
					<p>Once you have made this selection you will begin the registration process. You must complete the entire process to create an account. Applicants, you will need to upload a .pdf, or .doc version of your resume to complete the process.</p>

					<!-- USER TYPE -->
					<div class="form-group" 
						ng-init="user.type=FALSE">
					  <label for="radios" 
					  	class="col-sm-12">How can Teledent help you?</label>
					  <div class=" col-sm-12 required">
					    <div class="radio">
					      <label class="radio-custom" 
					      	data-initialize="radio" 
					      	id="radios-applicant">
					        <input type="radio" 
								ng-model="user.user_type" 
								value="applicant"/>
					        <span class="radio-label">I am an Applicant. I am looking for temporary or permanent work in the dental field.</span>
					      </label>
					    </div><div class="radio">
					      <label class="radio-custom" 
					      	data-initialize="radio" 
					      	id="radios-office">
					        <input type="radio" 
								ng-model="user.user_type" 
								value="office"/>
					        <span class="radio-label">I work at a Dental Office. I am looking to hire someone to work in our office.</span>
					      </label>
					    </div>
					    <p class="help-block"></p>
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
								class="form-control input-lg">
							<p class="help-block">This is your primary contact method.</p>
						</div>
					</div>
         
			
					<!-- SIGN UP BUTTON -->
					<div class="control-group">
						<!-- Button -->
						<div class="controls">
							<button class="btn btn-warning"
							disabled
							ng-if="!user.email_address || !user.user_type">
								Start Registration
							</button>

							<button class="btn btn-success"
							ng-click="actionRegister(user)"
							ng-if="user.email_address && user.user_type">
								Start Registration
							</button>
						</div>
					</div>
          		</fieldset>