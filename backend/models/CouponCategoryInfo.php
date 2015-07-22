<?php

namespace backend\models;

use Yii;
// Generated using gii tool.
/**
 * This is the model class for table "CouponCategoryInfo".
 *
 * @property integer $CategoryInfoID
 * @property integer $CouponID
 * @property integer $CategoryID
 * @property integer $SubCategoryID
 * @property integer $isFeaturedUnderCategory
 * @property integer $FeaturedRankUnderCategory
 * @property string $CategoryFeatureEndTime
 */
class CouponCategoryInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponCategoryInfo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['CouponID', 'CategoryID', 'SubCategoryID'], 'required'],
            [['CouponID', 'CategoryID', 'SubCategoryID', 'isFeaturedUnderCategory', 'FeaturedRankUnderCategory'], 'integer'],
            [['CategoryFeatureEndTime'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryInfoID' => 'Category Info ID',
            'CouponID' => 'Coupon ID',
            'CategoryID' => 'Category ID',
            'SubCategoryID' => 'Sub Category ID',
            'isFeaturedUnderCategory' => 'Is Featured Under Category',
            'FeaturedRankUnderCategory' => 'Featured Rank Under Category',
            'CategoryFeatureEndTime' => 'Category Feature End Time',
        ];
    }
    
    
}
