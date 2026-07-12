
<style>
</style>

<select class="form-control form-select form-control-default border-radius-2px border-top-left-radius-0px border-bottom-left-radius-0px" 
	id="{{ $elemSelectId }}" data-placeholder="Vui lòng chọn">
</select>
									
<script>
var loadDataListStatusActive; // Function fetch data danh sách trạng thái hoạt động

$(document).ready(function(){
	
	if ({{ $isDefaultGetAll }} == true) {
		/* Tạo select2 tất cả default value cho combobox này (Nếu không dùng thì xóa đi) */
		$('#{{ $elemSelectId }}').append('<option value="all">Tất cả</option>');
	}

    loadListVaiTro = function() {
		let defered = $.Deferred();

		/* Xử lý get chi tiết product */
		// Create object data to check
		var inputData = {
		};

		$.ajax({
			type : "GET",
			url: '{{ url("/api/role/list") }}', 
			contentType : "application/json",
			traditional: true,
			showLoading: false,
			data : inputData,
			success : function(data, textStatus, request) {
				data = data.DATAS.ROLE;
				if (!isEmpty(data)) {
					for (let index = 0; index < data.length; index++) {
						$('#{{ $elemSelectId }}').append(`<option value="${data[index].ID}">${data[index].TEN_VAI_TRO}</option>`);
					}
				}

				defered.resolve(data, textStatus, request);
			},
			error : function(request, textStatus, errorThrown) {
				if (request.status !== 401 && request.status !== 403) {
					request.responseJSON = request.responseText ? JSON.parse(request.responseText) : null;
					showToastFailure('top-right', request.responseJSON ? request.responseJSON.STATUS_DETAIL : 'Internal server');
				}
				defered.reject(request, textStatus, errorThrown);
			},
			complete : function() {
			}
		});

		return defered.promise();
	}
});
</script>