<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\MainCategory;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;

class MaincategoryController extends Controller
{
    use GeneralTrait ;
    public function index()
    {
        $category = MainCategory::selection()->get();

        //return $this->returnData('category' , $category , 'success');
        return response()->json($category,201);
    }

    public function getCategoryById(Request $request)
    {
        $category = MainCategory::selection()->find( $request->id);
        if(!$category)
        {
            return $this-> returnError('01','not fount category');
        }

        else
            return  $this->returnData('category' , $category ,'success' );

    }
    public function changeStatus(Request $request)
    {
        $category = MainCategory::selection()->find( $request->id);
        if(!$category)
        {
            return $this-> returnError('01','not fount category');
        }

        else
            $category->update(['active' =>  $request->active]);
            return  $this->returnSuccessMessage('sucess to update ' , '001');

    }

}
