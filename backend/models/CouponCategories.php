<?php

namespace backend\models;

use Yii;
// Generated using gii tool.

/**
 * This is the model class for table "CouponCategories".
 *
 * @property integer $CategoryID
 * @property string $Name
 * @property string $URLKeyword
 * @property integer $Priority
 * @property string $ImageLink
 * @property string $Title
 * @property string $MetaDescription
 * @property integer $NumActiveCoupons
 * @property string $CategoryImageColourCode
 * @property integer $FeaturedOnAppHome
 * @property double $CategoryPopularityScore
 */
class CouponCategories extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'CouponCategories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['URLKeyword', 'ImageLink', 'MetaDescription'], 'required'],
            [['Priority', 'NumActiveCoupons', 'FeaturedOnAppHome'], 'integer'],
            [['ImageLink', 'Title', 'MetaDescription'], 'string'],
            [['CategoryPopularityScore'], 'number'],
            [['Name', 'URLKeyword'], 'string', 'max' => 200],
            [['CategoryImageColourCode'], 'string', 'max' => 50],
            [['Name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'CategoryID' => 'Category ID',
            'Name' => 'Name',
            'URLKeyword' => 'Urlkeyword',
            'Priority' => 'Priority',
            'ImageLink' => 'Image Link',
            'Title' => 'Title',
            'MetaDescription' => 'Meta Description',
            'NumActiveCoupons' => 'Num Active Coupons',
            'CategoryImageColourCode' => 'Category Image Colour Code',
            'FeaturedOnAppHome' => 'Featured On App Home',
            'CategoryPopularityScore' => 'Category Popularity Score',
        ];
    }
}
