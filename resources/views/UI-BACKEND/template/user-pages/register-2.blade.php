<!DOCTYPE html>
<html lang="en">

<head>
<!-- Required meta tags -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<!-- /Added by HTTrack -->
<meta name="viewport"
	content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>PolluxUI Admin</title>
<!-- base:css -->
<link rel="stylesheet"
	href="{{ asset('css/UI-BACKEND/vendors/typicons/typicons.css') }}">
<link rel="stylesheet"
	href="{{ asset('css/UI-BACKEND/vendors/css/vendor.bundle.base.css') }}">
<!-- endinject -->
<!-- plugin css for this page -->
<!-- End plugin css for this page -->
<!-- inject:css -->
<link rel="stylesheet"
	href="{{ asset('css/UI-BACKEND/vertical-layout-light/style.css') }}">
<!-- endinject -->
<link rel="shortcut icon"
	href="{{ asset('image/UI-BACKEND/favicon.png') }}" />
</head>
<body>
	<div class="container-scroller">
		<div class="container-fluid page-body-wrapper full-page-wrapper">
			<div
				class="content-wrapper d-flex align-items-stretch auth auth-img-bg">
				<div class="row flex-grow">
					<div
						class="col-lg-6 d-flex align-items-center justify-content-center">
						<div class="auth-form-transparent text-start p-3">
							<div class="brand-logo">
								<img src="{{ asset('image/UI-BACKEND/logo-dark.svg') }}" alt="logo">
							</div>
							<h4>New here?</h4>
							<h6 class="font-weight-light">Join us today! It takes only few
								steps</h6>
							<form class="pt-3">
								<div class="form-group">
									<label>Username</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="typcn typcn-user-outline text-primary"></i>
											</span>
										</div>
										<input type="text"
											class="form-control form-control-lg border-left-0"
											placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<label>Email</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="typcn typcn-mail text-primary"></i>
											</span>
										</div>
										<input type="email"
											class="form-control form-control-lg border-left-0"
											placeholder="Email">
									</div>
								</div>
								<div class="form-group">
									<label>Country</label> <select
										class="form-control form-control-lg"
										id="exampleFormControlSelect2">
										<option>Country</option>
										<option>United States of America</option>
										<option>United Kingdom</option>
										<option>India</option>
										<option>Germany</option>
										<option>Argentina</option>
									</select>
								</div>
								<div class="form-group">
									<label>Password</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="typcn typcn-lock-closed-outline text-primary"></i>
											</span>
										</div>
										<input type="password"
											class="form-control form-control-lg border-left-0"
											id="exampleInputPassword" placeholder="Password">
									</div>
								</div>
								<div class="mb-4">
									<div class="form-check">
										<label class="form-check-label text-muted"> <input
											type="checkbox" class="form-check-input"> I agree to all
											Terms &amp; Conditions <i class="input-helper"></i></label>
									</div>
								</div>
								<div class="mt-3">
									<a
										class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
										href="../../index.html">SIGN UP</a>
								</div>
								<div class="text-center mt-4 font-weight-light">
									Already have an account? <a href="login.html"
										class="text-primary">Login</a>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 register-half-bg d-flex flex-row">
						<p
							class="text-white font-weight-medium text-center flex-grow align-self-end">Copyright
							© 2021 All rights reserved.</p>
					</div>
				</div>
			</div>
			<!-- content-wrapper ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->

	<!-- base:js -->
	<script src="{{ asset('js/UI-BACKEND/popper.min.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/bootstrap.min.js') }}"
		crossorigin="anonymous"></script>
	<script
		src="{{ asset('js/UI-BACKEND/vendors/js/vendor.bundle.base.js') }}"></script>
	<!-- endinject -->
	<!-- Plugin js for this page-->
	<script
		src="{{ asset('js/UI-BACKEND/vendors/chart.js/Chart.min.js') }}"></script>
	<!-- End plugin js for this page-->
	<!-- inject:js -->
	<script src="{{ asset('js/UI-BACKEND/off-canvas.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/hoverable-collapse.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/template.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/settings.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/todolist.js') }}"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="{{ asset('js/UI-BACKEND/dashboard.js') }}"></script>
	<!-- End custom js for this page-->
</body>

</html>

