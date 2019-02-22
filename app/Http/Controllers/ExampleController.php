<?php 

namespace App\Http\Controllers;

class ExampleController extends Controller
{
    use \App\HDP\BasicCrud;

    public $model = '\App\Models\Account';
    
    // public $dataDelete = ['status'=>'DECLINED'];
    
    public $insertValidation = [
        'balance' => 'required|numeric',
        'recStatus'=>'in:DELETE,DRAFT,ARCHIVE,PUBLISH'
    ];
    
    public $updateValidation = [
        'balance' => 'required|numeric',
        'id'=>'required|numeric',
        'recStatus'=>'in:DELETE,DRAFT,ARCHIVE,PUBLISH'
    ];

    public function index()
    {
        $this->responseCode = 200;
        $this->results = [1,2,3,4];
        return $this->response();
    }
}
