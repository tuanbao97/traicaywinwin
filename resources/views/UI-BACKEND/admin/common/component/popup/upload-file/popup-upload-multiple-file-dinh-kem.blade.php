<style>
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section {
		min-height: 140px;
		border: 1px dashed #3b86d1b3;
		background-image: linear-gradient(180deg, white, #F1F6FF);
		border-radius: 2px;
		position: relative;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section div.col:first-child {
		opacity: 1;
		visibility: visible;
		transition-duration: 0.2s;
		transform: scale(1);
		width: 200px;
		margin: auto;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section div.col:last-child {
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
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drag-over-effect div.col:first-child {
		opacity: 0;
		visibility: hidden;
		pointer-events: none;
		transform: scale(1.1);
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drag-over-effect div.col:last-child {
		opacity: 1;
		visibility: visible;
		transform: scale(1);
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section .cloud-icon {
		margin-top: 25px;
		margin-bottom: 20px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section .cloud-icon img {
		width: 80px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section span,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section button {
		display: block;
		margin: auto;
		color: #707EA0;
		margin-bottom: 10px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section button {
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

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .drop-section input {
		display: none;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section {
		display: none;
		text-align: left;
		padding-bottom: 20px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section .list-title {
		font-size: 0.95rem;
		color: #707EA0;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li {
		display: flex;
		margin: 15px 0px;
		padding-top: 4px;
		padding-bottom: 2px;
		border-radius: 8px;
		transition-duration: 0.2s;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li:hover {
		box-shadow: #E3EAF9 0px 0px 4px 0px, #E3EAF9 0px 12px 16px 0px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col {
		flex: .1;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col:nth-child(1) {
		flex: .15;
		text-align: center;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col:nth-child(2) {
		flex: .75;
		text-align: left;
		font-size: 0.9rem;
		color: #3e4046;
		padding: 8px 10px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col:nth-child(2) div.name {
		overflow: hidden;
		white-space: nowrap;
		text-overflow: ellipsis;
		max-width: 250px;
		display: inline-block;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col .file-name span {
		color: #707EA0;
		float: right;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .file-progress {
		width: 100%;
		height: 5px;
		margin-top: 8px;
		border-radius: 8px;
		background-color: #dee6fd;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .file-progress span {
		display: block;
		width: 0%;
		height: 100%;
		border-radius: 8px;
		background-image: linear-gradient(120deg, #6b99fd, #9385ff);
		transition-duration: 0.4s;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col .file-size {
		font-size: 0.75rem;
		margin-top: 3px;
		color: #707EA0;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col svg.cross,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col svg.tick {
		fill: #8694d2;
		background-color: #dee6fd;
		position: relative;
		left: 50%;
		top: 50%;
		transform: translate(-50%, -50%);
		border-radius: 50%;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li .col svg.tick {
		fill: #50a156;
		background-color: transparent;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li.complete span,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li.complete .file-progress,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li.complete svg.cross {
		display: none;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li.in-prog .file-size,
	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-section li.in-prog svg.tick {
		display: none;
	}
</style>

<style>

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-dialog-scrollable .modal-content {
		height: 100%;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body {
		margin: unset;
		padding: unset;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .col-item {
		padding: 0.4rem 0.4rem;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-description {
		font-size: 1.035rem;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .col-description {
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

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .col-description h6 {
		/* white-space: nowrap; */
		overflow: hidden;
		text-overflow: ellipsis;

		display: -webkit-box;
		-webkit-line-clamp: 2;
		-webkit-box-orient: vertical;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .col-svg svg.icon-delete {
		color: #b2b2b2;
		background: transparent;
		height: 55px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .section-svg {
		display: inline-block;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .section-svg.section-svg-icon-delete {
		padding-right: 7px;
		padding-left: 7px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .card-body .col-svg svg.icon-next {
		color: #b2b2b2;
		background: transparent;
		margin-right: 5px;
		height: 18px;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body .item-header:hover {
		color: white;
		background: #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body .item-header.active {
		color: white;
		background: #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body .item-header.border-focus {
		box-shadow: inset 0 0 0 2px #3c9af9eb;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body .item-header.active .col-svg svg.icon-next {
		color: white;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body:hover .col-svg svg.icon-next {
		color: white;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .card.mb-3.card-body .col-svg .section-svg-icon-delete:hover svg.icon-delete {
		color: #dc3545;
	}

	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .mt-2.d-flex {
        flex-wrap: wrap;
    }

	@media (max-width: 767px) {
		#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .nav-tabs .nav-link {
			padding: .75rem 1.2rem;
		}

		#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .mt-2.d-flex .btn-group {
            margin-bottom: 0.5rem;
        }
	}
	@media (max-width: 415px) {
    	#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .nav-tabs .nav-link {
			padding: .75rem 0.75rem;
		}

	}
</style>

<!-- Modal starts -->
<div class="modal fade" id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM" tabindex="-1"
	role="dialog" aria-labelledby="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_LABEL"
	data-bs-keyboard="true"
	data-bs-backdrop="static">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 750px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
					<svg name="{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM" data-action-type="CHI_TIET_FILE_DINH_KEM_GO_BACK_BTN" style="display: none;" class="icon go-back" width="1.6em" height="1.6em" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="none" stroke-width="19.456">
						<g stroke-width="0"></g>
						<g stroke-linecap="round" stroke-linejoin="round"></g>
						<g>
							<path fill="#7b7b7b" d="M224 480h640a32 32 0 110 64H224a32 32 0 010-64z"></path>
							<path fill="#7b7b7b" d="M237.248 512l265.408 265.344a32 32 0 01-45.312 45.312l-288-288a32 32 0 010-45.312l288-288a32 32 0 1145.312 45.312L237.248 512z"></path>
						</g>
					</svg>
				</div>

				<h5 class="modal-title" id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_LABEL">Danh sách file đính kèm</h5>

				<!-- Thêm attr này vào btn để có thể đóng popup tự động data-bs-dismiss="modal" -->
				<button type="button"
					id="{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_CLOSE"
					class="close btn rounded-circle"
					aria-label="Close">
					<span>×</span>
				</button>
			</div>
			<div class="modal-body">
				<!-- Đây là trường input hidden khi upload thành công, call_back sẽ trả về -->
				<section id="{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_FILE_DINH_KEM" class="d-none">

				</section>
				
				<div class="row">
					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM">
						<p class="card-description" style="margin-bottom: 15px;">Hiện có: <span class="one-line"><span class="error-message" style="display: unset;"><span id="soLuongFileDinhKem">0</span></span> file đính kèm</span>
						</p>
					</div>
					
					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM">
						<div id="{{ $sectionId }}_danhSachFileDinhKem" class="row list-card">
						</div>

						<div class="row list-card d-none" id="{{ $sectionId }}_rowFileDinhKemTemplate">
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
													<{-{TAG_IMG}-} action-type="item-detail" src="{-{SRC_IMG}-}" id="{-{UUID}-}" class="width-60 aspect-ratio-1-1 rounded-2" alt="">
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

					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM" style="display: none;">
						<div class="card-body">
							<div class="row">
								<div class="section-block col-lg-12 col-md-12 d-none">
									<div class="form-group">
										<label for="{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM">Thông tin file đính kèm</label>
										<div class="input-group">
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_UUID" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_NAME" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ORIGINAL_NAME" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DESCRIPTION" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_EXTENSION" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_TYPE" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_PATH" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DIRECTORY" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_SIZE" placeholder=""></textarea>
											<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_IMAGE_THUMNAIL" placeholder=""></textarea>
										</div>
									</div>
								</div>
								<div class="section-block col-lg-12 col-md-12">
									<div class="form-group">
										<label for="{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM">Tên file đính kèm<code>*</code></label>
										<div class="input-group">
											<input type="text" class="form-control" id="{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM" placeholder="">
											<span class="input-group-text" id="{{ $sectionId }}_EDIT_TYPE_FILE_DINH_KEM">.JPG</span>
										</div>
										<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM"></span>
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
										<label for="{{ $sectionId }}_EDIT_TAI_XUONG">Tải xuống</label>
										<button type="button" style="display: block;" class="btn btn-action btn-success btn-icon-text"
											onclick="{{ $sectionId }}_downloadFiles()">
											<i class="fa fa-save btn-icon-prepend"></i>Tải file đính kèm
										</button>
										<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_TAI_XUONG"></span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xl-12" name="{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM">
						<div class="upload-multiple">
							<div class="drop-section">
								<div class="col text-center">
									<div class="cloud-icon">
										<img src="{{ asset('image/UI-BACKEND/upload.png') }}" alt="cloud">
									</div>
									<span>Upload tập tin</span>
									<!-- <span>Hoặc</span> -->
									<!-- <button class="file-selector">Chọn tập tin</button> -->
									<input type="file" class="file-selector-input" accept="*" multiple>
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
				<button id="{{ $sectionId }}_BTN_DONE" name="{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM" type="button" class="btn btn-info width-100-percent">XONG</button>

				<div class="justify-content-end" name="{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM" style="display: none !important;">
					<div class="action-web">
						<button type="button" data-action-type="CHI_TIET_FILE_DINH_KEM_GO_BACK_BTN" class="btn btn-light btn-icon-text me-1">
							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
						</button>

						<!--
						<button type="button" class="btn btn-outline-info btn-fw btn-icon-text me-1" data-action-type="CHI_TIET_FILE_DINH_KEM_BTN_UNDO">
							<i class="fa fa-refresh btn-icon-prepend"></i>Hoàn tác
						</button> 
						-->

						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_FILE_DINH_KEM_BTN_SAVE">
							<i class="fa fa-save btn-icon-prepend"></i>Lưu
						</button>
					</div>

					<div class="action-mobile">
						<button type="button" data-action-type="CHI_TIET_FILE_DINH_KEM_GO_BACK_BTN" class="btn btn-light btn-icon-text me-1">
							<i class="fa fa-caret-left btn-icon-prepend"></i>Quay về
						</button>

						<!--
						<button type="button" class="btn btn-outline-info btn-fw btn-icon-text me-1" data-action-type="CHI_TIET_FILE_DINH_KEM_BTN_UNDO">
							<i class="fa fa-refresh btn-icon-prepend"></i>Hoàn tác
						</button> 
						-->

						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_FILE_DINH_KEM_BTN_SAVE">
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
	const {{ $sectionId }}_dropArea = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .upload-multiple .drop-section')
	const {{ $sectionId }}_listSection = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .upload-multiple .list-section')
	const {{ $sectionId }}_listContainer = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .upload-multiple .list')
	const {{ $sectionId }}_fileSelector = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .upload-multiple .drop-section')
	const {{ $sectionId }}_fileSelectorInput = document.querySelector('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .upload-multiple .file-selector-input')

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
		/*
		var splitType = type.split('/')[0]
		if (type == 'application/pdf' || splitType == 'image' || splitType == 'FileDinhKem') {
			return true
		}
		*/
		return true;
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
		let size = `${(file.size/(1024*1024)).toFixed(2)} MB`;

		// Create new row
		let templateRow = $('#{{ $sectionId }}_rowFileDinhKemTemplate').html();
		let newRow = templateRow.replaceAll('{-{NAME}-}', `${file.name}`);

		if (true/*file.type.startsWith("FileDinhKem/")*/) {
			let srcImg = "{{asset('image/UI-BACKEND/loading.gif') }}";
			let uuid = generateRandomString(10);
			newRow = newRow.replaceAll('{-{TAG_IMG}-}', 'img')
							.replaceAll('{-{SRC_IMG}-}', srcImg)
							.replaceAll('{-{UUID}-}', uuid);
			newRow = recoverTagHtml(newRow);

			// Append after div
			$('#{{ $sectionId }}_danhSachFileDinhKem').append(newRow);

			let soLuongFileDinhKemUpload = $('#soLuongFileDinhKem').text();
			if (isNumber(soLuongFileDinhKemUpload)) {
				soLuongFileDinhKemUpload = parseInt(soLuongFileDinhKemUpload) + 1;
				$('#soLuongFileDinhKem').text(soLuongFileDinhKemUpload);
			}
			
			// Gọi API để tải file gốc lên (không bị thay đổi kích thước)
			{{ $sectionId }}_storageFileDinhKem(file, uuid, function callback(uuid, documentStorage) {
				let srcImg = '';
				if (!isEmpty(documentStorage)) { // Nếu tồn tại ảnh đại diện thì sẽ show lên
					srcImg = '{{asset('image/UI-BACKEND/default-file-upload.png') }}';
					$('#' + uuid).attr('src', srcImg);

					// Cập nhật attribute thông tin tin FileDinhKem
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

					// Cập nhật số lượng FileDinhKem
					let soLuongFileDinhKemUpload = $('#soLuongFileDinhKem').text();
					if (isNumber(soLuongFileDinhKemUpload)) {
						let currSoLuongFileDinhKem = parseInt(soLuongFileDinhKemUpload) - 1 <= 0 ? 0 : parseInt(soLuongFileDinhKemUpload) - 1;
						$('#soLuongFileDinhKem').text(currSoLuongFileDinhKem)
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
		formData.append('FILES[]', file);

		// Call api upload multiple files
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: '{{ url("/api/document-storage/upload-multiples-file") }}',
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
var {{ $sectionId }}_scrollPosition = 0; // Biến để lưu vị trí scroll của div Danh sách FileDinhKem
$(document).ready(function() {

	var {{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem = {
		key: null,
		type_key: null,
		value: null
	}
	var {{ $sectionId }}_arrDataInitialPopupUploadMultipleFileDinhKem = [];
	
	/* Xử lý set data initial ban đầu. Phục vụ cho việc check thay đổi dữ liệu sau này */
	function {{ $sectionId }}_setDataInitialPopupUploadMultipleFileDinhKem(arrDocumentStorage) {
		// Reset array data initial
		{{ $sectionId }}_arrDataInitialPopupUploadMultipleFileDinhKem = [];

		// Init default
		{{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem.key = "{{ $sectionId }}_DANH_SACH_FILE_DINH_KEM";
		{{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem.type_key = "ARRAY";
		{{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem.value = arrDocumentStorage;
		{{ $sectionId }}_arrDataInitialPopupUploadMultipleFileDinhKem.push({{ $sectionId }}_dataInitialPopupUploadMultipleFileDinhKem); // Push to array

		return {{ $sectionId }}_arrDataInitialPopupUploadMultipleFileDinhKem;
	}

	/* Set default data popup upload multiple FileDinhKem */
	function {{ $sectionId }}_initDefaultDataPopupMultipleFileDinhKem(arrDocumentStorage) {
		// Set data initial
		{{ $sectionId }}_setDataInitialPopupUploadMultipleFileDinhKem(arrDocumentStorage);
	}
	
	/* Kiểm tra data thay đổi */
	function {{ $sectionId }}_isDataChangedUploadMultipleFileDinhKem() {
		let isDataChanged = false;

		// Get datas từ UI
		let arrDocumentStorage = {{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem_UI();
		// Reset array data initial
		let {{ $sectionId }}_arrDataPopupUploadMultipleFileDinhKem = [];

		// Init default
		{{ $sectionId }}_dataPopupUploadMultipleFileDinhKem = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataPopupUploadMultipleFileDinhKem.key = "{{ $sectionId }}_DANH_SACH_FILE_DINH_KEM";
		{{ $sectionId }}_dataPopupUploadMultipleFileDinhKem.type_key = "ARRAY";
		{{ $sectionId }}_dataPopupUploadMultipleFileDinhKem.value = arrDocumentStorage;
		{{ $sectionId }}_arrDataPopupUploadMultipleFileDinhKem.push({{ $sectionId }}_dataPopupUploadMultipleFileDinhKem); // Push to array

		// So sánh
		for (let dataFormUI of {{ $sectionId }}_arrDataPopupUploadMultipleFileDinhKem) {
			for (let dataInitial of {{ $sectionId }}_arrDataInitialPopupUploadMultipleFileDinhKem) {
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
	{{ $sectionId }}_handleOpenPopupUploadMultipleFileDinhKem = function() {
		// Set default data popup upload multiple FileDinhKem
		{{ $sectionId }}_initDefaultDataPopupMultipleFileDinhKem({{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem().DANH_SACH_FILE_DINH_KEM);

		// Reset số lượng FileDinhKem
		$('#soLuongFileDinhKem').text(0);
		
		// Xử lý set data Danh sách FileDinhKem
		$('#{{ $sectionId }}_danhSachFileDinhKem').html('');
		// Get datas từ UI
		let danhSachFileDinhKem = {{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem().DANH_SACH_FILE_DINH_KEM;
		{{ $sectionId }}_setDataDanhSachFileDinhKem(danhSachFileDinhKem);
	}

	/* Button close đóng popup */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_CLOSE').on('click', function(e) {
		// Đóng modal popup
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').modal('toggle');
	});

	/* Xử lý sự kiện khi nhấn phím trên modal */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM div[name="{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM"]').keyup(function(event) {
		if (event.keyCode === 13) { // Nhấn phím ENTER
			if (event.target.type === 'textarea') return;
			$('button[data-action-type="CHI_TIET_FILE_DINH_KEM_BTN_SAVE"]').trigger('click');
		}
	});

	/* Xử lý sự kiện click button xong */
	$('#{{ $sectionId }}_BTN_DONE').on('click', function(e) {
		let $danhSachColCardItem = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM #{{ $sectionId }}_danhSachFileDinhKem').find('a.col-card-item');
		if (isEmpty($danhSachColCardItem) || $danhSachColCardItem.length == 0) {

		} else {
			for (let index = 0; index < $danhSachColCardItem.length; index++) {
				let {{ $sectionId }}_documentStorageId = $($danhSachColCardItem[index]).attr('data-document-storage-id');
				if (!isNumber({{ $sectionId }}_documentStorageId)) {
					// Nếu chưa upload xong thì throw ra lỗi
					showToastInfo('top-right', 'FileDinhKem đang trong quá trình upload. Vui lòng đợi!');
					return;
				}
			}
		}

		{{ $sectionId }}_mustClosePopup = true;

		// Remove all append input upload multiple FileDinhKem
		{{ $sectionId }}_removeAllAppendInputUploadMultipleFileDinhKem();
		// Append input upload multiple FileDinhKem
		{{ $sectionId }}_appendInputUploadMultipleFileDinhKem({{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem_UI());

		// Call back
		{{ $sectionId }}_callBackUploadMultipleFileDinhKem({{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem_UI());

		// Đóng popup
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').modal('toggle');
	});

	/* Get array document storage */
	{{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem_UI = function() {
		let arrDanhSachFileDinhKemUpload = [];;
		let $danhSachColCardItem = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM #{{ $sectionId }}_danhSachFileDinhKem').find('a.col-card-item');
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
			arrDanhSachFileDinhKemUpload.push(objDocumentStorage);
		}
		return arrDanhSachFileDinhKemUpload;
	}
	
	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').on('show.bs.modal', function(e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-footer').removeClass('disable-events').addClass('disable-events');

		{{ $sectionId }}_scrollPosition = 0; // Biến để lưu vị trí scroll của div Danh sách FileDinhKem
		{{ $sectionId }}_modeSectionFileDinhKem('DANH_SACH_FILE_DINH_KEM');
		// Scroll on top
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body').scrollTop(0);
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').on('shown.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-footer').removeClass('disable-events');
	});

	var {{ $sectionId }}_mustClosePopup = false;
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').on('hide.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');

		if ({{ $sectionId }}_mustClosePopup === true) {
			{{ $sectionId }}_mustClosePopup = false;
			return;
		}
		
		// Kiểm tra xem dữ liệu có đang bị thay đổi so với ban đầu không ?
		let arrColCard = $('#{{ $sectionId }}_danhSachFileDinhKem.list-card').find('a.col-card-item');
		let isAllowViewChiTiet = arrColCard
			.filter(function(index) {
				return $(arrColCard[index]).attr('data-document-storage-id') == '{-{DOCUMENT_STORAGE_ID}-}';
			}).length == 0;
		let isDataChanged = {{ $sectionId }}_isDataChangedUploadMultipleFileDinhKem();
		if (isDataChanged === true || isAllowViewChiTiet == false) {
			e.preventDefault(); // Ngăn modal không bị đóng. Ngăn hành động mặc định (trong trường hợp này là đóng modal) xảy ra.

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Đóng modal popup
					{{ $sectionId }}_mustClosePopup = true;
					$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').modal('toggle');
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Có dữ liệu thay đổi.<span style=\"display: inline-block;\"> Bạn có muốn đóng popup không?</span>");
		}
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').on('hidden.bs.modal', function(e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});

	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM').on('hidePrevented.bs.modal', function(e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});


	/* Xử lý event click các item trong list-card FileDinhKem */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM #{{ $sectionId }}_danhSachFileDinhKem.list-card').on('click', function(e) {
		e.target;
		// Check xem đang click vào action type nào
		let actionType = e.target.getAttribute('action-type');

		let eleCurrTagA = e.target;
		let currSection = $(eleCurrTagA).closest('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .list-card .col-card .col-card-item');
		let dataUUID = currSection.attr('data-uuid');

		switch (actionType) {
			case 'item-delete': // Action type là click delete
				// Xử lý event xóa row FileDinhKem
				{{ $sectionId }}_xoaRowFileDinhKem(currSection, dataUUID);
				break;
			case 'item-detail': // Action type là click chi tiết
				let isAllowViewChiTiet = $('#SECTION_' + dataUUID).find('a.col-card-item').attr('data-document-storage-id') != '{-{DOCUMENT_STORAGE_ID}-}';
				if (!isAllowViewChiTiet) {
					showToastInfo('top-right', 'FileDinhKem đang trong quá trình upload. Vui lòng đợi!');
				} else {
					// Chi tiết FileDinhKem
					{{ $sectionId }}_chiTietFileDinhKem(currSection, dataUUID);
				}
				break;
			case 'item-move-up': // Action type là move up
				{{ $sectionId }}_moveUpFileDinhKem(currSection, dataUUID);
				break;
			case 'item-move-down': // Action type là move down
				{{ $sectionId }}_moveDownFileDinhKem(currSection, dataUUID);
				break;
			default:
				break;
		}
	});

	/* Xóa row FileDinhKem */
	{{ $sectionId }}_xoaRowFileDinhKem = function(currSection, dataUUID) {
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {

				// Xóa khỏi html
				$(currSection).closest('.col-card').remove();

				// Cập nhật số lượng FileDinhKem
				let soLuongFileDinhKemUpload = $('#soLuongFileDinhKem').text();
				if (isNumber(soLuongFileDinhKemUpload)) {
					let currSoLuongFileDinhKem = parseInt(soLuongFileDinhKemUpload) - 1 <= 0 ? 0 : parseInt(soLuongFileDinhKemUpload) - 1;
					$('#soLuongFileDinhKem').text(currSoLuongFileDinhKem)
				}
			} else if (result.isDismissed === true) {} else if (result.isDenied === true) {}
		});
	}

	/* Chi tiết FileDinhKem */
	{{ $sectionId }}_chiTietFileDinhKem = function(currSection, dataUUID) {
		{{ $sectionId }}_mustChangeTab = false;
		
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietFileDinhKem();
		
		// Scroll top
		{{ $sectionId }}_scrollPosition = $('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body').scrollTop();

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
		
		// Cập nhật thông tin chi tiết FileDinhKem
		{{ $sectionId }}_modeSectionFileDinhKem('CHI_TIET_FILE_DINH_KEM');

		// Thêm chi tiết FileDinhKem
		$('#{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM').val(replaceLastExtension({{ $sectionId }}_documentStorageOriginalName, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_FILE_DINH_KEM').text('.' + {{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_MO_TA').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_UUID').val(dataUUID);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID').val({{ $sectionId }}_documentStorageId);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ORIGINAL_NAME').val({{ $sectionId }}_documentStorageOriginalName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_NAME').val({{ $sectionId }}_documentStorageName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DESCRIPTION').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_EXTENSION').val({{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_TYPE').val({{ $sectionId }}_documentStorageType);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_PATH').val({{ $sectionId }}_documentStoragePath);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DIRECTORY').val({{ $sectionId }}_documentStorageDirectory);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_SIZE').val({{ $sectionId }}_documentStorageSize);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_IMAGE_THUMNAIL').val({{ $sectionId }}_documentStorageImageThumnail);
	}

	/* Move up FileDinhKem */
	{{ $sectionId }}_moveUpFileDinhKem = function(currSection, dataUUID) {
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
		scrollToElement($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM'), $cardItem, true);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('border-focus');
		}, 500);
	}

	/* Move down FileDinhKem */
	{{ $sectionId }}_moveDownFileDinhKem = function(currSection, dataUUID) {
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
		scrollToElement($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM'), $cardItem, true);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('border-focus');
		}, 500);
	}

	/* Go back Danh sách FileDinhKem */
	{{ $sectionId }}_goBackDanhSachFileDinhKem = function() {
		{{ $sectionId }}_modeSectionFileDinhKem('DANH_SACH_FILE_DINH_KEM');
	}

	/**
	 * Mode section FileDinhKem
	 * 
	 * mode: DANH_SACH_FILE_DINH_KEM hoặc CHI_TIET_FILE_DINH_KEM
	 */
	{{ $sectionId }}_modeSectionFileDinhKem = function(mode) {
		if (isEmpty(mode)) return;

		if (mode === 'DANH_SACH_FILE_DINH_KEM') {
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_LABEL').text('Danh sách file đính kèm');
			$("[name='{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM']").show();
			$("[name='{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM']").hide();
		} else if (mode === 'CHI_TIET_FILE_DINH_KEM') {
			$('#{{ $sectionId }}_tab-3x2').tab('show'); // Active tab default
			
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM_LABEL').text('Chi tiết file đính kèm');
			$("[name='{{ $sectionId }}_SECTION_DANH_SACH_FILE_DINH_KEM']").hide();
			$("[name='{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM']").show();

			// Scroll on top
			$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body').scrollTop(0);
		}
	}

	/* Xử lý event click go back Danh sách FileDinhKem */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM [data-action-type='CHI_TIET_FILE_DINH_KEM_GO_BACK_BTN']").on('click', function(e) {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_UUID').val();

		// Remove all card active
		$('a.col-card-item .card-body .col-item.item-header').removeClass('active');
		// Active card đang được chọn
		let $cardItem = $('#SECTION_' + uuid).find('a.col-card-item .card-body .col-item.item-header');
		$cardItem.removeClass('active').addClass('active');

		{{ $sectionId }}_goBackDanhSachFileDinhKem();

		// Scroll to element
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body').scrollTop({{ $sectionId }}_scrollPosition);

		setTimeout(() => { // Hiển thị active 1s sau đó remove đi
			$cardItem.removeClass('active');
		}, 300);
	});

	/* Xử lý reset all input data */
	function {{ $sectionId }}_resetAllInputChiTietFileDinhKem() {
		// Tất cả input ngoại trừ checkbox và radio button
		$('[id^="EDIT_"]').not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).val(null).trigger('change');
		});
	}

	/* Reset all messages sản phẩm */
	{{ $sectionId }}_resetAllMsgChiTietFileDinhKem = function() {
		$('[name="{{ $sectionId }}_SECTION_CHI_TIET_FILE_DINH_KEM"]').find($('[id^="MSG_"]')).not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).text('');
		});
	}

	/* Xử lý event refresh */
	{{ $sectionId }}_handleRefreshChiTietFileDinhKem = function() {
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietFileDinhKem();

		// Scroll on top
		$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body').scrollTop(0);
	}

	/* Get data chi tiết FileDinhKem từ Form UI */
	function {{ $sectionId }}_getDatasFormUIChiTietFileDinhKem() {
		let id = {
			key: null,
			type_key: null,
			value: null
		};
		let tenFileDinhKem = {
			key: null,
			type_key: null,
			value: null
		};
		let moTa = {
			key: null,
			type_key: null,
			value: null
		};

		id.key = "{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID";
		id.type_key = "ID";
		id.value = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID').val() : null;

		tenFileDinhKem.key = "{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM";
		tenFileDinhKem.type_key = "ID";
		tenFileDinhKem.value = !isEmpty($('#{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM').val()) ?
			$('#{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM').val() + '.' + $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_EXTENSION').val() : null;

		moTa.key = "{{ $sectionId }}_EDIT_MO_TA";
		moTa.type_key = "ID";
		moTa.value = !isEmpty($('#{{ $sectionId }}_EDIT_MO_TA').val()) ? $('#{{ $sectionId }}_EDIT_MO_TA').val() : null;

		return {
			id,
			tenFileDinhKem,
			moTa
		}
	}

	/* Validate chi tiết FileDinhKem */
	function {{ $sectionId }}_validateChiTietFileDinhKem() {
		let isValid = true;
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietFileDinhKem();

		let {
			id,
			tenFileDinhKem,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietFileDinhKem();

		if (isEmpty(id.value)) {
			isValid = false;
			$('#MSG_' + id.key).text('Id FileDinhKem không được để trống.');
		}

		if (isEmpty(tenFileDinhKem.value)) {
			isValid = false;
			$('#MSG_' + tenFileDinhKem.key).text('Tên file đính kèm không được để trống.');
		}

		return isValid;
	}

	/* Xử lý event undo chi tiết FileDinhKem */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM [data-action-type='CHI_TIET_FILE_DINH_KEM_BTN_UNDO']").on('click', function(e) {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_UUID').val();
		// Get thông tin ban đầu của FileDinhKem (Lưu trước đó)
		let originalTenFileDinhKem = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ORIGINAL_NAME').val() || '';
		let originalTypeFileDinhKem = '.' + ($('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_EXTENSION').val() || '');
		let originalMoTa = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DESCRIPTION').val() || '';

		$('#{{ $sectionId }}_EDIT_TEN_FILE_DINH_KEM').val(replaceLastExtension(originalTenFileDinhKem, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_FILE_DINH_KEM').text(originalTypeFileDinhKem);
		$('#{{ $sectionId }}_EDIT_MO_TA').val(originalMoTa);
	});

	/* Xử lý lưu chi tiết FileDinhKem */
	function {{ $sectionId }}_saveChiTietFileDinhKem() {
		let uuid = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_UUID').val();
		let {
			id,
			tenFileDinhKem,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietFileDinhKem();

		// Validate
		if ({{ $sectionId }}_validateChiTietFileDinhKem() == false) {
			scrollMsgInSection($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body'), true);
			return;
		}

		// Create object data
		var data = {
			TEN_FILE_DINH_KEM: tenFileDinhKem.value,
			MO_TA: moTa.value
		};

		$.ajax({
			type: "POST",
			url: '{{ url("/api/document-storage/file/update") }}' + "/" + id.value,
			contentType: "application/json",
			showLoading: true,
			data: JSON.stringify(data),
			success: function(data, textStatus, request) {
				// Ajax call completed successfully 
				showToastSuccess('top-right', data.STATUS_DETAIL);

				// Cập nhật input id
				$('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_ID').val(data.DATAS.DOCUMENT_STORAGE.ID);
				// Cập nhật thông tin FileDinhKem vừa update
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

				// Cập nhật tên FileDinhKem
				let $itemTenFileDinhKem = $('#SECTION_' + uuid).find('.col-card-item .col-description h6');
				$itemTenFileDinhKem.text(data.DATAS.DOCUMENT_STORAGE.ORIGINAL_NAME);
				

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
								case 'TEN_FILE_DINH_KEM':
									$('#MSG_{{ $sectionId }}_' + tenFileDinhKem.key).text(errorMsg);
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
					scrollMsgInSection($('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM .modal-body'), true);
				}

			},
			complete: function() {}
		});
	}

	/* Xử lý event lưu chi tiết FileDinhKem */
	$("#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM [data-action-type='CHI_TIET_FILE_DINH_KEM_BTN_SAVE']").on('click', function(e) {
		{{ $sectionId }}_saveChiTietFileDinhKem();
	});

	/* Xử lý event crop FileDinhKem 3x2 */
	$('#{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM [data-action-type="CROP_3x2_BTN_CHINH_SUA"], #{{ $sectionId }}_MODAL_UPLOAD_MULTIPLE_FILE_DINH_KEM [data-action-type="CROP_RAW_BTN_CHINH_SUA"]'
	).on('click', function (e) {
		// Get thông tin FileDinhKem
		let {{ $sectionId }}_documentStorageDirectory = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DIRECTORY').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_DIRECTORY').val() : '';
		let {{ $sectionId }}_documentStorageImageThumnail = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_IMAGE_THUMNAIL').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_IMAGE_THUMNAIL').val() : '';
	});

	/* Remove all append input upload multiple FileDinhKem */
	{{ $sectionId }}_removeAllAppendInputUploadMultipleFileDinhKem = function() {
		// Remove all element bên trong form
		$('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_FILE_DINH_KEM').html('');
	}
	
	/* Xử lý append input upload multiple FileDinhKem */
	{{ $sectionId }}_appendInputUploadMultipleFileDinhKem = function(arrDocumentStorage) {
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
				}).appendTo('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_FILE_DINH_KEM');
		}
	}

	/* Xử lý set data Danh sách FileDinhKem */
	{{ $sectionId }}_setDataDanhSachFileDinhKem = function(arrDocumentStorage) {
		if (isEmpty(arrDocumentStorage)) return;

		for (let index = 0; index < arrDocumentStorage.length; index++) { // Looping
			let documentStorage = arrDocumentStorage[index];
			let uuid = generateRandomString(10);
			let srcImg = '{{asset('image/UI-BACKEND/default-file-upload.png') }}';
			
			// Create new row
			let templateRow = $('#{{ $sectionId }}_rowFileDinhKemTemplate').html();
			let newRow = templateRow.replaceAll('{-{NAME}-}', documentStorage.ORIGINAL_NAME)
									.replaceAll('{-{TAG_IMG}-}', 'img')
									.replaceAll('{-{SRC_IMG}-}', srcImg)
									.replaceAll('{-{UUID}-}', uuid);
			newRow = recoverTagHtml(newRow);
			
			// Append after div
			$('#{{ $sectionId }}_danhSachFileDinhKem').append(newRow);

			// Cập nhật attribute thông tin tin FileDinhKem
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
		
			let soLuongFileDinhKemUpload = $('#soLuongFileDinhKem').text();
			if (isNumber(soLuongFileDinhKemUpload)) {
				soLuongFileDinhKemUpload = parseInt(soLuongFileDinhKemUpload) + 1;
				$('#soLuongFileDinhKem').text(soLuongFileDinhKemUpload);
			}
		}
	}

	/* Xử lý get danh sách upload multiple FileDinhKem */
	{{ $sectionId }}_getDanhSachUploadMultipleFileDinhKem = function() {
		let arrDanhSachFileDinhKemUpload = {
			'DANH_SACH_FILE_DINH_KEM': []
		};

		let $danhSachInput = $('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_FILE_DINH_KEM').find('input');
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
				, ATTR1: 'DANH_SACH_FILE_DINH_KEM'
				, SORT_ORDER: soThuTu
				, DESCRIPTION: documentStorageDescription
				, STATUS: documentStorageStatus
				, IMAGE_THUMNAIL: documentStorageImageThumnail
			}
			arrDanhSachFileDinhKemUpload.DANH_SACH_FILE_DINH_KEM.push(objDocumentStorage);

			soThuTu++; // Tăng lên 1 đơn vị
		}
		return arrDanhSachFileDinhKemUpload;
	}

	$('#{{ $sectionId }}_CHI_TIET_FILE_DINH_KEM_PLAY').on('play', function() {
		let FileDinhKem = $("#{{ $sectionId }}_CHI_TIET_FILE_DINH_KEM_PLAY")[0];
		FileDinhKem.muted = false; // Bật âm thanh
		FileDinhKem.play(); // Phát FileDinhKem
	});

	{{ $sectionId }}_downloadFiles = function() {
		let currFileDinhKem = $('#{{ $sectionId }}_EDIT_CHI_TIET_FILE_DINH_KEM_NAME').val();
		if (isEmpty(currFileDinhKem)) return;
		
		const url = '{{ url("/api/document-storages/download/") }}';
		const params = {
			'NAMES[]': currFileDinhKem
		};

		// AJAX request
		$.ajax({
			url: url,
			type: 'GET',
			data: params,
			showLoading: true,
			
			xhrFields: {
				responseType: 'blob' // Để nhận dữ liệu dưới dạng Blob
			},
			headers: {
			},
			success: function(blob, status, xhr) {
				// Lấy tên file từ Content-Disposition header (nếu có)
				const contentDisposition = xhr.getResponseHeader('Content-Disposition');
				let filename = 'downloaded_file'; // Tên mặc định nếu không tìm thấy

				if (contentDisposition && contentDisposition.includes('filename=')) {
					filename = contentDisposition
						.split('filename=')[1]
						.split(';')[0]
						.replace(/"/g, ''); // Xóa dấu ngoặc kép nếu có
				}

				// Tạo link để tải file
				const link = document.createElement('a');
				link.href = URL.createObjectURL(blob);
				link.download = filename;
				link.click();

				// Dọn dẹp URL object
				URL.revokeObjectURL(link.href);

				console.log(`File downloaded: ${filename}`);
			},
			error: function(xhr, status, error) {
				console.error('Download failed:', error);
			}
		});
	}

});
</script>