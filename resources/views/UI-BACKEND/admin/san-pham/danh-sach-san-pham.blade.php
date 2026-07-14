@extends('UI-BACKEND.admin.common.layout.master')

@section('plugin-css-for-this-page')
@stop 

@section('custom-css')
<style>
</style>
@stop 

@section('nav-item')
<li class="nav-item">
	<div class="d-flex align-items-baseline">
		<p class="mb-0">Admin</p>
		<i class="typcn typcn-chevron-right"></i>
		<p class="mb-0">Quản lý sản phẩm</p>
	</div>
</li>
@stop

@section('content')
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
									style="font-weight: 500; color: black; font-size: 16px;">TÌM
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
							<div class="col-xl-6 col-md-12 col-sm-12">
								<div class="form-group">
									<label for="exampleInputName1">Từ khóa</label> <input
										type="text" class="form-control" id="SEARCH_TU_KHOA"
										placeholder="Nhập từ khóa...">
								</div>
							</div>
							<div class="col-xl-3 col-md-4 col-sm-12">
								<div class="form-group">
									<label for="exampleInputActive">Danh mục sản phẩm<code>*</code></label>

									<!-- Include box upload 1 file vào -->
									@include('UI-BACKEND.admin.common.component.combobox.danh-muc-san-pham.combobox-danh-muc-san-pham', ['elemSelect2Id' => 'SELECT_DANH_MUC_SAN_PHAM', 'isDefaultGetAll' => 'true'])
								</div>
							</div>


							
							<div class="col-xl-3 col-md-4 col-sm-12">
								<div class="form-group">
									<label for="exampleInputActive">Hiển thị</label>

									<!-- Include combobox Hiển thị -->
									@include('UI-BACKEND.admin.common.component.combobox.status-active.combobox-status-active', ['elemSelect2Id' => 'SELECT_STATUS_ACTIVE', 'isDefaultGetAll' => 'true'])
								</div>
							</div>

							<div class="col-xl-3 col-md-4 col-sm-12">
								<div class="form-group">
									<label for="exampleInputActive">Trạng thái</label>
									<select id="SELECT_TRANG_THAI"
										class="form-control form-select form-control-default border-radius-2px border-top-left-radius-0px border-bottom-left-radius-0px">
										<option value="all" selected>Tất cả</option>
										<option value="USING">Đang bán</option>
										<option value="SOLD">Đã bán</option>
									</select>
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
							DANH SÁCH <span class="one-line">SẢN PHẨM</span>
						</h4>
					</div>
					<div class="col-md-4 col-sm-12 float-right text-align-right">
						<a href="{{ url('/admin/san-pham/chi-tiet') }}">
							<button type="button"
								class="btn btn-action btn-success btn-icon-text">
								<i class="fa fa-plus btn-icon-prepend"></i>Thêm mới
							</button>
						</a>
					</div>
				</div>

				<div class="table-responsive data-tables" style="margin-top: 10px;">
					<table id="tableProduct"
						class="table table-striped table-bordered" width="100%">

						<thead>
                            <tr>
                                <th>STT</th>
								<th>Thao tác</th>
                                <th>Hình ảnh</th>
                                <th>Tên sản phẩm</th>
                                <th>Danh mục sản phẩm</th>
								<th>Giá cả</th>
                                <th>Trạng thái</th>
                                <th>Hiển thị</th>
                            </tr>
                        </thead>

                		<tfoot>
                            <tr>
                                <th class="header-footer">STT</th>
								<th class="header-footer">Thao tác</th>
                                <th class="header-footer">Hình ảnh</th>
                                <th class="header-footer">Tên sản phẩm</th>
                                <th class="header-footer">Danh mục sản phẩm</th>
								<th class="header-footer">Giá cả</th>
                                <th class="header-footer">Trạng thái</th>
                                <th class="header-footer">Hiển thị</th>
                            </tr>
                        </tfoot>
					</table>
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
var dataTableProduct;
$(document).ready(function(){
	
	dataTableProduct = new DataTable('#tableProduct', {
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
    	, "serverSide": true // Xử lý render ở server-side. Khi retrieve API thì mặc định đã có chữ loading bên trong table rồi
		, "deferLoading": true // Tắt tự động tải dữ liệu. Ngăn DataTables gọi API lần đầu tiên.


		, ajax: {
			type : "GET"
			, url : '{{ url("/api/product/list") }}'
			, contentType : "application/json"
			, cache: false // Đảm bảo không cache dữ liệu
			, traditional: false // Bắt buộc đặt là false
			, showLoading: false
			, data : function(dataInput) { // Đây là function riêng của Datatables
				// Tìm giá trị nhập vào ô tìm kiếm
				let inputSearching = !isEmpty(dataInput.search.value) ? dataInput.search.value : null;

				// Tìm page mặc định
				let startPageFrUrl = window.wwAdminListUrl ? window.wwAdminListUrl.pageIndex(10) : 0;
				dataInput.start = startPageFrUrl * Number(dataInput.length);
				
				// Tìm giá trị phân trang
				let start = Number(dataInput.start);
				let length = Number(dataInput.length);

				// Tạo query param
				dataInput.PAGE = (start / length) + 1;
				dataInput.PER_PAGE = !isEmpty(length) && length > 0 ? length : 2147483647;
				dataInput.TU_KHOA = !isEmpty($('#SEARCH_TU_KHOA').val()) 
					? $('#SEARCH_TU_KHOA').val() 
					: (!isEmpty(inputSearching) ? inputSearching : '');
				dataInput.DANH_MUC_SAN_PHAM_ID = $('#SELECT_DANH_MUC_SAN_PHAM').val();
				dataInput.TRANG_THAI_HOAT_DONG = $('#SELECT_STATUS_ACTIVE').val();
				dataInput.TRANG_THAI = $('#SELECT_TRANG_THAI').val();
		

				// Sort
				// Tìm column nào đang sorting
				let arrColSorting = dataInput.order;
				let dirSorting = null, colNmSorting = null;
				if (!isEmpty(arrColSorting)) {
					let idxColSorting = arrColSorting[0].column;
					dirSorting = dataInput.order[0].dir;
					colNmSorting = dataInput.columns[idxColSorting].data;

					let objSort = {
						FIELD_NAME: colNmSorting,
						SORT_TYPE: dirSorting
					};
					dataInput.SORT = objSort;
				}
				

				return dataInput; // Trả về object input data
			}
			, dataSrc: function (json) {
				// Tính toán Paging
				json.recordsTotal = 0;
				json.recordsFiltered = 0;

				if (json.STATUS === true) {
					// Tính toán Paging
					if (json.DATAS.PRODUCT.DATA.length > 0) {
						json.recordsTotal = json.DATAS.PRODUCT.TOTAL_ITEM; // Skip không quan tâm
						json.recordsFiltered = json.DATAS.PRODUCT.TOTAL_ITEM; // Tính toán paging
					}
					json.draw = json.DATAS.PRODUCT.DRAW; // Đồng bộ hóa giữa request - response của Datatables. Để biết chính xác đang xử lý response hành động nào trên table (Nhập nhanh filter, paging...)
					
					var arrData = [];
					// Map dữ liệu từ server về DataTables
					arrData = json.DATAS.PRODUCT.DATA.map(function (item, index) {
						return {
							STT: index
							, FULL_DU_LIEU: item
							, ID: !isEmpty(item.ID) ? item.ID : ''
							, DANH_SACH_HINH_ANH_DAI_DIEN: item.DANH_SACH_HINH_ANH_DAI_DIEN
							, TEN_SAN_PHAM: !isEmpty(item.TEN_SAN_PHAM) ? item.TEN_SAN_PHAM : ''
							, TEN_SAN_PHAM_SLUG: !isEmpty(item.TEN_SAN_PHAM_SLUG) ? item.TEN_SAN_PHAM_SLUG : ''
							, DANH_MUC_SAN_PHAM: item.DANH_MUC_SAN_PHAM
							, GIA_CA: !isEmpty(item.GIA_CA) ? item.GIA_CA : ''
							, IS_GIA_CA_LIEN_HE: !isEmpty(item.IS_GIA_CA_LIEN_HE) ? item.IS_GIA_CA_LIEN_HE : false
							, TRANG_THAI: !isEmpty(item.TRANG_THAI) ? item.TRANG_THAI : null
					

							// Common
							, CRT_DT: !isEmpty(item.CRT_DT) ? item.CRT_DT : null
							, UPD_DT: !isEmpty(item.UPD_DT) ? item.UPD_DT : null
							, CRT_ID: !isEmpty(item.CRT_ID) ? item.CRT_ID : null
							, UPD_ID: !isEmpty(item.UPD_ID) ? item.UPD_ID : null
							, STATUS: !isEmpty(item.STATUS) ? item.STATUS : null
							, TRANG_THAI_HOAT_DONG: !isEmpty(item.TRANG_THAI_HOAT_DONG) ? item.TRANG_THAI_HOAT_DONG : null

						};
                    });

                    return arrData;
                } else {
                    console.error('Error fetching data from server');

					showToastFailure('top-right', json ? json.STATUS_DETAIL : 'Internal server');

                    return []; // Return array empty DataTables
                }
            }
		}
	
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
						let productId = !isEmpty(row.ID) ? row.ID : '';
						let html = '<span data-id="' + productId + '" >' + data + '</span>';
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
					"title": "Tên sản phẩm"
					, "data": "TEN_SAN_PHAM" // Dữ liệu lấy từ thuộc tính này

					, "visible": true // Có cho phép hiển thị column này hay không
	            	, "className": "text-left text-wrap-auto" // Class name cho column này
	            	, "searchable": true // Có cho phép search column này hay không
	            	, "orderable": true // Có cho phép sort column này hay không
	            	, "orderData": [3] // Sắp xếp theo dữ liệu cột index nào
					, "width": "300px"
					
					, "render": function (data, type, row, meta) {
						let pathUrl = '';
						if (!isEmpty(data)) {
							pathUrl = '{{ url("/admin/san-pham/chi-tiet") }}' + '/' + row.TEN_SAN_PHAM_SLUG + '-' + row.ID;
						}
						let html = '<a class="text-decoration-none" href="' + pathUrl + '"><span title="' + data + '">' + data + '</span></a>';
						return html;
					}
				}
	          , { 
					"title": "Danh mục sản phẩm"
					, "data": "DANH_MUC_SAN_PHAM" // Dữ liệu lấy từ thuộc tính này

					, "visible": true // Có cho phép hiển thị column này hay không
	            	, "className": "text-left text-wrap-auto" // Class name cho column này
	            	, "searchable": true // Có cho phép search column này hay không
	            	, "orderable": true // Có cho phép sort column này hay không
	            	, "orderData": [4] // Sắp xếp theo dữ liệu cột index nào
					, "width": "210px"
					
					, "render": function (data, type, row, meta) {
						return !isEmpty(data) ? data.TEN_DANH_MUC_SAN_PHAM : '';
					}
				}
			  , { 
					"title": "Giá cả"
					, "data": "GIA_CA" // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
	            	, "className": "text-left text-wrap-auto" // Class name cho column này
	            	, "searchable": true // Có cho phép search column này hay không
	            	, "orderable": true // Có cho phép sort column này hay không
	            	, "orderData": [5] // Sắp xếp theo dữ liệu cột index nào
					, "width": "240px"
					
					, "render": function (data, type, row, meta) {
						// Kiểm tra nếu là giá liên hệ hoặc không có giá
						if (row.IS_GIA_CA_LIEN_HE === true || isEmpty(data) || data === null || data === 0) {
							return '<span class="badge badge-warning" style="font-size: 14px;">Giá liên hệ</span>';
						}
						// Format giá tiền bằng tiếng Việt với viền màu xanh
						let textValue = formatVNDToText(data);
						return '<span class="badge badge-info" style="border: 2px solid #17a2b8; background-color: #17a2b8; color: white; font-size: 15px;">' + textValue + '</span>';
					}
				}

	          , { 
					"title": "Trạng thái"
					, "data": "TRANG_THAI"  // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-center" // Class name cho column này
					, "searchable": true // Có cho phép search column này hay không
					, "orderable": true // Có cho phép sort column này hay không
					, "orderData": [6] // Sắp xếp theo dữ liệu cột index nào
					, "width": "140px"
					
					, "render": function (data, type, row, meta) {
						if (data === 'SOLD') {
							return '<span class="badge badge-danger" style="font-size: 15px; background-color: #dc3545; color: white;">Đã bán</span>';
						} else if (data === 'USING') {
							return '<span class="badge badge-success" style="font-size: 15px; background-color: #28a745; color: white;">Đang bán</span>';
						} else {
							return '<span class="badge badge-secondary" style="font-size: 15px; background-color: #6c757d; color: white;">Không xác định</span>';
						}
					}
				}

	          , { 
					"title": "Hiển thị"
					, "data": "TRANG_THAI_HOAT_DONG"  // Dữ liệu lấy từ thuộc tính này
					
					, "visible": true // Có cho phép hiển thị column này hay không
					, "className": "text-center" // Class name cho column này
					, "searchable": false // Có cho phép search column này hay không
					, "orderable": false // Có cho phép sort column này hay không
					, "orderData": [7] // Sắp xếp theo dữ liệu cột index nào
					, "width": "100px"
					
					, "render": function (data, type, row, meta) {
						let isChecked = !isEmpty(data) && data === true ? true : false;

						let html = '<label class="switch">' +
								'	<input type="checkbox" class="action-btn primary" action-type="switch-active" ' + (isChecked ? "checked" : "") + '>' +
								'	<span class="slider"></span>' +
								'</label>';
						return html;
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
		, "iDisplayLength": 10
		, "language": {
			/* Đổi label search */
			"search": "Tìm kiếm"
			/* Set placeholder textbox search */
			, "searchPlaceholder": 'Nhập từ khóa...'
			/* Đổi label hiển thị kết quả */
	        , "info" : "<p class=\"card-description\">Hiển thị _START_ đến _END_. <span class=\"one-line\">Tổng số <code>_TOTAL_ kết quả</code> </span></p>" // text you want show for info section
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
	        }
	        
		}
		/* Dom set phần hiển thị chọn số lượng, ô tìm kiếm và phân trang */
		, "dom": 'Bflrtip'
		, "buttons": [
			// Button hiển thị danh sách theo CARD hoặc LIST
			{
				attr:  {
					title: 'Change views',
					id: 'card-toggle'
				}
				, text: 'Hiển thị kiểu <i class="fa fa-id-badge fa-fw fa-lg" aria-hidden="true"></i>'
				, className: 'animated bounce d-none'
				, action: function () {
					// $('#tableProduct').DataTable().columns([0]).visible(false, true);
					// $('#tableProduct').DataTable().columns.adjust().draw(false); // Điều chỉnh kích thước cột và vẽ lại
				}
			}
		]
		/* Tuỳ chỉnh thông tin hiển thị ở footer. */
		, infoCallback: function (settings, start, end, max, total, pre) { 
			return pre;
		}
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
			const dropdownsOnTable = $("#tableProduct .dropdown-toggle");
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
			const images = document.querySelectorAll("#tableProduct .td-img-thumnail > img");
			images.forEach((image) => {
				$(image).on("error", function(e) {
					image.src = "{{asset('image/UI-BACKEND/default-no-image.jpg') }}";
				});
			});

			// Chuyển đến trang cho lần refresh trang lần đầu tiên
			const pageInfo = $('#tableProduct').DataTable().page.info();
			if (settings.iDraw == 2) { // Số lần vẽ bảng. 1 lần init empty table + 1 lần retrieve lần đầu tiên (First time)
				let startPageFrUrl = window.wwAdminListUrl ? window.wwAdminListUrl.pageIndex(10) : 0;
				if (Number(pageInfo.pages) >= Number(startPageFrUrl)) 

				settings.IS_CALL_AJAX = false;
				$('#tableProduct').DataTable().page(startPageFrUrl).draw(false); // Draw bảng về trang nào
			}

			// Điều chỉnh lại kích thước cột
			$('#tableProduct').DataTable().columns.adjust();
        }
		/* Sau khi hoàn thành khởi tạo Datatables */
		,"initComplete": function (settings, json) {
			if (window.matchMedia('(max-width: 575px)').matches) { // Ẩn column nào khi là kích thước Mobile
				$('#tableProduct').DataTable().columns([0]).visible(false, true);
			}
			
			// Khởi tạo scroll ngang và dọc cho datatables
			$("#tableProduct").wrap("<div style='overflow:auto; width: 100%; position:relative; max-height: 70vh;'></div>");
			console.log(this.api().rows().data());
		}
    });

	// Listen event Datatables 
	dataTableProduct.on('page', function (e, settings) { // Event thay đổi page
		// Get thông tin page info
		let pageInfo = dataTableProduct.page.info();

		// Thêm tham số page vào URL
		let page = pageInfo.page + 1; // DataTables sử dụng index 0 cho trang, +1 để phù hợp với hiển thị của người dùng
		let length =  pageInfo.length > 0 ? pageInfo.length : 'all';
		if (page > 0 && window.wwAdminListUrl) {
			window.wwAdminListUrl.sync(page, length);
		}
	}).on('length.dt', function(e, settings, len) { // Event thay đổi 
		if (settings.iDraw !== 1) {
			settings.IS_CALL_AJAX = false;
			dataTableProduct.page('first').draw(false); // Chuyển về trang đầu và vẽ lại bảng
			
			if (window.wwAdminListUrl) {
				window.wwAdminListUrl.sync(1, len);
			}
		}
	}).on('preDraw', function(e, settings) { // Trước khi draw bảng. return TRUE -> tiếp tục. FALSE -> dừng không vẽ
		console.log('preDraw xảy ra tại: ' + new Date().getTime());
		if (settings.IS_CALL_AJAX === false) {
			settings.IS_CALL_AJAX = true;
			return false;
		}
		return true;

	}).on('draw', function(e, settings) { // Event draw bảng
		console.log('Redraw xảy ra tại: ' + new Date().getTime());
	});
	

    /* Handle event click action từng dòng row datatables */
    $('#tableProduct tbody').on('click', '.action-btn', function(e) {
        // Có thể dùng [e.currentTarget] để get thông tin element click hiện tại là gì
    	e.currentTarget;

    	// Get data row đang select từ datatables
    	var row = $(this).parents('tr');
		var data = dataTableProduct.row(row).data();

    	let actionType = $(e.currentTarget).attr('action-type') || '';
    	switch(actionType) {
    		case 'btn-edit':
    			let urlEdit = '{{ url("/admin/san-pham/chi-tiet") }}' + '/' + data.ID;
    			window.location.assign(urlEdit);
    	    	break;
    	  	case 'btn-delete':
    	  		// Xóa category product
				deleteProduct(data.ID, row);
    	    	break;
    	  	case 'switch-active':
    	  		switchActive(data.ID, row);
      	    	break;
    	  	case 'btn-move-down':
      	    
      	    	break;
    	}    	
    });

    /* Xử lý xóa product */
    function deleteProduct(productId, row) {
		// Gọi api xóa categoryP
		if (productId === '') {
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
					url: '{{ url("/api/product/delete") }}' + "/" + productId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify(data), 
					success: function(data, textStatus, request) {
						// Ajax call completed successfully 
    					showToastSuccess('top-right', data.STATUS_DETAIL);

    					// Datatables: Xóa row hiện tại. Nhưng k draw lại bảng, để keep phân trang. Nó vẫn xử lý ổn. Để không bị luôn go-back về page đầu tiên
    					dataTableProduct.row(row).remove().draw(false);
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

    /* Xử lý switch active Hiển thị */
    function switchActive(productId, row) {
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
					url: '{{ url("/api/product/active") }}' + "/" + productId, 
					contentType: "application/json",
					showLoading: true,
					data: JSON.stringify(data), 
					success: function(data, textStatus, request) {
						// Ajax call completed successfully 
    					showToastSuccess('top-right', data.STATUS_DETAIL);

						// Set lại giá trị cho cột ẩn giá trị active
    					let cellGiaTriActive = dataTableProduct.cell(row, '6');
    					// Datatables: active row hiện tại. Nhưng k draw lại bảng, để keep phân trang. Nó vẫn xử lý ổn. Để không bị luôn go-back về page đầu tiên
						cellGiaTriActive.data(isActived).draw(false);

						// Cập nhật UI row tương ứng
						row.prevObject.prop('checked', isActived);
					}, 
					error: function(request, textStatus, errorThrown) {
						if (request.status !== 401 && request.status !== 403) {
							request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
							showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
						}

						/* Xử lý trả lại dữ liệu switch Hiển thị trước đó */
						let elemActive = row.prevObject;
						elemActive.prop('checked', !isActived);
					},
					complete: function(){
					}
				});
  		    } else if (result.isDismissed === true) {
  		    	/* Xử lý trả lại dữ liệu switch Hiển thị trước đó */
  		    	let elemActive = row.prevObject;
  		    	elemActive.prop('checked', !isActived);
      	    } else if (result.isDenied === true) {

			}
		}, 'Bạn có muốn thay đổi <span style="display: inline-block;">trạng thái Hiển thị?</span>');
    }

    function fnSearchProduct() {
		// Trigger call Ajax reload Datatables
		let length = window.wwAdminListUrl ? window.wwAdminListUrl.dataTableLength(10) : $('#tableProduct').DataTable().page.len();

		// Fetch api retrieve data
		dataTableProduct.page(0).page.len(length).ajax.reload(null, false);
    }

	/* START Xử lý Async fetch data search, trước khi retrieve danh sách */
	var promiseLoadDataListStatusActive = loadDataListStatusActive();
	var promiseLoadDataListDanhMucSanPham = getListDanhMucSanPhamTree();

	$.when(promiseLoadDataListDanhMucSanPham, promiseLoadDataListStatusActive)
	.done(function(objDanhMucSanPham, objTrangThaiHoatDong) {
		fnSearchProduct();
	})
	.fail(function(...args) {
		console.log(`Lỗi đầu tiên. Và dừng tiến trình`);
		console.log(args);
	})
	.always(function() {
	});
	/* END Xử lý Async fetch data search, trước khi retrieve danh sách */

   	/* Handle event click btn search */
    $('#btnSearch').on('click', function() {
		if (window.wwAdminListUrl) {
		window.wwAdminListUrl.sync(1, 10);
		}
  
		fnSearchProduct();
    });

	/* Handle event click btn reset */
	$('#btnReset').on('click', function(e) {
		$('#SEARCH_TU_KHOA').val(null);
		setValueSelect2($('#SELECT_STATUS_ACTIVE'), 'all');
		setValueSelect2($('#SELECT_DANH_MUC_SAN_PHAM'), 'all');
		$('#SELECT_TRANG_THAI').val('all');
		fnSearchProduct();
	});

	$('#SEARCH_TU_KHOA').keyup(function(e) {
		if (e.keyCode == 13) {
			$(this).trigger('nhanPhimEnter'); // Có thể tự define 1 loại event mới tùy ý
		}
	});
	// Listen. Có thể tự define 1 loại event mới tùy ý
	$('#SEARCH_TU_KHOA').on('nhanPhimEnter', function(e) {
		fnSearchProduct();
	});
});
</script>
@stop
