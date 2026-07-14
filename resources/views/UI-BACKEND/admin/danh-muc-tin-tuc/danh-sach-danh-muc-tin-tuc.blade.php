@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
	/* Card View Styles */
	.category-card {
		height: 100%;
		display: flex;
		flex-direction: column;
	}

	.category-card .card-img-container {
		overflow: hidden;
		position: relative;
	}

	.category-card .card-img-top {
		width: 100%;
		max-height: 150px;
		object-fit: contain;
		background-color: #f8f9fa;
		transition: transform 0.35s ease;
	}

	.category-card .card-img-container:hover .card-img-top {
		transform: scale(1.1);
	}

	.category-card .card-body {
		flex-grow: 1;
		display: flex;
		flex-direction: column;
		font-size: 14px;
	}

	.category-card .card-body .card-title {
		font-size: 1.1rem;
	}

	.category-card .card-text {
		font-size: 14px;
		color: #666;
		margin-bottom: 10px;
		line-height: 1.4;
	}

	.category-card .card-meta {
		font-size: 14px;
		color: #888;
		margin-bottom: 15px;
	}

	.category-card .card-actions {
		margin-top: auto;
		padding-top: 1rem;
		border-top: 1px solid #f0f0f0;
		display: flex;
		justify-content: space-between;
		align-items: center;
		gap: 0.5rem;
	}

	.category-card .card-actions .btn-group {
		display: flex;
		gap: 8px;
	}

	.category-card .card-actions .btn-group .btn {
		border-radius: 50%;
		width: 35px;
		height: 35px;
		display: flex;
		align-items: center;
		justify-content: center;
		transition: all 0.2s ease-in-out;
	}

	.category-card .card-actions .btn-group .btn:hover {
		transform: translateY(-2px);
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
	}

	.category-card .status-badge {
		padding: 0.3em 0.75em;
		border-radius: 20px;
		font-size: 14px;
		font-weight: 500;
	}

	.category-card .status-active {
		background-color: #e6f7e6;
		color: #28a745;
	}

	.category-card .status-inactive {
		background-color: #f8d7da;
		color: #721c24;
	}

	/* Responsive */
	@media (max-width: 768px) {
		.category-card {
			margin-bottom: 15px;
		}
		
		.category-card .card-img-top {
			height: 120px;
		}
		
		.category-card .card-body {
			padding: 12px;
		}
		
		.category-card .card-title {
			font-size: 14px;
		}
		
		.category-card .card-text {
			font-size: 14px;
		}
	}

	/* Button group styles */
	.btn-group .btn.active {
		background-color: #007bff;
		color: white;
		border-color: #007bff;
	}

	.datatables-visually-hidden {
		position: absolute !important;
		width: 1px !important;
		height: 1px !important;
		margin: -1px !important;
		padding: 0 !important;
		overflow: hidden !important;
		clip: rect(0, 0, 0, 0) !important;
		border: 0 !important;
	}

	/* 
	  Class này sẽ được dùng để "ẩn" phần thân bảng một cách thông minh,
	  chỉ thu nhỏ chiều cao về 0 thay vì dùng display:none.
	  Điều này đảm bảo các control của DataTables vẫn hoạt động.
	*/
	.datatable-card-mode .dataTables_scrollBody {
		max-height: 0 !important;
		overflow: hidden;
		border-bottom: none !important;
		padding-top: 0;
		padding-bottom: 0;
		margin-top: 0;
		margin-bottom: 0;
	}
</style>
@stop

@section('nav-item')
<li class="nav-item">
	<div class="d-flex align-items-baseline">
		<p class="mb-0">Admin</p>
		<i class="typcn typcn-chevron-right"></i>
		<p class="mb-0">Quản lý danh mục tin tức</p>
	</div>
</li>
@stop @section('content')

<div class="row">
	<div class="col-12">
		<div id="accordion" class="accordion">
			<div class="card border-primary">
				<div class="card-header border-bottom" id="heading-1"
					style="padding: 15px 15px 15px 15px; background-color: #f2f4f6 !important;">
					<h5 class="mb-0">
						<div class="row">
							<div class="col">
								<!-- aria-expanded="false" -> icon -   else true -> icon +  -->
								<a aria-expanded="true" data-toggle="collapse"
									href="#collapse-1"> <span
									style="font-weight: 500; color: black; font-size: 17px;">TÌM
										KIẾM</span>
								</a>
							</div>
						</div>
					</h5>
				</div>
				<!-- Adding show into end class, to collapse div -->
				<div id="collapse-1" class="border-bottom collapse show"
					aria-labelledby="heading-1">
					<div class="card-body">
						<div class="row">
							<div class="col-md-9 col-sm-12">
								<div class="form-group">
									<label for="exampleInputName1">Từ khóa</label> <input
										type="text" class="form-control" id="SEARCH_TU_KHOA"
										placeholder="Nhập từ khóa...">
								</div>
							</div>
							<div class="col-md-3 col-sm-12">
								<div class="form-group">
									<label for="exampleInputActive">Hoạt động</label>

									<!-- Include box upload 1 file vào -->
									@include('UI-BACKEND.admin.common.component.combobox.status-active.combobox-status-active', ['elemSelect2Id' => 'SELECT_STATUS_ACTIVE', 'isDefaultGetAll' => 'true'])
								</div>
							</div>
							<div class="col-12 d-flex justify-content-end">
								<button type="button" id="btnReset" style="margin-right: 0.5rem !important;"
									class="btn btn-action btn-light btn-icon-text me-1 my-2">
									<i class="fa fa-refresh btn-icon-prepend"></i>Làm mới
								</button>
								<button type="button" id="btnSearch"
									class="btn btn-action btn-info btn-icon-text my-2">
									<i class="fa fa-search btn-icon-prepend"></i>Tìm kiếm
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-12 grid-margin stretch-card">
		<div class="card">
			<div class="card-body">
				<div class="row justify-content-between">
					<div class="col-md-6 col-sm-12">
						<h4 class="card-title">
							DANH SÁCH <span class="one-line">DANH MỤC TIN TỨC</span>
						</h4>
					</div>
					<div class="col-md-6 col-sm-12 text-end">
						<!-- Button chuyển đổi view -->
						<div class="btn-group me-2" role="group" aria-label="View toggle">
							<button type="button" id="btnTableView" class="btn btn-outline-primary active" title="Xem dạng bảng">
								<i class="fa fa-table"></i>
							</button>
							<button type="button" id="btnCardView" class="btn btn-outline-primary" title="Xem dạng thẻ">
								<i class="fa fa-th-large"></i>
							</button>
						</div>
						<a href="{{ url('/admin/danh-muc-tin-tuc/chi-tiet') }}">
							<button type="button"
								class="btn btn-action btn-success btn-icon-text">
								<i class="fa fa-plus btn-icon-prepend"></i>Thêm mới
							</button>
						</a>
					</div>
				</div>

				<!-- Table View -->
				<div id="tableView" class="table-responsive data-tables" style="margin-top: 10px">
					<table id="tableCategoryN"
						class="table table-striped table-bordered" width="100%">

						<thead>
                            <tr>
                                <th>STT</th>
								<th>Thao tác</th>
                                <th>Hình ảnh</th>
                                <th>Tên danh mục tin tức</th>
                                <th>Mô tả</th>
								<th>Danh mục cha</th>
                                <th>Hoạt động</th>
                            </tr>
                        </thead>

                		<tfoot>
                            <tr>
                                <th class="header-footer">STT</th>
								<th class="header-footer">Thao tác</th>
                                <th class="header-footer">Hình ảnh</th>
                                <th class="header-footer">Tên danh mục tin tức</th>
                                <th class="header-footer">Mô tả</th>
								<th class="header-footer">Danh mục cha</th>
                                <th class="header-footer">Hoạt động</th>
                            </tr>
                        </tfoot>
					</table>
				</div>

				<!-- Card View -->
				<div id="cardView" class="row" style="margin-top: 10px; display: none;">
					<!-- Cards sẽ được render bằng JavaScript -->
				</div>

				<!-- Shared Controls Container -->
				<div class="row datatables-controls mt-3">
					<div class="col-sm-12 col-md-5" id="datatables-info-container"></div>
					<div class="col-sm-12 col-md-7" id="datatables-pagination-container"></div>
				</div>
			</div>
		</div>
	</div>

</div>
@stop

@section('plugin-js-for-this-page')
@stop

@section('custom-js-for-this-page')
<script>
var dataTableCategoryN
$(document).ready(function(){
	
    dataTableCategoryN = new DataTable('#tableCategoryN', {
		"fixedHeader": { // Fix header cố định, khi scroll thì nó sẽ kéo thả theo cố định 1 vị trí
			"header": false,
			"footer": false
		}

		, "scrollX": false // Cho phép scroll ngang hay không
		, "scrollY": "" // Chiều cao height bao nhiêu pixel
		, "scrollCollapse": false // Khi define scrollY 1 chiều cao cố định thì scrollCollapse sẽ tự động fit theo dữ liệu dataset hiện có của datatables. Mà không làm có đoạn margin hard code height scrollY
		, "fixedColumns": {
			"start": 0, // Default: 0
			"end": 0 // Default: 0
		}
		
		, "responsive": false
		, "autoWidth": false

		, "paging": true // Có phân trang hay không
		, "pagingType": "numbers" // Kiểu phân trang: numbers - simple_numbers -  full_numbers 
		, "searching": true // Có cho phép searching hay không

		, "processing": false // Hiển thị box loading khi retrieve api ajax hay không
		, "serverSide": false // Xử lý render ở server-side. Khi retrieve API thì mặc định đã có chữ loading bên trong table rồi
		, "deferLoading": false // Tắt tự động tải dữ liệu. Ngăn DataTables gọi API lần đầu tiên.

		, "columns": [
				{
					"title": "STT"
					, "data": "STT" // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-center td-stt" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": true // Có cho phép sort column này hay không
					, "orderData": [0] // Sắp xếp theo dữ liệu cột index nào
					, "width": "70px"

					, "render": function (data, type, row, meta) {
						let categoryNId = !isEmpty(row.ID) ? row.ID : '';
						let html = '<span data-id="' + categoryNId + '" >' + data + '</span>';
						return html;
					}
				}
		    	, { 
					"title": "Thao tác"
					, "data": "FULL_DU_LIEU" // Dữ liệu lấy từ thuộc tính này
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "dataTable-td-thao-tac text-center" // Class name cho column này
					, "searchable": false // Có cho phép search column này hay không
					, "orderable": false // Có cho phép sort column này hay không
					, "orderData": [] // Sắp xếp theo dữ liệu cột index nào
					, "width": "auto"

					, "render": function (data, type, row, meta) {
						let html = `
								<div class="action-web">
									<button type="button" action-type="btn-edit" class="action-btn btn btn-sm btn-outline-primary btn-fw me-2" title="Chỉnh sửa">
										<i class="fa fa-edit btn-icon-prepend"></i>
									</button>
									
									<button type="button" action-type="btn-delete" class="action-btn btn btn-sm btn-outline-danger" title="Xóa">
										<i class="fa fa-trash-o btn-icon-prepend"></i>
									</button>
								</div>
								<div class="action-mobile">
									<div class="dropdown inline-block">
										<button type="button" class="btn btn-light dropdown-toggle" id="dropdownMenuIconButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton4">
											<button type="button" class="action-btn dropdown-item" action-type="btn-edit"><i class="fa fa-edit btn-icon-prepend"></i> Chỉnh sửa</button>
											<div class="dropdown-divider"></div>

											<button type="button" class="action-btn dropdown-item" action-type="btn-delete"><i class="fa fa-trash-o btn-icon-prepend"></i> Xóa</button>
											<div class="dropdown-divider"></div>
										</div>
									</div>
								</div>`;
						return html;
					}
				}
			  , { 
					"title": "Hình ảnh"
					, "data": "DANH_SACH_HINH_ANH_DAI_DIEN" // Dữ liệu lấy từ thuộc tính này
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-center td-img-thumnail" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": false // Có cho phép sort column này hay không
					, "orderData": [] // Sắp xếp theo dữ liệu cột index nào
					, "width": "100px"

					, "render": function (data, type, row, meta) {
						let html = '';
						if (data && data.length > 0) {
							let updateTime = new Date(data[0].UPD_DT ?? new Date()).getTime();
							html = '<img src="{{asset('') }}' + data[0].DIRECTORY + '/' + data[0].ASPECT_RATIO + '_' +  data[0].NAME + '?update_time=' + updateTime + '" alt="image">';
						} else {
							html = '<img src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="image">';
						}
						return html;
					}
				}
			  , { 
					"title": "Tên danh mục tin tức"
					, "data": "TEN_DANH_MUC_TIN_TUC" // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-left text-wrap-auto" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": true // Có cho phép sort column này hay không
					, "orderData": [3] // Sắp xếp theo dữ liệu cột index nào
					, "width": "300px"

					, "render": function (data, type, row, meta) {
						let pathUrl = '';
						if (!isEmpty(data)) {
							let id = row.FULL_DU_LIEU.TEN_DANH_MUC_TIN_TUC_SLUG + '-' + row.ID
							pathUrl =  '{{ url("/admin/danh-muc-tin-tuc/chi-tiet") }}' + '/' + id;
						}
						let treeLevel = row.FULL_DU_LIEU.PARENT_TREE_LEVEL
						var indent = '──'.repeat(treeLevel); // Lặp dấu '-' theo cấp
						let html = '<a class="text-decoration-none" href="' + pathUrl + '"><span title="' + data + '">' + indent + ' ' + data + '</span></a>';
						return html;
					}
				}
				, { 
					"title": "Mô tả"
					, "data": "MO_TA" // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-left text-wrap-auto" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": true // Có cho phép sort column này hay không
					, "orderData": [4] // Sắp xếp theo dữ liệu cột index nào
					, "width": "300px"

					, "render": function (data, type, row, meta) {
						return isEmpty(data) ? null : data;
					}
				}
				, { 
					"title": "Danh mục cha"
					, "data": "FULL_DU_LIEU" // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-left text-wrap-auto" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": true // Có cho phép sort column này hay không
					, "orderData": [5] // Sắp xếp theo dữ liệu cột index nào
					, "width": "300px"

					, "render": function (data, type, row, meta) {
						let pathUrl = '';
						let parentName = !isEmpty(data.PARENT_TEN_DANH_MUC_TIN_TUC) ? data.PARENT_TEN_DANH_MUC_TIN_TUC : '';
						if (!isEmpty(data) && !isEmpty(data.PARENT_ID)) {
							let id = row.FULL_DU_LIEU.PARENT_TEN_DANH_MUC_TIN_TUC_SLUG + '-' + row.PARENT_ID
							pathUrl =  '{{ url("/admin/danh-muc-tin-tuc/chi-tiet") }}' + '/' + id;
						}
						let html = '<a class="text-decoration-none" href="' + pathUrl + '"><span title="' + parentName + '">' + parentName + '</span></a>';
						return html;
					}
				}
				, {
					"title": "Hoạt động"
					, "data": "TRANG_THAI_HOAT_DONG" // Dữ liệu lấy từ thuộc tính này
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-center" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": false // Có cho phép sort column này hay không
					, "orderData": [] // Sắp xếp theo dữ liệu cột index nào
					, "width": "100px"

					, "render": function (data, type, row, meta) {
						let isChecked = !isEmpty(data) && data === true ? true : false;

						if (type === 'display') { // DataTables gọi khi hiển thị cell → bạn render HTML.
							let html = '<label class="switch">' +
								'	<input type="checkbox" class="action-btn primary" action-type="switch-active" ' + (isChecked ? "checked" : "") + '>' +
								'	<span class="slider"></span>' +
								'</label>';
							return html;
						}

						// type === 'filter' hoặc type === 'sort' → DataTables cần giá trị gốc → phải trả về true hoặc false
						return isChecked;
						
					}
				}
		]
		, "columnDefs": [ // Column defines
			// Cho tất cả các column
			{ 
				"targets": '_all'
				// , ...
			}
			, {
				"targets": 0, // Column index bắt đầu từ 0
				// , ...
			}
		]
		/* Set số lượng hiển thị */
		, "aLengthMenu": [
			  [10, 20, 50, -1]
			, [10, 20, 50, "Tất cả"]
		]
		/* Set số lượng hiển thị mặc định */
		, "iDisplayLength": -1
		, "language": {
			/* Đổi label search */
			"search": "Tìm kiếm"
			/* Set placeholder textbox search */
			, "searchPlaceholder": 'Nhập từ khóa...'
			/* Đổi label hiển thị kết quả */
			, "info" : "<p class=\"card-description\">Hiển thị _START_ đến _END_. <span class=\"one-line\">Tổng số <code>_TOTAL_ kết quả</code> </span></p>"// text you want show for info section
			, "emptyTable": '<h6 class="block text-center"><i class="fa fa-folder-open-o" style="color: #6c7293;"></i> {{ __("Không có dữ liệu") }}</h6>'
			/* Đổi label khi tìm kiếm không có record nào */
			, "zeroRecords": '<h6 class="block text-center"><i class="fa fa-folder-open-o" style="color: #6c7293;"></i> {{ __("Không có dữ liệu") }}</h6>'
			/* Đổi label khi filter không có kết quả nào */
			, "infoEmpty": "<p class=\"card-description\"><span class=\"one-line\">Không có dữ liệu</span></p>"
			, "infoFiltered": ""
			/* Đổi label hiển thị số dòng */
			, "lengthMenu": "Hiển thị &nbsp; _MENU_"
			/* Đổi label phân trang */
			, "paginate": {
				/* "first":      "Đầu tiên"
				, "last":       "Cuối cùng"
				, "next":       "Sau"
				, "previous":   "Trước" */
			},
			
		}
		/* Dom set phần hiển thị chọn số lượng, ô tìm kiếm và phân trang */
		, "dom": 'Bflrtip'
		, "buttons": [
			// Button hiển thị danh sách theo CARD hoặc LIST
			{
				attr:  {
					title: 'Change views',
					id: 'card-toggle'
				},
				text: 'Hiển thị kiểu <i class="fa fa-id-badge fa-fw fa-lg" aria-hidden="true"></i>',
				className: 'animated bounce d-none',
				action: function () {
					alert('Submit');
				}
			}
		]
		/* [Quan trọng] đây là hàm draw callback của datatables */
		, "drawCallback": function(settings) {
			var api = this.api();

			// Cập nhật số thứ tự
			api.rows().every(function (rowIdx, tableLoop, rowLoop) {
				// Cập nhật số thứ tự
				let indexRowSTT = 0;
				this.cell(rowIdx, indexRowSTT).data(rowIdx + 1);
			});
			
			// START Xử lý z-index cho các button dropdown trên datatables
			const dropdownsOnTable = $("#tableCategoryN .dropdown-toggle");
			dropdownsOnTable.each((index, dropdownToggleEl) => {

				// Listen Xử lý sự kiện vào trình kích hoạt thả xuống
				dropdownToggleEl.addEventListener("show.bs.dropdown", function (event) {
					$(event.target).closest("td").addClass("z-index-3");
				});
				dropdownToggleEl.addEventListener("hide.bs.dropdown", function (event) {
					$(event.target).closest("td").removeClass("z-index-3");
				});
			});
			// END Xử lý z-index cho các button dropdown trên datatables

			// Xử lý hiển thị default ảnh thumnail khi bị lỗi 404 không tìm thấy
			const images = document.querySelectorAll("#tableCategoryN .td-img-thumnail > img");
			images.forEach((image) => {
				$(image).on("error", function(e) {
					image.src = "{{asset('image/UI-BACKEND/default-no-image.jpg') }}";
				});
			});

			// Điều chỉnh lại kích thước cột
			$('#tableCategoryN').DataTable().columns.adjust();
			
		}
		/* Sau khi hoàn thành khởi tạo Datatables */
		,"initComplete": function (settings, json) {
			if (window.matchMedia('(max-width: 575px)').matches) {
				$('#tableCategoryN').DataTable().columns([0]).visible(false, true);
			}

			// Lấy container của DataTables
			const wrapper = $('#tableCategoryN_wrapper');
			
			// Di chuyển các controls vào container đã tạo sẵn
			wrapper.find('.dataTables_info').appendTo('#datatables-info-container');
			wrapper.find('.dataTables_paginate').appendTo('#datatables-pagination-container');
		}
	});

	// Listener cho sự kiện draw của DataTable (xảy ra khi tìm kiếm, phân trang, sắp xếp)
	dataTableCategoryN.on('draw.dt', function() {
		// Lấy dữ liệu của trang hiện tại đã được lọc
		var pageData = dataTableCategoryN.rows({ page: 'current' }).data().toArray();
		currentData = pageData.map(function(row) {
			return row.FULL_DU_LIEU;
		});

		// Nếu đang ở chế độ xem card, render lại với dữ liệu mới
		if (currentView === 'card') {
			renderCardView();
		}
	});

	// Khôi phục logic cập nhật URL khi chuyển trang hoặc thay đổi số lượng hiển thị
	dataTableCategoryN.on('page.dt', function() {
		const pageInfo = dataTableCategoryN.page.info();
		if (window.wwAdminListUrl) {
			window.wwAdminListUrl.sync(pageInfo.page + 1, pageInfo.length > 0 ? pageInfo.length : 'all');
		}
	}).on('length.dt', function(e, settings, len) {
		if (window.wwAdminListUrl) {
			window.wwAdminListUrl.sync(1, len);
		}
	});
 
	/* Handle event click action từng dòng row datatables */
    $('#tableCategoryN tbody').on('click', '.action-btn', function(e) {
        // Có thể dùng [e.currentTarget] để get thông tin element click hiện tại là gì
    	e.currentTarget;

    	// Get data row đang select từ datatables
    	var row = $(this).parents('tr');
		var data = dataTableCategoryN.row(row).data();

    	let actionType = $(e.currentTarget).attr('action-type') || '';
    	switch(actionType) {
    		case 'btn-edit':
				let id = data.ID;
				if (!isEmpty(data.ID)) {
					id = data.FULL_DU_LIEU.TEN_DANH_MUC_TIN_TUC_SLUG + '-' + data.ID;
				}
    			let urlEdit = '{{ url("/admin/danh-muc-tin-tuc/chi-tiet") }}' + '/' + id;
    			window.location.assign(urlEdit);
    	    	break;
    	  	case 'btn-delete':
    	  		// Xóa category news
				deleteCategoryN(data.ID, row);
    	    	break;
    	  	case 'switch-active':
    	  		switchActive(data.ID, row);
      	    	break;
    	  	case 'btn-move-down':
      	    
      	    	break;
    	}    	
    });

    /* Xử lý xóa category news */
    function deleteCategoryN(categoryNId, row) {
		// Gọi api xóa categoryN
		if (categoryNId === '') {
			showToastFailure('top-right', 'Không thể xóa. Vì dữ liệu chưa được tạo.');
			return;
		}
		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {
				// Create object data to save parameters
				var data = {
				}

				$.ajax({
					type: "DELETE", 
					url: '{{ url("/api/categoryn/delete") }}' + "/" + categoryNId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify(data), 
					success: function(data, textStatus, request) {
						// Ajax call completed successfully 
    					showToastSuccess('top-right', data.STATUS_DETAIL);

    					// Tải lại toàn bộ danh sách để đảm bảo dữ liệu luôn đồng bộ.
						// Thao tác này sẽ tự động cập nhật cả Table View và Card View.
						fnSearchCategoryN();
					}, 
					error: function(request, textStatus, errorThrown) {
						if (request.status !== 401 && request.status !== 403) {
							request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}
					},
					complete: function(){
					}
				});
			} else if (result.isDismissed === true) {
				
			} else if (result.isDenied === true) {

		  	}
		});
    }

    /* Xử lý switch active hoạt động */
    function switchActive(categoryNId, row) {
		let isActived = row.prevObject.is(":checked");
		row.prevObject.prop('checked', !isActived);

		showSwalWarningPopup(function callback(result) {
			if (result.isConfirmed === true) {
				let elemActive = row.prevObject;
				// Create object data to save parameters
				var data = {
					IS_ACTIVE: isActived
				}

				$.ajax({
					type: "PUT", 
					url: '{{ url("/api/categoryn/active") }}' + "/" + categoryNId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify(data), 
					success: function(data, textStatus, request) {
						// Ajax call completed successfully 
    					showToastSuccess('top-right', data.STATUS_DETAIL);

						// Set lại giá trị cho cột ẩn giá trị active
    					/* 
						let cellGiaTriActive = dataTableCategoryN.cell(row, '5');
    					// Datatables: active row hiện tại. Nhưng k draw lại bảng, để keep phân trang. Nó vẫn xử lý ổn. Để không bị luôn go-back về page đầu tiên
						cellGiaTriActive.data(isActived).draw(false); 
						*/
						// Cập nhật toàn bộ row data
						let rowData = dataTableCategoryN.row(row).data();
						rowData.TRANG_THAI_HOAT_DONG = isActived;
						dataTableCategoryN.row(row).data(rowData).draw(false);

						// Cập nhật UI row tương ứng
						row.prevObject.prop('checked', isActived);
					}, 
					error: function(request, textStatus, errorThrown) {
						if (request.status !== 401 && request.status !== 403) {
							request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}

						/* Xử lý trả lại dữ liệu switch hoạt động trước đó */
						let elemActive = row.prevObject;
						elemActive.prop('checked', !isActived);
					},
					complete: function(){
					}
				});
  		    } else if (result.isDismissed === true) {
  		    	/* Xử lý trả lại dữ liệu switch hoạt động trước đó */
  		    	let elemActive = row.prevObject;
  		    	elemActive.prop('checked', !isActived);
      	    } else if (result.isDenied === true) {

			}
		}, 'Bạn có muốn thay đổi <span style="display: inline-block;">trạng thái hoạt động?</span>');
    }

	/* START - Đệ quy danh mục */
	recursionCategoryNChilds = function(objCatgegoryN, resulData = [], treeLevel = 0) {
		if (isEmpty(objCatgegoryN) || objCatgegoryN.COUNT_CHILDREN === 0 || isEmpty(objCatgegoryN.DANH_SACH_CHILDREN)) return;
		treeLevel++;

		for (let i = 0; i < objCatgegoryN.DANH_SACH_CHILDREN.length; i++) {
			objCatgegoryN.DANH_SACH_CHILDREN[i].PARENT_TEN_DANH_MUC_TIN_TUC = objCatgegoryN.TEN_DANH_MUC_TIN_TUC;
			objCatgegoryN.DANH_SACH_CHILDREN[i].PARENT_TEN_DANH_MUC_TIN_TUC_SLUG = objCatgegoryN.TEN_DANH_MUC_TIN_TUC_SLUG;
			objCatgegoryN.DANH_SACH_CHILDREN[i].PARENT_ID = objCatgegoryN.ID;
			objCatgegoryN.DANH_SACH_CHILDREN[i].PARENT_TREE_LEVEL = treeLevel;

			resulData.push(objCatgegoryN.DANH_SACH_CHILDREN[i]);
			recursionCategoryNChilds(objCatgegoryN.DANH_SACH_CHILDREN[i], resulData, treeLevel);
		}
	}
	/* END - Đệ quy danh mục */

    function fnSearchCategoryN() {
    	// Create object data to check
		$.ajax({
			type : "GET"
			, url : '{{ url("/api/categoryn/list/tree") }}'
			, contentType : "application/json"
			, cache: false // Đảm bảo không cache dữ liệu
			, traditional: false // Bắt buộc đặt là false
			, showLoading: false
			, data : (function() { // IIFE 
				let dataInput = {};

				/* 
				dataInput.PAGE =  1 || null;
				dataInput.PER_PAGE = 2147483647 || null; 
				*/
				dataInput.IS_GET_ALL_ELEMENTS = true;
				dataInput.TRANG_THAI_HOAT_DONG = $('#SELECT_STATUS_ACTIVE').val();
				dataInput.TU_KHOA = !isEmpty($('#SEARCH_TU_KHOA').val()) ? $('#SEARCH_TU_KHOA').val() : '';
			
				return dataInput; // Trả về object input data
			})()
			, success : function(data, textStatus, request) {
				/* Start render table */
				var dataSet = [];
				var result = data.DATAS.CATEGORY_N.DATA;
				var resultData = !isEmpty(result) ? result : [];

				// Phần đệ quy parent-childs
				var resultDataAfterRecursion = [];
				for (let i = 0; i < resultData.length; i++) {
					resultData[i].PARENT_TEN_DANH_MUC_TIN_TUC = null;
					resultData[i].PARENT_TEN_DANH_MUC_TIN_TUC_SLUG = null;
					resultData[i].PARENT_ID = null;
					resultData[i].PARENT_TREE_LEVEL = 0;

					resultDataAfterRecursion.push(resultData[i]);
					recursionCategoryNChilds(resultData[i], resultDataAfterRecursion);
				}
				resultData = resultDataAfterRecursion;
				
				// Looping
				for (let i = 0; i < resultData.length; i++) {
					let objTmp = {};
					objTmp.STT = i;
					objTmp.FULL_DU_LIEU = resultData[i];
					objTmp.ID = !isEmpty(resultData[i]['ID']) ? resultData[i]['ID'] : '';
					objTmp.TEN_DANH_MUC_TIN_TUC = !isEmpty(resultData[i]['TEN_DANH_MUC_TIN_TUC']) ? resultData[i]['TEN_DANH_MUC_TIN_TUC'] : '';
					objTmp.PARENT_ID = !isEmpty(resultData[i]['PARENT_ID']) ? resultData[i]['PARENT_ID'] : null;
					objTmp.SORT_ORDER = !isEmpty(resultData[i]['SORT_ORDER']) ? resultData[i]['SORT_ORDER'] : null;
					objTmp.MO_TA = !isEmpty(resultData[i]['MO_TA']) ? resultData[i]['MO_TA'] : '';
					objTmp.TREE_LEVEL = !isEmpty(resultData[i]['TREE_LEVEL']) ? resultData[i]['TREE_LEVEL'] : '';
					objTmp.DANH_SACH_HINH_ANH_DAI_DIEN = resultData[i]['DANH_SACH_HINH_ANH_DAI_DIEN'];

					// Common
					objTmp.CRT_DT = !isEmpty(resultData[i]['CRT_DT']) ? resultData[i]['CRT_DT'] : null;
					objTmp.UPD_DT = !isEmpty(resultData[i]['UPD_DT']) ? resultData[i]['UPD_DT'] : null;
					objTmp.CRT_ID = !isEmpty(resultData[i]['CRT_ID']) ? resultData[i]['CRT_ID'] : null;
					objTmp.UPD_ID = !isEmpty(resultData[i]['UPD_ID']) ? resultData[i]['UPD_ID'] : null;
					objTmp.TRANG_THAI = !isEmpty(resultData[i]['TRANG_THAI']) ? resultData[i]['TRANG_THAI'] : null;
					objTmp.TRANG_THAI_HOAT_DONG = !isEmpty(resultData[i]['TRANG_THAI_HOAT_DONG']) ? resultData[i]['TRANG_THAI_HOAT_DONG'] : null;

					// Thêm row object này vào dataset
					dataSet.push(objTmp);
				}

				// Empty data table and destroy every before init
				dataTableCategoryN.clear();
				// Xóa tất cả sort trên columns
				dataTableCategoryN.order([]);
				// Add dataset vào datatables
				dataTableCategoryN.rows.add(dataSet).draw();

				// Chuyển đến trang và thiết lập length từ URL path
				let length = window.wwAdminListUrl
					? window.wwAdminListUrl.dataTableLength(10)
					: $('#tableCategoryN').DataTable().page.len();
				let startPageFrUrl = window.wwAdminListUrl
					? window.wwAdminListUrl.pageIndex(10)
					: 0;
				dataTableCategoryN.page.len(length).draw(); // Thiết lập length
				dataTableCategoryN.page(startPageFrUrl).draw(false); // Chuyển đến trang cụ thể
				/* End render table */

				// Đồng bộ dữ liệu và render lại Card View nếu đang được hiển thị
				var tableData = dataTableCategoryN.rows().data().toArray();
				currentData = tableData.map(function(row) {
					return row.FULL_DU_LIEU;
				});

				if (currentView === 'card') {
					renderCardView();
				}
			}
			, error : function(request, textStatus, errorThrown) {
				request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
			}
			, complete : function() {
			}
		});
    }

	/* START Xử lý Async fetch data search, trước khi retrieve danh sách */
	var promiseLoadDataListStatusActive = loadDataListStatusActive();
	$.when(promiseLoadDataListStatusActive).done(function() {
		fnSearchCategoryN();
	}).fail(function() {

	}).always(function() {

	});
	/* END Xử lý Async fetch data search, trước khi retrieve danh sách */

   	/* Handle event click btn search */
    $('#btnSearch').on('click', function() {
		// Bắt buộc phải bật "searchable": true trong define column mới có thể tìm kiếm được bằng api
		let searchTuKhoa = !isEmpty($('#SEARCH_TU_KHOA').val()) ? $('#SEARCH_TU_KHOA').val() : '';
		let searchTrangThaiHoatDong = $('#SELECT_STATUS_ACTIVE').val();

		// Tìm kiếm toàn bảng
		dataTableCategoryN.search(searchTuKhoa);


		// Tìm kiếm theo cột
		let columnIndex = dataTableCategoryN.settings().init().columns.findIndex(col => col.data === 'TRANG_THAI_HOAT_DONG');
		if (columnIndex !== -1 && searchTrangThaiHoatDong !== 'all') {
			dataTableCategoryN.column(columnIndex).search(searchTrangThaiHoatDong);
		} else { // Search all
			dataTableCategoryN.column(columnIndex).search('');
		}

		// Cuối cùng mới draw sau khi set tất cả điều kiện search
		dataTableCategoryN.draw();
    });

	/* Handle event click btn reset */
	$('#btnReset').on('click', function(e) {
		$('#SEARCH_TU_KHOA').val(null);
		setValueSelect2($('#SELECT_STATUS_ACTIVE'), 'all');
		fnSearchCategoryN();
	});

	$('#SEARCH_TU_KHOA').keyup(function(e) {
		if (e.keyCode == 13) {
			$(this).trigger('nhanPhimEnter'); // Có thể tự define 1 loại event mới tùy ý
		}
	});
	// Listen. Có thể tự define 1 loại event mới tùy ý
	$('#SEARCH_TU_KHOA').on('nhanPhimEnter', function(e) {
		$('#btnSearch').trigger('click');
	});

	// ===== VIEW TOGGLE FUNCTIONALITY =====
	var currentView = 'table'; // 'table' or 'card'
	var currentData = []; // Lưu trữ dữ liệu hiện tại

	// Toggle view buttons
	$('#btnCardView').on('click', function() {
		switchToCardView();
	});

	$('#btnTableView').on('click', function() {
		switchToTableView();
	});

	// Auto-switch to card view on mobile
	function checkMobileAndSwitchView() {
		if (window.innerWidth <= 768 && currentView === 'table') {
			switchToCardView();
		}
	}

	$(window).on('resize', checkMobileAndSwitchView);
	checkMobileAndSwitchView();

	// Switch to table view
	function switchToTableView() {
		currentView = 'table';
		$('#btnTableView').addClass('active');
		$('#btnCardView').removeClass('active');
		$('#tableView').show();
		$('#cardView').hide();
		dataTableCategoryN.columns.adjust();
	}

	// Force get data from DataTable
	function forceGetDataFromTable() {
		if (dataTableCategoryN && dataTableCategoryN.data) {
			var tableData = dataTableCategoryN.data().toArray();
			console.log('Force getting data from table:', tableData);
			currentData = tableData.map(function(row) {
				return row.FULL_DU_LIEU;
			});
			console.log('Processed data for cards:', currentData);
		} else {
			console.log('DataTable not available');
		}
	}

	// Switch to card view
	function switchToCardView() {
		currentView = 'card';
		$('#btnCardView').addClass('active');
		$('#btnTableView').removeClass('active');
		$('#tableView').hide();
		$('#cardView').show();
		
		// Kích hoạt sự kiện draw để đồng bộ dữ liệu mà không reset trang
		dataTableCategoryN.draw('page');
	}

	// Render card view
	function renderCardView() {
		console.log('Rendering card view with data:', currentData);
		
		if (!currentData || currentData.length === 0) {
			console.log('No data available for card view');
			$('#cardView').html('<div class="col-12 text-center"><p>Không có dữ liệu</p></div>');
			return;
		}

		let cardHtml = '';
		currentData.forEach(function(item, index) {
			console.log('Processing item:', item);
			
			let imageUrl = '';
			if (item.DANH_SACH_HINH_ANH_DAI_DIEN && item.DANH_SACH_HINH_ANH_DAI_DIEN.length > 0) {
				let updateTime = new Date(item.UPD_DT ?? new Date()).getTime();
				imageUrl = '{{asset('') }}' + item.DANH_SACH_HINH_ANH_DAI_DIEN[0].DIRECTORY + '/' + item.DANH_SACH_HINH_ANH_DAI_DIEN[0].ASPECT_RATIO + '_' + item.DANH_SACH_HINH_ANH_DAI_DIEN[0].NAME + '?update_time=' + updateTime;
			} else {
				imageUrl = '{{asset('image/UI-BACKEND/default-image.png') }}';
			}

			let treeLevel = item.PARENT_TREE_LEVEL || 0;
			let indent = '──'.repeat(treeLevel);
			let categoryName = indent + ' ' + item.TEN_DANH_MUC_TIN_TUC;

			let parentName = item.PARENT_TEN_DANH_MUC_TIN_TUC || 'Không có';
			let statusClass = item.TRANG_THAI_HOAT_DONG ? 'status-active' : 'status-inactive';
			let statusText = item.TRANG_THAI_HOAT_DONG ? 'Hoạt động' : 'Không hoạt động';

			let detailUrl = '';
			if (item.TEN_DANH_MUC_TIN_TUC_SLUG) {
				let id = item.TEN_DANH_MUC_TIN_TUC_SLUG + '-' + item.ID;
				detailUrl = '{{ url("/admin/danh-muc-tin-tuc/chi-tiet") }}' + '/' + id;
			}

			cardHtml += `
				<div class="col-lg-4 col-md-6 col-6 mb-3">
					<div class="card category-card" data-id="${item.ID}">
						<a href="${detailUrl}">
							<div class="card-img-container">
								<img src="${imageUrl}" class="card-img-top" alt="${item.TEN_DANH_MUC_TIN_TUC}">
							</div>
						</a>
						<div class="card-body">
							<h5 class="card-title">
								<a href="${detailUrl}" class="text-decoration-none">${categoryName}</a>
							</h5>
							<p class="card-text">${item.MO_TA || 'Không có mô tả'}</p>
							<div class="card-meta">
								<strong>Danh mục cha:</strong> ${parentName}<br>
								<strong>STT:</strong> ${index + 1}
							</div>
							<div class="card-actions">
								<span class="status-badge ${statusClass}">${statusText}</span>
								<div class="btn-group" role="group">
									<a href="${detailUrl}" class="btn btn-sm btn-outline-primary" title="Chỉnh sửa">
										<i class="fa fa-edit"></i>
									</a>
									<button type="button" class="btn btn-sm btn-outline-danger action-btn" action-type="btn-delete" title="Xóa" data-id="${item.ID}">
										<i class="fa fa-trash-o"></i>
									</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			`;
		});

		$('#cardView').html(cardHtml);
		console.log('Card view rendered successfully');
	}

	// Handle card view actions
	$(document).on('click', '#cardView .action-btn[action-type="btn-delete"]', function() {
		let id = $(this).data('id');
		let cardElement = $(this).closest('.category-card');
		
		// Gọi function xóa giống như trong table view
		deleteCategoryN(id, cardElement);
	});
});
</script>
@stop
