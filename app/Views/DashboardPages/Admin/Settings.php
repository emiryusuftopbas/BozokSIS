
<div class="column is-9">

	<div class="is-centered">
		<div class="box">
			<form class="form" method="POST" onsubmit="return false" id="change-password-form" >
				<input type="hidden" name="userrole" value="<?php echo $userRole ?>" >
				<input type="hidden" name="userid" value="<?php echo $userId ?>">
				<div class="field">
					<label class="label">Current Password</label>
					<div class="control">
						<input class="input" type="password" name="currentpassword" >
					</div>
				</div>
				<div class="field">
					<label class="label">New Password</label>
					<div class="control">
						<input class="input" type="password" name="newpassword">
					</div>
				</div>
				<div class="field is-centered">
					<div class="control">
						<button class="button is-link" onclick="ChangePassword()" >Change Password</button>
					</div>
				</div>
			</form>
			</div>
		</div>
	</div>
</div>