<style>
</style>

<select class="form-control select2-padding-custom" id="{{ $elemSelect2Id }}" data-placeholder="Vui lòng chọn">
</select>
									
<script>
var loadDataListStatusActive; // Function fetch data danh sách trạng thái hoạt động

$(document).ready(function(){
	/* Init combobox select2 trạng thái hoạt động */
    // Function init select2 trạng thái hoạt động
    function initSelect2TreeDanhMucTinTuc(arrayData, isDefaultGetAll, selectedVal) {
    	// Empty dữ liệu và destroy select2 trước đó
		if($("#{{ $elemSelect2Id }}").data('select2')) $("#{{ $elemSelect2Id }}").empty().select2('destroy');
    
    	if (isDefaultGetAll === true) {
    		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
        	$('#{{ $elemSelect2Id }}').append('<option value="all">Tất cả</option>');
        	$('#{{ $elemSelect2Id }}').val('all').trigger('change');
    	}
    	
		$("#{{ $elemSelect2Id }}").select2ToTree(
			{
				/* [Quan trọng] Phần khởi tạo input select2 tree */
				treeData: {
					/* Một mảng chứa dữ liệu */
					dataArr: arrayData, 
					/* id của select2 sẽ mapping với field nào trong arrayData */
					valFld: "ID",
					/* Tên label của select2 sẽ mapping với field nào trong arrayData */
					labelFld: "TEN_DANH_MUC_TIN_TUC",
					/* Tên object chứa array children */
					incFld: "DANH_SACH_CHILDREN",
					/* Có đươc expand hay collapse */
					expandAll: true
				}, 
				maximumSelectionLength: 10,
				width: "100%",
				closeOnSelect: true,
				placeholder: $( this ).data( 'placeholder' ),
				allowClear: true,
				multiple: true,
				/* Set thông tin message cho select2 */
	    		language: {
	                noResults: function() {
	                    return "Không tìm thấy kết quả";
	                }
					, maximumSelected: function(args) {
						return "Bạn chỉ được chọn tối đa " + args.maximum + " mục.";
					}
	            }
			}
		);
    
		// Set selected value
		if (!isEmpty(selectedVal)) $("#{{ $elemSelect2Id }}").val(selectedVal).trigger('change');
    	
    }
    // Event select2 nên để bên ngoài function init để tránh trường hợp duplicate call event
    $('#{{ $elemSelect2Id }}').on('select2:select', function (e) {
		let currItemSelecting = e.params.data.id;
		if (!isEmpty(currItemSelecting) && currItemSelecting == 'all') { // Khi chọn all thì sẽ xóa hết các item còn lại
			let arrItem = $('#{{ $elemSelect2Id }}').val().filter(item=>item == 'all');
			$('#{{ $elemSelect2Id }}').val(arrItem).trigger('change');
		} else if ($('#{{ $elemSelect2Id }}').val().length > 1 && $('#{{ $elemSelect2Id }}').val().includes('all')) { // Khi chọn các item còn lại thì xóa All
			let arrItem = $('#{{ $elemSelect2Id }}').val().filter(item=>item != 'all');
			$('#{{ $elemSelect2Id }}').val(arrItem).trigger('change');
		}
    }).on('change', function (e) {
		
    }).on('select2:open', function() {
		// Ngăn bàn phím mở tự động khi dropdown được mở
		preventOpenKeyboardSelect2();
	});
    
	getListDanhMucTinTucTree = function(selectedVal) {
		let $deferred = $.Deferred();
		
		$.ajax({
			type : "GET",
			url : '{{ url("/api/categoryn/list/tree") }}',
			contentType : "application/json",
			traditional: true,
			showLoading: false,
			data : function() { // IIFE 
				let dataInput = {};

				dataInput.IS_GET_ALL_ELEMENTS = true;

				return dataInput; // Trả về object input data
			}(),
			success : function(data, textStatus, request) {
				/* [Quan trọng] đây là phần build data cho select2 tree */
				let arrResult = [];
				var result = data.DATAS.CATEGORY_N;
				if (result && result.DATA) {
					arrResult = result.DATA;
				}

				// Init select2 tree
				initSelect2TreeDanhMucTinTuc(arrResult, {{ $isDefaultGetAll }}, selectedVal || null);

				$deferred.resolve(data, textStatus, request);
			},
			error : function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}

				$deferred.reject(request, textStatus, errorThrown);
			},
			complete : function() {
			}
		});

		return $deferred.promise();
	}


});
</script> 