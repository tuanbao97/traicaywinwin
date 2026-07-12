<?php

namespace App\Repository;

use App\Enum\AppConstant;

abstract class BaseRepository implements RepositoryInterface
{
    //model muốn tương tác
    protected $model;

    //khởi tạo
    public function __construct()
    {
        $this->setModel();
    }

    public function setModel() {
        $this->model = app()->make(
            $this->getModel()    
        );
    }

    //lấy model tương ứng
    abstract public function getModel();

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update($id, array $attributes, $primaryKey = 'ID')
    {
        $result = $this->find($id, $primaryKey);
        if (!$result) {
            return null;
        }
        $result->update($attributes);
        return $result;
        
    }

    public function find($id, $primaryKey = 'ID')
    {
        $result = $this->model->whereIn('STATUS', [
                AppConstant::STATUS_USING,
                AppConstant::STATUS_SOLD
            ])->where($primaryKey, '=', $id);
        return $result;
    }

    public function save(array $attributes, $primaryKey = 'ID')
    {
        $model = null;
        
        if (is_null($attributes[$primaryKey])) {
            $model = $this->create($attributes);
        } else {
            $model = $this->update($attributes[$primaryKey], $attributes, $primaryKey);
        }
        return $model;
        
    }


}
