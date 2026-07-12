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
<link rel="stylesheet" href="{{ asset('css/UI-BACKEND/vendors/jquery-toast-plugin/jquery.toast.min.css') }}">
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
						<div class="col-12 grid-margin">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Jquery-toast styles</h4>
									<p class="card-description mb-0">Click on the below buttons for
										notifications in different styles.</p>
									<p class="card-description">
										The
										<code>icon</code>
										property can be used to specify the predefined types of toasts
										- success, info, warning and danger
									</p>
									<div
										class="template-demo d-flex justify-content-between flex-wrap">
										<button type="button" class="btn btn-success btn-fw"
											onclick="showSuccessToast()">Success</button>
										<button type="button" class="btn btn-info btn-fw"
											onclick="showInfoToast()">Info</button>
										<button type="button" class="btn btn-warning btn-fw"
											onclick="showWarningToast()">Warning</button>
										<button type="button" class="btn btn-danger btn-fw"
											onclick="showDangerToast()">Danger</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 grid-margin">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Jquery-toast positions</h4>
									<p class="card-description">
										The
										<code>position</code>
										property can be used to specify the predefined positions of
										toasts
									</p>
									<div
										class="template-demo d-flex justify-content-between flex-wrap">
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('bottom-left')">Bottom-left</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('bottom-right')">Bottom-right</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('bottom-center')">Bottom-center</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('top-left')">Top-left</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('top-right')">Top-right</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('top-center')">Top-center</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastPosition('mid-center')">Mid-center</button>
										<button type="button" class="btn btn-outline-primary btn-sm"
											onclick="showToastInCustomPosition()">Custom</button>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Bootstrap alert</h4>
									<p class="card-description">
										Add class
										<code>.alert .alert-*</code>
									</p>
									<div class="alert alert-success" role="alert">You successfully
										read this important alert message.</div>
									<div class="alert alert-info" role="alert">This alert needs
										your attention, but it's not that important.</div>
									<div class="alert alert-warning" role="alert">Better check
										yourself, you're not looking too good.</div>
									<div class="alert alert-danger" role="alert">Change a few
										things up and try submitting again.</div>
									<div class="alert alert-primary" role="alert">This is a primary
										alert</div>
									<div class="alert alert-secondary" role="alert">This alert is
										not so important.</div>
								</div>
							</div>
						</div>
						<div class="col-md-6 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Custom alerts</h4>
									<p class="card-description">Custom HTML inside alert</p>
									<div class="card card-inverse-secondary mb-5">
										<div class="card-body">
											<p class="mb-4">Well done! You successfully read this
												important alert message.</p>
											<button class="btn btn-secondary d-block d-sm-inline mx-auto">Ok</button>
											<button
												class="btn btn-light d-block d-sm-inline mx-auto mt-2 mt-sm-0 ml-sm-1">Cancel</button>
										</div>
									</div>
									<div class="card card-inverse-info">
										<div class="card-body">
											<p class="mb-4">Heads up! This alert needs your attention,
												but it's not super important.</p>
											<button class="btn btn-info d-block d-sm-inline mx-auto">Ok</button>
											<button
												class="btn btn-light d-block d-sm-inline mx-auto mt-2 mt-sm-0 ml-sm-1">Cancel</button>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-12 grid-margin">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Bootstrap alerts in fill colors</h4>
									<p class="card-description">
										Add class
										<code>.alert-fill-*</code>
										with
										<code>.alert</code>
									</p>
									<div class="alert alert-fill-primary" role="alert">
										<i class="typcn typcn-warning"></i> There! This is a primary
										alert.
									</div>
									<div class="alert alert-fill-success" role="alert">
										<i class="typcn typcn-warning"></i> Well done! You
										successfully read this important alert message.
									</div>
									<div class="alert alert-fill-info" role="alert">
										<i class="typcn typcn-warning"></i> Heads up! This alert needs
										your attention, but it's not super important.
									</div>
									<div class="alert alert-fill-warning" role="alert">
										<i class="typcn typcn-warning"></i> Warning! Better check
										yourself, you're not looking too good.
									</div>
									<div class="alert alert-fill-danger" role="alert">
										<i class="typcn typcn-warning"></i> Oh snap! Change a few
										things up and try submitting again.
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-6 stretch-card">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title">Desktop notification</h4>
									<p class="card-description">Create simple desktop notifications</p>
									<form>
										<div class="form-group">
											<label for="title">Title</label> <input type="text"
												class="form-control" id="title"
												placeholder="Write some title here" value="Sample title"
												required> <label class="mt-4" for="message">Message</label>
											<textarea placeholder="Write some message here" id="message"
												class="form-control" required>Sample content</textarea>
										</div>
										<button type="submit" class="btn btn-success">
											<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
											Notify
										</button>
									</form>
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
									& made with <i
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
	<script src="{{ asset('js/UI-BACKEND/popper.min.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/bootstrap.min.js') }}"
		crossorigin="anonymous"></script>
	<script
		src="{{ asset('js/UI-BACKEND/vendors/js/vendor.bundle.base.js') }}"></script>
	<!-- endinject -->
	<!-- Plugin js for this page-->
	<script src="{{ asset('js/UI-BACKEND/vendors/jquery-toast-plugin/jquery.toast.min.js') }}"></script>
	<!-- End plugin js for this page-->
	<!-- inject:js -->
	<script src="{{ asset('js/UI-BACKEND/off-canvas.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/hoverable-collapse.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/template.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/settings.js') }}"></script>
	<script src="{{ asset('js/UI-BACKEND/todolist.js') }}"></script>
	<!-- endinject -->
	<!-- Custom js for this page-->
	<script src="{{ asset('js/UI-BACKEND/toastDemo.js') }}"></script>
	<!-- End custom js for this page-->
</body>

</html>

