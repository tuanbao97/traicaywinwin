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
							<h4>Welcome back!</h4>
							<h6 class="font-weight-light">Happy to see you again!</h6>
							<form class="pt-3">
								<div class="form-group">
									<label for="exampleInputEmail">Username</label>
									<div class="input-group">
										<div class="input-group-prepend bg-transparent">
											<span class="input-group-text bg-transparent border-right-0">
												<i class="typcn typcn-user-outline text-primary"></i>
											</span>
										</div>
										<input type="text"
											class="form-control form-control-lg border-left-0"
											id="exampleInputEmail" placeholder="Username">
									</div>
								</div>
								<div class="form-group">
									<label for="exampleInputPassword">Password</label>
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
								<div
									class="my-2 d-flex justify-content-between align-items-center">
									<div class="form-check">
										<label class="form-check-label text-muted"> <input
											type="checkbox" class="form-check-input"> Keep me signed in <i
											class="input-helper"></i></label>
									</div>
									<a href="#" class="auth-link text-black">Forgot password?</a>
								</div>
								<div class="my-3">
									<a
										class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn"
										href="../../index.html">LOGIN</a>
								</div>
								<div class="mb-2 d-flex">
									<button type="button"
										class="btn btn-facebook auth-form-btn flex-grow mr-1">
										<i class="typcn typcn-social-facebook me-2"></i>Facebook
									</button>
									<button type="button"
										class="btn btn-google auth-form-btn flex-grow ms-1">
										<i class="typcn typcn-social-google-plus-circular me-2"></i>Google
									</button>
								</div>
								<div class="text-center mt-4 font-weight-light">
									Don't have an account? <a href="register-2.html"
										class="text-primary">Create</a>
								</div>
							</form>
						</div>
					</div>
					<div class="col-lg-6 login-half-bg d-flex flex-row">
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

