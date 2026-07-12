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
		transition: all 0.3s ease;
		border: 1px solid #e3e6f0;
		border-radius: 8px;
		overflow: hidden;
		box-shadow: 0 2px 4px rgba(0,0,0,0.1);
	}

	.category-card:hover {
		box-shadow: 0 4px 8px rgba(0,0,0,0.15);
		transform: translateY(-2px);
	}

	.category-card a {
		text-decoration: none;
		color: inherit;
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
		padding: 1rem;
	}

	.category-card .card-body .card-title {
		font-size: 1.1rem;
		font-weight: 600;
	}

	.category-card .card-text {
		color: #6c757d;
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
		width: 32px;
		height: 32px;
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
		font-size: 10px;
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

	.btn-group .btn.active {
		background-color: #4B49AC;
		color: white;
	}
	.btn-outline-primary {
		color: #4B49AC;
		border-color: #4B49AC;
	}
	.btn-outline-primary:hover {
		background-color: #4B49AC;
		color: #fff;
	}
</style>
@stop

@section('nav-item')
<li class="nav-item">
	<div class="d-flex align-items-baseline">
		<p class="mb-0">Admin</p>
		<i class="typcn typcn-chevron-right"></i>
		<p class="mb-0">Quản lý danh mục sản phẩm</p>
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
					<div class="col-md-8 col-sm-12">
						<h4 class="card-title">
							DANH SÁCH <span class="one-line">DANH MỤC SẢN PHẨM</span>
						</h4>
					</div>
					<div class="col-md-4 col-sm-12 float-right text-align-right">
						<!-- View Switcher -->
						<div class="btn-group me-2" role="group" aria-label="View toggle">
							<button type="button" id="btnTableView" class="btn btn-outline-primary active" title="Xem dạng bảng">
								<i class="fa fa-table"></i>
							</button>
							<button type="button" id="btnCardView" class="btn btn-outline-primary" title="Xem dạng thẻ">
								<i class="fa fa-th-large"></i>
							</button>
						</div>
						<a href="{{ url('/admin/danh-muc-san-pham/chi-tiet') }}">
							<button type="button"
								class="btn btn-action btn-success btn-icon-text">
								<i class="fa fa-plus btn-icon-prepend"></i>Thêm mới
							</button>
						</a>
					</div>
				</div>

				<!-- Table View -->
				<div id="tableView" class="table-responsive data-tables" style="margin-top: 10px">
					<table id="tableCategoryP"
						class="table table-striped table-bordered" width="100%">
						<thead>
                            <tr>
                                <th>STT</th>
								<th>Thao tác</th>
                                <th>Hình ảnh</th>
                                <th>Tên danh mục sản phẩm</th>
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
                                <th class="header-footer">Tên danh mục sản phẩm</th>
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
var dataTableCategoryP;
var currentView = 'table'; // 'table' or 'card'
var currentData = []; // Lưu trữ dữ liệu cho card view

$(document).ready(function(){
	
    dataTableCategoryP = new DataTable('#tableCategoryP', {
		"processing": true,
		"responsive": false,
		"autoWidth": false,
		"bSort": false,
		"searching": true,
		"paging": true,
		"pagingType": "numbers",
		"serverSide": false,
		"deferLoading": false,
		"aLengthMenu": [ [10, 20, 50, -1], [10, 20, 50, "Tất cả"] ],
		"iDisplayLength": -1,
		"language": {
			"search": "Tìm kiếm",
			"searchPlaceholder": 'Nhập từ khóa...',
			"info" : "<p class=\"card-description\">Hiển thị _START_ đến _END_. <span class=\"one-line\">Tổng số <code>_TOTAL_ kết quả</code></span></p>",
			"emptyTable": '<h6 class="block text-center"><i class="fa fa-folder-open-o" style="color: #6c7293;"></i> {{ __("Không có dữ liệu") }}</h6>',
			"zeroRecords": '<h6 class="block text-center"><i class="fa fa-folder-open-o" style="color: #6c7293;"></i> {{ __("Không có dữ liệu") }}</h6>',
			"infoEmpty": "<p class=\"card-description\"><span class=\"one-line\">Không có dữ liệu</span></p>",
			"infoFiltered": "",
			"lengthMenu": "Hiển thị &nbsp; _MENU_",
			"paginate": { "first": "Đầu tiên", "last": "Cuối cùng", "next": "Sau", "previous": "Trước" },
		},
		"columns": [
			{
				"title": "STT", "data": "STT", "className": "text-center td-stt", "width": "70px", "orderable": true,
				"render": function (data, type, row) { return '<span data-id="' + row.ID + '" >' + data + '</span>'; }
			},
			{ 
				"title": "Thao tác", "data": "FULL_DU_LIEU", "className": "dataTable-td-thao-tac text-center", "width": "auto", "orderable": false,
				"render": function () {
					return `
								<div class="action-web">
							<button type="button" action-type="btn-edit" class="action-btn btn btn-sm btn-outline-primary btn-fw me-2" title="Chỉnh sửa"><i class="fa fa-edit btn-icon-prepend"></i></button>
							<button type="button" action-type="btn-delete" class="action-btn btn btn-sm btn-outline-danger" title="Xóa"><i class="fa fa-trash-o btn-icon-prepend"></i></button>
								</div>
								<div class="action-mobile">
									<div class="dropdown inline-block">
								<button type="button" class="btn btn-light dropdown-toggle" data-bs-toggle="dropdown"></button>
								<div class="dropdown-menu">
											<button type="button" class="action-btn dropdown-item" action-type="btn-edit"><i class="fa fa-edit btn-icon-prepend"></i> Chỉnh sửa</button>
											<div class="dropdown-divider"></div>
											<button type="button" class="action-btn dropdown-item" action-type="btn-delete"><i class="fa fa-trash-o btn-icon-prepend"></i> Xóa</button>
										</div>
									</div>
								</div>`;
				}
			},
			{ 
				"title": "Hình ảnh", "data": "DANH_SACH_HINH_ANH_DAI_DIEN", "className": "text-center td-img-thumnail", "width": "100px", "orderable": false,
				"render": function (data) {
					if (data && data.length > 0) {
						let updateTime = new Date(data[0].UPD_DT ?? new Date()).getTime();
						return '<img src="{{asset('') }}' + data[0].DIRECTORY + '/' + data[0].ASPECT_RATIO + '_' +  data[0].NAME + '?update_time=' + updateTime + '" alt="image">';
					}
					return '<img src="{{asset('image/UI-BACKEND/default-image.png') }}" alt="image">';
				}
			},
			{ 
				"title": "Tên danh mục sản phẩm", "data": "TEN_DANH_MUC_SAN_PHAM", "className": "text-left text-wrap-auto", "width": "300px", "orderable": true,
				"render": function (data, type, row) {
					let pathUrl = '{{ url("/admin/danh-muc-san-pham/chi-tiet") }}' + '/' + row.FULL_DU_LIEU.TEN_DANH_MUC_SAN_PHAM_SLUG + '-' + row.ID;
					let indent = '──'.repeat(row.FULL_DU_LIEU.PARENT_TREE_LEVEL || 0);
					return '<a class="text-decoration-none" href="' + pathUrl + '"><span title="' + data + '">' + indent + ' ' + data + '</span></a>';
				}
			},
			{ 
				"title": "Mô tả", "data": "MO_TA", "className": "text-left text-wrap-auto", "width": "300px", "orderable": true,
				"render": function (data) { return isEmpty(data) ? '' : data; }
			},
			{ 
				"title": "Danh mục cha", "data": "FULL_DU_LIEU", "className": "text-left text-wrap-auto", "width": "300px", "orderable": true,
				"render": function (data, type, row) {
					let parentName = data.PARENT_TEN_DANH_MUC_SAN_PHAM || '';
					if (!parentName) return '';
					let pathUrl = '{{ url("/admin/danh-muc-san-pham/chi-tiet") }}' + '/' + row.FULL_DU_LIEU.PARENT_TEN_DANH_MUC_SAN_PHAM_SLUG + '-' + data.PARENT_ID;
					return '<a class="text-decoration-none" href="' + pathUrl + '"><span title="' + parentName + '">' + parentName + '</span></a>';
				}
			},
			{
				"title": "Hoạt động", "data": "TRANG_THAI_HOAT_DONG", "className": "text-center", "width": "100px", "orderable": false,
				"render": function (data, type, row) {
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
		],
		"dom": 'Bflrtip',
		"buttons": [],
		"drawCallback": function(settings) {
			var api = this.api();
			api.rows().every(function (rowIdx) { this.cell(rowIdx, 0).data(rowIdx + 1); });
			$("#tableCategoryP .dropdown-toggle").on("show.bs.dropdown", function (e) { $(e.target).closest("td").addClass("z-index-3"); });
			$("#tableCategoryP .dropdown-toggle").on("hide.bs.dropdown", function (e) { $(e.target).closest("td").removeClass("z-index-3"); });
			$("#tableCategoryP .td-img-thumnail > img").on("error", function() { this.src = "{{asset('image/UI-BACKEND/default-no-image.jpg') }}"; });
			$('#tableCategoryP').DataTable().columns.adjust();
		},
		"initComplete": function (settings, json) {
			const wrapper = $('#tableCategoryP_wrapper');
			wrapper.find('.dataTables_info').appendTo('#datatables-info-container');
			wrapper.find('.dataTables_paginate').appendTo('#datatables-pagination-container');
			wrapper.find('.dataTables_filter').hide(); // Ẩn bộ lọc mặc định
		}
	});

	dataTableCategoryP.on('draw.dt', function() {
		var pageData = dataTableCategoryP.rows({ page: 'current' }).data().toArray();
		currentData = pageData.map(function(row) { return row.FULL_DU_LIEU; });
		if (currentView === 'card') {
			renderCardView();
		}
	});
 
    $('#tableCategoryP tbody').on('click', '.action-btn', function(e) {
    	var row = $(this).parents('tr');
		var data = dataTableCategoryP.row(row).data();
    	let actionType = $(e.currentTarget).attr('action-type');
    	switch(actionType) {
    		case 'btn-edit':
    			let id = data.FULL_DU_LIEU.TEN_DANH_MUC_SAN_PHAM_SLUG + '-' + data.ID;
    			window.location.assign('{{ url("/admin/danh-muc-san-pham/chi-tiet") }}/' + id);
    	    	break;
    	  	case 'btn-delete':
				deleteCategoryP(data.ID);
    	    	break;
    	  	case 'switch-active':
    	  		switchActive(data.ID, row);
      	    	break;
    	}    	
    });

	function deleteCategoryP(categoryPId) {
		if (!categoryPId) {
			showToastFailure('top-right', 'Không thể xóa. Vì dữ liệu chưa được tạo.');
			return;
		}
		showSwalWarningPopup(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					type: "DELETE", 
					url: '{{ url("/api/categoryp/delete") }}/' + categoryPId,
					showLoading: true,
					success: function(data) {
    					showToastSuccess('top-right', data.STATUS_DETAIL);
						fnSearchCategoryP();
					}, 
					error: function(request) {
						if (request.status !== 401 && request.status !== 403) {
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}
					}
				});
		  	}
		});
    }

    function switchActive(categoryPId, row) {
		let isActived = row.prevObject.is(":checked");
		row.prevObject.prop('checked', !isActived);

		showSwalWarningPopup(function(result) {
			if (result.isConfirmed) {
				$.ajax({
					type: "PUT", 
					url: '{{ url("/api/categoryp/active") }}/' + categoryPId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify({ IS_ACTIVE: isActived }),
					success: function(data) {
    					showToastSuccess('top-right', data.STATUS_DETAIL);
						
						// Cập nhật toàn bộ row data
						let rowData = dataTableCategoryP.row(row).data();
						rowData.TRANG_THAI_HOAT_DONG = isActived;
						dataTableCategoryP.row(row).data(rowData).draw(false);

						// Cập nhật UI row tương ứng
						row.prevObject.prop('checked', isActived);
					}, 
					error: function(request) {
						if (request.status !== 401 && request.status !== 403) {
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}
						// Xử lý trả lại dữ liệu switch hoạt động trước đó
						let elemActive = row.prevObject;
						elemActive.prop('checked', !isActived);
					}
				});
  		    } else {
  		    	// Xử lý trả lại dữ liệu switch hoạt động trước đó
  		    	let elemActive = row.prevObject;
  		    	elemActive.prop('checked', !isActived);
      	    }
		}, 'Bạn có muốn thay đổi trạng thái hoạt động?');
    }

	function recursionCategoryPChilds(objCategory, resulData = [], treeLevel = 0) {
		if (!objCategory || objCategory.COUNT_CHILDREN === 0 || !objCategory.DANH_SACH_CHILDREN) return;
		treeLevel++;
		for (let child of objCategory.DANH_SACH_CHILDREN) {
			child.PARENT_TEN_DANH_MUC_SAN_PHAM = objCategory.TEN_DANH_MUC_SAN_PHAM;
			child.PARENT_TEN_DANH_MUC_SAN_PHAM_SLUG = objCategory.TEN_DANH_MUC_SAN_PHAM_SLUG;
			child.PARENT_ID = objCategory.ID;
			child.PARENT_TREE_LEVEL = treeLevel;
			resulData.push(child);
			recursionCategoryPChilds(child, resulData, treeLevel);
		}
	}

    function fnSearchCategoryP() {
		$.ajax({
			type : "GET",
			url : '{{ url("/api/categoryp/list/tree") }}',
			cache: false,
			showLoading: false,
			success : function(data) {
				var rawData = data.DATAS.CATEGORY_P.DATA || [];
				var resultDataAfterRecursion = [];
				for (let item of rawData) {
					item.PARENT_TREE_LEVEL = 0;
					resultDataAfterRecursion.push(item);
					recursionCategoryPChilds(item, resultDataAfterRecursion);
				}
				
				var dataSet = resultDataAfterRecursion.map((item, index) => ({
					STT: index + 1,
					FULL_DU_LIEU: item,
					ID: item.ID,
					TEN_DANH_MUC_SAN_PHAM: item.TEN_DANH_MUC_SAN_PHAM,
					MO_TA: item.MO_TA,
					DANH_SACH_HINH_ANH_DAI_DIEN: item.DANH_SACH_HINH_ANH_DAI_DIEN,
					TRANG_THAI_HOAT_DONG: item.TRANG_THAI_HOAT_DONG,
				}));

				dataTableCategoryP.clear().rows.add(dataSet).draw();
				$('#btnSearch').trigger('click'); // Áp dụng bộ lọc hiện tại
			},
			error : function(request) {
				if (request.status !== 401 && request.status !== 403) {
				showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
			}
			}
		});
    }

	var promiseLoadDataListStatusActive = loadDataListStatusActive();
	$.when(promiseLoadDataListStatusActive).done(fnSearchCategoryP);

    $('#btnSearch').on('click', function() {
		let searchTuKhoa = $('#SEARCH_TU_KHOA').val() || '';
		let searchTrangThaiHoatDong = $('#SELECT_STATUS_ACTIVE').val();
		dataTableCategoryP.search(searchTuKhoa);

		let activeColumnIndex = dataTableCategoryP.settings().init().columns.findIndex(col => col.data === 'TRANG_THAI_HOAT_DONG');
		if (activeColumnIndex !== -1) {
			let searchValue = searchTrangThaiHoatDong === 'all' ? '' : (searchTrangThaiHoatDong === 'true' ? '^true$' : '^false$');
			dataTableCategoryP.column(activeColumnIndex).search(searchValue, true, false);
		}
		dataTableCategoryP.draw();
    });

	$('#btnReset').on('click', function() {
		$('#SEARCH_TU_KHOA').val('');
		setValueSelect2($('#SELECT_STATUS_ACTIVE'), 'all');
		dataTableCategoryP.search('').columns().search('').draw();
	});

	$('#SEARCH_TU_KHOA').on('keyup', function(e) { if (e.keyCode == 13) $('#btnSearch').trigger('click'); });

	// ===== VIEW TOGGLE FUNCTIONALITY =====
	$('#btnCardView').on('click', () => switchToCardView());
	$('#btnTableView').on('click', () => switchToTableView());

	function switchToTableView() {
		currentView = 'table';
		$('#btnTableView').addClass('active');
		$('#btnCardView').removeClass('active');
		$('#tableView').show();
		$('#cardView').hide();
		dataTableCategoryP.columns.adjust();
	}

	function switchToCardView() {
		currentView = 'card';
		$('#btnCardView').addClass('active');
		$('#btnTableView').removeClass('active');
		$('#tableView').hide();
		$('#cardView').show();
		dataTableCategoryP.draw('page');
	}

	function renderCardView() {
		if (!currentData || currentData.length === 0) {
			$('#cardView').html('<div class="col-12 text-center"><p>Không có dữ liệu</p></div>');
			return;
		}

		let cardHtml = currentData.map((item, index) => {
			let imageUrl = (item.DANH_SACH_HINH_ANH_DAI_DIEN && item.DANH_SACH_HINH_ANH_DAI_DIEN.length > 0)
				? `{{asset('')}}${item.DANH_SACH_HINH_ANH_DAI_DIEN[0].DIRECTORY}/${item.DANH_SACH_HINH_ANH_DAI_DIEN[0].ASPECT_RATIO}_${item.DANH_SACH_HINH_ANH_DAI_DIEN[0].NAME}`
				: '{{asset('image/UI-BACKEND/default-image.png')}}';
			
			let detailUrl = `{{ url("/admin/danh-muc-san-pham/chi-tiet") }}/${item.TEN_DANH_MUC_SAN_PHAM_SLUG}-${item.ID}`;
			let categoryName = '──'.repeat(item.PARENT_TREE_LEVEL || 0) + ' ' + item.TEN_DANH_MUC_SAN_PHAM;
			let parentName = item.PARENT_TEN_DANH_MUC_SAN_PHAM || 'Không có';
			let statusClass = item.TRANG_THAI_HOAT_DONG ? 'status-active' : 'status-inactive';
			let statusText = item.TRANG_THAI_HOAT_DONG ? 'Hoạt động' : 'Không hoạt động';

			return `
				<div class="col-lg-4 col-md-6 col-6 mb-3">
					<div class="card category-card" data-id="${item.ID}">
						<a href="${detailUrl}">
							<div class="card-img-container">
								<img src="${imageUrl}" class="card-img-top" alt="${item.TEN_DANH_MUC_SAN_PHAM}" onerror="this.src='{{asset('image/UI-BACKEND/default-no-image.jpg')}}'">
							</div>
						</a>
						<div class="card-body">
							<h5 class="card-title"><a href="${detailUrl}">${categoryName}</a></h5>
							<p class="card-text" style="font-size: 15px;">${item.MO_TA || 'Không có mô tả'}</p>
							<div class="card-meta" style="font-size: 15px; color: #6c757d;">
								<strong>Danh mục cha:</strong> ${parentName}
							</div>
							<div class="card-actions">
								<span class="status-badge ${statusClass}">${statusText}</span>
								<div class="btn-group" role="group">
									<a href="${detailUrl}" class="btn btn-sm btn-outline-primary" title="Chỉnh sửa"><i class="fa fa-edit"></i></a>
									<button type="button" class="btn btn-sm btn-outline-danger action-btn" action-type="btn-delete" title="Xóa" data-id="${item.ID}"><i class="fa fa-trash-o"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>`;
		}).join('');
		$('#cardView').html(cardHtml);
	}

	$(document).on('click', '#cardView .action-btn[action-type="btn-delete"]', function() {
		deleteCategoryP($(this).data('id'));
	});
});
</script>
@stop
