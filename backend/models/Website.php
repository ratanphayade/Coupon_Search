<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "Website".
 *
 * @property integer $WebsiteID
 * @property integer $IsSpecialPopUp
 * @property string $WebsiteTitle
 * @property string $WebsiteName
 * @property string $URLKeyword
 * @property string $WebsiteURL
 * @property string $Description
 * @property integer $AdNetworkID
 * @property string $AffilateURL
 * @property integer $IsActive
 * @property integer $IsFeatured
 * @property string $AndroidPackageName
 * @property string $AndroidDeeplinkUrl
 * @property string $iOSPackageName
 * @property string $iOSDeeplinkUrl
 * @property string $WindowsPackageName
 * @property string $WindowsDeeplinkUrl
 * @property string $SearchKeywords
 * @property string $DateAdded
 * @property integer $Views
 * @property string $DateEmailsLastSent
 * @property string $AlternateSpellings
 * @property integer $UseHomeAsLandingPage
 * @property string $RequiredQueryString
 * @property string $OverrideAffiliateUrlFormat
 * @property integer $DisableLandingPages
 * @property integer $ModerateUserCoupons
 * @property string $AccessCode
 * @property integer $RatingCalculated
 * @property double $Rating
 * @property integer $NumOfRatings
 * @property integer $PauseAffiliateCampaign
 * @property integer $Tier
 * @property string $Notes
 * @property string $YouTubeVideoID
 * @property integer $AuthorID
 * @property string $PageTitle
 * @property string $MetaDescription
 * @property string $MetaKeywords
 * @property integer $PageTitleID
 * @property integer $noOfOffers
 * @property integer $noOfCoupons
 * @property integer $noOfDeals
 * @property integer $WebsiteCategoryID
 * @property string $LogoBackgroundColor
 * @property integer $noOfCouponsMinusOneTime
 * @property string $LogoLastModified
 * @property double $WebsitePopularityScore
 * @property integer $MonthlyCouponClicks
 */
class Website extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Website';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['IsSpecialPopUp', 'AdNetworkID', 'IsActive', 'IsFeatured', 'Views', 'UseHomeAsLandingPage', 'DisableLandingPages', 'ModerateUserCoupons', 'RatingCalculated', 'NumOfRatings', 'PauseAffiliateCampaign', 'Tier', 'AuthorID', 'PageTitleID', 'noOfOffers', 'noOfCoupons', 'noOfDeals', 'WebsiteCategoryID', 'noOfCouponsMinusOneTime', 'MonthlyCouponClicks'], 'integer'],
            [['Description', 'SearchKeywords', 'AlternateSpellings', 'MetaDescription', 'MetaKeywords'], 'string'],
            [['DateAdded', 'DateEmailsLastSent', 'LogoLastModified'], 'safe'],
            [['AlternateSpellings', 'UseHomeAsLandingPage', 'DisableLandingPages', 'AccessCode', 'Rating', 'NumOfRatings', 'YouTubeVideoID', 'noOfCoupons', 'noOfDeals'], 'required'],
            [['Rating', 'WebsitePopularityScore'], 'number'],
            [['WebsiteTitle', 'WebsiteName'], 'string', 'max' => 100],
            [['URLKeyword', 'WebsiteURL', 'AndroidPackageName', 'AndroidDeeplinkUrl', 'iOSPackageName', 'iOSDeeplinkUrl', 'WindowsPackageName', 'WindowsDeeplinkUrl', 'RequiredQueryString', 'PageTitle'], 'string', 'max' => 200],
            [['AffilateURL'], 'string', 'max' => 500],
            [['OverrideAffiliateUrlFormat', 'Notes'], 'string', 'max' => 1000],
            [['AccessCode'], 'string', 'max' => 10],
            [['YouTubeVideoID'], 'string', 'max' => 15],
            [['LogoBackgroundColor'], 'string', 'max' => 7]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'WebsiteID' => 'Website ID',
            'IsSpecialPopUp' => 'Is Special Pop Up',
            'WebsiteTitle' => 'Website Title',
            'WebsiteName' => 'Website Name',
            'URLKeyword' => 'Urlkeyword',
            'WebsiteURL' => 'Website Url',
            'Description' => 'Description',
            'AdNetworkID' => 'Ad Network ID',
            'AffilateURL' => 'Affilate Url',
            'IsActive' => 'Is Active',
            'IsFeatured' => 'Is Featured',
            'AndroidPackageName' => 'Android Package Name',
            'AndroidDeeplinkUrl' => 'Android Deeplink Url',
            'iOSPackageName' => 'I Ospackage Name',
            'iOSDeeplinkUrl' => 'I Osdeeplink Url',
            'WindowsPackageName' => 'Windows Package Name',
            'WindowsDeeplinkUrl' => 'Windows Deeplink Url',
            'SearchKeywords' => 'Search Keywords',
            'DateAdded' => 'Date Added',
            'Views' => 'Views',
            'DateEmailsLastSent' => 'Date Emails Last Sent',
            'AlternateSpellings' => 'Alternate Spellings',
            'UseHomeAsLandingPage' => 'Use Home As Landing Page',
            'RequiredQueryString' => 'Required Query String',
            'OverrideAffiliateUrlFormat' => 'Override Affiliate Url Format',
            'DisableLandingPages' => 'Disable Landing Pages',
            'ModerateUserCoupons' => 'Moderate User Coupons',
            'AccessCode' => 'Access Code',
            'RatingCalculated' => 'Rating Calculated',
            'Rating' => 'Rating',
            'NumOfRatings' => 'Num Of Ratings',
            'PauseAffiliateCampaign' => 'Pause Affiliate Campaign',
            'Tier' => 'Tier',
            'Notes' => 'Notes',
            'YouTubeVideoID' => 'You Tube Video ID',
            'AuthorID' => 'Author ID',
            'PageTitle' => 'Page Title',
            'MetaDescription' => 'Meta Description',
            'MetaKeywords' => 'Meta Keywords',
            'PageTitleID' => 'Page Title ID',
            'noOfOffers' => 'No Of Offers',
            'noOfCoupons' => 'No Of Coupons',
            'noOfDeals' => 'No Of Deals',
            'WebsiteCategoryID' => 'Website Category ID',
            'LogoBackgroundColor' => 'Logo Background Color',
            'noOfCouponsMinusOneTime' => 'No Of Coupons Minus One Time',
            'LogoLastModified' => 'Logo Last Modified',
            'WebsitePopularityScore' => 'Website Popularity Score',
            'MonthlyCouponClicks' => 'Monthly Coupon Clicks',
        ];
    }
}
