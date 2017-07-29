<div ng-controller="RegistrationController">

	<form novalidate class="simple-form">

		{{formState}}

		<!-- STEP 1.a - SIGN IN -->
		<div id="signinForm" 
			class="signin container"
			ng-show="formState == 'signin'">
			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<label>E-mail: 
						<input type="email" 
							name="email"
							ng-model="user.email"
							required />
							<span 
								ng-if="user.email.$dirty && !user.email" 
								class="alert">Invalid email address</span>
					</label>
			  	</div>
				<div class="col-sm-12 col-lg-6">
					<label>Password: 
						<input type="password" 
							name="password"
							ng-model="user.password"
							required />
							<span 
								ng-if="user.email.$dirty && !user.email" 
								class="alert">Invalid email address</span>
					</label>
			  	</div>
			</div>
		</div>
		
		<!-- STEP 1.b - CREATE ACCOUNT -->
		<div id="registerForm" 
			class="register container">

			<div class="row">
				<div class="col-sm-12 col-lg-6">
					<label>E-mail: 
						<input type="email" 
							name="email"
							ng-model="user.email"
							required />
							<span 
								ng-if="user.email.$dirty && !user.email" 
								class="alert">Invalid email address</span>
					</label>
			  	</div>
				<div class="col-sm-12 col-lg-6">
					<label>
						<input type="radio" 
							ng-model="user.type" 
							value="applicant" />
							Applicant
					</label>
					<label>
						<input type="radio" 
							ng-model="user.type" 
							value="office" />
							Office
					</label>
			  	</div>

			</div>
			<div class="row">

				<div class="col-sm-12">
					<input type="button" 
						ng-click="reset()" 
						value="Reset" />

					<input type="submit"
						ng-if="!user.email || !user.type" 
						disabled
						value="Save" />

					<input type="submit"
						ng-if="user.email && user.type" 
						ng-click="update(user)" 
						value="Save" />

			  	</div>

			</div>

		</div>
	</form>

	<pre>user = {{user | json}}</pre>
	<pre>master = {{master | json}}</pre>
</div>