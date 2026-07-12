<style>
/* Start css drag and drop upload 1 file */
.{{ $sectionId}}.box-upload-one-img {
	position: relative;
	margin: 0 auto;
	max-width: {{ $maxWidth }};
}

.{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img-overlay {
	position: absolute;
	right: -3px;
	z-index: 10;
	top: 38px;
}

.{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img {
	position: relative;
	max-width: {{ $maxWidth }};
	aspect-ratio: {{ $ratio }}; /* Tỉ lệ height bằng 2/3 chiều width */
	padding: 5px;
	display: flex;
	align-items: center;
	justify-content: center;
	text-align: center;
	font-family: "Quicksand", sans-serif;
	font-weight: 500;
	font-size: 20px;
	cursor: pointer;
	color: #cccccc;
	border: 2px dashed #3b86d1b3;
	border-radius: 10px;
}

.{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img--over {
	border-style: solid;
}

.{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img__input {
	display: none;
}

.{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img__thumb {
	width: 100%;
	height: 100%;
	border-radius: 6px;
	overflow: hidden;
	background-color: #ffffff;
	background-size: cover;
	position: relative;
	background-repeat: no-repeat;
	background-position: center center;
}

/* Hiển thị tên label của hình ảnh phía dưới */
/* .{{ $sectionId}}.box-upload-one-img .drop-zone-box-one-img__thumb::after {
	content: attr(data-label);
	position: absolute;
	bottom: 0;
	left: 0;
	width: 100%;
	padding: 5px 0;
	color: #ffffff;
	background: rgba(0, 0, 0, 0.75);
	font-size: 11px;
	text-align: center;
} */

.{{ $sectionId}}.box-upload-one-img .border-style {
	border: 4px dashed #009578;
	border-radius: 10px;
}

.{{ $sectionId}}.box-upload-one-img .border-none {
	border: none !important;
	outline: none;
}

.{{ $sectionId}}.box-upload-one-img .btn-chuc-nang {
	position: absolute;
	top: 7px;
	right: 3px;
	z-index: 1;
	display: none;
    border-top-right-radius: 6px;
    border-bottom-right-radius: 0px;
    border-top-left-radius: 0px;
    border-bottom-left-radius: 0px;
}

@media (max-width: 992px) {
	.{{ $sectionId}}.box-upload-one-img {
		margin: 0 auto;
	}
}
/* End css drag and drop upload 1 file */
</style>

<style>
#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .section-container-{{ $sectionId }}_cropper {
	/* background-color: #f7f7f7; */
	background-color: #ffffff;
	text-align: center;
	width: 100%;
	max-height: 250px;
	min-height: 100px;

	overflow: hidden; /* Ẩn phần thừa của ảnh nếu có */
	position: relative; /* Để căn chỉnh hình ảnh bên trong container */
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .section-container-{{ $sectionId }}_cropper > .img-container-{{ $sectionId }}_cropper {
	max-width: 100%;
	max-height: 100%;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .section-container-{{ $sectionId }}_cropper > .img-container-{{ $sectionId }}_cropper > img {
	display: block;
	max-width: 100%;

	max-height: 250px;
	min-height: 100px;
	margin: auto;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-dialog-scrollable .modal-content {
	height: 100%;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body {
	margin: unset;
	padding: unset;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .col-item {
	padding: 0.4rem 0.4rem;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-description {
	font-size: 1.035rem;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .col-description {
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

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .col-description h6 {
	white-space: nowrap;
	overflow: hidden;
	text-overflow: ellipsis;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .col-svg svg.icon-delete {
	color: #b2b2b2;
	background: transparent;
	height: 55px;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .section-svg {
	display: inline-block;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .section-svg.section-svg-icon-delete {
	padding-right: 7px;
	padding-left: 7px;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .card-body .col-svg svg.icon-next {
	color: #b2b2b2;
	background: transparent;
	margin-right: 5px;
	height: 18px;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body .item-header:hover {
	color: white;
	background: #3c9af9eb;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body .item-header.active {
	color: white;
	background: #3c9af9eb;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body .item-header.border-focus {
	box-shadow: inset 0 0 0 2px #3c9af9eb;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body .item-header.active .col-svg svg.icon-next {
	color: white;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body:hover .col-svg svg.icon-next {
	color: white;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .list-card .card.mb-3.card-body .col-svg .section-svg-icon-delete:hover svg.icon-delete {
	color: #dc3545;
}

#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .mt-2.d-flex {
	flex-wrap: wrap;
}

@media (max-width: 767px) {
	#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .nav-tabs .nav-link {
		padding: .75rem 1.2rem;
	}

	#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .mt-2.d-flex .btn-group {
		margin-bottom: 0.5rem;
	}
}
@media (max-width: 415px) {
	#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .nav-tabs .nav-link {
		padding: .75rem 0.75rem;
	}

}
</style>

<!-- Đây là trường input hidden khi upload thành công, call_back sẽ trả về -->
<section id="{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_HINH_ANH_DAI_DIEN" class="d-none">

</section>
<div class="{{ $sectionId}} box-upload-one-img">
	<button type="button" class="btn btn-info dropdown-toggle btn-chuc-nang me-1" data-bs-toggle="dropdown" style="padding: 0.8rem 0.8rem;" aria-haspopup="true" aria-expanded="false">
		Chức năng
	</button>
	<div class="dropdown-menu" id="tzz0YWhiP5_SECTION_DROP_DOWN_MENU_ICON_BTN" aria-labelledby="tzz0YWhiP5_DROP_DOWN_MENU_ICON_BTN" style="">
		<button type="button" class="dropdown-item" action-type="item-delete" onClick="{{ $sectionId}}_delBoxOneImg()">
			<i class="icon-trash icon-action-mobile" action-type="item-delete"></i>Xóa
		</button>
		<div class="dropdown-divider"></div>

		<button type="button" class="dropdown-item" action-type="item-detail" onClick="{{ $sectionId}}_chiTietOneImg()">
			<i class="icon-doc icon-action-mobile" action-type="item-detail"></i>Chi tiết
		</button>
		<div class="dropdown-divider"></div>

	</div>

	<div class="drop-zone-box-one-img" id="{{ $sectionId }}_divDropZone">
	    <span class="drop-zone-box-one-img__prompt default-text-box-upload-one-img" style="font-size: large;"></span>
		<input id="{{ $sectionId }}_fileInput" type="file" name="files" class="drop-zone-box-one-img__input" accept="image/*">
  	</div>
</div>

<!-- Modal starts -->
<div class="modal fade" id="{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE" tabindex="-1"
	role="dialog" aria-labelledby="{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE_LABEL" aria-hidden="true"
	data-bs-keyboard="true" 
	data-bs-backdrop="static">
	<div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document" style="max-width: 750px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
				</div>

				<h5 class="modal-title" id="{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE_LABEL">Chỉnh sửa hình ảnh</h5>
				
				<!-- Thêm attr này vào btn để có thể đóng popup tự động data-bs-dismiss="modal" -->
				<button type="button"
					id="{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE_CLOSE"
					class="close btn rounded-circle" 
					aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="section-block col-lg-12 col-md-12">
						<div class="form-group">
							<!-- <label for="section_yqY0Oz_EDIT_MA_LO">Hình ảnh</label> -->
							<div class="card-body">
								<ul class="nav nav-tabs" role="tablist" id="{{ $sectionId }}_TAB_KICH_THUOC_HINH_ANH">
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
												<img id="{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture">
												<img id="{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_{{ $aspectRatio }}" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture" style="display: none;">
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
												<img id="{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture">
												<img id="{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_RAW" src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="Picture" style="display: none;">
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
							<label for="{{ $sectionId }}_EDIT_TEN_HINH_ANH">Thông tin hình ảnh</label>
							<div class="input-group">
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_UUID" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_NAME" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ORIGINAL_NAME" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DESCRIPTION" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_TYPE" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_PATH" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DIRECTORY" placeholder=""></textarea>
								<textarea type="text" class="form-control" id="{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_SIZE" placeholder=""></textarea>
							</div>
						</div>
					</div>

					<div class="section-block col-lg-12 col-md-12">
						<div class="form-group">
							<label for="{{ $sectionId }}_EDIT_TEN_HINH_ANH">Tên hình ảnh<code>*</code></label>
							<div class="input-group">
								<input type="text" class="form-control" id="{{ $sectionId }}_EDIT_TEN_HINH_ANH" placeholder="">
								<span class="input-group-text" id="{{ $sectionId }}_EDIT_TYPE_HINH_ANH">.JPG</span>
							</div>
							<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_TEN_HINH_ANH"></span>
						</div>
					</div>
					<div class="section-block col-lg-12 col-md-12">
						<div class="form-group">
							<label for="{{ $sectionId }}_EDIT_MO_TA">Mô tả</label>
							<textarea rows="3" class="form-control" id="{{ $sectionId }}_EDIT_MO_TA" placeholder=""></textarea>
							<span class="error-message" id="MSG_{{ $sectionId }}_EDIT_MO_TA"></span>
						</div>
					</div>
                    
				</div>
			</div>
			<div class="modal-footer">
				<div class="justify-content-end">
					<div class="action-web">
						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_HINH_ANH_BTN_SAVE">
							<i class="fa fa-save btn-icon-prepend"></i>Lưu
						</button>
					</div>

					<div class="action-mobile">
						<button type="button" class="btn btn-action btn-info btn-icon-text" data-action-type="CHI_TIET_HINH_ANH_BTN_SAVE">
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
$(document).ready(function() {
	var {{ $sectionId }}_cropper; // Biến global cropper thư viện tạo ảnh crop
  	var {{ $sectionId }}_defaultTextBoxUplOneImg;
	var {{ $sectionId }}_dataInitialPopupBoxUplOneImg = {
		key: null,
		type_key: null,
		value: null
	}
	var {{ $sectionId }}_arrDataInitialPopupBoxUplOneImg = [];
 
	{{ $sectionId }}_setDefaultTextBoxUplOneImg = function(defaultText){
		defaultText = defaultText || '';
		$('.{{ $sectionId}} .default-text-box-upload-one-img').text(defaultText);
		{{ $sectionId }}_defaultTextBoxUplOneImg = defaultText;
	}

	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').on('show.bs.modal', function(e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-footer').removeClass('disable-events').addClass('disable-events');

		// Scroll on top
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-body').scrollTop(0);

		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietHinhAnh();

		// Thêm chi tiết hình ảnh
		let {{ $sectionId }}_documentStorageOriginalName = isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ORIGINAL_NAME').val()) ? '' : $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ORIGINAL_NAME').val();
		let {{ $sectionId }}_documentStorageExtension = isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val()) ? '' : $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val();
		let {{ $sectionId }}_documentStorageDesc = isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DESCRIPTION').val()) ? '' : $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DESCRIPTION').val();
		$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val(replaceLastExtension({{ $sectionId }}_documentStorageOriginalName, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_HINH_ANH').text('.' + {{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_MO_TA').val({{ $sectionId }}_documentStorageDesc);
		
		if ({{ $sectionId }}_cropper) {
			{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
		}
		{{ $sectionId }}_showCropperHinhAnh(false);
		
		{{ $sectionId }}_mustChangeTab = false;
		$('#{{ $sectionId }}_tab-{{ $aspectRatio }}').tab('show'); // Active tab default

		// Handle open popup
		{{ $sectionId }}_handleOpenPopupBoxUplOneImg({{ $sectionId}}_getDanhSachUploadHinhAnhDaiDien().DANH_SACH_HINH_ANH_DAI_DIEN[0]);
		
		// Scroll top
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-body').scrollTop(0);
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').on('shown.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-footer').removeClass('disable-events');
	});
	
	var {{ $sectionId }}_mustClosePopup = false;
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').on('hide.bs.modal', function(e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');
		if ({{ $sectionId }}_mustClosePopup === true) {
			{{ $sectionId }}_mustClosePopup = false;
			return;
		}
		// Kiểm tra xem dữ liệu có đang bị thay đổi so với ban đầu không ?
		let isDataChanged = {{ $sectionId }}_isDataChangedPopupBoxUplImg();
		if (isDataChanged === true) {
			e.preventDefault(); // Ngăn modal không bị đóng. Ngăn hành động mặc định (trong trường hợp này là đóng modal) xảy ra.

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Đóng modal popup
					{{ $sectionId }}_mustClosePopup = true;
					$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').modal('toggle');
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Có dữ liệu thay đổi.<span style=\"display: inline-block;\"> Bạn có muốn đóng popup không?</span>");
		}
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').on('hidden.bs.modal', function(e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});

	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').on('hidePrevented.bs.modal', function(e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});
	
	/* Xử lý logic khi open popup */
	{{ $sectionId }}_handleOpenPopupBoxUplOneImg = function(documentStorage) {
		// Set default value
		{{ $sectionId }}_initDefaultDataPopupBoxUplOneImg(documentStorage);
	}
	
	/* Xử lý set data initial ban đầu. Phục vụ cho việc check thay đổi dữ liệu sau này */
	function {{ $sectionId }}_setDataInitialPopupBoxUplOneImg(documentStorage) {
		// Reset array data initial
		{{ $sectionId }}_arrDataInitialPopupBoxUplOneImg = [];

		// ID
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.key = "ID";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.value = documentStorage.ID;
		{{ $sectionId }}_arrDataInitialPopupBoxUplOneImg.push({{ $sectionId }}_dataInitialPopupBoxUplOneImg); // Push to array

		// ORIGINAL NAME
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.key = "ORIGINAL_NAME";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.value = documentStorage.ORIGINAL_NAME;
		{{ $sectionId }}_arrDataInitialPopupBoxUplOneImg.push({{ $sectionId }}_dataInitialPopupBoxUplOneImg); // Push to array

		// DESCRIPTION
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg = {}; // Tạo đối tượng mới
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.key = "DESCRIPTION";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.type_key = "ID";
		{{ $sectionId }}_dataInitialPopupBoxUplOneImg.value = documentStorage.DESCRIPTION;
		{{ $sectionId }}_arrDataInitialPopupBoxUplOneImg.push({{ $sectionId }}_dataInitialPopupBoxUplOneImg); // Push to array

		return {{ $sectionId }}_arrDataInitialPopupBoxUplOneImg;
	}

	/* Set default data popup upload */
	function {{ $sectionId }}_initDefaultDataPopupBoxUplOneImg(documentStorage) {
		// Set data initial
		{{ $sectionId }}_setDataInitialPopupBoxUplOneImg(documentStorage);
		console.log("Datas initail : ");
		console.log({{ $sectionId }}_arrDataInitialPopupBoxUplOneImg);

		{{ $sectionId }}_resetAllMsgChiTietHinhAnh();
	}

	/* Kiểm tra data thay đổi */
	function {{ $sectionId }}_isDataChangedPopupBoxUplImg() {
		let isDataChanged = false;

		// Get datas từ FORM UI
		let {
			arrData
		} = {{ $sectionId }}_getArrDatasFormUIChiTietHinhAnh();

		// Get detail datas từ FORM UI
		for (let dataFormUI of arrData) {
			for (let dataInitial of {{ $sectionId }}_arrDataInitialPopupBoxUplOneImg) {
				let dataFormVal = isEmpty(dataFormUI.value) ? '' : dataFormUI.value;
				let dataInitVal = isEmpty(dataInitial.value) ? '' : dataInitial.value;

				if (!isEmpty(dataFormUI.key) && !isEmpty(dataInitial.key)
					&& dataFormUI.key == dataInitial.key
					&& dataFormVal != dataInitVal
				) {
					isDataChanged = true;
					return isDataChanged;
				}
			}
		}

		return isDataChanged;
	}
	
	/* START drop and drag upload 1 file */
	document.querySelectorAll(".{{ $sectionId}} .drop-zone-box-one-img__input").forEach((inputElement) => {
		const dropZoneElement = inputElement.closest(".{{ $sectionId}} .drop-zone-box-one-img");
	
		dropZoneElement.addEventListener("click", (e) => {
			// Reset input file mỗi lần click upload file lại, để cho phép upload lần thứ 2 cùng tên file
			{{ $sectionId }}_resetInputBoxOneImg(inputElement);
			inputElement.click();
		});
	
		inputElement.addEventListener("change", (e) => {
			if (inputElement.files.length) {
				{{ $sectionId }}_updateThumbnailBoxOneImg(dropZoneElement, inputElement.files[0]);
			}
		});
	
		dropZoneElement.addEventListener("dragover", (e) => {
			e.preventDefault();
			dropZoneElement.classList.add("drop-zone-box-one-img--over");
		});
	
		["dragleave", "dragend"].forEach((type) => {
			dropZoneElement.addEventListener(type, (e) => {
				dropZoneElement.classList.remove("drop-zone-box-one-img--over");
			});
		});
	
		dropZoneElement.addEventListener("drop", (e) => {
			e.preventDefault();
	
			if (e.dataTransfer.files.length) {
				inputElement.files = e.dataTransfer.files;
				{{ $sectionId }}_updateThumbnailBoxOneImg(dropZoneElement, e.dataTransfer.files[0]);
			}
	
			dropZoneElement.classList.remove("drop-zone-box-one-img--over");
		});
	});

	/**
	 * Reset input file mỗi lần click upload file lại, để cho phép upload lần thứ 2 cùng tên file
	 *
	 * @param {HTMLElement} dropZoneElement
	 * @param {File} file
	 */
	function {{ $sectionId }}_resetInputBoxOneImg(inputElement) {
        inputElement.value = null;
    }

	/**
	 * Updates the thumbnail on a drop zone element.
	 *
	 * @param {HTMLElement} dropZoneElement
	 * @param {File} file
	 */
	function {{ $sectionId }}_updateThumbnailBoxOneImg(dropZoneElement, file) {
		$('.{{ $sectionId}}.box-upload-one-img .btn-chuc-nang').hide();
		let thumbnailElement = dropZoneElement.querySelector(".drop-zone-box-one-img__thumb");

		// First time - remove the prompt
		if (dropZoneElement.querySelector(".drop-zone-box-one-img__prompt")) {
			dropZoneElement.querySelector(".drop-zone-box-one-img__prompt").remove();
		}

		// First time - there is no thumbnail element, so lets create it
		if (!thumbnailElement) {
			thumbnailElement = document.createElement("div");
			thumbnailElement.classList.add("drop-zone-box-one-img__thumb");
			dropZoneElement.appendChild(thumbnailElement);
		}

		let srcImg = "{{asset('image/UI-BACKEND/loading.gif') }}";
		thumbnailElement.style.backgroundImage = "url(" + srcImg + '?time=' + new Date().getTime() + ")";
		thumbnailElement.style.backgroundSize = "80% 80%";
	
		// Show thumbnail for image files
		if (!file.type.startsWith("image/")) {
			{{ $sectionId}}_deleteContentBoxOneImgUpload();
			return;
		}
		
		// Gọi API để tải file gốc lên (không bị thay đổi kích thước)
		{{ $sectionId }}_uploadBoxOneImg(file, function callback(documentStorage) {
			if (isEmpty(documentStorage)) { // Upload thất bại
				{{ $sectionId}}_deleteContentBoxOneImgUpload();
				return;
			};

			// Hiển thị modal popup
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').modal('show');
			
			// First time - remove the prompt
			if (dropZoneElement.querySelector(".drop-zone-box-one-img__prompt")) {
				dropZoneElement.querySelector(".drop-zone-box-one-img__prompt").remove();
			}

			thumbnailElement.dataset.label = documentStorage.ORIGINAL_NAME; // Label

			// Chi tiết thông tin hình ảnh
			{{ $sectionId }}_chiTietHinhAnh(documentStorage);
			let srcImg = '{{asset('') }}' + documentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + documentStorage.NAME;
			thumbnailElement.style.backgroundSize = "100% 100%";
			thumbnailElement.style.backgroundImage = "url(" + srcImg + '?time=' + new Date().getTime() + ")";
			$('.{{ $sectionId}}.box-upload-one-img .btn-chuc-nang').show();
		});
	}

	/**
	 * Set Thumnail into div drop zone
	 *
	 * @param {HTMLElement} {{ $sectionId }}_divDropZone
	 * @param {String} nameFile: name file . ex: demo.jsp
	 * @param {String} pathFile: path file . ex: /2024/12/20240316/b0ed2a47-9a48-45fd-8afb-404fd97a4f15.png
	 */
	{{ $sectionId }}_setThumbnailBoxOneImg = function({{ $sectionId }}_divDropZone, nameFile, directory) {
		if (!{{ $sectionId }}_divDropZone || !nameFile || !directory) {
			return;
		}

		// Check exists file
    	let thumbnailElement = {{ $sectionId }}_divDropZone.querySelector(".drop-zone-box-one-img__thumb");

    	// First time - remove the prompt
		if ({{ $sectionId }}_divDropZone.querySelector(".drop-zone-box-one-img__prompt")) {
			{{ $sectionId }}_divDropZone.querySelector(".drop-zone-box-one-img__prompt").remove();
		}

		// First time - there is no thumbnail element, so lets create it
		if (!thumbnailElement) {
			thumbnailElement = document.createElement("div");
			thumbnailElement.classList.add("drop-zone-box-one-img__thumb");
			{{ $sectionId }}_divDropZone.appendChild(thumbnailElement);
		}

		// Show btn delete image
		$('.{{ $sectionId}}.box-upload-one-img .btn-chuc-nang').show();

		// Set label name file
		thumbnailElement.dataset.label = nameFile || '';
		// Set image
		srcImg = '{{asset('') }}' + directory + '/' + '{{ $aspectRatio }}_' + nameFile;
		thumbnailElement.style.backgroundImage = "url(" + srcImg + '?time=' + new Date().getTime() + ")";
	}

	 /**
	 * Upload box one image
	 *
	 * @param file
	 */
 	function {{ $sectionId }}_uploadBoxOneImg(file, callback) {
		// Get form
		var formData = new FormData();
		// List of files to add to form data
		formData.append('FILES[]', file);
		formData.append('DANH_SACH_KICH_THUOC_HINH_ANH[]', '{{ $aspectRatio }}');
		// formData.append('DANH_SACH_KICH_THUOC_HINH_ANH[]', '{{ $aspectRatio }}');
	
		// Call api upload multiple files
		$.ajax({
			type: "POST",
			enctype: 'multipart/form-data',
			url: '{{ url("/api/document-storage/upload-multiples-hinh-anh") }}',
			data: formData,
			showLoading: false,
	
			// prevent jQuery from automatically transforming the data into a query string
			processData: false,
			contentType: false,
			cache: false,
			timeout: 1000000,
			success: function(data, textStatus, jqXHR) {
				// Ajax call completed successfully 
				showToastSuccess('top-right', data.STATUS_DETAIL);

				{{ $sectionId }}_appendInputUploadHinhAnhDaiDien(data.DATAS.DocumentStorage[0]);

				callback(data.DATAS.DocumentStorage[0]);
			},
			error: function(request, textStatus, errorThrown) {
				// Some error in ajax call 
				if (request && request.responseJSON && request.responseJSON.STATUS_DETAIL)
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');

				callback(null);
			},
			complete : function() {

			}
		});
	
	}

	/* Xử lý append input upload hình ảnh */
	{{ $sectionId }}_appendInputUploadHinhAnhDaiDien = function(documentStorage) {
		// Remove all element bên trong section form
		$('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_HINH_ANH_DAI_DIEN').html('');

		// Tạo danh sách input vào form
		// Tạo input
		$('<input>').attr({
			id: '{{ $sectionId }}_' + documentStorage.ID
			, value: documentStorage.ID
			, 'data-document-storage-id': documentStorage.ID
			, 'data-document-storage-name': isEmpty(documentStorage.NAME) ? '' : documentStorage.NAME
			, 'data-document-storage-original-name': isEmpty(documentStorage.ORIGINAL_NAME) ? '' : documentStorage.ORIGINAL_NAME
			, 'data-document-storage-type': isEmpty(documentStorage.TYPE_FILE) ? '' : documentStorage.TYPE_FILE
			, 'data-document-storage-extension': isEmpty(documentStorage.EXTENSION) ? '' : documentStorage.EXTENSION
			, 'data-document-storage-path': isEmpty(documentStorage.PATH) ? '' : documentStorage.PATH
			, 'data-document-storage-directory': isEmpty(documentStorage.DIRECTORY) ? '' : documentStorage.DIRECTORY
			, 'data-document-storage-size': isEmpty(documentStorage.SIZE) ? '' : documentStorage.SIZE
			, 'data-document-storage-description': isEmpty(documentStorage.DESCRIPTION) ? '' : documentStorage.DESCRIPTION
		}).appendTo('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_HINH_ANH_DAI_DIEN');
	}
 
	/**
	 * Delete box one image
	 *
	 * @param 
	 */
	{{ $sectionId}}_delBoxOneImg = function() {
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {
				{{ $sectionId}}_deleteContentBoxOneImgUpload();
			} else if (result.isDismissed === true) {

			} else if (result.isDenied === true) {

			}
		}, "<span style=\"display: inline-block;\"> Bạn có muốn xóa không?</span>");
		
	}

	{{ $sectionId}}_chiTietOneImg = function() {
		// Hiển thị modal popup
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').modal('show');
	}
	
	/**
	 * Delete content box one image upload
	 *
	 * @param 
	 */
 	{{ $sectionId}}_deleteContentBoxOneImgUpload = function() {
		$("#{{ $sectionId }}_divDropZone").html('<span class="drop-zone-box-one-img__prompt">' + {{ $sectionId }}_defaultTextBoxUplOneImg + '</span> <input id="{{ $sectionId }}_fileInput" type="file" name="files" class="drop-zone-box-one-img__input" accept="image/*">');
		$('.{{ $sectionId}}.box-upload-one-img .btn-chuc-nang').hide();
		
		// Remove all element bên trong section form
		$('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_HINH_ANH_DAI_DIEN').html('');
 	}

	/* Xử lý get danh sách upload multiple hình ảnh */
	{{ $sectionId}}_getDanhSachUploadHinhAnhDaiDien = function() {
		let arrDanhSachHinhAnhUpload = {
			'DANH_SACH_HINH_ANH_DAI_DIEN': []
		};

		let $danhSachInput = $('#{{ $sectionId }}_SECTION_UPLOAD_DANH_SACH_HINH_ANH_DAI_DIEN').find('input');
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

			let objDocumentStorage = {
				ID: documentStorageId
				, NAME: documentStorageName
				, ORIGINAL_NAME: documentStorageOriginalName
				, TYPE_FILE: documentStorageType
				, EXTENSION: documentStorageExtension
				, PATH: documentStoragePath
				, DIRECTORY: documentStorageDirectory
				, SIZE: documentStorageSize
				, ATTR1: 'DANH_SACH_HINH_ANH_DAI_DIEN'
				, ATTR2: '{{ $aspectRatio }}'
				, SORT_ORDER: soThuTu
				, IS_THUMNAIL: true
				, DESCRIPTION: documentStorageDescription
			}
			arrDanhSachHinhAnhUpload.DANH_SACH_HINH_ANH_DAI_DIEN.push(objDocumentStorage);

			soThuTu++; // Tăng lên 1 đơn vị
		}
		return arrDanhSachHinhAnhUpload;
	}
 
	/* Reset all messages sản phẩm */
	{{ $sectionId }}_resetAllMsgChiTietHinhAnh = function() {
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').find($('[id^="MSG_"]')).not('[type="radio"], [type="checkbox"]').each(function(i, obj) {
			$(this).text('');
		});
	}
	
	/* Chi tiết hình ảnh */
	{{ $sectionId }}_chiTietHinhAnh = function(documentStorage) {
		let {{ $sectionId }}_documentStorageId = documentStorage.ID;
		let {{ $sectionId }}_documentStorageName = documentStorage.NAME;
		let {{ $sectionId }}_documentStorageOriginalName = documentStorage.ORIGINAL_NAME;
		let {{ $sectionId }}_documentStorageType = documentStorage.TYPE_FILE;
		let {{ $sectionId }}_documentStorageExtension = documentStorage.EXTENSION;
		let {{ $sectionId }}_documentStoragePath = documentStorage.PATH;
		let {{ $sectionId }}_documentStorageDirectory = documentStorage.DIRECTORY;
		let {{ $sectionId }}_documentStorageSize = documentStorage.SIZE;
		let {{ $sectionId }}_documentStorageStatus = documentStorage.STATUS;
		let {{ $sectionId }}_documentStorageDesc = documentStorage.DESCRIPTION;
		
		// Thay đổi hình ảnh
		// Hình ảnh {{ $aspectRatio }}
		$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}').show();
		let image = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}');
		let srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + '{{ $aspectRatio }}_' + {{ $sectionId }}_documentStorageName;
		image.src = srcImg + '?time=' + new Date().getTime();

		// Hình ảnh RAW
		$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW').show();
		let imageRaw = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW');
		let srcImgRaw = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageName;
		imageRaw.src = srcImgRaw + '?time=' + new Date().getTime();
		
		// Thêm chi tiết hình ảnh
		$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val(replaceLastExtension({{ $sectionId }}_documentStorageOriginalName, ''));
		$('#{{ $sectionId }}_EDIT_TYPE_HINH_ANH').text('.' + {{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_MO_TA').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val({{ $sectionId }}_documentStorageId);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ORIGINAL_NAME').val({{ $sectionId }}_documentStorageOriginalName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_NAME').val({{ $sectionId }}_documentStorageName);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DESCRIPTION').val({{ $sectionId }}_documentStorageDesc);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val({{ $sectionId }}_documentStorageExtension);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_TYPE').val({{ $sectionId }}_documentStorageType);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_PATH').val({{ $sectionId }}_documentStoragePath);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DIRECTORY').val({{ $sectionId }}_documentStorageDirectory);
		$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_SIZE').val({{ $sectionId }}_documentStorageSize);
	}
 
	/* Xử lý Ẩn/Hiện {{ $sectionId }}_cropper hình ảnh */
	{{ $sectionId }}_showCropperHinhAnh = function(isHienThi) {
		if (isHienThi === true) {
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}').hide();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_{{ $aspectRatio }}').show();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW').hide();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_RAW').show();
			
			$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH, #{{ $sectionId }}_EDIT_MO_TA').closest('.section-block').hide();
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-footer').hide();
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .icon.go-back').hide();

			// Show hide button tương ứng
			$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [name='{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA']").hide();
			$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [name='{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER']").show();
		} else {
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}').show();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_{{ $aspectRatio }}').hide();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW').show();
			$('#{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_RAW').hide();


			$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH, #{{ $sectionId }}_EDIT_MO_TA').closest('.section-block').show();
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-footer').show();
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .icon.go-back').show();

			// Show hide button tương ứng
			$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [name='{{ $sectionId }}_SECTION_CROP_BTN_CHINH_SUA']").show();
			$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [name='{{ $sectionId }}_SECTION_CROP_BTNS_CROPPER']").hide();
		}
	}
	
	/* Xử lý event crop hình ảnh {{ $aspectRatio }} */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_CHINH_SUA"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_CHINH_SUA"]'
	).on('click', function (e) {
		// Kiểm tra nếu {{ $sectionId }}_cropper đã được khởi tạo và hủy nó
		if ({{ $sectionId }}_cropper) {
			{{ $sectionId }}_cropper.destroy();  // Hủy {{ $sectionId }}_cropper trước khi khởi tạo lại
		}
		
		// Get thông tin hình ảnh
		let {{ $sectionId }}_documentStorageDirectory = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DIRECTORY').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_DIRECTORY').val() : '';
		let {{ $sectionId }}_documentStorageName = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_NAME').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_NAME').val() : '';

		// Get type kích thước hình ảnh
		let typeKichThuocHinhAnh = $(e.target).attr('data-action-type') || '';
		let kichThuocCropAnh = 3/2; // default 3x2
		
		let image, srcImg = null;
		if (typeKichThuocHinhAnh === 'CROP_RAW_BTN_CHINH_SUA') { // Ảnh gốc
			kichThuocCropAnh = NaN;
			image = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_RAW');
			srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageName;
		} else { // Ảnh kích thước {{ $aspectRatio }}
			kichThuocCropAnh = {{ $ratio }};
			image = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_CROPPER_{{ $aspectRatio }}');
			srcImg = '{{asset('') }}' + {{ $sectionId }}_documentStorageDirectory + '/' + {{ $sectionId }}_documentStorageName;
		}
		image.src = srcImg + '?time=' + new Date().getTime();
		image.onload = function() {
			{{ $sectionId }}_showCropperHinhAnh(true);
			
			/* viewMode: Quy định cách {{ $sectionId }}_cropper hiển thị hình ảnh và khung crop.
				+ viewMode: 0: Không hạn chế, hình ảnh có thể nhỏ hơn vùng chứa. Có thể crop ra bên ngoài hình ảnh
				+ viewMode: 1: Giữ cho hình ảnh luôn bao phủ toàn bộ vùng chứa (ít nhất chiều rộng hoặc chiều cao).
				+ viewMode: 2: Giữ cho hình ảnh luôn bao phủ toàn bộ vùng chứa mà không được nhỏ hơn khung crop.
				+ viewMode: 3: Tương tự viewMode: 2, nhưng hạn chế việc crop chỉ trong giới hạn hình ảnh. 
			*/
			/* dragMode:
				+ 'none': Vô hiệu hóa tính năng kéo thả hình ảnh, chỉ cho phép di chuyển hoặc thay đổi kích thước khung crop. Các tùy chọn khác:
				+ 'move': Cho phép kéo hình ảnh.
				+ 'crop': Kéo để tạo khung crop mới. 
			*/
			/* autoCropArea:
				+ Từ 0 đến 1: phần trăm kích thước crop. Default: 0.8 tức 80%
			*/
			{{ $sectionId }}_cropper = new Cropper(image, {
				aspectRatio: kichThuocCropAnh, // Đặt tỷ lệ khung cắt (crop box)
				autoCropArea: 1, // Từ 0 đến 1. Xác định kích thước vùng cắt xén tự động (phần trăm). => 100%

				viewMode: 0, //  Giữ cho hình ảnh luôn bao phủ toàn bộ vùng chứa (ít nhất chiều rộng hoặc chiều cao)
				
				dragMode: 'none', // Vô hiệu hóa tính năng kéo thả hình ảnh, chỉ cho phép di chuyển hoặc thay đổi kích thước khung crop
				responsive: true, // Đảm bảo hình ảnh và khung crop sẽ tự động thay đổi kích thước khi thay đổi kích thước cửa sổ trình duyệt.
				
				zoomable: true, // Cho phép phóng to/thu nhỏ hình ảnh bằng các phương thức zoom
				zoomOnWheel: false, // Tắt phóng to/thu nhỏ bằng con lăn chuột
				zoomOnTouch: false, // Tắt zoom bằng cảm ứng
	
				cropBoxMovable: true,  // Cho phép di chuyển khung crop mà không làm di chuyển hình ảnh.
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
			{{ $sectionId }}_showCropperHinhAnh(false);
		};
		
	});

	/* Xử lý event zoom in */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_ZOOM_IN"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_ZOOM_IN"]').on('click', function(e) {
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
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_ZOOM_OUT"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_ZOOM_OUT"]').on('click', function(e) {
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
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_XOAY_TRAI"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_XOAY_TRAI"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.rotate(-45); // Xoay trái 45 độ
	});

	/* Xử lý event xoay phải */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_XOAY_PHAI"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_XOAY_PHAI"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.rotate(45); // Xoay phải 45 độ
	});

	/* Xử lý event gương ngang */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_GUONG_NGANG"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_GUONG_NGANG"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.scaleX(-1 * {{ $sectionId }}_cropper.getImageData().scaleX);
	});

	/* Xử lý event gương dọc */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_GUONG_DOC"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_GUONG_DOC"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.scaleY(-1 * {{ $sectionId }}_cropper.getImageData().scaleY);
	});

	/* Xử lý event reset crop */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_CROP_RESET"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_CROP_RESET"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.reset();
	});
	
	/* Xử lý event hủy crop */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_{{ $aspectRatio }}_BTN_CROP_HUY"], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type="CROP_RAW_BTN_CROP_HUY"]').on('click', function(e) {
		if (!{{ $sectionId }}_cropper || isEmpty({{ $sectionId }}_cropper.getImageData())) {
			return;
		}
		{{ $sectionId }}_cropper.destroy();
		{{ $sectionId }}_showCropperHinhAnh(false);
	});

	/* Xử lý event lưu hình ảnh đã crop */
	$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type='CROP_{{ $aspectRatio }}_BTN_CROP_AND_SAVE'], #{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type='CROP_RAW_BTN_CROP_AND_SAVE']").on('click', function(e) {
		let originalImgName = $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ORIGINAL_NAME').val() || '';
		let extensionImg = $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val() || ''; //png

		// Get type kích thước hình ảnh
		let typeKichThuocHinhAnh = $(e.target).attr('data-action-type') || '';
		
		let {
			id,
			tenHinhAnh,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietHinhAnh();
		
		if (isEmpty(originalImgName) || isEmpty(extensionImg) || !{{ $sectionId }}_cropper || !{{ $sectionId }}_cropper.getCroppedCanvas()) {
			return;
		}
		// Lấy hình ảnh đã cắt dưới dạng canvas
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

			if (typeKichThuocHinhAnh === 'CROP_RAW_BTN_CROP_AND_SAVE') { // Ảnh gốc
				formData.append('KICH_THUOC_HINH_ANH', 'raw');
			} else { // Ảnh kích thước {{ $aspectRatio }}
				formData.append('KICH_THUOC_HINH_ANH', '{{ $aspectRatio }}');
			}

			// Call api upload crop hình ảnh
			$.ajax({
				type: "POST",
				enctype: 'multipart/form-data',
				url: '{{ url("/api/document-storage/hinh-anh/crop") }}' + "/" + id.value,
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
					$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val(data.DATAS.DocumentStorage.ID);
					
					// Cập nhật hình ảnh sau khi crop
					if (typeKichThuocHinhAnh === 'CROP_RAW_BTN_CROP_AND_SAVE') { // Ảnh gốc
						let image = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_RAW');
						let srcImg = '{{asset('') }}' + data.DATAS.DocumentStorage.DIRECTORY + '/' + data.DATAS.DocumentStorage.NAME;
						image.src = srcImg + '?time=' + new Date().getTime();
					} else { // Ảnh kích thước {{ $aspectRatio }}
						let image = document.getElementById('{{ $sectionId }}_CHI_TIET_HINH_ANH_{{ $aspectRatio }}');
						let srcImg = '{{asset('') }}' + data.DATAS.DocumentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + data.DATAS.DocumentStorage.NAME;
						image.src = srcImg + '?time=' + new Date().getTime();

						// Hình ảnh ngoài danh sách hình ảnh upload
						let thumbnailElement = document.getElementsByClassName('{{ $sectionId}} box-upload-one-img')[0].querySelector(".drop-zone-box-one-img__thumb");
						thumbnailElement.dataset.label = data.DATAS.DocumentStorage; // Label
						let srcImgRaw = '{{asset('') }}' + data.DATAS.DocumentStorage.DIRECTORY + '/' + '{{ $aspectRatio }}_' + data.DATAS.DocumentStorage.NAME;
						thumbnailElement.style.backgroundSize = "100% 100%";
						thumbnailElement.style.backgroundImage = "url(" + srcImgRaw + '?time=' + new Date().getTime() + ")";
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
					{{ $sectionId }}_showCropperHinhAnh(false);
				}
			});
		});
	});

	/* Get data chi tiết hình ảnh từ Form UI */
	function {{ $sectionId }}_getDatasFormUIChiTietHinhAnh() {
		let id = {
			key: null,
			type_key: null,
			value: null
		};
		let tenHinhAnh = {
			key: null,
			type_key: null,
			value: null
		};
		let moTa = {
			key: null,
			type_key: null,
			value: null
		};

		id.key = "{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID";
		id.type_key = "ID";
		id.value = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val() : null;

		tenHinhAnh.key = "{{ $sectionId }}_EDIT_TEN_HINH_ANH";
		tenHinhAnh.type_key = "ID";
		tenHinhAnh.value = !isEmpty($('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val()) ?
			$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val() + '.' + $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val() : null;

		moTa.key = "{{ $sectionId }}_EDIT_MO_TA";
		moTa.type_key = "ID";
		moTa.value = !isEmpty($('#{{ $sectionId }}_EDIT_MO_TA').val()) ? $('#{{ $sectionId }}_EDIT_MO_TA').val() : null;

		return {
			id,
			tenHinhAnh,
			moTa
		}
	}

	/* Get array data chi tiết hình ảnh từ Form UI */
	function {{ $sectionId }}_getArrDatasFormUIChiTietHinhAnh() {
		let arrData = [];

		let data = {key : null, type_key : null, value : null};
		data.key = "ID";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val()) ? $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val() : null;
		arrData.push(data); // Push data into array

		data = {};
		data.key = "ORIGINAL_NAME";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val()) ?
			$('#{{ $sectionId }}_EDIT_TEN_HINH_ANH').val() + '.' + $('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_EXTENSION').val() : null;
		arrData.push(data); // Push data into array

		data = {};
		data.key = "DESCRIPTION";
		data.type_key = "ID";
		data.value = !isEmpty($('#{{ $sectionId }}_EDIT_MO_TA').val()) ? $('#{{ $sectionId }}_EDIT_MO_TA').val() : null;
		arrData.push(data); // Push data into array

		return {
			arrData
		}
	}

	/* Xử lý sự kiện khi nhấn phím trên modal */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').keyup(function(event) {
		if (event.keyCode === 13) { // Nhấn phím ENTER
			if (event.target.type === 'textarea') return;
			$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE button[data-action-type="CHI_TIET_HINH_ANH_BTN_SAVE"]').trigger('click');
		}
	});

	/* Xử lý sự kiện click button xong */
	$("#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE [data-action-type='CHI_TIET_HINH_ANH_BTN_SAVE']").on('click', function(e) {
		{{ $sectionId }}_saveChiTietHinhAnh();
	});

	/* Validate chi tiết hình ảnh */
	function {{ $sectionId }}_validateChiTietHinhAnh() {
		let isValid = true;
		// Reset all msg
		{{ $sectionId }}_resetAllMsgChiTietHinhAnh();

		let {
			id,
			tenHinhAnh,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietHinhAnh();

		if (isEmpty(id.value)) {
			isValid = false;
			$('#MSG_' + id.key).text('Id hình ảnh không được để trống.');
		}

		if (isEmpty(tenHinhAnh.value)) {
			isValid = false;
			$('#MSG_' + tenHinhAnh.key).text('Tên hình ảnh không được để trống.');
		}

		return isValid;
	}
	
	/* Xử lý lưu chi tiết hình ảnh */
	function {{ $sectionId }}_saveChiTietHinhAnh() {
		let {
			id,
			tenHinhAnh,
			moTa
		} = {{ $sectionId }}_getDatasFormUIChiTietHinhAnh();

		// Validate
		if ({{ $sectionId }}_validateChiTietHinhAnh() == false) {
			scrollMsgInSection($('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-body'), true);
			return;
		}

		// Create object data
		var data = {
			TEN_HINH_ANH: tenHinhAnh.value,
			MO_TA: moTa.value
		};

		$.ajax({
			type: "POST",
			url: '{{ url("/api/document-storage/hinh-anh/update") }}' + "/" + id.value,
			contentType: "application/json",
			showLoading: true,
			data: JSON.stringify(data),
			success: function(data, textStatus, request) {
				// Ajax call completed successfully 
				showToastSuccess('top-right', data.STATUS_DETAIL);

				// Cập nhật input id
				$('#{{ $sectionId }}_EDIT_CHI_TIET_HINH_ANH_ID').val(data.DATAS.DOCUMENT_STORAGE.ID);
				// Cập nhật thông tin hình ảnh vừa update
				{{ $sectionId }}_appendInputUploadHinhAnhDaiDien(data.DATAS.DOCUMENT_STORAGE);

				// Set lại data initial hình ảnh
				{{ $sectionId }}_initDefaultDataPopupBoxUplOneImg(data.DATAS.DOCUMENT_STORAGE);

				/* Chi tiết hình ảnh */
				{{ $sectionId }}_chiTietHinhAnh(data.DATAS.DOCUMENT_STORAGE);

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
								case 'TEN_HINH_ANH':
									$('#MSG_{{ $sectionId }}_' + tenHinhAnh.key).text(errorMsg);
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
					scrollMsgInSection($('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE .modal-body'), true);
				}

			},
			complete: function() {}
		});
	}

	/* Xử lý event chuyển tab */
	var {{ $sectionId }}_mustChangeTab = false;
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE #{{ $sectionId }}_TAB_KICH_THUOC_HINH_ANH').on('show.bs.tab', function(e) {
		console.log('Chuyển tab');
		if ({{ $sectionId }}_mustChangeTab === true) {
			{{ $sectionId }}_mustChangeTab = false;
			return;
		}
		// Tab hiện tại
		const $fromTab = $(e.relatedTarget);

		// Tab đích
		const $toTab = $(e.target);

		// Kiểm tra xem có đang crop hình ảnh không. Nếu có thì hỏi xác nhận trước khi chuyển tab
		if ({{ $sectionId }}_cropper && !isEmpty({{ $sectionId }}_cropper.getImageData())
			&& !isEmpty(({{ $sectionId }}_cropper.getCropBoxData()))
		) {
			e.preventDefault(); // Ngăn chuyển tab. Giữ nguyên tab cũ

			showSwalWarningPopup(function callback(result) {
				if (result.isConfirmed === true) {
					// Cho phép chuyển tab
					{{ $sectionId }}_mustChangeTab = true;
					$toTab.tab('show');

					// Xử lý trigger click hủy crop hình ảnh tương ứng
					$($fromTab.attr('href')).find('button[data-group-action-type="CROP_BTN_CROP_HUY"]').click();
				} else if (result.isDismissed === true) {

				} else if (result.isDenied === true) {

				}
			}, "Hình ảnh đang chỉnh sửa.<span style=\"display: inline-block;\"> Bạn có muốn chuyển tab không?</span>");

		}
		
	});
 
	/* Button close đóng popup */
	$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE_CLOSE').on('click', function(e) {
		// Đóng modal popup
		$('#{{ $sectionId }}_MODAL_CROP_BOX_UPLOAD_1_IMAGE').modal('toggle');
	});


 	/* END drop and drag upload 1 file */
});
</script>