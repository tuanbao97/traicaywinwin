<style>
	#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC.modal .modal-dialog .modal-content .modal-body {
		padding-top: 15px;
		/* padding-bottom: 5px; */
	}

	#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC #{{ $sectionId }}_GO_BACK_BTN {
		display: none;
	}

	#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC .modal-body {
		min-height: 50px;
	}
	
	@media ( max-width : 575px) {
		#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC .modal-footer {
			display: none !important;
		}
	}

	@media (max-width: 575px) {
		
	}
</style>

<!-- Modal starts -->

<div class="modal fade" id="{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC" tabindex="-1"
	role="dialog" aria-labelledby="LIST-DANH-MUC-TIN-TUC-LABEL"
	aria-hidden="true" 
	data-bs-keyboard="true" 
	data-bs-backdrop="static">
	<div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable" role="document"
		style="max-width: 600px;">
		<div class="modal-content">
			<div class="modal-header">
				<div class="section-go-back">
					<svg id="{{ $sectionId }}_GO_BACK_BTN" class="icon go-back" width="1.6em" height="1.6em" viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="none" stroke-width="19.456"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#7b7b7b" d="M224 480h640a32 32 0 110 64H224a32 32 0 010-64z"></path><path fill="#7b7b7b" d="M237.248 512l265.408 265.344a32 32 0 01-45.312 45.312l-288-288a32 32 0 010-45.312l288-288a32 32 0 1145.312 45.312L237.248 512z"></path></g></svg>
				</div>

				<h5 class="modal-title" id="LIST-DANH-MUC-TIN-TUC-LABEL">Chọn danh mục tin tức</h5>

				<button type="button" class="close btn rounded-circle" data-bs-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body disable-events" id="modal-body-list-card-dm-tin-tuc">
				<style>
					#{{ $sectionId }} .list-card .col-card {
						margin-bottom: -8px;
					}

					#{{ $sectionId }} .list-card .col-card .col-img {
						padding-left: 3px;
					}

					#{{ $sectionId }} .list-card .col-card .col-description {
						padding-left: 0px;
						padding-right: 0px;
					}

					#{{ $sectionId }} .list-card .col-card .col-svg {
						text-align: right;
						color: #b2b2b2;
						padding-right: 5px;
						margin-left: 0px;
						padding-left: 0px;
					}

					#{{ $sectionId }} .list-card .card.mb-3.card-body {
						padding-top: 7px;
						padding-bottom: 7px;
					}

					#{{ $sectionId }} .list-card .card.mb-3.card-body:hover {
						background: #3c9af9eb;
						color: white;
					}

					#{{ $sectionId }} .list-card .card.mb-3.card-body:hover svg {
						color: white;
					}

					#{{ $sectionId }} .list-card .card.mb-3.card-body.active {
						background: #3697f9b3;
						color: white;
					}

					#{{ $sectionId }} .list-card .card.mb-3.card-body.active svg {
						color: white;
					}
				</style>

				<section id="{{ $sectionId }}">
					<!-- START block template card tin tức -->
					<div tree-level="{-{TREE_LEVEL}-}" id="{{ $sectionId }}_danhMucTinTucTemplateRow" class="d-none">
						<div class="col-xl-12 col-card">
							<a href="javascript:void(0);" class="text-reset text-decoration-none" action-type="item-card" data-label="{-{NAME}-}" data-id="{-{ID}-}" data-parent-id="{-{PARENT_ID}-}" data-count-children="{-{COUNT_CHILDREN}-}" data-path-view="{-{PATH_VIEW}-}">
								<div class="card mb-3 card-body">
									<div class="row align-items-center">
										<div class="col-auto col-img">
											<{-{TAG_IMG}-} src="{-{SRC_IMG}-}" class="width-80 rounded-3" alt="">
										</div>
										<div class="col col-description">
											<div class="overflow-hidden flex-nowrap">
												<h6 class="mb-1" style="padding-top: 5px; line-height: 1.2rem;">
													{-{NAME}-}
												</h6>
											</div>
										</div>
										<div class="col-1 col-svg">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 20" data-type="monochrome" width="1em" height="1em" fill="none" class="b1l31kza">
												<path fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" d="M2 2l8 7.9L2 18"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>

					<!-- END block template card tin tức -->

					<div id="{{ $sectionId }}_danhMucTinTucRow" class="row list-card">
					</div>

					<div class="row list-card" tree-level="1" style="display: none;">

						<div class="col-xl-12 col-card">
							<a href="javascript:void(0);" class="text-reset text-decoration-none" action-type="item-card" data-label="Danh mục con 1" data-id="1" data-parent-id="null">
								<div class="card mb-3 card-body">
									<div class="row align-items-center">
										<div class="col-auto col-img">
											<img src="https://png.pngtree.com/png-vector/20190901/ourlarge/pngtree-news-icon-design-vector-png-image_1711820.jpg" class="width-50 rounded-3" alt="">
										</div>
										<div class="col col-description">
											<div class="overflow-hidden flex-nowrap">
												<h6 class="mb-1" style="padding-top: 5px; line-height: 1.2rem;">
													Danh mục con 1
												</h6>
											</div>
										</div>
										<div class="col-1 col-svg">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 13 20" data-type="monochrome" width="1em" height="1em" fill="none" class="b1l31kza">
												<path fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" d="M2 2l8 7.9L2 18"></path>
											</svg>
										</div>
									</div>
								</div>
							</a>
						</div>

					</div>
				</section>

				<script>
					$(document).ready(function() {

					});
				</script>
			</div>
			<div class="modal-footer d-none">
				<button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal Ends -->

<script>
//Tạo biến tree level mặc định là = 0
var {{ $sectionId }}_treeLevelListTinTuc = 0;

$(document).ready(function(){
	/* Xử lý khi open popup */
	{{ $sectionId }}_handleOpenPopupTinTuc = function() {
		// Reset tree level
		{{ $sectionId }}_treeLevelListTinTuc = 0;

		// Xóa tất cả css selector item trước đó
		$('#{{ $sectionId }} .list-card').find('a').find('.card.mb-3.card-body').each(function(index) {
			$(this).removeClass('active');
		});

		// Xóa tất cả popup con
		$('#{{ $sectionId }}_danhMucTinTucRow > [id^="{{ $sectionId }}_TREE_LEVEL_"]').each(function(index) {
			let treeLevelId = $(this).attr('id');
			let treeLevelData = $(this).attr('tree-level');

			if (treeLevelData == 0) {

				$('#' + treeLevelId).show();

				// Hiển thị/ Ẩn button go-back trên modal popup
				{{ $sectionId }}_handleShowHideGoBackBtn();

				return; // continue
			}
			// Xóa tất cả các block khác ngoài tree-level 0
			$('#' + treeLevelId).remove();
			
		});
	}

	/* Xử lý sự kiện khi modal ĐANG MỞ */
	$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').on('show.bs.modal', function (e) {
		// Xử lý sự kiện khi modal bắt đầu mở. Đang chuyển cảnh...
		console.log('Modal đang mở!');
		$('#modal-body-list-card-dm-tin-tuc').removeClass('disable-events').addClass('disable-events');
	});

	/* Xử lý sự kiện khi modal ĐÃ MỞ */
	$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').on('shown.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đã mở. Hoàn tất chuyển cảnh
		console.log('Modal đã mở!');
		$('#modal-body-list-card-dm-tin-tuc').removeClass('disable-events');
	});
	
	/* Xử lý sự kiện khi modal ĐANG ĐÓNG */
	$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').on('hide.bs.modal', function (e) {
		// Xử lý sự kiện khi modal đang đóng. Đang chuyển cảnh...
		console.log('Modal đang đóng!');
	});

	/* Xử lý sự kiện sau khi MODAL ĐÃ ĐÓNG */
	$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').on('hidden.bs.modal', function (e) {
		// Xử lý sự kiện sau khi modal đã đóng. Hoàn tất chuyển cảnh.
		console.log('Modal đã được đóng!');
	});
	
	/* Xử lý ngăn người dùng đóng modal bằng click vào backdrop */
	$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').on('hidePrevented.bs.modal', function (e) {
		// Ngăn modal focus lại khi click vào backdrop
		e.preventDefault();
	});
	
	/* Get danh sách danh mục tin tức */
	function {{ $sectionId }}_getListDanhMucTinTuc(parentId) {
		$.ajax({
			type : "GET",
			url : '{{ url("/api/categoryn/list") }}',
			contentType : "application/json",
			showLoading: false,
			traditional: true,
			data : function() { // IIFE 
				let dataInput = {};

				dataInput.PARENT_ID = parentId || null;
				dataInput.IS_GET_ALL_ELEMENTS = true;

				return dataInput; // Trả về object input data
			}(),
			success : function(data, textStatus, request) {
				// Remove div trước khi khởi tạo. Tránh trường hợp bị duplicate nhiều lần
				$('#{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc).remove();

				// Xử lý thêm một block section div tree level
				let newSectionTreeLevel = '<div tree-level="' + {{ $sectionId }}_treeLevelListTinTuc + '" id="{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc + '"></div>';
				$('#{{ $sectionId }}_danhMucTinTucRow').append(newSectionTreeLevel);

				let templateRow = $('#{{ $sectionId }}_danhMucTinTucTemplateRow').html();

				let arrResult = [];
				var result = data.DATAS.CATEGORY_N.DATA;
				if (result && result.length > 0) {
					for (let i = 0; i < result.length; i++) {
						let idVal = result[i]['ID'] || '';
						let nameVal = result[i]['TEN_DANH_MUC_TIN_TUC'] || '';
						let parentIdVal = result[i]['PARENT_ID'] || null;
						let countChildrenVal = result[i]['COUNT_CHILDREN'] || 0;
						let pathView = result[i]['PATH_VIEW'] || '';

						// Create new row
						let newRow = templateRow.replaceAll('{-{NAME}-}', nameVal)
												.replaceAll('{-{ID}-}', idVal)
												.replaceAll('{-{PARENT_ID}-}', parentIdVal)
												.replaceAll('{-{COUNT_CHILDREN}-}', countChildrenVal)
												.replaceAll('{-{PATH_VIEW}-}', pathView);;

						// Xử lý hiển thị hình ảnh
						let srcImg = "";
						if (result[i].DANH_SACH_HINH_ANH_DAI_DIEN && result[i].DANH_SACH_HINH_ANH_DAI_DIEN.length > 0) { // Nếu tồn tại ảnh đại diện thì sẽ show lên
							let updTime = new Date(result[i].DANH_SACH_HINH_ANH_DAI_DIEN[0]?.UPD_DT ?? new Date()).getTime();
							srcImg = "{{asset('') }}" + result[i].DANH_SACH_HINH_ANH_DAI_DIEN[0].DIRECTORY + '/' + '{{ $aspectRatio }}_' + result[i].DANH_SACH_HINH_ANH_DAI_DIEN[0].NAME + "?update_time=" + updTime;
						} else {
							srcImg = "{{asset('image/UI-BACKEND/default-image.png') }}";
						}
						
						newRow = newRow.replaceAll('{-{TAG_IMG}-}', 'img')
									   .replaceAll('{-{SRC_IMG}-}', srcImg);
						newRow = recoverTagHtml(newRow);

						// Append after div
						$('#{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc).append(newRow);
					}
				}

			},
			error : function(request, textStatus, errorThrown) {
				request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
			},
			complete : function() {
				
				// Scroll on top
				$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC .modal-body').scrollTop(0);

				// Hiển thị/ Ẩn button go-back trên modal popup
				{{ $sectionId }}_handleShowHideGoBackBtn();
			}
		});
	}
	{{ $sectionId }}_getListDanhMucTinTuc();

	/* Xử lý event click các item trong list-card */
	$('#{{ $sectionId }} .list-card').on('click', 'a', function(e) {
		e.currentTarget;
		// Check xem đang click vào action type nào
		let actionType = e.currentTarget.getAttribute('action-type');

		switch (actionType) {
			case 'item-card': // Nếu là action type là click vào item-card
				let eleCurrTagA = e.currentTarget;

				/* Get thông tin current section block của menu */
				let currSection = $(eleCurrTagA).closest('.row.list-card');
				let currSectionId = currSection.attr('id');
				let currSectionLevel = currSection.attr('tree-level');

				/* Get thông tim item danh mục đang chọn click */
				let dataLabel = eleCurrTagA.getAttribute('data-label');
				let dataId = eleCurrTagA.getAttribute('data-id');
				let dataParentId = eleCurrTagA.getAttribute('data-parent-id');
				let countChildren = eleCurrTagA.getAttribute('data-count-children');
				let pathView = eleCurrTagA.getAttribute('data-path-view');

				/* Đổi css active item danh mục đang được chọn - và xóa css active các item còn lại */
				// Xóa tất cả các active thẻ card item .card.mb-3.card-body
				$('#' + currSectionId + ' .card.mb-3.card-body').removeClass('active');
				let eleCurrCardItem = $(eleCurrTagA).find('.card.mb-3.card-body').first();
				// Add class active
				eleCurrCardItem.removeClass('active').addClass('active');
				
				// Xử lý event click item card danh mục
				{{ $sectionId }}_clickItemCardDanhMuc(currSectionId, currSectionLevel, dataLabel, JSON.parse(dataId), JSON.parse(dataParentId), countChildren, pathView);
		    	break;
		  	case 'pause':
		    	break;
		}
		
	});

	/* Xử lý sự kiện khi click item */
	function {{ $sectionId }}_clickItemCardDanhMuc(currSectionId, currSectionLevel, dataLabel, dataId, dataParentId, countChildren, pathView) {
		console.log('Current section id: ' + currSectionId + '\nCurrent section level: ' + currSectionLevel 
				+ '\nItem data id: ' + dataId + '\nItem data label: ' + dataLabel + '\nItem data parent id : ' + dataParentId
				+ '\nCount childrens: ' + countChildren);

		// Nếu đã đến item cuối cùng trong tree (tức không còn children nữa) thì tiến hành chọn đối tượng này
		if (countChildren == 0) {
			// Đóng modal popup
			console.log($('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').hasClass('show'));
			if ($('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').hasClass('show')) {
				$('#{{ $sectionId }}_MODAL-LIST-DANH-MUC-TIN-TUC').modal('hide'); // Chỉ ẩn modal nếu nó đang mở
			}

			{{ $sectionId }}_callBack_danhMucTinTuc(dataLabel, dataId, pathView);
			return;
		}

		// Ẩn current section để mở section child
		$('#{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc).hide();
		// Xóa tất cả các active thẻ card item .card.mb-3.card-body
		$('#' + currSectionId + ' .card.mb-3.card-body').removeClass('active');
		

		// Hiển thị section child
		{{ $sectionId }}_treeLevelListTinTuc++;
		{{ $sectionId }}_getListDanhMucTinTuc(dataId);

	}

	/* Xử lý click go back */
	$('#{{ $sectionId }}_GO_BACK_BTN').on('click', function(e) {
		if ({{ $sectionId }}_treeLevelListTinTuc === 0) return;

		// Ẩn section hiện tại
		$treeLevelCurr = $('#{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc);
		$treeLevelCurr.hide();
			
		// Hiển thị section parent trước đó
		{{ $sectionId }}_treeLevelListTinTuc--;
		$treeLevelParent = $('#{{ $sectionId }}_TREE_LEVEL_' + {{ $sectionId }}_treeLevelListTinTuc);
		$treeLevelParent.show();

		// Hiển thị/ Ẩn button go-back trên modal popup
		{{ $sectionId }}_handleShowHideGoBackBtn();

	});

	/* Xử lý logic show hide btn go back */
	{{ $sectionId }}_handleShowHideGoBackBtn = function() {
		if ({{ $sectionId }}_treeLevelListTinTuc > 0) {
			$('#{{ $sectionId }}_GO_BACK_BTN').show();
		} else {
			$('#{{ $sectionId }}_GO_BACK_BTN').hide();
		}
	}

});
</script> 