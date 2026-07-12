<style>
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section {
		min-height: 140px;
		border: 1px dashed #3b86d1b3;
		background-image: linear-gradient(180deg, white, #F1F6FF);
		border-radius: 2px;
		position: relative;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section div.col:first-child {
		opacity: 1;
		visibility: visible;
		transition-duration: 0.2s;
		transform: scale(1);
		width: 200px;
		margin: auto;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section div.col:last-child {
		text-align: center;
		font-size: 30px;
		font-weight: 700;
		color: #c0cae1;
		position: absolute;
		top: 0px;
		bottom: 0px;
		left: 0px;
		right: 0px;
		margin: auto;
		height: 55px;
		pointer-events: none;
		opacity: 0;
		visibility: hidden;
		transform: scale(0.6);
		transition-duration: 0.2s;
	}

	/* we will use "drag-over-effect" class in js */
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drag-over-effect div.col:first-child {
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		transform: scale(1.1);
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drag-over-effect div.col:last-child {
		opacity: 1;
		visibility: visible;
		transform: scale(1);
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section .cloud-icon {
		margin-top: 25px;
		margin-bottom: 20px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section .cloud-icon img {
		width: 80px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section span,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section button {
		display: block;
		margin: auto;
		color: #707EA0;
		margin-bottom: 10px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section button {
		color: white;
		background-color: #5874C6;
		border: none;
		outline: none;
		padding: 7px 20px;
		border-radius: 8px;
		margin-top: 20px;
		cursor: pointer;
		box-shadow: rgba(50, 50, 93, 0.25) 0px 13px 27px -5px, rgba(0, 0, 0, 0.3) 0px 8px 16px -8px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .drop-section input {
		display: none;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section {
		display: none;
		text-align: left;
		padding-bottom: 20px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section .list-title {
		font-size: 0.95rem;
		color: #707EA0;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li {
		display: flex;
		margin: 15px 0px;
		padding-top: 4px;
		padding-bottom: 2px;
		border-radius: 8px;
		transition-duration: 0.2s;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li:hover {
		box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col {
		flex: .1;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col:nth-child(1) {
		flex: .15;
		text-align: center;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col:nth-child(2) {
		flex: .75;
		text-align: left;
		font-size: 0.9rem;
		color: #3e4046;
		padding: 8px 10px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col:nth-child(2) div.name {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		max-width: 250px;
		display: inline-block;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col .file-name span {
		color: #707EA0;
		float: right;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .file-progress {
		width: 100%;
		height: 5px;
		margin-top: 8px;
		border-radius: 8px;
		background-color: #dee6fd;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .file-progress span {
		display: block;
		width: 0%;
		height: 100%;
		border-radius: 8px;
		background-image: linear-gradient(120deg, #6b99fd, #9385ff);
		transition-duration: 0.4s;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col .file-size {
		font-size: 0.75rem;
		margin-top: 3px;
		color: #707EA0;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col svg.cross,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col svg.tick {
		fill: #8694d2;
		background-color: #dee6fd;
		position: relative;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		border-radius: 50%;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li .col svg.tick {
		fill: #50a156;
		background-color: transparent;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li.complete span,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li.complete .file-progress,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li.complete svg.cross {
		display: none;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li.in-prog .file-size,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-section li.in-prog svg.tick {
		display: none;
	}
</style>

<style>

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .section-container-{{ $sectionId }}_cropper {
		/* background-color: #f7f7f7; */
		background-color: #ffffff;
		text-align: center;
		width: 100%;
		max-height: 250px;
    	min-height: 100px;

		overflow: hidden; /* Ẩn phần thừa của ảnh nếu có */
    	position: relative; /* Để căn chỉnh Video bên trong container */
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .section-container-{{ $sectionId }}_cropper > .img-container-{{ $sectionId }}_cropper {
		max-width: 100%;
		max-height: 100%;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .section-container-{{ $sectionId }}_cropper > .img-container-{{ $sectionId }}_cropper > img {
		display: block;
		max-width: 100%;

		max-height: 250px;
    	min-height: 100px;
		margin: auto;
	}
	
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-dialog-scrollable .modal-content {
		height: 100%;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body {
		margin: unset;
		padding: unset;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .col-item {
		padding: 0.4rem 0.4rem;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-description {
		font-size: 1.035rem;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .col-description {
		flex: 1;
		/* Đảm bảo cột này chiếm tối đa không gian còn lại */
		min-width: 0;
		/* Cho phép co lại để tránh tràn */
		padding-left: unset;
		padding-right: unset;

		height: 60px;
		display: flex;
		/* justify-content: center; */
		align-items: center;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .col-description h6 {
		/* white-space: nowrap; */
		overflow: hidden;
		text-overflow: ellipsis;
		
		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .col-svg svg.icon-delete {
		color: #b2b2b2;
		background: transparent;
		height: 55px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .section-svg {
		display: inline-block;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .section-svg.section-svg-icon-delete {
		padding-right: 7px;
		padding-left: 7px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .card-body .col-svg svg.icon-next {
		color: #b2b2b2;
		background: transparent;
		margin-right: 5px;
		height: 18px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body .item-header:hover {
		color: white;
		background: #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body .item-header.active {
		color: white;
		background: #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body .item-header.border-focus {
		box-shadow: inset 0 0 0 2px #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body .item-header.active .col-svg svg.icon-next {
		color: white;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body:hover .col-svg svg.icon-next {
		color: white;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .card.mb-3.card-body .col-svg .section-svg-icon-delete:hover svg.icon-delete {
		color: #dc3545;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .mt-2.d-flex {
        flex-wrap: wrap;
    }

	@media (max-width: 767px) {
		#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .nav-tabs .nav-link {
			padding: .75rem 1.2rem;
		}

		#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .mt-2.d-flex .btn-group {
            margin-bottom: 0.5rem;
        }
	}
	@media (max-width: 415px) {
    	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .nav-tabs .nav-link {
			padding: .75rem 0.75rem;
		}

	}
</style>

<!-- Modal starts -->
<div class="modal fade" id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO" tabindex="-1"
	role="dialog" aria-labelledby="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_LABEL"
	data-bs-keyboard="true"
	data-bs-backdrop="static">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 750px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
					<svg name="{{ $sectionId }}_SECTION_CHI_TIET_VIDEO" data-action-type="CHI_TIET_VIDEO_GO_BACK_BTN" style="display: none;" class="icon go-back" width="1.6em" height="1.6em" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="none" stroke-width="19.456">
						<g stroke-width="0"></g>
						<g stroke-linecap="round" stroke-linejoin="round"></g>
						<g>
							<path fill="#7b7b7b" d="M224 480h640a32 32 0 110 64H224a32 32 0 010-64z"></path>
							<path fill="#7b7b7b" d="M237.248 512l265.408 265.344a32 32 0 01-45.312 45.312l-288-288a32 32 0 010-45.312l288-288a32 32 0 1145.312 45.312L237.248 512z"></path>
						</g>
					</svg>
				</div>

				<h5 class="modal-title" id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_LABEL">Danh sách video</h5>

				<!-- Thêm attr này vào btn để có thể đóng popup tự động data-bs-dismiss="modal" -->
				<button type="button"
					id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_CLOSE"
					class="close btn rounded-circle"
					aria-label="Close">
					<span>×</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Đây là trường input hidden khi upload thành công, call_back sẽ trả về -->
				<section id="{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_VIDEO" class="d-none">

				</section>
				
				<div class="row">
					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_VIDEO">
						<p class="card-description" style="margin-bottom: 15px;">Hiện có: <span class="one-line"><span class="error-message" style="display: unset;"><span id="soLuongVideo">0</span> trên <span id="tongSoVideoChoPhep">2</span></span> video được phép upload</span>
						</p>
					</div>
					
					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_VIDEO">
						<div id="{{ $sectionId }}_danhSachVideo" class="row list-card">
						</div>

						<div class="row list-card d-none" id="{{ $sectionId }}_rowVideoTemplate">
							<div class="col-sm-6 col-card" id="SECTION_{-{UUID}-}">
								<a href="javascript:void(0);" class="text-reset text-decoration-none col-card-item" 
									action-type="item-card"
									data-uuid="{-{UUID}-}"
									data-document-storage-id="{-{DOCUMENT_STORAGE_ID}-}"
									data-document-storage-name="{-{DOCUMENT_STORAGE_NAME}-}"
									data-document-storage-original-name="{-{DOCUMENT_STORAGE_ORIGINAL_NAME}-}"
									data-document-storage-type="{-{DOCUMENT_STORAGE_TYPE}-}"
									data-document-storage-extension="{-{DOCUMENT_STORAGE_EXTENSION}-}"
									data-document-storage-path="{-{DOCUMENT_STORAGE_PATH}-}"
									data-document-storage-directory="{-{DOCUMENT_STORAGE_DIRECTORY}-}"
									data-document-storage-size="{-{DOCUMENT_STORAGE_SIZE}-}"
									data-document-storage-status="{-{DOCUMENT_STORAGE_STATUS}-}"
									data-document-storage-description="{-{DOCUMENT_STORAGE_DESCRIPTION}-}"
								>
									<div class="card mb-3 card-body">
										<div class="col-12 col-item item-header">
											<div class="row align-items-center">
												<div class="col-auto col-img" action-type="item-detail">
													<{-{TAG_IMG}-} action-type="item-detail" src="{-{SRC_IMG}-}" id="{-{UUID}-}" class="width-100 rounded-2" style="margin-left: 1px;" alt="">
												</div>
												<div class="col col-description" action-type="item-detail">
													<div class="overflow-hidden flex-nowrap" action-type="item-detail">
														<h6 action-type="item-detail" class="mb-1" style="padding-top: 5px; line-height: 1.2rem;">
															{-{NAME}-}
														</h6>
													</div>
												</div>
												<div class="col-auto col-svg">
													<!-- <div class="section-svg section-svg-icon-delete" action-type="item-delete">
														<svg class="w-6 h-6 text-gray-800 dark:text-white icon-delete" action-type="item-delete" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
															<path action-type="item-delete" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z" />
														</svg>
													</div>

													<div class="section-svg section-svg-icon-next">
														<svg class="w-6 h-6 text-gray-800 dark:text-white icon-next" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 20" data-type="monochrome" width="1em" height="1em" fill="none" class="b1l31kza">
															<path fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" d="M2 2l8 7.9L2 18"></path>
														</svg>
													</div> -->



													<button type="button" class="btn btn-light dropdown-toggle me-1"
														id="{-{UUID}-}_DROP_DOWN_MENU_ICON_BTN" data-bs-toggle="dropdown"
														style="padding: 0.8rem 0.8rem;"
														aria-haspopup="true" aria-expanded="false"></button>
													<div class="dropdown-menu"
														id="{-{UUID}-}_SECTION_DROP_DOWN_MENU_ICON_BTN"
														aria-labelledby="{-{UUID}-}_DROP_DOWN_MENU_ICON_BTN">
														<button type="button" class="dropdown-item" action-type="item-delete">
															<i class="icon-trash icon-action-mobile" action-type="item-delete"></i>Xóa
														</button>
														<div class="dropdown-divider"></div>

														<button type="button" class="dropdown-item" action-type="item-detail">
															<i class="icon-doc icon-action-mobile" action-type="item-detail"></i>Chi tiết
														</button>
														<div class="dropdown-divider"></div>

														<button type="button" class="dropdown-item" action-type="item-move-up">
															<i class="icon-arrow-up-circle icon-action-mobile" action-type="item-move-up"></i>Lên
														</button>

														<div class="dropdown-divider"></div>
														<button type="button" class="dropdown-item" action-type="item-move-down">
															<i class="icon-arrow-down-circle icon-action-mobile" action-type="item-move-down"></i>Xuống
														</button>
													</div>



												</div>
											</div>
										</div>

									</div>
								</a>
							</div>
						</div>

					</div>

					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_CHI_TIET_VIDEO" style="display: none;">
						<div class="card-body">
							<div class="row">
								<!-- <p class="card-description">Thông tin Video</p> -->
								<div class="section-block col-lg-12 col-md-12">
									<div class="form-group">
										<!-- <label for="section_yqY0Oz_EDIT_MA_LO">Video</label> -->
										<div class="card-body">
											<ul class="nav nav-tabs" role="tablist" id="{{ $sectionId }}_TAB_KICH_THUOC_VIDEO">
												<li class="nav-item">
													<a class="nav-link active" id="{{ $sectionId }}_tab-{{ $aspectRatio }}" data-bs-toggle="tab" href="#{{ $sectionId }}_section-tab-{{ $aspectRatio }}" role="tab" aria-controls="section-tab-{{ $aspectRatio }}" aria-selected="true">Kích thước ảnh đại diện</a>
												</li>

												<li class="nav-item">
													<a class="nav-link" id="{{ $sectionId }}_tab-raw" data-bs-toggle="tab" href="#{{ $sectionId }}_section-tab-raw" role="tab" aria-controls="section-tab-raw" aria-selected="false">Ảnh gốc</a>
												</li>
												
												<!-- 
												<li class="nav-item">
													<a class="nav-link" id="{{ $sectionId }}_tab-{{ $aspectRatio }}" data-bs-toggle="tab" href="#{{ $sectionId }}_section-tab-{{ $aspectRatio }}" role="tab" aria-controls="{{ $sectionId }}_section-tab-{{ $aspectRatio }}" aria-selected="false">3 x 2</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="{{ $sectionId }}_tab-4x3" data-bs-toggle="tab" href="#section-tab-4x3" role="tab" aria-controls="section-tab-4x3" aria-selected="false">4 x 3</a>
												</li>
												<li class="nav-item">
													<a class="nav-link" id="{{ $sectionId }}_tab-16x9" data-bs-toggle="tab" href="#section-tab-16x9" role="tab" aria-controls="section-tab-16x9" aria-selected="false">16 x 9</a>
												</li> 
												-->

											</ul>
											<div class="tab-content">
												<div class="tab-pane fade active show" id="{{ $sectionId }}_section-tab-{{ $aspectRatio }}" role="tabpanel" aria-labelledby="tab-{{ $aspectRatio }}">
													<div class="section-container-{{ $sectionId }}_cropper">
														<div class="img-container-{{ $sectionId }}_cropper">
															<img id="{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture">
															<img id="{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_{{ $aspectRatio }}" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture" style="display: none;">
														</div>
													</div>

													<div class="mt-2 d-flex align-items-center justify-content-center">

														<div name="{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA">
															<button data-action-type="CROP_{{ $aspectRatio }}_BTN_CHINH_SUA" type="button" class="btn btn-success btn-rounded btn-icon-text"><i class="fa fa-pencil-square-o btn-icon-prepend"></i>Chỉnh sửa</button>
														</div>
														
														<div class="btn-group me-2" role="group" aria-label="Basic example1" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_ZOOM_IN' title="Zoom-in" style="width: 40px;"><i class="fa fa-search-plus btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_ZOOM_OUT' title="Zoom-out" style="width: 40px;"><i class="fa fa-search-minus btn-icon-prepend"></i></button>
														</div>

														<div class="btn-group me-2" role="group" aria-label="Basic example2" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_XOAY_TRAI' title="Xoay trái" style="width: 40px;"><i class="fa fa-rotate-left btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_XOAY_PHAI' title="Xoay phải" style="width: 40px;"><i class="fa fa-rotate-right btn-icon-prepend"></i></button>
														</div>

														<div class="btn-group me-2" role="group" aria-label="Basic example3" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_GUONG_NGANG' title="Gương ngang" style="width: 40px;"><i class="fa fa-arrows-h btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_GUONG_DOC' title="Gương dọc" style="width: 40px;"><i class="fa fa-arrows-v btn-icon-prepend"></i></button>
														</div>
														
														<div class="btn-group me-2" role="group" aria-label="Basic example4" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_{{ $aspectRatio }}_BTN_CROP_RESET'><i class="fa fa-refresh" style="margin-right: 0.5rem;"></i>Reset</button>
															<button type="button" class="btn btn-danger" data-group-action-type="CROP_BTN_CROP_HUY" data-action-type='CROP_{{ $aspectRatio }}_BTN_CROP_HUY'><i class="fa fa-window-close" style="margin-right: 0.5rem;"></i>Hủy</button>
															<button type="button" class="btn btn-info" data-action-type='CROP_{{ $aspectRatio }}_BTN_CROP_AND_SAVE'><i class="fa fa-save" style="margin-right: 0.5rem;"></i>Lưu</button>
														</div>
														
													</div>
												</div>

												<div class="tab-pane fade" id="{{ $sectionId }}_section-tab-raw" role="tabpanel" aria-labelledby="tab-raw">
													<div class="section-container-{{ $sectionId }}_cropper">
														<div class="img-container-{{ $sectionId }}_cropper">
															<img id="{{ $sectionId }}_CHI_TIET_VIDEO_RAW" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture">
															<img id="{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_RAW" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture" style="display: none;">
														</div>
													</div>

													<div class="mt-2 d-flex align-items-center justify-content-center">

														<div name="{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA">
															<button data-action-type="CROP_RAW_BTN_CHINH_SUA" type="button" class="btn btn-success btn-rounded btn-icon-text"><i class="fa fa-pencil-square-o btn-icon-prepend"></i>Chỉnh sửa</button>
														</div>
														
														<div class="btn-group me-2" role="group" aria-label="Basic example1" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_ZOOM_IN' title="Zoom-in" style="width: 40px;"><i class="fa fa-search-plus btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_ZOOM_OUT' title="Zoom-out" style="width: 40px;"><i class="fa fa-search-minus btn-icon-prepend"></i></button>
														</div>

														<div class="btn-group me-2" role="group" aria-label="Basic example2" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_XOAY_TRAI' title="Xoay trái" style="width: 40px;"><i class="fa fa-rotate-left btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_XOAY_PHAI' title="Xoay phải" style="width: 40px;"><i class="fa fa-rotate-right btn-icon-prepend"></i></button>
														</div>

														<div class="btn-group me-2" role="group" aria-label="Basic example3" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_GUONG_NGANG' title="Gương ngang" style="width: 40px;"><i class="fa fa-arrows-h btn-icon-prepend"></i></button>
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_GUONG_DOC' title="Gương dọc" style="width: 40px;"><i class="fa fa-arrows-v btn-icon-prepend"></i></button>
														</div>
														
														<div class="btn-group me-2" role="group" aria-label="Basic example4" name="{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER" style="display: none;">
															<button type="button" class="btn btn-light " data-action-type='CROP_RAW_BTN_CROP_RESET'><i class="fa fa-refresh" style="margin-right: 0.5rem;"></i>Reset</button>
															<button type="button" class="btn btn-danger" data-group-action-type="CROP_BTN_CROP_HUY" data-action-type='CROP_RAW_BTN_CROP_HUY'><i class="fa fa-window-close" style="margin-right: 0.5rem;"></i>Hủy</button>
															<button type="button" class="btn btn-info" data-action-type='CROP_RAW_BTN_CROP_AND_SAVE'><i class="fa fa-save" style="margin-right: 0.5rem;"></i>Lưu</button>
														</div>
														
													</div>
												</div>

												<!-- 
												<div class="tab-pane fade" id="{{ $sectionId }}_section-tab-{{ $aspectRatio }}" role="tabpanel" aria-labelledby="tab-{{ $aspectRatio }}">
													D
												</div>
												<div class="tab-pane fade" id="section-tab-4x3" role="tabpanel" aria-labelledby="tab-4x3">
													C
												</div>
												<div class="tab-pane fade" id="section-tab-16x9" role="tabpanel" aria-labelledby="tab-16x9">
													E
												</div> 
												-->

											</div>
										</div>
									</div>
								</div>
								<div class="section-block col-lg-12 col-md-12 d-none">
									<div class="form-group">
										<label for="{{ $sectionId }}_EDIT_TEN_VIDEO">Thông tin Video</label>
										<div class="input-group">
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_NAME" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ORIGINAL_NAME" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DESCRIPTION" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_EXTENSION" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_TYPE" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_PATH" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DIRECTORY" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_SIZE" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_IMAGE_THUMNAIL" placeholder=""></textarea>
										</div>
									</div>
								</div>
								<div class="section-block col-lg-12 col-md-12">
									<div class="form-group">
										<label for="{{ $sectionId }}_EDIT_TEN_VIDEO">Tên Video<code>*</code></label>
										<div class="input-group">
											<input type="text" class="form-control" id="{{ $sectionId }}_EDIT_TEN_VIDEO" placeholder="">
											<span class="input-group-text" id="{{ $sectionId }}_EDIT_TYPE_VIDEO">.JPG</span>
										</div>
										<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_TEN_VIDEO"></span>
									</div>
								</div>
								<div class="section-block col-lg-12 col-md-12">
									<div class="form-group">
										<label for="{{ $sectionId }}_EDIT_MO_TA">Mô tả</label>
										<textarea rows="3" class="form-control" id="{{ $sectionId }}_EDIT_MO_TA" placeholder=""></textarea>
										<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_MO_TA"></span>
									</div>
								</div>
								<div class="section-block col-lg-12 col-md-12">
									<div class="form-group">
										<label for="{{ $sectionId }}_CHI_TIET_VIDEO_PLAY">Trình phát video</label>
										<div class="section d-flex justify-content-center embed-responsive embed-responsive-16by9">

											<video id="{{ $sectionId }}_CHI_TIET_VIDEO_PLAY" controls width="100%">
												<source id="{{ $sectionId }}_CHI_TIET_VIDEO_PLAY_SOURCE" type="video/mp4">
												Trình duyệt không hỗ trợ video
											</video>

										</div>
										<span class="error-message" id="MSG_{{ $sectionId }}_CHI_TIET_VIDEO_PLAY"></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_VIDEO">
						<div class="upload-multiple">
							<div class="drop-section">
								<div class="col text-center">
									<div class="cloud-icon">
										<img src="{{ asset('image/UI-BACKEND/upload.png') }}" alt="cloud">
									</div>
									<span>Upload video</span>
									<!-- <span>Hoặc</span> -->
									<!-- <button class="file-selector">Chọn tập tin</button> -->
									<input type="file" class="file-selector-input" accept="video/*" multiple>
								</div>
								<div class="col">
									<div class="drop-here">Thả vào đây</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
			<div class="modal-footer">
				<button id="{{ $sectionId }}_BTN_DONE" name="{{ $sectionId }}_SECTION_DANH_SACH_VIDEO" type="button" class="btn btn-info width-100-percent">XONG</button>

				<div class="justify-content-end" name="{{ $sectionId }}_SECTION_CHI_TIET_VIDEO" style="display: none !important;">
					<div class="action-web">
						<button type="button" data-action-type="CHI_TIET_VIDEO_GO_BACK_BTN" class="btn btn-light btn-icon-text me-1">
							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
						</button>

						<!--
						<button type="button" class="btn btn-outline-info btn-fw btn-icon-text me-1" data-action-type="CHI_TIET_VIDEO_BTN_UNDO">
							<i class="fa fa-refresh btn-icon-prepend"></i>Hoàn tác
						</button> 
						-->

						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_VIDEO_BTN_SAVE">
							<i class="fa fa-save btn-icon-prepend"></i>Lưu
						</button>
					</div>

					<div class="action-mobile">
						<button type="button" data-action-type="CHI_TIET_VIDEO_GO_BACK_BTN" class="btn btn-light btn-icon-text me-1">
							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
						</button>

						<!--
						<button type="button" class="btn btn-outline-info btn-fw btn-icon-text me-1" data-action-type="CHI_TIET_VIDEO_BTN_UNDO">
							<i class="fa fa-refresh btn-icon-prepend"></i>Hoàn tác
						</button> 
						-->

						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_VIDEO_BTN_SAVE">
							<i class="fa fa-save btn-icon-prepend"></i>Lưu
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ends -->

<script>
	const {{ $sectionId }}_dropArea = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .upload-multiple .drop-section')
	const {{ $sectionId }}_listSection = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .upload-multiple .list-section')
	const {{ $sectionId }}_listContainer = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .upload-multiple .list')
	const {{ $sectionId }}_fileSelector = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .upload-multiple .drop-section')
	const {{ $sectionId }}_fileSelectorInput = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .upload-multiple .file-selector-input')
	var {{ $sectionId }}_cropper; // Biến global cropper thư viện tạo ảnh crop
	
	// upload files with browse button
	{{ $sectionId }}_fileSelector.onclick = () => {{ $sectionId }}_fileSelectorInput.click()
	{{ $sectionId }}_fileSelectorInput.onchange = () => {
		[...{{ $sectionId }}_fileSelectorInput.files].forEach((file) => {
			if ({{ $sectionId }}_typeValidation(file.type)) {
				{{ $sectionId }}_uploadFile(file)
			}
		});

		// Reset input file mỗi lần click upload file lại, để cho phép upload lần thứ 2 cùng tên file
		{{ $sectionId }}_resetInputUploadFile({{ $sectionId }}_fileSelectorInput);
	}

	// when file is over the drag area
	{{ $sectionId }}_dropArea.ondragover = (e) => {
		e.preventDefault();
		[...e.dataTransfer.items].forEach((item) => {
			if ({{ $sectionId }}_typeValidation(item.type)) {
				{{ $sectionId }}_dropArea.classList.add('drag-over-effect')
			}
		})
	}
	// when file leave the drag area
	{{ $sectionId }}_dropArea.ondragleave = () => {
		{{ $sectionId }}_dropArea.classList.remove('drag-over-effect')
	}
	// when file drop on the drag area
	{{ $sectionId }}_dropArea.ondrop = (e) => {
		e.preventDefault();
		{{ $sectionId }}_dropArea.classList.remove('drag-over-effect')
		if (e.dataTransfer.items) {
			[...e.dataTransfer.items].forEach((item) => {
				if (item.kind === 'file') {
					const file = item.getAsFile();
					if ({{ $sectionId }}_typeValidation(file.type)) {
						{{ $sectionId }}_uploadFile(file)
					}
				}
			})
		} else {
			[...e.dataTransfer.files].forEach((file) => {
				if ({{ $sectionId }}_typeValidation(file.type)) {
					{{ $sectionId }}_uploadFile(file)
				}
			})
		}
	}


	// check the file type
	function {{ $sectionId }}_typeValidation(type) {
		var splitType = type.split('/')[0]
		if (type == 'application/pdf' || splitType == 'image' || splitType == 'video') {
			return true
		}
	}

	/**
	 * Reset input file mỗi lần click upload file lại, để cho phép upload lần thứ 2 cùng tên file
	 *
	 * @param {HTMLElement} dropZoneElement
	 * @param {File} file
	 */
	function {{ $sectionId }}_resetInputUploadFile(inputElement) {
        inputElement.value = null;
    }
	
	// upload file function
	function {{ $sectionId }}_uploadFile(file) {
		let soLuongFileUpload = $('#{{ $sectionId }}_danhSachVideo').find('.col-card').length;
		if (soLuongFileUpload >= 2) {
			showToastInfo('top-right', 'Đã vượt quá 2 file cho phép upload');
			return;
		}

		let size = `${(file.size/(1024*1024)).toFixed(2)} MB`;

		// Create new row
		let templateRow = $('#{{ $sectionId }}_rowVideoTemplate').html();
		let newRow = templateRow.replaceAll('{-{NAME}-}', `${file.name}`);

		if (file.type.startsWith("video/")) {
			let srcImg = "{{asset('image/UI-BACKEND/loading.gif') }}";
			let uuid = generateRandomString(10);
			newRow = newRow.replaceAll('{-{TAG_IMG}-}', 'img')
							.replaceAll('{-{SRC_IMG}-}', srcImg)
							.replaceAll('{-{UUID}-}', uuid);
			newRow = recoverTagHtml(newRow);

			// Append after div
			$('#{{ $sectionId }}_danhSachVideo').append(newRow);

			let soLuongVideoUpload = $('#soLuongVideo').text();
			if (isNumber(soLuongVideoUpload)) {
				soLuongVideoUpload = parseInt(soLuongVideoUpload) + 1;
				$('#soLuongVideo').text(soLuongVideoUpload);
			}
			
			// Gọi API để tải file gốc lên (không bị thay đổi kích thước)
			{{ $sectionId }}_storageFileDinhKem(file, uuid, function callback(uuid, documentStorage) {
				let srcImg = '';
				if (!isEmpty(documentStorage)) { // Nếu tồn tại ảnh đại diện thì sẽ show lên
					srcImg = '{{asset('') }}' + documentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + documentStorage.IMAGE_THUMNAIL;
					$('#' + uuid).attr('src', srcImg + '?time=' + new Date().getTime());

					// Cập nhật attribute thông tin tin Video
					let $colCardItem = $('#SECTION_' + uuid).find('.col-card-item');
					$colCardItem.attr('data-document-storage-id', documentStorage.ID);
					$colCardItem.attr('data-document-storage-name', documentStorage.NAME);
					$colCardItem.attr('data-document-storage-original-name', documentStorage.ORIGINAL_NAME);
					$colCardItem.attr('data-document-storage-type', documentStorage.TYPE_FILE);
					$colCardItem.attr('data-document-storage-extension', documentStorage.EXTENSION);
					$colCardItem.attr('data-document-storage-path', documentStorage.PATH);
					$colCardItem.attr('data-document-storage-directory', documentStorage.DIRECTORY);
					$colCardItem.attr('data-document-storage-size', documentStorage.SIZE);
					$colCardItem.attr('data-document-storage-status', documentStorage.STATUS);
					$colCardItem.attr('data-document-storage-description', documentStorage.DESCRIPTION);
					$colCardItem.attr('data-document-storage-image-thumnail', documentStorage.IMAGE_THUMNAIL);
				
				} else { // Ngược lại, gặp lỗi thì xóa ảnh khỏi html bị lỗi
					$('#' + uuid).closest('.col-card').remove();

					// Cập nhật số lượng Video
					let soLuongVideoUpload = $('#soLuongVideo').text();
					if (isNumber(soLuongVideoUpload)) {
						let currSoLuongVideo = parseInt(soLuongVideoUpload) - 1 <= 0 ? 0 : parseInt(soLuongVideoUpload) - 1;
						$('#soLuongVideo').text(currSoLuongVideo)
					}
				}
			});
		}

	}

	/**
	 * Lưu vào database
	 *
	 * @param file
	 */
	function {{ $sectionId }}_storageFileDinhKem(file, uuid, callback) {
		// Get form
		var formData = new FormData();
		// List of files to add to form data
		formData.append('VIDEOS[]', file);
		formData.append('KICH_THUOC_HINH_ANH_DAI_DIEN', '{{ $aspectRatio }}');

		// Call api upload multiple files
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: '{{ url("/api/document-storage/upload-multiples-video") }}',
			data: formData,
			showLoading: false,

			// Ngăn jQuery tự động chuyển đổi data thành chuỗi query
			processData: false,
			contentType: false,
			cache: false,
			timeout: 1000000,
			success: function(data, textStatus, jqXHR) {
				// Ajax call completed successfully 
				// showToastSuccess('top-right', data.STATUS_DETAIL);

				callback(uuid, data.DATAS.DocumentStorage[0]);
			},
			error: function(request, textStatus, errorThrown) {
				// Some error in ajax call 
				/* if (request && request.responseJSON && request.responseJSON.STATUS_DETAIL)
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server'); */

				callback(uuid, null);
			},
			complete: function() {

			}
		});
	}
</script>


<script>
var {{ $sectionId }}_scrollPosition = 0; // Biến để lưu vị trí scroll của div Danh sách video
$(document).ready(function() {

	var {{ $sectionId }}_dataInitialPopupUploadMultipleVideo = {
		key: null,
		type_key: null,
		value: null
	}
	var {{ $sectionId }}_arrDataInitialPopupUploadMultipleVideo = [];
	
	/* Xử lý set data initial ban đầu. Phục vụ cho việc check thay đổi dữ liệu sau này */
	function {{ $sectionId }}_setDataInitialPopupUploadMultipleVideo(arrDocumentStorage) {
		// Reset array data initial
		{{ $sectionId }}_arrDataInitialPopupUploadMultipleVideo = [];

		// Init default
		{{ $sectionId }}_dataInitialPopupUploadMultipleVideo = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupUploadMultipleVideo.key = "{{ $sectionId }}_DANH_SACH_VIDEO";
		{{ $sectionId }}_dataInitialPopupUploadMultipleVideo.type_key = "ARRAY";
		{{ $sectionId }}_dataInitialPopupUploadMultipleVideo.value = arrDocumentStorage;
		{{ $sectionId }}_arrDataInitialPopupUploadMultipleVideo.push({{ $sectionId }}_dataInitialPopupUploadMultipleVideo); // Push to array

		return {{ $sectionId }}_arrDataInitialPopupUploadMultipleVideo;
	}

	/* Set default data popup upload multiple Video */
	function {{ $sectionId }}_initDefaultDataPopupMultipleVideo(arrDocumentStorage) {
		// Set data initial
		{{ $sectionId }}_setDataInitialPopupUploadMultipleVideo(arrDocumentStorage);
	}
	
	/* Kiểm tra data thay đổi */
	function {{ $sectionId }}_isDataChangedUploadMultipleVideo() {
		let isDataChanged = false;

		// Get datas từ UI
		let arrDocumentStorage = {{ $sectionId }}_getDanhSachUploadMultipleVideo_UI();
		// Reset array data initial
		let {{ $sectionId }}_arrDataPopupUploadMultipleVideo = [];

		// Init default
		{{ $sectionId }}_dataPopupUploadMultipleVideo = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataPopupUploadMultipleVideo.key = "{{ $sectionId }}_DANH_SACH_VIDEO";
		{{ $sectionId }}_dataPopupUploadMultipleVideo.type_key = "ARRAY";
		{{ $sectionId }}_dataPopupUploadMultipleVideo.value = arrDocumentStorage;
		{{ $sectionId }}_arrDataPopupUploadMultipleVideo.push({{ $sectionId }}_dataPopupUploadMultipleVideo); // Push to array

		// So sánh
		for (let dataFormUI of {{ $sectionId }}_arrDataPopupUploadMultipleVideo) {
			for (let dataInitial of {{ $sectionId }}_arrDataInitialPopupUploadMultipleVideo) {
				let dataFormVal = isEmpty(dataFormUI.value) ? '' : dataFormUI.value;
				let dataInitVal = isEmpty(dataInitial.value) ? '' : dataInitial.value;

				if (!isEmpty(dataFormUI.key) && !isEmpty(dataInitial.key)
					&& dataFormUI.key == dataInitial.key
				) {
					if (Array.isArray(dataInitVal) && Array.isArray(dataFormVal)) {
						if (dataInitVal.length != dataFormVal.length) {
							isDataChanged = true;
							return isDataChanged;
						} else {
							for (let i = 0; i < dataInitVal.length; i++) {
								if (dataInitVal[i].ID != dataFormVal[i].ID) {
									isDataChanged = true;
									return isDataChanged;
								}
							}
						}
					} else {
						if (dataFormVal != dataInitVal){
							isDataChanged = true;
							return isDataChanged;
						}
					}
					
				}
			}
		}

		return isDataChanged;
	}
	
	/* Xử lý logic khi open popup */
	{{ $sectionId }}_handleOpenPopupUploadMultipleVideo = function() {
		// Set default data popup upload multiple Video
		{{ $sectionId }}_initDefaultDataPopupMultipleVideo({{ $sectionId }}_getDanhSachUploadMultipleVideo().DANH_SACH_VIDEO);

		// Reset số lượng Video
		$('#soLuongVideo').text(0);
		
		// Xử lý set data Danh sách video
		$('#{{ $sectionId }}_danhSachVideo').html('');
		// Get datas từ UI
		let danhSachVideo = {{ $sectionId }}_getDanhSachUploadMultipleVideo().DANH_SACH_VIDEO;
		{{ $sectionId }}_setDataDanhSachVideo(danhSachVideo);
	}

	/* Button close đóng popup */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_CLOSE').on('click', function(e) {
		// Đóng modal popup
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').modal('toggle');
	});

	/* Xử lý sự kiện khi nhấn phím trên modal */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO div[name="{{ $sectionId }}_SECTION_CHI_TIET_VIDEO"]').keyup(function(event) {
		if (event.keyCode === 13) { // Nhấn phím ENTER
			if (event.target.type === 'textarea') return;
			$('button[data-action-type="CHI_TIET_VIDEO_BTN_SAVE"]').trigger('click');
		}
	});

	/* Xử lý sự kiện click button xong */
	$('#{{ $sectionId }}_BTN_DONE').on('click', function(e) {
		let $danhSachColCardItem = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO #{{ $sectionId }}_danhSachVideo').find('a.col-card-item');
		if (isEmpty($danhSachColCardItem) || $danhSachColCardItem.length == 0) {

		} else {
			for (let index = 0; index < $danhSachColCardItem.length; index++) {
				let {{ $sectionId }}_documentStorageId = $($danhSachColCardItem[index]).attr('data-document-storage-id');
				if (!isNumber({{ $sectionId }}_documentStorageId)) {
					// Nếu chưa upload xong thì throw ra lỗi
					showToastInfo('top-right', 'Video đang trong quá trình upload. Vui lòng đợi!');
					return;
				}
			}
		}

		{{ $sectionId }}_mustClosePopup = true;

		// Remove all append input upload multiple Video
		{{ $sectionId }}_removeAllAppendInputUploadMultipleVideo();
		// Append input upload multiple Video
		{{ $sectionId }}_appendInputUploadMultipleVideo({{ $sectionId }}_getDanhSachUploadMultipleVideo_UI());

		// Call back
		{{ $sectionId }}_callBackUploadMultipleVideo({{ $sectionId }}_getDanhSachUploadMultipleVideo_UI());

		// Đóng popup
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').modal('toggle');
	});

	/* Get array document storage */
	{{ $sectionId }}_getDanhSachUploadMultipleVideo_UI = function() {
		let arrDanhSachVideoUpload = [];;
		let $danhSachColCardItem = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO #{{ $sectionId }}_danhSachVideo').find('a.col-card-item');
		for (let index = 0; index < $danhSachColCardItem.length; index++) {
			let documentStorageId = $($danhSachColCardItem[index]).attr('data-document-storage-id');
			if (!isNumber(documentStorageId)) {
				continue;
			}
			
			let documentStorageName = $($danhSachColCardItem[index]).attr('data-document-storage-name');
			let documentStorageOriginalName = $($danhSachColCardItem[index]).attr('data-document-storage-original-name');
			let documentStorageType = $($danhSachColCardItem[index]).attr('data-document-storage-type');
			let documentStorageExtension = $($danhSachColCardItem[index]).attr('data-document-storage-extension');
			let documentStoragePath = $($danhSachColCardItem[index]).attr('data-document-storage-path');
			let documentStorageDirectory = $($danhSachColCardItem[index]).attr('data-document-storage-directory');
			let documentStorageSize = $($danhSachColCardItem[index]).attr('data-document-storage-size');
			let documentStorageStatus = $($danhSachColCardItem[index]).attr('data-document-storage-status');
			let documentStorageDescription = $($danhSachColCardItem[index]).attr('data-document-storage-description');
			let documentStorageImageThumnail = $($danhSachColCardItem[index]).attr('data-document-storage-image-thumnail');

			let objDocumentStorage = {
				ID: documentStorageId
				, NAME: documentStorageName
				, ORIGINAL_NAME: documentStorageOriginalName
				, TYPE_FILE: documentStorageType
				, EXTENSION: documentStorageExtension
				, PATH: documentStoragePath
				, DIRECTORY: documentStorageDirectory
				, SIZE: documentStorageSize
				, DESCRIPTION: documentStorageDescription
				, STATUS: documentStorageStatus
				, IMAGE_THUMNAIL: documentStorageImageThumnail
			}
			arrDanhSachVideoUpload.push(objDocumentStorage);
		}
		return arrDanhSachVideoUpload;
	}
	
	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').on('show.bs.modal', function(e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-footer').removeClass('disable-events').addClass('disable-events');

		{{ $sectionId }}_scrollPosition = 0; // Biến để lưu vị trí scroll của div Danh sách video
		{{ $sectionId }}_modeSectionVideo('DANH_SACH_VIDEO');
		// Scroll on top
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body').scrollTop(0);
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').on('shown.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-footer').removeClass('disable-events');
	});

	var {{ $sectionId }}_mustClosePopup = false;
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').on('hide.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');

		if ({{ $sectionId }}_mustClosePopup === true) {
			{{ $sectionId }}_mustClosePopup = false;
			return;
		}
		
		// Kiểm tra xem dữ liệu có đang bị thay đổi so với ban đầu không ?
		let arrColCard = $('#{{ $sectionId }}_danhSachVideo.list-card').find('a.col-card-item');
		let isAllowViewChiTiet = arrColCard
			.filter(function(index) {
				return $(arrColCard[index]).attr('data-document-storage-id') == '{-{DOCUMENT_STORAGE_ID}-}';
			}).length == 0;
		let isDataChanged = {{ $sectionId }}_isDataChangedUploadMultipleVideo();
		if (isDataChanged === true || isAllowViewChiTiet == false) {
			e.preventDefault(); // Ngăn modal không bị đóng. Ngăn hành động mặc định (trong trường hợp này là đóng modal) xảy ra.

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Đóng modal popup
					{{ $sectionId }}_mustClosePopup = true;
					$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').modal('toggle');
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Có dữ liệu thay đổi.<span style=\"display: inline-block;\"> Bạn có muốn đóng popup không?</span>");
		}
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').on('hidden.bs.modal', function(e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});

	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO').on('hidePrevented.bs.modal', function(e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});


	/* Xử lý event click các item trong list-card Video */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO #{{ $sectionId }}_danhSachVideo.list-card').on('click', function(e) {
		e.target;
		// Check xem đang click vào action type nào
		let actionType = e.target.getAttribute('action-type');

		let eleCurrTagA = e.target;
		let currSection = $(eleCurrTagA).closest('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .list-card .col-card .col-card-item');
		let dataUUID = currSection.attr('data-uuid');

		switch (actionType) {
			case 'item-delete': // Action type là click delete
				// Xử lý event xóa row Video
				{{ $sectionId }}_xoaRowVideo(currSection, dataUUID);
				break;
			case 'item-detail': // Action type là click chi tiết
				let isAllowViewChiTiet = $('#SECTION_' + dataUUID).find('a.col-card-item').attr('data-document-storage-id') != '{-{DOCUMENT_STORAGE_ID}-}';
				if (!isAllowViewChiTiet) {
					showToastInfo('top-right', 'Video đang trong quá trình upload. Vui lòng đợi!');
				} else {
					// Chi tiết Video
					{{ $sectionId }}_chiTietVideo(currSection, dataUUID);
				}
				break;
			case 'item-move-up': // Action type là move up
				{{ $sectionId }}_moveUpVideo(currSection, dataUUID);
				break;
			case 'item-move-down': // Action type là move down
				{{ $sectionId }}_moveDownVideo(currSection, dataUUID);
				break;
			default:
				break;
		}
	});

	/* Xóa row Video */
	{{ $sectionId }}_xoaRowVideo = function(currSection, dataUUID) {
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {

				// Xóa khỏi html
				$(currSection).closest('.col-card').remove();

				// Cập nhật số lượng Video
				let soLuongVideoUpload = $('#soLuongVideo').text();
				if (isNumber(soLuongVideoUpload)) {
					let currSoLuongVideo = parseInt(soLuongVideoUpload) - 1 <= 0 ? 0 : parseInt(soLuongVideoUpload) - 1;
					$('#soLuongVideo').text(currSoLuongVideo)
				}
			} else if (result.isDismissed === true) {} else if (result.isDenied === true) {}
		});
	}

	/* Chi tiết Video */
	{{ $sectionId }}_chiTietVideo = function(currSection, dataUUID) {
		if ({{ $sectionId }}_cropper) {
			{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
		}
		{{ $sectionId }}_mustChangeTab = false;
		
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietVideo();
		
		// Scroll top
		{{ $sectionId }}_scrollPosition = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body').scrollTop();

		let {{ $sectionId }}_documentStorageId = currSection.attr('data-document-storage-id');
		let {{ $sectionId }}_documentStorageName = currSection.attr('data-document-storage-name');
		let {{ $sectionId }}_documentStorageOriginalName = currSection.attr('data-document-storage-original-name');
		let {{ $sectionId }}_documentStorageType = currSection.attr('data-document-storage-type');
		let {{ $sectionId }}_documentStorageExtension = currSection.attr('data-document-storage-extension');
		let {{ $sectionId }}_documentStoragePath = currSection.attr('data-document-storage-path');
		let {{ $sectionId }}_documentStorageDirectory = currSection.attr('data-document-storage-directory');
		let {{ $sectionId }}_documentStorageSize = currSection.attr('data-document-storage-size');
		let {{ $sectionId }}_documentStorageStatus = currSection.attr('data-document-storage-status');
		let {{ $sectionId }}_documentStorageDesc = currSection.attr('data-document-storage-description');
		let {{ $sectionId }}_documentStorageImageThumnail = currSection.attr('data-document-storage-image-thumnail');

		if ({{ $sectionId }}_cropper) {
			{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
		}
		{{ $sectionId }}_showCropperVideo(false);
		
		// Thay đổi Video
		// Video {{ $aspectRatio }}
		$('#{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}').show();
		let image = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}');
		let srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + '{{ $aspectRatio }}_' + {{ $sectionId }}_documentStorageImageThumnail;
		image.src = srcImg + '?time=' + new Date().getTime();

		// Video RAW
		$('#{{ $sectionId }}_CHI_TIET_VIDEO_RAW').show();
		let imageRaw = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_RAW');
		let srcImgRaw = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageImageThumnail;
		imageRaw.src = srcImgRaw + '?time=' + new Date().getTime();
		
		// Video player
		try {
			let srcVideoPlay = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageName;
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY_SOURCE').attr('src', srcVideoPlay + '?time=' + new Date().getTime());
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY')[0].load();
		} catch (error) {
			
		}

		// Cập nhật thông tin chi tiết Video
		{{ $sectionId }}_modeSectionVideo('CHI_TIET_VIDEO');

		// Thêm chi tiết Video
		$('#{{ $sectionId }}_EDIT_TEN_VIDEO').val(replaceLastExtension({{ $sectionId }}_documentStorageOriginalName, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_VIDEO').text('.' + {{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_MO_TA').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID').val(dataUUID);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID').val({{ $sectionId }}_documentStorageId);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ORIGINAL_NAME').val({{ $sectionId }}_documentStorageOriginalName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_NAME').val({{ $sectionId }}_documentStorageName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DESCRIPTION').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_EXTENSION').val({{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_TYPE').val({{ $sectionId }}_documentStorageType);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_PATH').val({{ $sectionId }}_documentStoragePath);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DIRECTORY').val({{ $sectionId }}_documentStorageDirectory);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_SIZE').val({{ $sectionId }}_documentStorageSize);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_IMAGE_THUMNAIL').val({{ $sectionId }}_documentStorageImageThumnail);
	}

	/* Move up Video */
	{{ $sectionId }}_moveUpVideo = function(currSection, dataUUID) {
		let currCard = $(currSection).closest('.col-card');
		let prevCard = currCard.prev();

		if (prevCard == null || prevCard.length == 0) {
			showToastInfo('top-right', 'Hiện tại đã là vị trí đầu tiên');
			return;
		}

		// Tạo 2 div tạm thời để thay thế vị trí
		let tmpCurrCard = currCard.clone();
		let tmpPrevCard = prevCard.clone();

		// Replace section position
		currCard.replaceWith(tmpPrevCard);
		prevCard.replaceWith(tmpCurrCard);

		// Ẩn button dropdown
		let $btnAction = $("#" + $(currSection).attr('data-uuid') + "_DROP_DOWN_MENU_ICON_BTN");
		let $sectionAction = $("#" + $(currSection).attr('data-uuid') + "_SECTION_DROP_DOWN_MENU_ICON_BTN");
		$btnAction.removeClass('show');
		$btnAction.attr('aria-expanded', 'false');
		$sectionAction.removeClass('show');

		let $cardItem = $('#SECTION_' + dataUUID).find('a.col-card-item .card-body .col-item.item-header');
		$cardItem.removeClass('border-focus').addClass('border-focus');

		// Scroll to element
		scrollToElement($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO'), $cardItem, true);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('border-focus');
		}, 500);
	}

	/* Move down Video */
	{{ $sectionId }}_moveDownVideo = function(currSection, dataUUID) {
		let currCard = $(currSection).closest('.col-card');
		let nextCard = currCard.next();

		if (nextCard == null || nextCard.length == 0) {
			showToastInfo('top-right', 'Hiện tại đã là vị trí cuối cùng');
			return;
		}

		// Tạo 2 div tạm thời để thay thế vị trí
		let tmpCurrCard = currCard.clone();
		let tmpNextCard = nextCard.clone();

		// Replace section position
		currCard.replaceWith(tmpNextCard);
		nextCard.replaceWith(tmpCurrCard);

		// Ẩn hộp thả xuống
		let $btnAction = $("#" + $(currSection).attr('data-uuid') + "_DROP_DOWN_MENU_ICON_BTN");
		let $sectionAction = $("#" + $(currSection).attr('data-uuid') + "_SECTION_DROP_DOWN_MENU_ICON_BTN");
		$btnAction.removeClass('show');
		$btnAction.attr('aria-expanded', 'false');
		$sectionAction.removeClass('show');

		let $cardItem = $('#SECTION_' + dataUUID).find('a.col-card-item .card-body .col-item.item-header');
		$cardItem.removeClass('border-focus').addClass('border-focus');

		// Scroll to element
		scrollToElement($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO'), $cardItem, true);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('border-focus');
		}, 500);
	}

	/* Go back Danh sách video */
	{{ $sectionId }}_goBackDanhSachVideo = function() {
		{{ $sectionId }}_modeSectionVideo('DANH_SACH_VIDEO');
	}

	/**
	 * Mode section Video
	 * 
	 * mode: DANH_SACH_VIDEO hoặc CHI_TIET_VIDEO
	 */
	{{ $sectionId }}_modeSectionVideo = function(mode) {
		if (isEmpty(mode)) return;

		if (mode === 'DANH_SACH_VIDEO') {
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_LABEL').text('Danh sách video');
			$("[name='{{ $sectionId }}_SECTION_DANH_SACH_VIDEO']").show();
			$("[name='{{ $sectionId }}_SECTION_CHI_TIET_VIDEO']").hide();
		} else if (mode === 'CHI_TIET_VIDEO') {
			$('#{{ $sectionId }}_tab-{{ $aspectRatio }}').tab('show'); // Active tab default
			
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO_LABEL').text('Chi tiết Video');
			$("[name='{{ $sectionId }}_SECTION_DANH_SACH_VIDEO']").hide();
			$("[name='{{ $sectionId }}_SECTION_CHI_TIET_VIDEO']").show();

			// Scroll on top
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body').scrollTop(0);
		}
	}

	/* Xử lý event click go back Danh sách video */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type='CHI_TIET_VIDEO_GO_BACK_BTN']").on('click', function(e) {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID').val();

		// Remove all card active
		$('a.col-card-item .card-body .col-item.item-header').removeClass('active');
		// Active card đang được chọn
		let $cardItem = $('#SECTION_' + uuid).find('a.col-card-item .card-body .col-item.item-header');
		$cardItem.removeClass('active').addClass('active');

		{{ $sectionId }}_goBackDanhSachVideo();

		// Stop video
		$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY')[0].pause(); // Dừng video
		$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY')[0].currentTime = 0; // Đặt lại video về đầu

		// Scroll to element
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body').scrollTop({{ $sectionId }}_scrollPosition);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('active');
		}, 300);
	});

	/* Xử lý reset all input data */
	function {{ $sectionId }}_resetAllInputChiTietVideo() {
		// Tất cả input ngoại trừ checkbox và radio button
		$('[id^="EDIT_"]').not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).val(null).trigger('change');
		});
	}

	/* Reset all messages sản phẩm */
	{{ $sectionId }}_resetAllMsgChiTietVideo = function() {
		$('[name="{{ $sectionId }}_SECTION_CHI_TIET_VIDEO"]').find($('[id^="MSG_"]')).not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).text('');
		});
	}

	/* Xử lý event refresh */
	{{ $sectionId }}_handleRefreshChiTietVideo = function() {
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietVideo();

		// Scroll on top
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body').scrollTop(0);
	}

	/* Get data chi tiết Video từ Form UI */
	function {{ $sectionId }}_getDatasFormUIChiTietVideo() {
		let id = {
			key: null,
			type_key: null,
			value: null
		};
		let tenVideo = {
			key: null,
			type_key: null,
			value: null
		};
		let moTa = {
			key: null,
			type_key: null,
			value: null
		};

		id.key = "{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID";
		id.type_key = "ID";
		id.value = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID').val() : null;

		tenVideo.key = "{{ $sectionId }}_EDIT_TEN_VIDEO";
		tenVideo.type_key = "ID";
		tenVideo.value = !isEmpty($('#{{ $sectionId }}_EDIT_TEN_VIDEO').val()) ?
			$('#{{ $sectionId }}_EDIT_TEN_VIDEO').val() + '.' + $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_EXTENSION').val() : null;

		moTa.key = "{{ $sectionId }}_EDIT_MO_TA";
		moTa.type_key = "ID";
		moTa.value = !isEmpty($('#{{ $sectionId }}_EDIT_MO_TA').val()) ? $('#{{ $sectionId }}_EDIT_MO_TA').val() : null;

		return {
			id,
			tenVideo,
			moTa
		}
	}

	/* Validate chi tiết Video */
	function {{ $sectionId }}_validateChiTietVideo() {
		let isValid = true;
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietVideo();

		let {
			id,
			tenVideo,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietVideo();

		if (isEmpty(id.value)) {
			isValid = false;
			$('#MSG_' + id.key).text('Id Video không được để trống.');
		}

		if (isEmpty(tenVideo.value)) {
			isValid = false;
			$('#MSG_' + tenVideo.key).text('Tên Video không được để trống.');
		}

		return isValid;
	}

	/* Xử lý event undo chi tiết Video */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type='CHI_TIET_VIDEO_BTN_UNDO']").on('click', function(e) {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID').val();
		// Get thông tin ban đầu của Video (Lưu trước đó)
		let originalTenVideo = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ORIGINAL_NAME').val() || '';
		let originalTypeVideo = '.' + ($('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_EXTENSION').val() || '');
		let originalMoTa = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DESCRIPTION').val() || '';

		$('#{{ $sectionId }}_EDIT_TEN_VIDEO').val(replaceLastExtension(originalTenVideo, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_VIDEO').text(originalTypeVideo);
		$('#{{ $sectionId }}_EDIT_MO_TA').val(originalMoTa);
	});

	/* Xử lý lưu chi tiết Video */
	function {{ $sectionId }}_saveChiTietVideo() {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID').val();
		let {
			id,
			tenVideo,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietVideo();

		// Validate
		if ({{ $sectionId }}_validateChiTietVideo() == false) {
			scrollMsgInSection($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body'), true);
			return;
		}

		// Create object data
		var data = {
			TEN_VIDEO: tenVideo.value,
			MO_TA: moTa.value
		};

		$.ajax({
			type: "POST",
			url: '{{ url("/api/document-storage/video/update") }}' + "/" + id.value,
			contentType: "application/json",
			showLoading: true,
			data: JSON.stringify(data),
			success: function(data, textStatus, request) {
				// Ajax call completed successfully 
				showToastSuccess('top-right', data.STATUS_DETAIL);

				// Cập nhật input id
				$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID').val(data.DATAS.DOCUMENT_STORAGE.ID);
				// Cập nhật thông tin Video vừa update
				let $colCardItem = $('#SECTION_' + uuid).find('.col-card-item');
				$colCardItem.attr('data-document-storage-id', data.DATAS.DOCUMENT_STORAGE.ID);
				$colCardItem.attr('data-document-storage-name', data.DATAS.DOCUMENT_STORAGE.NAME);
				$colCardItem.attr('data-document-storage-original-name', data.DATAS.DOCUMENT_STORAGE.ORIGINAL_NAME);
				$colCardItem.attr('data-document-storage-type', data.DATAS.DOCUMENT_STORAGE.TYPE_FILE);
				$colCardItem.attr('data-document-storage-extension', data.DATAS.DOCUMENT_STORAGE.EXTENSION);
				$colCardItem.attr('data-document-storage-path', data.DATAS.DOCUMENT_STORAGE.PATH);
				$colCardItem.attr('data-document-storage-directory', data.DATAS.DOCUMENT_STORAGE.DIRECTORY);
				$colCardItem.attr('data-document-storage-size', data.DATAS.DOCUMENT_STORAGE.SIZE);
				$colCardItem.attr('data-document-storage-status', data.DATAS.DOCUMENT_STORAGE.STATUS);
				$colCardItem.attr('data-document-storage-description', data.DATAS.DOCUMENT_STORAGE.DESCRIPTION);
				$colCardItem.attr('data-document-storage-image-thumnail', data.DATAS.DOCUMENT_STORAGE.IMAGE_THUMNAIL);

				// Cập nhật tên Video
				let $itemTenVideo = $('#SECTION_' + uuid).find('.col-card-item .col-description h6');
				$itemTenVideo.text(data.DATAS.DOCUMENT_STORAGE.ORIGINAL_NAME);
				

			},
			error: function(request, textStatus, errorThrown) {
				try {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON && !isEmpty(request.responseJSON.STATUS_DETAIL) ? request.responseJSON.STATUS_DETAIL : 'Internal server');

					// Set error msg
					var errors = request.responseJSON != null ? request.responseJSON.ERRORS : null;
					// Looping các key của error messages
					for (let key in errors) {
						if (errors.hasOwnProperty(key)) {
							// Lopping danh sách lỗi
							let keyVals = errors[key];
							let errorMsg = '';
							for (var i in keyVals) {
								let keyVal = keyVals[i];
								errorMsg += keyVal;
								if (i < keyVals.length - 1) errorMsg += ' ';
							}

							// Set error message
							$('#MSG_{{ $sectionId }}_' + key.replaceAll('.', '\\.')).text(errorMsg);
							switch (key) {
								case 'TEN_VIDEO':
									$('#MSG_{{ $sectionId }}_' + tenVideo.key).text(errorMsg);
									break;
								case 'MO_TA':
									$('#MSG_{{ $sectionId }}_' + moTa.key).text(errorMsg);
									break;
								default:
									break;
							}
						}
					}
				} catch (err) {
					// Block of code to handle errors
					showToastFailure('top-right', 'Internal server');
				} finally {
					// Khối mã sẽ được thực thi bất kể kết quả thành công hay lỗi
					// Scroll message lỗi
					scrollMsgInSection($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-body'), true);
				}

			},
			complete: function() {}
		});
	}

	/* Xử lý event lưu chi tiết Video */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type='CHI_TIET_VIDEO_BTN_SAVE']").on('click', function(e) {
		{{ $sectionId }}_saveChiTietVideo();
	});

	/* Xử lý event crop Video {{ $aspectRatio }} */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_CHINH_SUA"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_CHINH_SUA"]'
	).on('click', function (e) {
		// Kiểm tra nếu {{ $sectionId }}_cropper đã được khởi tạo và hủy nó
		if ({{ $sectionId }}_cropper) {
			{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
		}
		
		// Get thông tin Video
		let {{ $sectionId }}_documentStorageDirectory = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DIRECTORY').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_DIRECTORY').val() : '';
		let {{ $sectionId }}_documentStorageImageThumnail = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_IMAGE_THUMNAIL').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_IMAGE_THUMNAIL').val() : '';

		// Get type kích thước Video
		let typeKichThuocVideo = $(e.target).attr('data-action-type') || '';
		let kichThuocCropAnh = 3/2; // default 3x2
		let image, srcImg = null;
		if (typeKichThuocVideo === 'CROP_RAW_BTN_CHINH_SUA') { // Ảnh gốc
			kichThuocCropAnh = NaN;
			image = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_RAW');
			srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageImageThumnail;
		} else { // Ảnh kích thước {{ $aspectRatio }}
			kichThuocCropAnh = {{ $ratio }};
			image = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_{{ $aspectRatio }}');
			srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageImageThumnail;
		}
		image.src = srcImg + '?time=' + new Date().getTime();
		image.onload = function() {
			{{ $sectionId }}_showCropperVideo(true);
			
			/* viewMode: Quy định cách {{ $sectionId }}_cropper hiển thị Video và khung crop.
				+ viewMode: 0: Không hạn chế, Video có thể nhỏ hơn vùng chứa. Có thể crop ra bên ngoài Video
				+ viewMode: 1: Giữ cho Video luôn bao phủ toàn bộ vùng chứa (ít nhất chiều rộng hoặc chiều cao).
				+ viewMode: 2: Giữ cho Video luôn bao phủ toàn bộ vùng chứa mà không được nhỏ hơn khung crop.
				+ viewMode: 3: Tương tự viewMode: 2, nhưng hạn chế việc crop chỉ trong giới hạn Video. 
			*/
			/* dragMode:
				+ 'none': Vô hiệu hóa tính năng kéo thả Video, chỉ cho phép di chuyển hoặc thay đổi kích thước khung crop. Các tùy chọn khác:
				+ 'move': Cho phép kéo Video.
				+ 'crop': Kéo để tạo khung crop mới. 
			*/
			/* autoCropArea:
				+ Từ 0 đến 1: phần trăm kích thước crop. Default: 0.8 tức 80%
			*/
			{{ $sectionId }}_cropper = new Cropper(image, {
				aspectRatio: kichThuocCropAnh, // Đặt tỷ lệ khung cắt (crop box)
				autoCropArea: 1, // Từ 0 đến 1. Xác định kích thước vùng cắt xén tự động (phần trăm). => 100%

				viewMode: 0, //  Giữ cho Video luôn bao phủ toàn bộ vùng chứa (ít nhất chiều rộng hoặc chiều cao)
				
				dragMode: 'none', // Vô hiệu hóa tính năng kéo thả Video, chỉ cho phép di chuyển hoặc thay đổi kích thước khung crop
				responsive: true, // Đảm bảo Video và khung crop sẽ tự động thay đổi kích thước khi thay đổi kích thước cửa sổ trình duyệt.
				
				zoomable: true, // Cho phép phóng to/thu nhỏ Video bằng các phương thức zoom
				zoomOnWheel: false, // Tắt phóng to/thu nhỏ bằng con lăn chuột
				zoomOnTouch: false, // Tắt zoom bằng cảm ứng
	
				cropBoxMovable: true,  // Cho phép di chuyển khung crop mà không làm di chuyển Video.
				cropBoxResizable: true, // Cho phép thay đổi kích thước khung crop (kéo các góc hoặc cạnh để điều chỉnh kích thước).
				
				ready: function () {
					// Nên đặt dữ liệu crop box trước ở đây
				},
				
				crop(event) {
					// Hàm callback được kích hoạt mỗi khi có sự thay đổi về việc cắt ảnh.
					// Các thông tin về quá trình cắt được trả về thông qua đối tượng event.detail
					console.log("x :" + event.detail.x);
					console.log("y :" + event.detail.y);
					console.log("width :" + event.detail.width);
					console.log("height :" + event.detail.height);
					console.log("rotate :" + event.detail.rotate);
					console.log("scaleX :" + event.detail.scaleX);
					console.log("scaleY :" + event.detail.scaleY);
				},

				zoom: function (e) { //	Sự kiện zoom in/ zoom out
					console.log(e.type, e.detail.ratio);
				}
			});
		}
		
		// Gán sự kiện error cho đối tượng Image
		image.onerror = function() {
			if ({{ $sectionId }}_cropper) {
				{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
			}
			{{ $sectionId }}_showCropperVideo(false);
		};
		
	});

	/* Xử lý event lưu Video đã crop */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type='CROP_{{ $aspectRatio }}_BTN_CROP_AND_SAVE'], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type='CROP_RAW_BTN_CROP_AND_SAVE']").on('click', function(e) {
		let originalImgName = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ORIGINAL_NAME').val() || '';
		let extensionImg = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_EXTENSION').val() || ''; //png

		// Get type kích thước Video
		let typeKichThuocVideo = $(e.target).attr('data-action-type') || '';
		
		let {
			id,
			tenVideo,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietVideo();
		
		if (isEmpty(originalImgName) || isEmpty(extensionImg) || !{{ $sectionId }}_cropper || !{{ $sectionId }}_cropper.getCroppedCanvas()) {
			return;
		}
		// Lấy Video đã cắt dưới dạng canvas
        const croppedCanvas = {{ $sectionId }}_cropper.getCroppedCanvas();

		// Tạo canvas mới với kích thước của ảnh cắt (crop box)
		const newCanvas = document.createElement('canvas');
   	 	newCanvas.width = croppedCanvas.width;
    	newCanvas.height = croppedCanvas.height;
	
		// Lấy ngữ cảnh vẽ của canvas mới
		const ctx = newCanvas.getContext('2d');
		// Đổ nền trắng vào toàn bộ canvas
		ctx.fillStyle = "#ffffff";  // Màu trắng
   	 	ctx.fillRect(0, 0, newCanvas.width, newCanvas.height);
		// Vẽ ảnh đã cắt lên canvas mới
		ctx.drawImage(croppedCanvas, 0, 0);
		
		// Chuyển canvas thành Blob
		newCanvas.toBlob(function(blob) {
			// Tạo đối tượng FormData để chứa dữ liệu Blob
			const formData = new FormData();
			formData.append('FILE', blob, originalImgName); // Tên file

			if (typeKichThuocVideo === 'CROP_RAW_BTN_CROP_AND_SAVE') { // Ảnh gốc
				formData.append('KICH_THUOC_HINH_ANH', 'raw');
			} else { // Ảnh kích thước {{ $aspectRatio }}
				formData.append('KICH_THUOC_HINH_ANH', '{{ $aspectRatio }}');
			}

			// Call api upload multiple files
			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: '{{ url("/api/document-storage/hinh-anh-dai-dien-video/crop") }}' + "/" + id.value,
				data: formData,
				showLoading: true,

				// Ngăn jQuery tự động chuyển đổi data thành chuỗi query
				processData: false,
				contentType: false,
				cache: false,
				timeout: 1000000,
				success: function(data, textStatus, jqXHR) {
					// Ajax call completed successfully 
					showToastSuccess('top-right', data.STATUS_DETAIL);

					// Cập nhật input id
					$('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_ID').val(data.DATAS.DocumentStorage.ID);
					
					// Cập nhật Video sau khi crop
					if (typeKichThuocVideo === 'CROP_RAW_BTN_CROP_AND_SAVE') { // Ảnh gốc
						let image = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_RAW');
						let srcImg = '{{asset('') }}' + data.DATAS.DocumentStorage.DIRECTORY + '/' + data.DATAS.DocumentStorage.IMAGE_THUMNAIL;
						image.src = srcImg + '?time=' + new Date().getTime();
					} else { // Ảnh kích thước {{ $aspectRatio }}
						let image = document.getElementById('{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}');
						let srcImg = '{{asset('') }}' + data.DATAS.DocumentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + data.DATAS.DocumentStorage.IMAGE_THUMNAIL;
						image.src = srcImg + '?time=' + new Date().getTime();

						// Video ngoài Danh sách video upload
						let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_VIDEO_UUID').val();
						let $cardItem = $('#SECTION_' + uuid).find('a.col-card-item .card-body .col-item.item-header');
						let $thumnailImg = $cardItem.find('.col-img > img');
						$thumnailImg.attr('src', srcImg + '?time=' + new Date().getTime());
					}

				},
				error: function(request, textStatus, errorThrown) {
					// Some error in ajax call 
					if (request && request.responseJSON && request.responseJSON.STATUS_DETAIL)
						showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				},
				complete: function() {
					if ({{ $sectionId }}_cropper) {
						{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
					}
					{{ $sectionId }}_showCropperVideo(false);
				}
			});
		});
	});

	/* Xử lý event zoom in */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_ZOOM_IN"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_ZOOM_IN"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}

		const rawMaxHeightImg = 250;
		let heightImgZoomIn = {{ $sectionId }}_cropper.getImageData().height;
		if ((heightImgZoomIn / rawMaxHeightImg) < 2) {
			{{ $sectionId }}_cropper.zoom(0.08); // Zoom in hệ số 0,08
		}
		
	});

	/* Xử lý event zoom out */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_ZOOM_OUT"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_ZOOM_OUT"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		
		const rawMaxHeightImg = 250;
		let heightImgZoomOut = {{ $sectionId }}_cropper.getImageData().height;
		if ((rawMaxHeightImg / heightImgZoomOut) < 2) {
			{{ $sectionId }}_cropper.zoom(-0.08); // Zoom in hệ số -0,08
		}
	});

	/* Xử lý event xoay trái */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_XOAY_TRAI"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_XOAY_TRAI"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.rotate(-45); // Xoay trái 45 độ
	});

	/* Xử lý event xoay phải */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_XOAY_PHAI"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_XOAY_PHAI"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.rotate(45); // Xoay phải 45 độ
	});

	/* Xử lý event gương ngang */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_GUONG_NGANG"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_GUONG_NGANG"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.scaleX(-1 * {{ $sectionId }}_cropper.getImageData().scaleX);
	});

	/* Xử lý event gương dọc */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_GUONG_DOC"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_GUONG_DOC"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.scaleY(-1 * {{ $sectionId }}_cropper.getImageData().scaleY);
	});

	/* Xử lý event reset crop */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_CROP_RESET"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_CROP_RESET"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.reset();
	});

	/* Xử lý event hủy crop */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_{{ $aspectRatio }}_BTN_CROP_HUY"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [data-action-type="CROP_RAW_BTN_CROP_HUY"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.destroy();
		{{ $sectionId }}_showCropperVideo(false);
	});
	
	/* Xử lý Ẩn/Hiện {{ $sectionId }}_cropper Video */
	{{ $sectionId }}_showCropperVideo = function(isHienThi) {
		if (isHienThi === true) {
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}').hide();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_{{ $aspectRatio }}').show();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_RAW').hide();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_RAW').show();
			
			$('#{{ $sectionId }}_EDIT_TEN_VIDEO, #{{ $sectionId }}_EDIT_MO_TA').closest('.section-block').hide();
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-footer').hide();
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .icon.go-back').hide();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY').closest('.section-block').hide();

			// Show hide button tương ứng
			$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [name='{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA']").hide();
			$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [name='{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER']").show();
		} else {
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_{{ $aspectRatio }}').show();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_{{ $aspectRatio }}').hide();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_RAW').show();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_CROPPER_RAW').hide();


			$('#{{ $sectionId }}_EDIT_TEN_VIDEO, #{{ $sectionId }}_EDIT_MO_TA').closest('.section-block').show();
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .modal-footer').show();
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO .icon.go-back').show();
			$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY').closest('.section-block').show();

			// Show hide button tương ứng
			$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [name='{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA']").show();
			$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO [name='{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER']").hide();
		}
	}

	/* Xử lý event chuyển tab */
	var {{ $sectionId }}_mustChangeTab = false;
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_VIDEO #{{ $sectionId }}_TAB_KICH_THUOC_VIDEO').on('show.bs.tab', function(e) {
		if ({{ $sectionId }}_mustChangeTab === true) {
			{{ $sectionId }}_mustChangeTab = false;
			return;
		}
		// Tab hiện tại
		const $fromTab = $(e.relatedTarget);

		// Tab đích
		const $toTab = $(e.target);

		// Kiểm tra xem có đang crop Video không. Nếu có thì hỏi xác nhận trước khi chuyển tab
		if ({{ $sectionId }}_cropper && !isEmpty({{ $sectionId }}_cropper.getImageData())
			&& !isEmpty(({{ $sectionId }}_cropper.getCropBoxData()))
		) {
			e.preventDefault(); // Ngăn chuyển tab. Giữ nguyên tab cũ

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Cho phép chuyển tab
					{{ $sectionId }}_mustChangeTab = true;
					$toTab.tab('show');

					// Xử lý trigger click hủy crop Video tương ứng
					$($fromTab.attr('href')).find('button[data-group-action-type="CROP_BTN_CROP_HUY"]').click();
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Video đang chỉnh sửa.<span style=\"display: inline-block;\"> Bạn có muốn chuyển tab không?</span>");

		}
		
	});

	/* Remove all append input upload multiple Video */
	{{ $sectionId }}_removeAllAppendInputUploadMultipleVideo = function() {
		// Remove all element bên trong form
		$('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_VIDEO').html('');
	}
	
	/* Xử lý append input upload multiple Video */
	{{ $sectionId }}_appendInputUploadMultipleVideo = function(arrDocumentStorage) {
		// Tạo danh sách input vào form
		if (isEmpty(arrDocumentStorage)) return;
		for (let index = 0; index < arrDocumentStorage.length; index++) {
				// Tạo input
				$('<input>').attr({
					id: '{{ $sectionId}}_' + arrDocumentStorage[index].ID
					, value: arrDocumentStorage[index].ID
					, 'data-document-storage-id': arrDocumentStorage[index].ID
					, 'data-document-storage-name': isEmpty(arrDocumentStorage[index].NAME) ? '' : arrDocumentStorage[index].NAME
					, 'data-document-storage-original-name': isEmpty(arrDocumentStorage[index].ORIGINAL_NAME) ? '' : arrDocumentStorage[index].ORIGINAL_NAME
					, 'data-document-storage-type': isEmpty(arrDocumentStorage[index].TYPE_FILE) ? '' : arrDocumentStorage[index].TYPE_FILE
					, 'data-document-storage-extension': isEmpty(arrDocumentStorage[index].EXTENSION) ? '' : arrDocumentStorage[index].EXTENSION
					, 'data-document-storage-path': isEmpty(arrDocumentStorage[index].PATH) ? '' : arrDocumentStorage[index].PATH
					, 'data-document-storage-directory': isEmpty(arrDocumentStorage[index].DIRECTORY) ? '' : arrDocumentStorage[index].DIRECTORY
					, 'data-document-storage-size': isEmpty(arrDocumentStorage[index].SIZE) ? '' : arrDocumentStorage[index].SIZE
					, 'data-document-storage-description': isEmpty(arrDocumentStorage[index].DESCRIPTION) ? '' : arrDocumentStorage[index].DESCRIPTION
					, 'data-document-storage-status': isEmpty(arrDocumentStorage[index].STATUS) ? '' : arrDocumentStorage[index].STATUS
					, 'data-document-storage-image-thumnail': isEmpty(arrDocumentStorage[index].IMAGE_THUMNAIL) ? '' : arrDocumentStorage[index].IMAGE_THUMNAIL
				}).appendTo('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_VIDEO');
		}
	}

	/* Xử lý set data Danh sách video */
	{{ $sectionId }}_setDataDanhSachVideo = function(arrDocumentStorage) {
		if (isEmpty(arrDocumentStorage)) return;

		for (let index = 0; index < arrDocumentStorage.length; index++) { // Looping
			let documentStorage = arrDocumentStorage[index];
			let uuid = generateRandomString(10);
			let srcImg = '{{asset('') }}' + documentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + documentStorage.IMAGE_THUMNAIL;
			
			// Create new row
			let templateRow = $('#{{ $sectionId }}_rowVideoTemplate').html();
			let newRow = templateRow.replaceAll('{-{NAME}-}', documentStorage.ORIGINAL_NAME)
									.replaceAll('{-{TAG_IMG}-}', 'img')
									.replaceAll('{-{SRC_IMG}-}', srcImg + '?time=' + new Date().getTime())
									.replaceAll('{-{UUID}-}', uuid);
			newRow = recoverTagHtml(newRow);
			
			// Append after div
			$('#{{ $sectionId }}_danhSachVideo').append(newRow);

			// Cập nhật attribute thông tin tin Video
			let $colCardItem = $('#SECTION_' + uuid).find('.col-card-item');
			$colCardItem.attr('data-document-storage-id', documentStorage.ID);
			$colCardItem.attr('data-document-storage-name', documentStorage.NAME);
			$colCardItem.attr('data-document-storage-original-name', documentStorage.ORIGINAL_NAME);
			$colCardItem.attr('data-document-storage-type', documentStorage.TYPE_FILE);
			$colCardItem.attr('data-document-storage-extension', documentStorage.EXTENSION);
			$colCardItem.attr('data-document-storage-path', documentStorage.PATH);
			$colCardItem.attr('data-document-storage-directory', documentStorage.DIRECTORY);
			$colCardItem.attr('data-document-storage-size', documentStorage.SIZE);
			$colCardItem.attr('data-document-storage-status', documentStorage.STATUS);
			$colCardItem.attr('data-document-storage-description', documentStorage.DESCRIPTION);
			$colCardItem.attr('data-document-storage-image-thumnail', documentStorage.IMAGE_THUMNAIL);
		
			let soLuongVideoUpload = $('#soLuongVideo').text();
			if (isNumber(soLuongVideoUpload)) {
				soLuongVideoUpload = parseInt(soLuongVideoUpload) + 1;
				$('#soLuongVideo').text(soLuongVideoUpload);
			}
		}
	}

	/* Xử lý get danh sách upload multiple Video */
	{{ $sectionId }}_getDanhSachUploadMultipleVideo = function() {
		let arrDanhSachVideoUpload = {
			'DANH_SACH_VIDEO': []
		};

		let $danhSachInput = $('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_VIDEO').find('input');
		let soThuTu = 0;
		for (let index = 0; index < $danhSachInput.length; index++) {
			let documentStorageId = $($danhSachInput[index]).attr('data-document-storage-id');
			if (!isNumber(documentStorageId)) {
				continue;
			}
			
			let documentStorageName = $($danhSachInput[index]).attr('data-document-storage-name');
			let documentStorageOriginalName = $($danhSachInput[index]).attr('data-document-storage-original-name');
			let documentStorageType = $($danhSachInput[index]).attr('data-document-storage-type');
			let documentStorageExtension = $($danhSachInput[index]).attr('data-document-storage-extension');
			let documentStoragePath = $($danhSachInput[index]).attr('data-document-storage-path');
			let documentStorageDirectory = $($danhSachInput[index]).attr('data-document-storage-directory');
			let documentStorageSize = $($danhSachInput[index]).attr('data-document-storage-size');
			let documentStorageStatus = $($danhSachInput[index]).attr('data-document-storage-status');
			let documentStorageDescription = $($danhSachInput[index]).attr('data-document-storage-description');
			let documentStorageImageThumnail = $($danhSachInput[index]).attr('data-document-storage-image-thumnail');

			let objDocumentStorage = {
				ID: documentStorageId
				, NAME: documentStorageName
				, ORIGINAL_NAME: documentStorageOriginalName
				, TYPE_FILE: documentStorageType
				, EXTENSION: documentStorageExtension
				, PATH: documentStoragePath
				, DIRECTORY: documentStorageDirectory
				, SIZE: documentStorageSize
				, ATTR1: 'DANH_SACH_VIDEO'
				, SORT_ORDER: soThuTu
				, DESCRIPTION: documentStorageDescription
				, STATUS: documentStorageStatus
				, IMAGE_THUMNAIL: documentStorageImageThumnail
			}
			arrDanhSachVideoUpload.DANH_SACH_VIDEO.push(objDocumentStorage);

			soThuTu++; // Tăng lên 1 đơn vị
		}
		return arrDanhSachVideoUpload;
	}

	$('#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY').on('play', function() {
		let video = $("#{{ $sectionId }}_CHI_TIET_VIDEO_PLAY")[0];
		video.muted = false; // Bật âm thanh
		video.play(); // Phát video
	});

});
</script>