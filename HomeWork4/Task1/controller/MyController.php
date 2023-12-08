<?php
class MyController
{
    private $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function getAllRecords(): array|bool
    {
        return $this->model->getAllRecordsModel();
    }
}
