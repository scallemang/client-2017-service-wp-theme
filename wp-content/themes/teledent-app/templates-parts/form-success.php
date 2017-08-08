<content 
	ng-if="formState == 'success'">

	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2>Hello {{master.first_name}},</h2>
				<p>Your Teledent account is ready. A secure password has been created and e-mailed to you.</p> 
				
				<h3>Quick links</h3>
				<ul ng-if="master.user_type == 'applicant'">
					<li><a href="/dashboard" title="{{master.first_name}}'s Dashboard">Dashboard</li>
					<li><a href="/contracts" title="View Contract placements">Contracts placements</li>
					<li><a href="/permanent" title="View Permanent placements">Permanent placements</li>
					<li><a href="/temporary" title="View Temporary placements">Temporary placements</li>
				</ul>

				<ul ng-if="master.user_type == 'office'">
					<li><a href="/dashboard" title="{{master.first_name}}'s Dashboard">Dashboard</li>
					<li><a href="/post-contract" title="View Contract placements">Create Contract offer</li>
					<li><a href="/post-permanent" title="View Permanent placements">Create Permanent offer</li>
					<li><a href="/post-temporary" title="View Temporary placements">Create Temporary offer</li>
				</ul>
				
			</div>   
		</div>
	</div>	
	
</content>
