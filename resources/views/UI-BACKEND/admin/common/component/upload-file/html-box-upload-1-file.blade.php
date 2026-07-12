@include('UI-BACKEND.admin.common.component.upload-file.box-upload-1-file',
    [
        'sectionId' => 'section_' . $uuid,
        'aspectRatio' => '1x1',
        'ratio' => '1/1',
        'maxWidth' => '350px'
    ]
)
<script>
$(document).ready(function () {
    /* START Handle upload box 1 ảnh  */
    {{'section_' . $uuid}}_setDefaultTextBoxUplOneImg('{{ $title }}');

    // Định nghĩa hàm
    // Khởi tạo object nếu chưa tồn tại
    window.myFunctionsOnHtmlBoxUpload1File = window.myFunctionsOnHtmlBoxUpload1File || {};

    // Thêm hàm vào đối tượng mà không ghi đè
    Object.assign(window.myFunctionsOnHtmlBoxUpload1File, {
        
        "{{'section_' . $uuid}}_getHinhAnhDaiDien": function() {
            return {{ 'section_' . $uuid }}_getDanhSachUploadHinhAnhDaiDien();
        },

        "{{'section_' . $uuid}}_setThumbnailBoxOneImg": function(nameFile, directory) {
            {{ 'section_' . $uuid }}_setThumbnailBoxOneImg($("#{{'section_' . $uuid}}_divDropZone")[0], nameFile, directory);
        },

        "{{ 'section_' . $uuid }}_setChiTietHinhAnh": function(objAvatar) {
            {{ "section_" . $uuid }}_chiTietHinhAnh(objAvatar);
        },

        "{{ 'section_' . $uuid }}_setInputUploadHinhAnhDaiDien": function(objAvatar) {
            {{ "section_" . $uuid }}_appendInputUploadHinhAnhDaiDien(objAvatar);
        }
    });
});
</script>