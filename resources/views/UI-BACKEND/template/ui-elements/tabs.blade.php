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
                    <div class="col-md-12 col-xl-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Basic Tab</h4>
                          <p class="card-description">Horizontal bootstrap tab</p>
                          <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home-1" role="tab" aria-controls="home-1" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile-1" role="tab" aria-controls="profile-1" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact-1" role="tab" aria-controls="contact-1" aria-selected="false">Contact</a>
                            </li>
                          </ul>
                          <div class="tab-content">
                            <div class="tab-pane fade show active" id="home-1" role="tabpanel" aria-labelledby="home-tab">
                              <div class="media">
                                <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/13.jpg') }}" alt="sample image">
                                <div class="media-body">
                                  <h4 class="mt-0">Why choose us?</h4>
                                  <p>
                                      Far curiosity incommode now led smallness allowance. Favour bed assure son things yet. She consisted 
                                      consulted elsewhere happiness disposing household any old the. Widow downs you new shade drift hopes 
                                      small. So otherwise commanded sweetness we improving. Instantly by daughters resembled unwilling principle 
                                      so middleton.
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="profile-1" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="media">
                                <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/faces/face12.jpg') }}" alt="sample image">
                                <div class="media-body">
                                  <h4 class="mt-0">John Doe</h4>
                                  <p>
                                      Fail most room even gone her end like. Comparison dissimilar unpleasant six compliment two unpleasing 
                                      any add. Ashamed my company thought wishing colonel it prevent he in. Pretended residence are something 
                                      far engrossed old off.
                                  </p>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="contact-1" role="tabpanel" aria-labelledby="contact-tab">
                              <h4>Contact us </h4>
                              <p>
                                Feel free to contact us if you have any questions!
                              </p>
                              <p>
                                <i class="typcn typcn-phone-outline text-info"></i>
                                +123456789
                              </p>
                              <p>
                                <i class="typcn typcn-mail text-success"></i>
                                contactus@example.com
                              </p>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-xl-6 grid-margin stretch-card d-none d-md-flex">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Vertical Tabs</h4>
                          <p class="card-description">Add class <code>.nav-tabs-vertical</code> to <code>.nav</code> and 
                            <code>.tab-content-vertical</code> to <code>.tab-content</code>
                          </p>
                          <div class="row">
                            <div class="col-4">
                              <ul class="nav nav-tabs nav-tabs-vertical" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab-vertical" data-bs-toggle="tab" href="#home-2" role="tab" aria-controls="home-2" aria-selected="true">
                                  Home
                                  <i class="typcn typcn-home-outline text-info ms-2"></i>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab-vertical" data-bs-toggle="tab" href="#profile-2" role="tab" aria-controls="profile-2" aria-selected="false">
                                  Profile
                                  <i class="typcn typcn-user-outline text-danger ms-2"></i>
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="contact-tab-vertical" data-bs-toggle="tab" href="#contact-2" role="tab" aria-controls="contact-2" aria-selected="false">
                                  Reach
                                  <i class="typcn typcn-mail text-success ms-2"></i>
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="col-8">
                              <div class="tab-content tab-content-vertical">
                                <div class="tab-pane fade show active" id="home-2" role="tabpanel" aria-labelledby="home-tab-vertical">
                                  <div class="text-center">
                                    <img class="me-3 w-25 mb-4" src="{{ asset('image/UI-BACKEND/samples/300x300/12.jpg') }}" alt="sample image">                            
                                  </div>
                                  <p>
                                      Inhabiting discretion the her dispatched decisively boisterous joy. So form were wish open 
                                      is able of mile of. Waiting express if prevent it we an musical. Especially reasonable travelling 
                                  </p>
                                </div>
                                <div class="tab-pane fade" id="profile-2" role="tabpanel" aria-labelledby="profile-tab-vertical">
                                  <div class="text-center">
                                    <img class="mb-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/faces/face1.jpg') }}" alt="sample image">
                                    <h5 class="mt-0">Adam John</h5>
                                    <p class="mb-0">UX specialist</p>
                                    <p class="mb-0">Florida</p>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="contact-2" role="tabpanel" aria-labelledby="contact-tab-vertical">
                                  <h4>Contact us </h4>
                                  <p>
                                    Feel free to contact us if you have any questions!
                                  </p>
                                  <p>
                                    <i class="typcn typcn-phone-outline text-info"></i>
                                    +123456789
                                  </p>
                                  <p>
                                    <i class="typcn typcn-mail text-success"></i>
                                    contactus@example.com
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12 grid-margin stretch-card d-none d-md-flex">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Custom vertical tab</h4>
                          <p class="card-description">Add class <code>.nav-tabs-vertical-custom</code> to <code>.nav</code>
                          and <code>.tab-content-vertical-custom</code> to <code>.tab-content</code></p>
                          <div class="row">
                            <div class="col-3">
                              <ul class="nav nav-tabs nav-tabs-vertical-custom" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="home-tab-custom" data-bs-toggle="tab" href="#home-3" role="tab" aria-controls="home-3" aria-selected="true">
                                    Playing Video Games With Imagination
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="profile-tab-custom" data-bs-toggle="tab" href="#profile-3" role="tab" aria-controls="profile-3" aria-selected="false">
                                    Getting Free Publicity For Your Business
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="contact-tab-custom" data-bs-toggle="tab" href="#contact-3" role="tab" aria-controls="contact-3" aria-selected="false">
                                    Tips For Designing An Effective Business Card
                                  </a>
                                </li>
                              </ul>
                            </div>
                            <div class="col-9 col-lg-6">
                              <div class="tab-content tab-content-vertical tab-content-vertical-custom">
                                <div class="tab-pane fade show active" id="home-3" role="tabpanel" aria-labelledby="home-tab-custom">
                                  <h6 class="font-weight-normal">Profiles Of The Powerful Advertising Exec Steve Grasse</h6>
                                  <h3 class="font-weight-normal">How To Write Better Advertising Copy</h3>
                                  <div class="d-flex mt-4">
                                      <img src="{{ asset('image/UI-BACKEND/samples/300x300/3.jpg') }}" class="w-25 h-100 rounded" alt="image">
                                      <img src="{{ asset('image/UI-BACKEND/samples/300x300/4.jpg') }}" class="w-25 h-100 ms-2 rounded" alt="image">                              
                                  </div>
                                  <p class="mt-4">
                                      The key to victory is discipline, and that means a well made bed. You will practice until you can make 
                                      your bed in your sleep. You don't know how to do any of those. Then throw her in the laundry room, which 
                                      will hereafter be referred to as "the brig".
                                  </p>
                                </div>
                                <div class="tab-pane fade" id="profile-3" role="tabpanel" aria-labelledby="profile-tab-custom">
                                  <div class="media">
                                    <img class="align-self-center me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/15.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>
                                          And until then, I can never die? I'm a thing. Fry, you can't just sit here in the dark listening to 
                                          classical music. Is today's hectic lifestyle making you tense and impatient? Is today's hectic lifestyle 
                                          making you tense and impatient?
                                      </p>
                                      <p>
                                          Robot 1-X, save my friends! And Zoidberg! Aww, it's true. I've been hiding it for so long. Fry, we have a 
                                          crate to deliver. Yes! In your face, Gandhi! Interesting. No, wait, the other thing: tedious.
                                      </p>
                                      <p>
                                          Five hours? Aw, man! Couldn't you just get me the death penalty? Yes! In your face, Gandhi! We're rescuing 
                                          ya. Yeah, I do that with my stupidness. With gusto.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="contact-3" role="tabpanel" aria-labelledby="contact-tab-custom">
                                  <div class="media">
                                    <div class="media-body">
                                      <h5 class="mt-0 mb-1">You've swallowed a planet!</h5>
                                      Did I mention we have comfy chairs? You hate me; you want to kill me! Well, go on! Kill me! KILL ME! I'm the Doctor, 
                                      I'm worse than everyone's aunt. *catches himself* And that is not how I'm introducing myself.
                                    </div>
                                    <img class="ms-3 w-25" src="{{ asset('image/UI-BACKEND/samples/300x300/5.jpg') }}" alt="sample image">
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-xl-6 grid-margin stretch-card">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Pills</h4>
                          <p class="card-description">Basic nav pills</p>
                          <ul class="nav nav-pills nav-pills-success" id="pills-tab" role="tablist">
                            <li class="nav-item">
                              <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Home</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Profile</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Contact</a>
                            </li>
                          </ul>
                          <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                              <div class="media">
                                <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/12.jpg') }}" alt="sample image">
                                <div class="media-body">
                                  <h5 class="mt-0">I'm doing mental jumping jacks.</h5>
                                  <p>Only you could make those words cute. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. I am not a killer. I feel like a 
                                    jigsaw puzzle missing a piece. And I'm not even sure what the picture should be.</p>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                              <div class="media">
                                <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}" alt="sample image">
                                <div class="media-body">
                                  <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is computerized. Tell him time is of the essence. 
                                    Somehow, I doubt that. You have a good heart, Dexter.</p>
                                </div>
                              </div>
                            </div>
                            <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                              <div class="media">
                                <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/14.jpg') }}" alt="sample image">
                                <div class="media-body">
                                  <p>
                                      I'm really more an apartment person. This man is a knight in shining armor. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                  </p>
                                  <p>
                                      I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. I catch killers. Hello, Dexter Morgan.
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-12 col-xl-6 grid-margin stretch-card d-none d-md-flex">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Vertical Pills</h4>
                          <p class="card-description">Add class <code>.nav-pills-vertical</code> to <code>.nav</code> and 
                            <code>.tab-content-vertical</code> to <code>.tab-content</code>
                          </p>
                          <div class="row">
                            <div class="col-4">
                              <ul class="nav nav-pills nav-pills-vertical nav-pills-info" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                <li class="nav-item">
                                  <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                                    <i class="typcn typcn-home-outline"></i>
                                    Home
                                  </a>                          
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                                    <i class="typcn typcn-user-outline"></i>
                                    Profile
                                  </a>                          
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                                    <i class="typcn typcn-mail"></i>
                                    Reach
                                  </a>                          
                                </li>
                              </ul>
                            </div>
                            <div class="col-8">
                              <div class="tab-content tab-content-vertical" id="v-pills-tabContent">
                                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/11.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <h5 class="mt-0">I'm doing mental jumping jacks.</h5>
                                      <p>
                                        Only you could make those words cute. Oh I beg to differ, I think we have a lot to discuss. After all, 
                                        you are a client. I am not a killer. 
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is computerized. Tell him time is of the essence. 
                                        Somehow, I doubt that. You have a good heart, Dexter.</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/14.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>
                                          I'm really more an apartment person. This man is a knight in shining armor. Oh I beg to differ, I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                      </p>
                                      <p>
                                          I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. I catch killers. Hello, Dexter Morgan.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <h4 class="card-title">Custom pills</h4>
                          <p class="card-description">Add class <code>.nav-pills-custom</code> and <code>.tab-content-custom-pill</code> to <code>.nav-pills</code> and <code>.tab-content</code></p>
                          <div class="row">
                            <div class="col-md-10 mx-auto">
                              <ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">
                                <li class="nav-item">
                                  <a class="nav-link active" id="pills-home-tab-custom" data-toggle="pill" href="#pills-health" role="tab" aria-controls="pills-home" aria-selected="true">
                                    Health
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-profile-tab-custom" data-toggle="pill" href="#pills-career" role="tab" aria-controls="pills-profile" aria-selected="false">
                                    Career
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-contact-tab-custom" data-toggle="pill" href="#pills-music" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Music
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-vibes-tab-custom" data-toggle="pill" href="#pills-vibes" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Vibes
                                  </a>
                                </li>
                                <li class="nav-item">
                                  <a class="nav-link" id="pills-energy-tab-custom" data-toggle="pill" href="#pills-energy" role="tab" aria-controls="pills-contact" aria-selected="false">
                                    Energy
                                  </a>
                                </li>
                              </ul>
                              <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">
                                <div class="tab-pane fade show active" id="pills-health" role="tabpanel" aria-labelledby="pills-home-tab-custom">
                                  <div class="d-flex mb-4">
                                    <img src="{{ asset('image/UI-BACKEND/samples/300x300/12.jpg') }}" class="w-25 h-100 rounded" alt="sample image">
                                    <img src="{{ asset('image/UI-BACKEND/samples/300x300/1.jpg') }}" class="w-25 h-100 ms-4 rounded" alt="sample image">
                                    <img src="{{ asset('image/UI-BACKEND/samples/300x300/2.jpg') }}" class="w-25 h-100 ms-4 rounded" alt="sample image">
                                  </div>
                                  <p>
                                      I'm not the monster he wants me to be. So I'm neither man nor beast. I'm something new entirely. With 
                                      my own set of rules. I'm Dexter. Boo. Only you could make those words cute. I'm thinking two circus clowns dancing. You?
                                  </p>
                                  <p>
                                      Under normal circumstances, I'd take that as a compliment. Tell him time is of the essence. I'm really more 
                                      an apartment person. Finding a needle in a haystack isn't hard when every straw is computerized.
                                  </p>
                                </div>
                                <div class="tab-pane fade" id="pills-career" role="tabpanel" aria-labelledby="pills-profile-tab-custom">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/10.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>I'm thinking two circus clowns dancing. You? Finding a needle in a haystack isn't hard when every straw is 
                                        computerized. Tell him time is of the essence. 
                                        Somehow, I doubt that. You have a good heart, Dexter.</p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-music" role="tabpanel" aria-labelledby="pills-contact-tab-custom">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/14.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>
                                          I'm really more an apartment person. This man is a knight in shining armor. Oh I beg to differ, 
                                          I think we have a lot to discuss. After all, you are a client. You all right, Dexter?
                                      </p>
                                      <p>
                                          I'm generally confused most of the time. Cops, another community I'm not part of. You're a killer. 
                                          I catch killers. Hello, Dexter Morgan.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-vibes" role="tabpanel" aria-labelledby="pills-vibes-tab-custom">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/15.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>
                                          This man is a knight in shining armor. I feel like a jigsaw puzzle missing a piece. And I'm not 
                                          even sure what the picture should be. Somehow, I doubt that. You have a good heart, Dexter. Keep your mind limber.
                                      </p>
                                    </div>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="pills-energy" role="tabpanel" aria-labelledby="pills-energy-tab-custom">
                                  <div class="media">
                                    <img class="me-3 w-25 rounded" src="{{ asset('image/UI-BACKEND/samples/300x300/11.jpg') }}" alt="sample image">
                                    <div class="media-body">
                                      <p>
                                          Finding a needle in a haystack isn't hard when every straw is computerized. You're a killer. I catch killers. 
                                          I will not kill my sister. I will not kill my sister. I will not kill my sister. Rorschach would say you have a hard time relating to others.
                                      </p>
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
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-sm-flex justify-content-center justify-content-sm-between">
                                <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2023 <a href="https://www.bootstrapdash.com/" class="text-muted" target="_blank">Bootstrapdash</a>. All rights reserved.</span>
                                <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center text-muted">Hand-crafted &amp; made with <i class="typcn typcn-heart-full-outline text-danger"></i></span>
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

