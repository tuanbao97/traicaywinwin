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
		<!-- partial:partials/_navbar.html -->
		<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
			<div class="navbar-brand-wrapper d-flex justify-content-center">
				<div
					class="navbar-brand-inner-wrapper d-flex justify-content-between align-items-center w-100">
					<a class="navbar-brand brand-logo" href="index.html"><img
						src="{{ asset('image/UI-BACKEND/logo.svg') }}" alt="logo" /></a> <a
						class="navbar-brand brand-logo-mini" href="index.html"><img
						src="{{ asset('image/UI-BACKEND/logo-mini.svg') }}" alt="logo" /></a>
					<button class="navbar-toggler navbar-toggler align-self-center"
						type="button" data-toggle="minimize">
						<span class="typcn typcn-th-menu"></span>
					</button>
				</div>
			</div>
			<div
				class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
				<ul class="navbar-nav mr-lg-2">
					<li class="nav-item nav-profile dropdown"><a class="nav-link"
						href="#" data-toggle="dropdown" id="profileDropdown"> <img
							src="{{ asset('image/UI-BACKEND/faces/face5.jpg') }}"
							alt="profile" /> <span class="nav-profile-name">Eugenia Mullins</span>
					</a>
						<div class="dropdown-menu dropdown-menu-right navbar-dropdown"
							aria-labelledby="profileDropdown">
							<a class="dropdown-item"> <i
								class="typcn typcn-cog-outline text-primary"></i> Settings
							</a> <a class="dropdown-item"> <i
								class="typcn typcn-eject text-primary"></i> Logout
							</a>
						</div></li>
					<li class="nav-item nav-user-status dropdown">
						<p class="mb-0">Last login was 23 hours ago.</p>
					</li>
				</ul>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-date dropdown"><a
						class="nav-link d-flex justify-content-center align-items-center"
						href="javascript:;">
							<h6 class="date mb-0">Today : Mar 23</h6> <i
							class="typcn typcn-calendar"></i>
					</a></li>
					<li class="nav-item dropdown"><a
						class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center"
						id="messageDropdown" href="#" data-toggle="dropdown"> <i
							class="typcn typcn-cog-outline mx-0"></i> <span class="count"></span>
					</a>
						<div
							class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
							aria-labelledby="messageDropdown">
							<p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="{{ asset('image/UI-BACKEND/faces/face4.jpg') }}"
										alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal">David
										Grey</h6>
									<p class="font-weight-light small-text text-muted mb-0">The
										meeting is cancelled</p>
								</div>
							</a> <a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="{{ asset('image/UI-BACKEND/faces/face2.jpg') }}"
										alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal">Tim
										Cook</h6>
									<p class="font-weight-light small-text text-muted mb-0">New
										product launch</p>
								</div>
							</a> <a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<img src="{{ asset('image/UI-BACKEND/faces/face3.jpg') }}"
										alt="image" class="profile-pic">
								</div>
								<div class="preview-item-content flex-grow">
									<h6 class="preview-subject ellipsis font-weight-normal">
										Johnson</h6>
									<p class="font-weight-light small-text text-muted mb-0">
										Upcoming board meeting</p>
								</div>
							</a>
						</div></li>
					<li class="nav-item dropdown mr-0"><a
						class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center"
						id="notificationDropdown" href="#" data-toggle="dropdown"> <i
							class="typcn typcn-bell mx-0"></i> <span class="count"></span>
					</a>
						<div
							class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
							aria-labelledby="notificationDropdown">
							<p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
							<a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-success">
										<i class="typcn typcn-info mx-0"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject font-weight-normal">Application
										Error</h6>
									<p class="font-weight-light small-text mb-0 text-muted">Just
										now</p>
								</div>
							</a> <a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-warning">
										<i class="typcn typcn-cog-outline mx-0"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject font-weight-normal">Settings</h6>
									<p class="font-weight-light small-text mb-0 text-muted">
										Private message</p>
								</div>
							</a> <a class="dropdown-item preview-item">
								<div class="preview-thumbnail">
									<div class="preview-icon bg-info">
										<i class="typcn typcn-user mx-0"></i>
									</div>
								</div>
								<div class="preview-item-content">
									<h6 class="preview-subject font-weight-normal">New user
										registration</h6>
									<p class="font-weight-light small-text mb-0 text-muted">2 days
										ago</p>
								</div>
							</a>
						</div></li>
				</ul>
				<button
					class="navbar-toggler navbar-toggler-right d-lg-none align-self-center"
					type="button" data-toggle="offcanvas">
					<span class="typcn typcn-th-menu"></span>
				</button>
			</div>
		</nav>
		<!-- partial -->
		<nav class="navbar-breadcrumb col-xl-12 col-12 d-flex flex-row p-0">
			<div class="navbar-links-wrapper d-flex align-items-stretch">
				<div class="nav-link">
					<a href="javascript:;"><i class="typcn typcn-calendar-outline"></i></a>
				</div>
				<div class="nav-link">
					<a href="javascript:;"><i class="typcn typcn-mail"></i></a>
				</div>
				<div class="nav-link">
					<a href="javascript:;"><i class="typcn typcn-folder"></i></a>
				</div>
				<div class="nav-link">
					<a href="javascript:;"><i class="typcn typcn-document-text"></i></a>
				</div>
			</div>
			<div
				class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
				<ul class="navbar-nav mr-lg-2">
					<li class="nav-item ml-0">
						<h4 class="mb-0">Dashboard</h4>
					</li>
					<li class="nav-item">
						<div class="d-flex align-items-baseline">
							<p class="mb-0">Home</p>
							<i class="typcn typcn-chevron-right"></i>
							<p class="mb-0">Main Dahboard</p>
						</div>
					</li>
				</ul>
				<ul class="navbar-nav navbar-nav-right">
					<li class="nav-item nav-search d-none d-md-block mr-0">
						<div class="input-group">
							<input type="text" class="form-control" placeholder="Search..."
								aria-label="search" aria-describedby="search">
							<div class="input-group-prepend">
								<span class="input-group-text" id="search"> <i
									class="typcn typcn-zoom"></i>
								</span>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</nav>
		<div class="container-fluid page-body-wrapper">
			<!-- partial:partials/_settings-panel.html -->
			<div class="theme-setting-wrapper">
				<div id="settings-trigger">
					<i class="typcn typcn-cog-outline"></i>
				</div>
				<div id="theme-settings" class="settings-panel">
					<i class="settings-close typcn typcn-times"></i>
					<p class="settings-heading">SIDEBAR SKINS</p>
					<div class="sidebar-bg-options selected" id="sidebar-light-theme">
						<div class="img-ss rounded-circle bg-light border mr-3"></div>
						Light
					</div>
					<div class="sidebar-bg-options" id="sidebar-dark-theme">
						<div class="img-ss rounded-circle bg-dark border mr-3"></div>
						Dark
					</div>
					<p class="settings-heading mt-2">HEADER SKINS</p>
					<div class="color-tiles mx-0 px-4">
						<div class="tiles success"></div>
						<div class="tiles warning"></div>
						<div class="tiles danger"></div>
						<div class="tiles info"></div>
						<div class="tiles dark"></div>
						<div class="tiles default"></div>
					</div>
				</div>
			</div>
			<div id="right-sidebar" class="settings-panel">
				<i class="settings-close typcn typcn-times"></i>
				<ul class="nav nav-tabs" id="setting-panel" role="tablist">
					<li class="nav-item"><a class="nav-link active" id="todo-tab"
						data-toggle="tab" href="#todo-section" role="tab"
						aria-controls="todo-section" aria-expanded="true">TO DO LIST</a></li>
					<li class="nav-item"><a class="nav-link" id="chats-tab"
						data-toggle="tab" href="#chats-section" role="tab"
						aria-controls="chats-section">CHATS</a></li>
				</ul>
				<div class="tab-content" id="setting-content">
					<div class="tab-pane fade show active scroll-wrapper"
						id="todo-section" role="tabpanel" aria-labelledby="todo-section">
						<div class="add-items d-flex px-3 mb-0">
							<form class="form w-100">
								<div class="form-group d-flex">
									<input type="text" class="form-control todo-list-input"
										placeholder="Add To-do">
									<button type="submit"
										class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
								</div>
							</form>
						</div>
						<div class="list-wrapper px-3">
							<ul class="d-flex flex-column-reverse todo-list">
								<li>
									<div class="form-check">
										<label class="form-check-label"> <input class="checkbox"
											type="checkbox"> Team review meeting at 3.00 PM
										</label>
									</div> <i class="remove typcn typcn-delete-outline"></i>
								</li>
								<li>
									<div class="form-check">
										<label class="form-check-label"> <input class="checkbox"
											type="checkbox"> Prepare for presentation
										</label>
									</div> <i class="remove typcn typcn-delete-outline"></i>
								</li>
								<li>
									<div class="form-check">
										<label class="form-check-label"> <input class="checkbox"
											type="checkbox"> Resolve all the low priority tickets due
											today
										</label>
									</div> <i class="remove typcn typcn-delete-outline"></i>
								</li>
								<li class="completed">
									<div class="form-check">
										<label class="form-check-label"> <input class="checkbox"
											type="checkbox" checked> Schedule meeting for next week
										</label>
									</div> <i class="remove typcn typcn-delete-outline"></i>
								</li>
								<li class="completed">
									<div class="form-check">
										<label class="form-check-label"> <input class="checkbox"
											type="checkbox" checked> Project review
										</label>
									</div> <i class="remove typcn typcn-delete-outline"></i>
								</li>
							</ul>
						</div>
						<div class="events py-4 border-bottom px-3">
							<div class="wrapper d-flex mb-2">
								<i class="typcn typcn-media-record-outline text-primary mr-2"></i>
								<span>Feb 11 2018</span>
							</div>
							<p class="mb-0 font-weight-thin text-gray">Creating component
								page</p>
							<p class="text-gray mb-0">build a js based app</p>
						</div>
						<div class="events pt-4 px-3">
							<div class="wrapper d-flex mb-2">
								<i class="typcn typcn-media-record-outline text-primary mr-2"></i>
								<span>Feb 7 2018</span>
							</div>
							<p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
							<p class="text-gray mb-0 ">Call Sarah Graves</p>
						</div>
					</div>
					<!-- To do section tab ends -->
					<div class="tab-pane fade" id="chats-section" role="tabpanel"
						aria-labelledby="chats-section">
						<div
							class="d-flex align-items-center justify-content-between border-bottom">
							<p
								class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
							<small
								class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
								All</small>
						</div>
						<ul class="chat-list">
							<li class="list active">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face1.jpg') }}"
										alt="image"><span class="online"></span>
								</div>
								<div class="info">
									<p>Thomas Douglas</p>
									<p>Available</p>
								</div> <small class="text-muted my-auto">19 min</small>
							</li>
							<li class="list">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face2.jpg') }}"
										alt="image"><span class="offline"></span>
								</div>
								<div class="info">
									<div class="wrapper d-flex">
										<p>Catherine</p>
									</div>
									<p>Away</p>
								</div>
								<div class="badge badge-success badge-pill my-auto mx-2">4</div>
								<small class="text-muted my-auto">23 min</small>
							</li>
							<li class="list">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face3.jpg') }}"
										alt="image"><span class="online"></span>
								</div>
								<div class="info">
									<p>Daniel Russell</p>
									<p>Available</p>
								</div> <small class="text-muted my-auto">14 min</small>
							</li>
							<li class="list">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face4.jpg') }}"
										alt="image"><span class="offline"></span>
								</div>
								<div class="info">
									<p>James Richardson</p>
									<p>Away</p>
								</div> <small class="text-muted my-auto">2 min</small>
							</li>
							<li class="list">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face5.jpg') }}"
										alt="image"><span class="online"></span>
								</div>
								<div class="info">
									<p>Madeline Kennedy</p>
									<p>Available</p>
								</div> <small class="text-muted my-auto">5 min</small>
							</li>
							<li class="list">
								<div class="profile">
									<img src="{{ asset('image/UI-BACKEND/faces/face6.jpg') }}"
										alt="image"><span class="online"></span>
								</div>
								<div class="info">
									<p>Sarah Graves</p>
									<p>Available</p>
								</div> <small class="text-muted my-auto">47 min</small>
							</li>
						</ul>
					</div>
					<!-- chat tab ends -->
				</div>
			</div>
			<!-- partial -->
			<!-- partial:partials/_sidebar.html -->

			@include('UI-BACKEND.template.menu')

			<!-- partial -->
			<div class="main-panel">
				<div class="content-wrapper">
					<div class="row">
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Default accordion</h4>
									<p class="card-description">
										Use class
										<code>.accordion</code>
										for basic accordion
									</p>
									<div class="mt-4">
										<div class="accordion" id="accordion" role="tablist">
											<div class="card">
												<div class="card-header" role="tab" id="heading-1">
													<h6 class="mb-0">
														<a data-bs-toggle="collapse" href="#collapse-1"
															aria-expanded="true" aria-controls="collapse-1"> How can
															I pay for an order I placed? </a>
													</h6>
												</div>
												<div id="collapse-1" class="collapse show" role="tabpanel"
													aria-labelledby="heading-1" data-bs-parent="#accordion">
													<div class="card-body">
														<div class="row">
															<div class="col-3">
																<img src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}"
																	class="mw-100" alt="image">
															</div>
															<div class="col-9">
																<p class="mb-0">You can pay for the product you have
																	purchased using credit cards, debit cards, or via
																	online banking. We also on-delivery services.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-2">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-2" aria-expanded="false"
															aria-controls="collapse-2"> I can’t sign in to my account
														</a>
													</h6>
												</div>
												<div id="collapse-2" class="collapse" role="tabpanel"
													aria-labelledby="heading-2" data-bs-parent="#accordion">
													<div class="card-body">
														<p>If while signing in to your account you see an error
															message, you can do the following</p>
														<ol class="pl-3 mt-4">
															<li>Check your network connection and try again</li>
															<li>Make sure your account credentials are correct while
																signing in</li>
															<li>Check whether your account is accessible in your
																region</li>
														</ol>
														<br>
														<p class="text-success">
															<i class="typcn typcn-warning-outline me-2"></i>If the
															problem persists, you can contact our support.
														</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-3">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-3" aria-expanded="false"
															aria-controls="collapse-3"> Can I add money to the
															wallet? </a>
													</h6>
												</div>
												<div id="collapse-3" class="collapse" role="tabpanel"
													aria-labelledby="heading-3" data-bs-parent="#accordion">
													<div class="card-body">
														<p class="mb-0">You can add money to the wallet for any
															future transaction from your bank account using
															net-banking, or credit/debit card transaction. The money
															in the wallet can be used for an easier and faster
															transaction.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Bordered accordions</h4>
									<p class="card-description">
										Use class
										<code>.accordion-bordered</code>
										for bordered accordions
									</p>
									<div class="mt-4">
										<div class="accordion accordion-bordered" id="accordion-2"
											role="tablist">
											<div class="card">
												<div class="card-header" role="tab" id="heading-4">
													<h6 class="mb-0">
														<a data-bs-toggle="collapse" href="#collapse-4"
															aria-expanded="false" aria-controls="collapse-4"> How can
															I pay for an order I placed? </a>
													</h6>
												</div>
												<div id="collapse-4" class="collapse" role="tabpanel"
													aria-labelledby="heading-4" data-bs-parent="#accordion-2">
													<div class="card-body">
														<p class="mb-0">You can pay for the product you have
															purchased using credit cards, debit cards, or via online
															banking. We also provide cash-on-delivery services for
															most of our products. You can also use your account
															wallet for payment.</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-5">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-5" aria-expanded="false"
															aria-controls="collapse-5"> I can’t sign in to my account
														</a>
													</h6>
												</div>
												<div id="collapse-5" class="collapse" role="tabpanel"
													aria-labelledby="heading-5" data-bs-parent="#accordion-2">
													<div class="card-body">
														<p>If while signing in to your account you see an error
															message, you can do the following</p>
														<ol class="pl-3">
															<li>Check your network connection and try again</li>
															<li>Make sure your account credentials are correct while
																signing in</li>
															<li>Check whether your account is accessible in your
																region</li>
														</ol>
														<br> <i class="typcn typcn-warning-outline me-2"></i>If
														the problem persists, you can contact our support.
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-6">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-6" aria-expanded="true"
															aria-controls="collapse-6"> How can I deactivate my
															account? </a>
													</h6>
												</div>
												<div id="collapse-6" class="collapse show" role="tabpanel"
													aria-labelledby="heading-6" data-bs-parent="#accordion-2">
													<div class="card-body">
														<p class="mb-0">If you wish to deactivate your account,
															you can go to the Settings page of your account. Click on
															Account Settings and then click on Deactivate. You can
															join again as and when you wish.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Filled accordions</h4>
									<p class="card-description">
										Use class
										<code>.accordion-filled</code>
										for Basic Accordion
									</p>
									<div class="accordion accordion-filled" id="accordion-7"
										role="tablist">
										<div class="card">
											<div class="card-header" role="tab" id="heading-7">
												<h5 class="mb-0">
													<a data-bs-toggle="collapse" href="#collapse-7"
														aria-expanded="false" aria-controls="collapse-7"> Can I
														transfer the money from the wallet to my bank account? </a>
												</h5>
											</div>
											<div id="collapse-7" class="collapse" role="tabpanel"
												aria-labelledby="heading-7" data-bs-parent="#accordion-3">
												<div class="card-body">
													<p class="mb-0">You can at any time reclaim your money to
														your bank account that you have registered with us. If
														there are no registered account, then you can add an
														account in the ‘Register Bank Account’ page.</p>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" role="tab" id="heading-8">
												<h5 class="mb-0">
													<a class="collapsed" data-bs-toggle="collapse"
														href="#collapse-8" aria-expanded="true"
														aria-controls="collapse-8"> I forgot my account password.
														What should I do? </a>
												</h5>
											</div>
											<div id="collapse-8" class="collapse show" role="tabpanel"
												aria-labelledby="heading-8" data-bs-parent="#accordion-3">
												<div class="card-body">
													<ol class="pl-3">
														<li>Click on the ‘forgot password’ link.</li>
														<li>Enter your email address registered with us</li>
														<li>Click on the link sent you in the email</li>
														<li>Reset your password</li>
													</ol>
												</div>
											</div>
										</div>
										<div class="card">
											<div class="card-header" role="tab" id="heading-9">
												<h5 class="mb-0">
													<a class="collapsed" data-bs-toggle="collapse"
														href="#collapse-9" aria-expanded="false"
														aria-controls="collapse-9"> What should I do if I need any
														assistance using my account </a>
												</h5>
											</div>
											<div id="collapse-9" class="collapse" role="tabpanel"
												aria-labelledby="heading-9" data-bs-parent="#accordion-3">
												<div class="card-body">
													<p class="mb-0">If you need any assistance while using your
														account, you can contact our customer support via email at
														support@abc.com. Or you can live chat with our support
														team. Our support team is available 24*7</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Solid header accordion</h4>
									<p class="card-description">
										Use class
										<code>.accordion-solid-header</code>
										for basic accordion
									</p>
									<div class="mt-4">
										<div class="accordion accordion-solid-header" id="accordion-4"
											role="tablist">
											<div class="card">
												<div class="card-header" role="tab" id="heading-10">
													<h6 class="mb-0">
														<a data-bs-toggle="collapse" href="#collapse-10"
															aria-expanded="true" aria-controls="collapse-10"> How can
															I pay for an order I placed? </a>
													</h6>
												</div>
												<div id="collapse-10" class="collapse show" role="tabpanel"
													aria-labelledby="heading-10" data-bs-parent="#accordion-4">
													<div class="card-body">
														<div class="row">
															<div class="col-3">
																<img src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}"
																	class="mw-100" alt="image">
															</div>
															<div class="col-9">
																<p class="mb-0">You can pay for the product you have
																	purchased using credit cards, debit cards, or via
																	online banking. We also on-delivery services.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-11">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-11" aria-expanded="false"
															aria-controls="collapse-11"> I can’t sign in to my
															account </a>
													</h6>
												</div>
												<div id="collapse-11" class="collapse" role="tabpanel"
													aria-labelledby="heading-11" data-bs-parent="#accordion-4">
													<div class="card-body">
														<p>If while signing in to your account you see an error
															message, you can do the following</p>
														<ol class="pl-3 mt-4">
															<li>Check your network connection and try again</li>
															<li>Make sure your account credentials are correct while
																signing in</li>
															<li>Check whether your account is accessible in your
																region</li>
														</ol>
														<br>
														<p class="text-success">
															<i class="typcn typcn-warning-outline me-2"></i>If the
															problem persists, you can contact our support.
														</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-12">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-12" aria-expanded="false"
															aria-controls="collapse-12"> Can I add money to the
															wallet? </a>
													</h6>
												</div>
												<div id="collapse-12" class="collapse" role="tabpanel"
													aria-labelledby="heading-12" data-bs-parent="#accordion-4">
													<div class="card-body">
														<p class="mb-0">You can add money to the wallet for any
															future transaction from your bank account using
															net-banking, or credit/debit card transaction. The money
															in the wallet can be used for an easier and faster
															transaction.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Solid content accordion</h4>
									<p class="card-description">
										Use class
										<code>.accordion-solid-content</code>
										for basic accordion
									</p>
									<div class="mt-4">
										<div class="accordion accordion-solid-content"
											id="accordion-5" role="tablist">
											<div class="card">
												<div class="card-header" role="tab" id="heading-13">
													<h6 class="mb-0">
														<a data-bs-toggle="collapse" href="#collapse-13"
															aria-expanded="true" aria-controls="collapse-13"> How can
															I pay for an order I placed? </a>
													</h6>
												</div>
												<div id="collapse-13" class="collapse show" role="tabpanel"
													aria-labelledby="heading-13" data-bs-parent="#accordion-5">
													<div class="card-body">
														<div class="row">
															<div class="col-3">
																<img src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}"
																	class="mw-100" alt="image">
															</div>
															<div class="col-9">
																<p class="mb-0">You can pay for the product you have
																	purchased using credit cards, debit cards, or via
																	online banking. We also on-delivery services.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-14">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-14" aria-expanded="false"
															aria-controls="collapse-14"> I can’t sign in to my
															account </a>
													</h6>
												</div>
												<div id="collapse-14" class="collapse" role="tabpanel"
													aria-labelledby="heading-14" data-bs-parent="#accordion-5">
													<div class="card-body">
														<p>If while signing in to your account you see an error
															message, you can do the following</p>
														<ol class="pl-3 mt-4">
															<li>Check your network connection and try again</li>
															<li>Make sure your account credentials are correct while
																signing in</li>
															<li>Check whether your account is accessible in your
																region</li>
														</ol>
														<br>
														<p class="text-danger">
															<i class="typcn typcn-warning-outline me-2"></i>If the
															problem persists, you can contact our support.
														</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-15">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-15" aria-expanded="false"
															aria-controls="collapse-15"> Can I add money to the
															wallet? </a>
													</h6>
												</div>
												<div id="collapse-15" class="collapse" role="tabpanel"
													aria-labelledby="heading-15" data-bs-parent="#accordion-5">
													<div class="card-body">
														<p class="mb-0">You can add money to the wallet for any
															future transaction from your bank account using
															net-banking, or credit/debit card transaction. The money
															in the wallet can be used for an easier and faster
															transaction.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Multi colored accordion</h4>
									<p class="card-description">
										Use class
										<code>.accordion-multi-colored</code>
										for basic accordion
									</p>
									<div class="mt-4">
										<div class="accordion accordion-multi-colored"
											id="accordion-6" role="tablist">
											<div class="card">
												<div class="card-header" role="tab" id="heading-16">
													<h6 class="mb-0">
														<a data-bs-toggle="collapse" href="#collapse-16"
															aria-expanded="false" aria-controls="collapse-16"> How
															can I pay for an order I placed? </a>
													</h6>
												</div>
												<div id="collapse-16" class="collapse" role="tabpanel"
													aria-labelledby="heading-16" data-bs-parent="#accordion-6">
													<div class="card-body">
														<div class="row">
															<div class="col-3">
																<img src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}"
																	class="mw-100" alt="image">
															</div>
															<div class="col-9">
																<p class="mb-0">You can pay for the product you have
																	purchased using credit cards, debit cards, or via
																	online banking. We also on-delivery services.</p>
															</div>
														</div>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-17">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-17" aria-expanded="false"
															aria-controls="collapse-17"> I can’t sign in to my
															account </a>
													</h6>
												</div>
												<div id="collapse-17" class="collapse" role="tabpanel"
													aria-labelledby="heading-17" data-bs-parent="#accordion-6">
													<div class="card-body">
														<p>If while signing in to your account you see an error
															message, you can do the following</p>
														<ol class="pl-3 mt-4">
															<li>Check your network connection and try again</li>
															<li>Make sure your account credentials are correct while
																signing in</li>
															<li>Check whether your account is accessible in your
																region</li>
														</ol>
														<br>
														<p class="text-danger">
															<i class="typcn typcn-warning-outline me-2"></i>If the
															problem persists, you can contact our support.
														</p>
													</div>
												</div>
											</div>
											<div class="card">
												<div class="card-header" role="tab" id="heading-18">
													<h6 class="mb-0">
														<a class="collapsed" data-bs-toggle="collapse"
															href="#collapse-18" aria-expanded="true"
															aria-controls="collapse-18"> Can I add money to the
															wallet? </a>
													</h6>
												</div>
												<div id="collapse-18" class="collapse show" role="tabpanel"
													aria-labelledby="heading-18" data-bs-parent="#accordion-6">
													<div class="card-body">
														<p class="mb-0">You can add money to the wallet for any
															future transaction from your bank account using
															net-banking, or credit/debit card transaction. The money
															in the wallet can be used for an easier and faster
															transaction.</p>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- content-wrapper ends -->
				<!-- partial:../../partials/_footer.html -->
				<footer class="footer">
					<div class="card">
						<div class="card-body">
							<div
								class="d-sm-flex justify-content-center justify-content-sm-between">
								<span
									class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright
									© 2023 <a href="https://www.bootstrapdash.com/"
									class="text-muted" target="_blank">Bootstrapdash</a>. All
									rights reserved.
								</span> <span
									class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted
									&amp; made with <i
									class="typcn typcn-heart-full-outline text-danger"></i>
								</span>
							</div>
						</div>
					</div>
				</footer>
				<!-- partial -->
			</div>
			<!-- main-panel ends -->
		</div>
		<!-- page-body-wrapper ends -->
	</div>
	<!-- container-scroller -->

	<!-- base:js -->
	<script src="{{ asset('js/UI-BACKEND/popper.min.js') }}" ></script>
	<script src="{{ asset('js/UI-BACKEND/bootstrap.min.js') }}" crossorigin="anonymous"></script>
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

