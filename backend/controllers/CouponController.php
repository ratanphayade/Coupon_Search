<?php

namespace backend\controllers;

use Yii;
use backend\models\Coupon;
use backend\models\Website;
use backend\models\CouponCategories;
use yii\web\Controller;
use yii\data\Pagination;
use PHPExcel;

/**
 * CouponController
 */
class CouponController extends Controller
{
    
    public function actionIndex()
    {
        
        $query = Coupon::find();
        
        // Listing all available Stores
        $stores = $this->getAllWebsites();
        //Listing all available Categories
        $category = $this->getAllCategories();
        
        //Setting page size
        $pagination = new Pagination([
            'defaultPageSize' => 60,
            'totalCount' => $query->count(),
        ]);
        
        //Querying for Data
        $coupons = $query
                    ->orderBy('CouponID')
                    ->joinWith('website')
                    ->joinWith('couponCategories')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        
        //Rendering to the Webpage
        return $this->render('index', [
            'coupons' => $coupons,
            'stores' => $stores,
            'category'=>$category,
            'pagination' => $pagination,
        ]);
    }
/*
 * This function will handle the search action
 * This takes three parameters and partially renders the result to the page
 * @coupontype : This parameter will hold the value of coupon type [deal=>1 | coupon=>0]
 * @store      : This parameter will hold the value of website ID
 * @category   : This parameter will hold the value of category ID
 * @return     : Filtered coupon list to search view
 * if not set all the parameter will have the value as string 'all'
 */
    public function actionSearch($coupontype, $store, $category){
        $coupontype = $_GET['coupontype'];

        $store = (isset($_GET['store']))? $_GET['store'] : "all";
        
        $category = (isset($_GET['category']))? $_GET['category'] : "all";
        
        // Partially rendering the search result to existing page
        return $this->renderPartial('search', [
                    'coupons' => $this->extractData($coupontype, $store, $category),           
        ]); 
    }
    
    //This function will return all website details
    private function getAllWebsites(){   
        return Website::find()->orderBy('WebsiteName')->all();        
    }
    
    //This function will return all Cetegory details
    private function getAllCategories() {
        return CouponCategories::find()->orderBy('Name')->all();   
    }
    
/**
* This function will handle the download Action
* This takes three parameters and generated the excel file
* @coupontype : This parameter will hold the value of coupon type [deal=>1 | coupon=>0]
* @store      : This parameter will hold the value of website ID
* @category   : This parameter will hold the value of category ID
* @return filtered coupons to search view
*/
    
    public function actionDownload($coupontype, $store, $category) {
       
        $objPHPExcel = new \PHPExcel();
        
        $coupontype = (isset($_GET['coupontype']))? $_GET['coupontype'] : "all";

        $store = (isset($_GET['store']))? $_GET['store'] : "all";
        
        $category = (isset($_GET['category']))? $_GET['category'] : "all";
        
        
        $coupons=$this->extractData($caregory, $store, $category);
        $i = 1;
        foreach ($coupons as $coupon) {
            $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$i, $coupon->CouponID)
            ->setCellValue('B'.$i, $coupon->Title)
            ->setCellValue('C'.$i, $coupon->Description)
            ->setCellValue('D'.$i, $coupon->CouponCode)
            ->setCellValue('E'.$i, $coupon->website->WebsiteName);
            $i++;
        }
        
 
        // Naming the active spread sheet
        $objPHPExcel->getActiveSheet()->setTitle('List Of Coupons');
        $objPHPExcel->setActiveSheetIndex(0);

        // Redirect output to a clients web browser (Excel5)
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');
        // It will be called file.xls
        header('Content-Disposition: attachment; filename="coupons.xls"');

    }
    
    /**
     *  This function returns the filtered coupons list to the calling function.
     * @coupontype : This parameter will hold the value of coupon type [deal=>1 | coupon=>0]
     * @store      : This parameter will hold the value of website ID
     * @category   : This parameter will hold the value of category ID
     * @return filtered coupons to calling function view
     *
     */
    
    private function extractData($coupontype, $store, $category){

        $condition = "";
        
        //Seting the search critaria
        
        if($coupontype != 'all')
            $condition .= "IsDeal=$coupontype && ";
        
        if($store != 'all')
            $condition .= "WebsiteID=$store && ";
        
        if($category != 'all')
            $condition .= "CouponCategories.CategoryID=$category && ";
        
        $condition .= "1=1";
        
        return Coupon::find()
                    ->where($condition)        
                    ->orderBy('CouponID')
                    ->with('website')
                    ->joinWith('couponCategories')
                    ->limit(100)
                    ->all();
    }
}
