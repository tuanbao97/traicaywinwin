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
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div
										class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="{{ asset('image/UI-BACKEND/faces/face11.jpg') }}"
											class="img-lg rounded" alt="profile image">
										<div
											class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-0">Maria</h6>
											<p class="text-muted mb-1">maria@gmail.com</p>
											<p class="mb-0 text-success font-weight-bold">Designer</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div
										class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="{{ asset('image/UI-BACKEND/faces/face9.jpg') }}"
											class="img-lg rounded" alt="profile image">
										<div
											class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-0">Thomas Edison</h6>
											<p class="text-muted mb-1">thomas@gmail.com</p>
											<p class="mb-0 text-success font-weight-bold">Developer</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div
										class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
										<img src="{{ asset('image/UI-BACKEND/faces/face12.jpg') }}"
											class="img-lg rounded" alt="profile image">
										<div
											class="ms-sm-3 ms-md-0 ms-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
											<h6 class="mb-0">Edward</h6>
											<p class="text-muted mb-1">edward@gmail.com</p>
											<p class="mb-0 text-success font-weight-bold">Tester</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-12">
							<div class="row">
								<div
									class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Todays Income</h4>
											<div class="d-flex justify-content-between">
												<p class="text-muted">Avg. Session</p>
												<p class="text-muted">max: 40</p>
											</div>
											<div class="progress progress-md">
												<div class="progress-bar bg-info w-25" role="progressbar"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div
									class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Total Revenue</h4>
											<div class="d-flex justify-content-between">
												<p class="text-muted">Avg. Session</p>
												<p class="text-muted">max: 120</p>
											</div>
											<div class="progress progress-md">
												<div class="progress-bar bg-success w-25" role="progressbar"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div
									class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Pending Product</h4>
											<div class="d-flex justify-content-between">
												<p class="text-muted">Avg. Session</p>
												<p class="text-muted">max: 54</p>
											</div>
											<div class="progress progress-md">
												<div class="progress-bar bg-danger w-25" role="progressbar"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
								<div
									class="col-12 col-sm-6 col-md-6 col-xl-3 grid-margin stretch-card">
									<div class="card">
										<div class="card-body">
											<h4 class="card-title">Sales</h4>
											<div class="d-flex justify-content-between">
												<p class="text-muted">Avg. Session</p>
												<p class="text-muted">max: 143</p>
											</div>
											<div class="progress progress-md">
												<div class="progress-bar bg-warning w-25" role="progressbar"
													aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 grid-margin">
							<div class="card d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-facebook text-facebook icon-md"></i>
										<div class="ms-3">
											<h6 class="text-facebook">50k likes</h6>
											<p class="mt-2 text-muted card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin">
							<div class="card d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-youtube text-youtube icon-md"></i>
										<div class="ms-3">
											<h6 class="text-youtube">2.62k Subscribers</h6>
											<p class="mt-2 text-muted card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin">
							<div class="card d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-twitter text-twitter icon-md"></i>
										<div class="ms-3">
											<h6 class="text-twitter">3k followers</h6>
											<p class="mt-2 text-muted card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 grid-margin">
							<div class="card bg-facebook d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-facebook text-white icon-md"></i>
										<div class="ms-3">
											<h6 class="text-white">50k likes</h6>
											<p class="mt-2 text-white card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin">
							<div class="card bg-linkedin d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-linkedin text-white icon-md"></i>
										<div class="ms-3">
											<h6 class="text-white">5k connections</h6>
											<p class="mt-2 text-white card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin">
							<div class="card bg-twitter d-flex align-items-center">
								<div class="card-body">
									<div class="d-flex flex-row align-items-center">
										<i class="typcn typcn-social-twitter text-white icon-md"></i>
										<div class="ms-3">
											<h6 class="text-white">3k followers</h6>
											<p class="mt-2 text-white card-text">You main list growing</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Todo</h4>
									<div class="add-items d-flex">
										<input type="text" class="form-control todo-list-input"
											placeholder="What do you need to do today?">
										<button
											class="add btn btn-primary font-weight-bold todo-list-add-btn">Add</button>
									</div>
									<div class="list-wrapper">
										<ul
											class="d-flex flex-column-reverse todo-list todo-list-custom">
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox"> Meeting with Alisa <i
														class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox" checked=""> Call John <i
														class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox"> Create invoice <i class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox"> Print Statements <i class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
											<li class="completed">
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox" checked=""> Prepare for presentation <i
														class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
											<li>
												<div class="form-check form-check-flat">
													<label class="form-check-label"> <input class="checkbox"
														type="checkbox"> Pick up kids from school <i
														class="input-helper"></i>
													</label>
												</div> <i class="remove typcn typcn-delete-outline"></i>
											</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Recommended</h4>
									<div class="d-flex align-items-center pb-3 border-bottom">
										<img class="img-sm rounded-circle"
											src="{{ asset('image/UI-BACKEND/faces/face5.jpg') }}"
											alt="profile">
										<div class="ms-3">
											<h6 class="mb-1">Stella Davidson</h6>
											<small class="text-muted mb-0"> <i
												class="typcn typcn-location-outline mr-1"></i>New York City,
												USA
											</small>
										</div>
										<i
											class="typcn typcn-tick font-weight-bold ms-auto px-1 py-1 text-info"></i>
									</div>
									<div class="d-flex align-items-center py-3 border-bottom">
										<img class="img-sm rounded-circle"
											src="{{ asset('image/UI-BACKEND/faces/face6.jpg') }}"
											alt="profile">
										<div class="ms-3">
											<h6 class="mb-1">Daniel Russel</h6>
											<small class="text-muted mb-0"> <i
												class="typcn typcn-location-outline mr-1"></i>Florida, USA
											</small>
										</div>
										<i
											class="typcn typcn-plus font-weight-bold ms-auto px-1 py-1 text-success"></i>
									</div>
									<div class="d-flex align-items-center py-3 border-bottom">
										<img class="img-sm rounded-circle"
											src="{{ asset('image/UI-BACKEND/faces/face7.jpg') }}"
											alt="profile">
										<div class="ms-3">
											<h6 class="mb-1">Bruno King</h6>
											<small class="text-muted mb-0"> <i
												class="typcn typcn-location-outline mr-1"></i>Arkansas, USA
											</small>
										</div>
										<i
											class="typcn typcn-tick font-weight-bold ms-auto px-1 py-1 text-info"></i>
									</div>
									<div class="d-flex align-items-center py-3 border-bottom">
										<img class="img-sm rounded-circle"
											src="{{ asset('image/UI-BACKEND/faces/face8.jpg') }}"
											alt="profile">
										<div class="ms-3">
											<h6 class="mb-1">David Moore</h6>
											<small class="text-muted mb-0"> <i
												class="typcn typcn-location-outline mr-1"></i>Arizon, USA
											</small>
										</div>
										<i
											class="typcn typcn-plus font-weight-bold ms-auto px-1 py-1 text-success"></i>
									</div>
									<div class="d-flex align-items-center pt-3">
										<img class="img-sm rounded-circle"
											src="{{ asset('image/UI-BACKEND/faces/face9.jpg') }}"
											alt="profile">
										<div class="ms-3">
											<h6 class="mb-1">Rafell John</h6>
											<small class="text-muted mb-0"> <i
												class="typcn typcn-location-outline mr-1"></i>Alaska, USA
											</small>
										</div>
										<i
											class="typcn typcn-plus font-weight-bold ms-auto px-1 py-1 text-success"></i>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Updates</h4>
									<ul class="bullet-line-list">
										<li>
											<h6>User confirmation</h6>
											<p>Lorem Ipsum is simply dummy text of the printing</p>
											<p class="text-muted mb-4">
												<i class="typcn typcn-time"></i> 7 months ago.
											</p>
										</li>
										<li>
											<h6>Continuous evaluation</h6>
											<p>Lorem Ipsum is simply dummy text of the printing</p>
											<p class="text-muted mb-4">
												<i class="typcn typcn-time"></i> 7 months ago.
											</p>
										</li>
										<li>
											<h6>Promotion</h6>
											<p>Lorem Ipsum is simply dummy text of the printing</p>
											<p class="text-muted">
												<i class="typcn typcn-time"></i> 7 months ago.
											</p>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-5 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body text-center">
									<div>
										<img src="{{ asset('image/UI-BACKEND/faces/face5.jpg') }}"
											class="img-lg rounded-circle mb-2" alt="profile image">
										<h4>Maria Johnson</h4>
										<p class="text-muted mb-0">Developer</p>
									</div>
									<p class="mt-2 card-text">Lorem ipsum dolor sit amet,
										consectetuer adipiscing elit. Aenean commodo ligula eget
										dolor. Lorem</p>
									<button class="btn btn-info btn-sm mt-3 mb-4">Follow</button>
									<div class="border-top pt-3">
										<div class="row">
											<div class="col-4">
												<h6>5896</h6>
												<p>Post</p>
											</div>
											<div class="col-4">
												<h6>1596</h6>
												<p>Followers</p>
											</div>
											<div class="col-4">
												<h6>7896</h6>
												<p>Likes</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-7 grid-margin grid-margin-md-0 stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Tickets</h4>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th class="pt-1 pl-0">Assigned</th>
													<th class="pt-1">Product</th>
													<th class="pt-1">Priority</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td class="py-1 pl-0">
														<div class="d-flex align-items-center">
															<img
																src="{{ asset('image/UI-BACKEND/faces/face1.jpg') }}"
																alt="profile">
															<div class="ms-3">
																<p class="mb-0">Sophia Brown</p>
																<p class="mb-0 text-muted text-small">Product Designer</p>
															</div>
														</div>
													</td>
													<td>Web App</td>
													<td><label class="badge badge-success">Low</label></td>
												</tr>
												<tr>
													<td class="py-1 pl-0">
														<div class="d-flex align-items-center">
															<img
																src="{{ asset('image/UI-BACKEND/faces/face6.jpg') }}"
																alt="profile">
															<div class="ms-3">
																<p class="mb-0">Rachel Newton</p>
																<p class="mb-0 text-muted text-small">Mobile Developer</p>
															</div>
														</div>
													</td>
													<td>Mobile App</td>
													<td><label class="badge badge-warning">Medium</label></td>
												</tr>
												<tr>
													<td class="py-1 pl-0">
														<div class="d-flex align-items-center">
															<img
																src="{{ asset('image/UI-BACKEND/faces/face15.jpg') }}"
																alt="profile">
															<div class="ms-3">
																<p class="mb-0">Marcus Stevens</p>
																<p class="mb-0 text-muted text-small">Core Developer</p>
															</div>
														</div>
													</td>
													<td>Plugin</td>
													<td><label class="badge badge-danger">High</label></td>
												</tr>
												<tr>
													<td class="py-1 pl-0">
														<div class="d-flex align-items-center">
															<img
																src="{{ asset('image/UI-BACKEND/faces/face2.jpg') }}"
																alt="profile">
															<div class="ms-3">
																<p class="mb-0">Theresa Becker</p>
																<p class="mb-0 text-muted text-small">Product Designer</p>
															</div>
														</div>
													</td>
													<td>Web App</td>
													<td><label class="badge badge-success">Low</label></td>
												</tr>
												<tr>
													<td class="py-1 pl-0">
														<div class="d-flex align-items-center">
															<img
																src="{{ asset('image/UI-BACKEND/faces/face3.jpg') }}"
																alt="profile">
															<div class="ms-3">
																<p class="mb-0">Jessie Ortiz</p>
																<p class="mb-0 text-muted text-small">Web Developer</p>
															</div>
														</div>
													</td>
													<td>SAAS App</td>
													<td><label class="badge badge-danger">High</label></td>
												</tr>
											</tbody>
										</table>
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

