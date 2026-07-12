<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('district', function (Blueprint $table) {
            $table->comment('Quận / huyện');
            $table->string('CODE', 191)->primary()->comment('Mã thành phố - tỉnh thành - quận huyện');
            $table->string('NAME', 2000)->comment('Tên thành phố - tỉnh thành - quận huyện');
            $table->string('TYPE', 1000)->nullable()->comment('Loại là: Tỉnh hay Thành Phố');
            $table->integer('SORT_ORDER')->nullable()->comment('Số thứ tự');
            $table->string('PARENT_CODE', 1000)->nullable()->comment('Parent mã thành phố - tỉnh thành - quận huyện');
            $table->longText('DESCRIPTION')->nullable()->comment('Mô tả');
            $table->dateTime('CRT_DT', 6)->nullable()->comment('Ngày tạo');
            $table->dateTime('UPD_DT', 6)->nullable()->comment('Ngày chỉnh sửa');
            $table->string('CRT_NAME', 500)->nullable()->comment('Tên người tạo');
            $table->string('UPD_NAME', 500)->nullable()->comment('Tên người sửa');
            $table->bigInteger('CRT_ID')->nullable()->comment('Người tạo');
            $table->bigInteger('UPD_ID')->nullable()->comment('Người chỉnh sửa');
            $table->string('STATUS')->default('USING')->comment('Trạng thái sử dụng: \'USING\' / \'DELLETED\'');
            $table->boolean('IS_ACTIVE')->nullable()->default(true)->comment('Có đang active sử dụng hay không');
            $table->string('PROVINCES_CODE', 191)->index();
            $table->longText('ATTR1')->nullable()->comment('ATTR1');
            $table->longText('ATTR2')->nullable()->comment('ATTR2');
            $table->longText('ATTR3')->nullable()->comment('ATTR3');
            $table->longText('ATTR4')->nullable()->comment('ATTR4');
            $table->longText('ATTR5')->nullable()->comment('ATTR5');
            $table->longText('ATTR6')->nullable()->comment('ATTR6');
            $table->longText('ATTR7')->nullable()->comment('ATTR7');
            $table->longText('ATTR8')->nullable()->comment('ATTR8');
            $table->longText('ATTR9')->nullable()->comment('ATTR9');
            $table->longText('ATTR10')->nullable()->comment('ATTR10');
            $table->longText('ATTR11')->nullable()->comment('ATTR11');
            $table->longText('ATTR12')->nullable()->comment('ATTR12');
            $table->longText('ATTR13')->nullable()->comment('ATTR13');
            $table->longText('ATTR14')->nullable()->comment('ATTR14');
            $table->longText('ATTR15')->nullable()->comment('ATTR15');
            $table->longText('ATTR16')->nullable()->comment('ATTR16');
            $table->longText('ATTR17')->nullable()->comment('ATTR17');
            $table->longText('ATTR18')->nullable()->comment('ATTR18');
            $table->longText('ATTR19')->nullable()->comment('ATTR19');
            $table->longText('ATTR20')->nullable()->comment('ATTR20');
            $table->longText('ATTR21')->nullable()->comment('ATTR21');
            $table->longText('ATTR22')->nullable()->comment('ATTR22');
            $table->longText('ATTR23')->nullable()->comment('ATTR23');
            $table->longText('ATTR24')->nullable()->comment('ATTR24');
            $table->longText('ATTR25')->nullable()->comment('ATTR25');
            $table->longText('ATTR26')->nullable()->comment('ATTR26');
            $table->longText('ATTR27')->nullable()->comment('ATTR27');
            $table->longText('ATTR28')->nullable()->comment('ATTR28');
            $table->longText('ATTR29')->nullable()->comment('ATTR29');
            $table->longText('ATTR30')->nullable()->comment('ATTR30');
            $table->longText('ATTR31')->nullable()->comment('ATTR31');
            $table->longText('ATTR32')->nullable()->comment('ATTR32');
            $table->longText('ATTR33')->nullable()->comment('ATTR33');
            $table->longText('ATTR34')->nullable()->comment('ATTR34');
            $table->longText('ATTR35')->nullable()->comment('ATTR35');
            $table->longText('ATTR36')->nullable()->comment('ATTR36');
            $table->longText('ATTR37')->nullable()->comment('ATTR37');
            $table->longText('ATTR38')->nullable()->comment('ATTR38');
            $table->longText('ATTR39')->nullable()->comment('ATTR39');
            $table->longText('ATTR40')->nullable()->comment('ATTR40');
            $table->longText('ATTR41')->nullable()->comment('ATTR41');
            $table->longText('ATTR42')->nullable()->comment('ATTR42');
            $table->longText('ATTR43')->nullable()->comment('ATTR43');
            $table->longText('ATTR44')->nullable()->comment('ATTR44');
            $table->longText('ATTR45')->nullable()->comment('ATTR45');
            $table->longText('ATTR46')->nullable()->comment('ATTR46');
            $table->longText('ATTR47')->nullable()->comment('ATTR47');
            $table->longText('ATTR48')->nullable()->comment('ATTR48');
            $table->longText('ATTR49')->nullable()->comment('ATTR49');
            $table->longText('ATTR50')->nullable()->comment('ATTR50');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('district');
    }
};
