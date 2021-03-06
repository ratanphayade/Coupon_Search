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
class CouponController extends Controller{
    
    public function actionIndex(){
        
        $coupons = Coupon::find();
        
        //ng page size
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $coupons->count(),
        ]);
        
        //Querying for Data
        $filteredCoupons = $coupons
                    ->orderBy('CouponID')
                    ->joinWith('website')
                    ->joinWith('couponCategories')
                    ->offset($pagination->offset)
                    ->limit($pagination->limit)
                    ->all();
        
        //Rendering to the Webpage
        return $this->render('index', [
            'coupons' => $filteredCoupons,
            'stores' => $this->getAllWebsites(),
            'category' => $this->getAllCategories(),
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
    public function actionSearch($couponType, $Stores, $Category){
        $coupontype = $_GET['couponType'];

        $store = (isset($_GET['Stores']))? $_GET['Stores'] : "all";
        
        $category = (isset($_GET['Category']))? $_GET['Category'] : "all";
                 
        $coupons = Coupon::find();
        
        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $coupons->count(),
        ]);
        
        $filteredCoupons = $this->extractData($coupons, $coupontype, $store, 
                                              $category , $pagination->limit, 
                                              $pagination->offset);

        // Partially rendering the search result to existing page
        return $this->renderPartial('search', [
                    'coupons' => $filteredCoupons,       
                    'status' => empty($filteredCoupons)? 0 : 1,
                    'pagination' => $pagination,
            
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
    
    public function actionDownload($couponType, $Stores, $Category) {
        
        $coupontype = $_GET['couponType'];

        $store = (isset($_GET['Stores']))? $_GET['Stores'] : "all";
        
        $category = (isset($_GET['Category']))? $_GET['Category'] : "all";
        
        $coupons=$this->extractData(Coupon::find(), $category, $store, $category);
        
        $excel = new PHPExcel();
        $excel->getActiveSheet()
                  ->setCellValue('B1', "Title")
                  ->setCellValue('C1', "Website Name")
                  ->setCellValue('D1', "Coupon Code")
                  ->setCellValue('E1', "Description");
        $i = 2;
        foreach ($coupons as $coupon) {
            $excel->getActiveSheet()
                  ->setCellValue('B'.$i, $coupon->Title)
                  ->setCellValue('C'.$i, $coupon->website->WebsiteName)
                  ->setCellValue('D'.$i, $coupon->CouponCode)
                  ->setCellValue('E'.$i, $coupon->Description);
            $i++;
        }
        
        // Naming the active spread sheet
        $excel->getActiveSheet()->setTitle('List Of Coupons');
        $excel->setActiveSheetIndex(0);

        // Redirect output to a clients web browser (Excel5)
        header('Cache-Control: max-age=0');
        $objWriter = \PHPExcel_IOFactory::createWriter($excel, 'Excel5');
 
        // We'll be outputting an excel file
        header('Content-type: application/vnd.ms-excel');

        // It will be called file.xls
        header('Content-Disposition: attachment; filename="result.xls"');

        // Write file to the browser
        $objWriter->save('php://output');
    }
    
    /**
     *  This function returns the filtered coupons list to the calling function.
     * @coupontype : This parameter will hold the value of coupon type [deal=>1 | coupon=>0]
     * @store      : This parameter will hold the value of website ID
     * @category   : This parameter will hold the value of category ID
     * @return filtered coupons to calling function view
     *
     */
    
    private function extractData($query, $coupontype, $store, $category, $limit=60, $offset=0){

        $condition = "";
        
        //Seting the search critaria
        if($coupontype != 'all'){
            $condition .= "IsDeal=$coupontype && ";
        }
        if($store != 'all'){
            $condition .= "website.WebsiteID=$store && ";
        }
        if($category != 'all'){
            $condition .= "CouponCategories.CategoryID=$category && ";
        }
        $condition .= "1";
        
        return $query
                    ->where($condition)        
                    ->orderBy('CouponID')
                    ->joinWith('website')
                    ->joinWith('couponCategories')
                    ->limit($limit)
                    ->offset($offset)
                    ->all();
    }
}
