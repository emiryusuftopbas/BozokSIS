<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="ie=edge">
		<link rel="stylesheet" href="app/views/assets/css/bulma.min.css">
		<link rel="stylesheet" href="app/views/assets/css/main.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	<body>
		<?php echo md5(sha1("student123")); ?>
		<div class="background"></div>
		<section class="hero is-fullheight">
			<div class="hero-head"></div>
			<div class="modal" id="signup-modal">
				<div class="modal-background"></div>
				<div class="modal-content">
					<div class="section modal-wrap">
						<div class="box">
							<form onsubmit="return false" id="signup-form">
								<div class="field">
									<label class="label">Name</label>
									<p class="control has-icons-left ">
										<input class="input" type="text" name="name">
										<span class="icon is-small is-left">
											<i class="fa fa-user"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<label class="label">Email</label>
									<p class="control has-icons-left ">
										<input class="input" type="text" name="email">
										<span class="icon is-small is-left">
											<i class="fa fa-envelope"></i>
										</span>
									</p>
								</div>
								<div class="field">
									<label class="label">Password</label>
									<p class="control has-icons-left ">
										<input class="input" type="password" name="password">
										<span class="icon is-small is-left">
											<i class="fa fa-key"></i>
										</span>
									</p>
								</div>
								
								<div class="is-centered">
									<button class="button is-success" onclick="SignUp()">Sign Up</button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<button class="modal-close is-large" aria-label="close" id="signup-modal-close-button"></button>
			</div>
			<div class="hero-body">
				<div class="container">
					<div class="columns is-vcentered">
						<div class="column">
							<div class="is-centered">
								<img class="responsive-img bozok-logo" src="app/views/assets/img/original-logo.png">
							</div>
							<div style="">
								<h4 class="title is-4 has-text-centered">Student Information System</h4>
							</div>
						</div>
						<div class="column">
							<div class="colums">
								<div class="column"></div>
								<div class="column">
									<div class="box is-box-transparent">
										<form onsubmit="return false" id="signin-form">
											<div class="field">
												<label class="label">Username</label>
												<p class="control has-icons-left ">
													<input class="input" type="text" name="username">
													<span class="icon is-small is-left">
														<i class="fa fa-envelope"></i>
													</span>
												</p>
											</div>
											<div class="field">
												<label class="label">Password</label>
												<p class="control has-icons-left ">
													<input class="input" type="password" name="password">
													<span class="icon is-small is-left">
														<i class="fa  fa-key"></i>
													</span>
												</p>
											</div>
											<div class="field">
												<div class="control is-centered">
													<button class="button is-link" onclick="SignIn()">Login</button>
													<a href="#" id="signup-modal-open-button" class="button"  >
														<span class="icon">
															<i class="fa fa-user-plus"></i>
														</span>
														<span>Sign Up</span>
													</a>
												</div>
											</div>
										</form>
										
									</div>
								</div>
								<div class="column"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="hero-foot"></div>
			<script src="app/views/assets/js/main.js" type="text/javascript"></script>
			<script src="app/views/assets/js/jquery.min.js" type="text/javascript"></script>
			<script src="app/views/assets/js/jquery.min.js" type="text/javascript"></script>
			<script src="app/views/assets/js/sweetalert.min.js" type="text/javascript"></script>
		</section>
	</body>
</html>