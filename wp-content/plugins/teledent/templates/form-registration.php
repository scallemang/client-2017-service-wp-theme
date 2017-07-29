					<fieldset
         			ng-show="formState == 'register'">
            		<div id="legend">
              			<legend class="">Register</legend>
            		</div>
  
  				    <!-- <div class="input-group">
				    	<input type="email" 
								id="email"
								ng-model="user.email"
								required 
								name="email" 
								placeholder="youemail@domain.com" 
								class="form-control input-lg">
				      <div class="input-group-btn">
				        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action <span class="caret"></span></button>
				        <ul class="dropdown-menu">
				          <li><a href="#">Action</a></li>
				          <li><a href="#">Another action</a></li>
				          <li><a href="#">Something else here</a></li>
				          <li role="separator" class="divider"></li>
				          <li><a href="#">Separated link</a></li>
				        </ul>
				      </div>
				    </div> --> 

					<div class="control-group">
						<label class="control-label" for="email_address">E-mail</label>
						<div class="controls">
							<input type="email" 
								id="email_address"
								ng-model="user.email_address"
								required 
								name="email_address" 
								placeholder="example@email.com" 
								class="form-control input-lg">
							<p class="help-block">Please provide your E-mail</p>
						</div>
					</div>
         
					<div class="control-group">
						<h3>Account Type</h3>           
						<label 
							class="control-label" 
							for="applicant">
							Applicant
						</label>
						<div class="controls">
							<input type="radio" 
								ng-model="user.type" 
								value="applicant"
								name="applicant" />
						</div>
						<label 
							class="control-label" 
							for="office">
							Office
						</label>
						<div class="controls">
							<input type="radio" 
								ng-model="user.office" 
								value="office"
								name="office" />
						</div>
						<p class="help-block"></p>
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
							ng-click="actionRegister(user)"
							ng-if="user.email_address && user.type">
								Register
							</button>
						</div>
					</div>
          		</fieldset>