
<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = "Coupon Search";
?>
<style>
    .top-buffer { margin-top:20px; }
</style>
    
<script src="js/script.js"></script>
<div class="container-fluid" style="margin-top:-10px;">
    <div class="row">
        <div class="col-md-4" >
            <div class="panel-group" id="panel-158751" style="position:fixed; width:350px">
                <h1><?= "Coupon Search" ?></h1>
                <form role="form" onchange="refreshWithUpdatedDetails();">
		<div class="panel panel-default">
                    <div class="panel-heading" id="panel1">
			<a class="panel-title collapsed" x data-toggle="collapse" data-parent="#panel-158751" href="#panel-element-401808">Deal Type</a>
                    </div>
                    <div id="panel-element-401808" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="deal" name="couponType" value="1" onchange="refreshWithUpdatedDetails();"> Deal
                                    </label>
                                    <br/>
                                    <label>
                                        <input type="checkbox" id="coupon" name="couponType" value="0" onchange="refreshWithUpdatedDetails();"> Coupon
                                    </label>
				</div> 
			</div>
                    </div>
		</div>
		<div class="panel panel-default">
                    <div class="panel-heading">
			<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-158751" href="#panel-element-896831">Store</a>
                    </div>
                    <div id="panel-element-896831" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="checkbox" style="overflow-y: scroll; height:300px;">
                                    <label>
                                        <input type="radio"  name="Stores" id="allbrands" checked="true" onchange="refreshWithUpdatedDetails();" value="all"/> Select All
                                    </label>
                                    <br/>
                                    <?php foreach ($stores as $website) { ?>
                                        <label>
                                            <input type="radio" id="allbrands" value="<?= $website->WebsiteID; ?>" name ="Stores" onchange="refreshWithUpdatedDetails();">
                                            <?php echo $website->WebsiteTitle; ?>
                                        </label>
                                        <br/>
                                    <?php } ?> 
				</div> 
			</div>
                    </div>
		</div>
                <div class="panel panel-default">
                    <div class="panel-heading">
			<a class="panel-title collapsed" data-toggle="collapse" data-parent="#panel-158751" href="#panel-element-896833">Categories</a>
                    </div>
                    <div id="panel-element-896833" class="panel-collapse collapse">
			<div class="panel-body">
				<div class="checkbox" style="overflow-y: scroll; height:300px;">
                                    <label>
                                        <input type="radio" name="Category" id="category" checked="true" value="all" onchange="refreshWithUpdatedDetails();"/> Select All
                                    </label>      
                                    <br>
                                    <?php foreach ($category as $brand) { ?>
                                        <label>
                                            <input type="radio" id="category" value="<?= $brand->CategoryID; ?>" name ="Category" onchange="refreshWithUpdatedDetails();">
                                            <?php echo $brand->Name; ?>
                                        </label>
                                        <br/>
                                    <?php } ?> 
				</div>
			</div>
                    </div>
                </div>
                <input type="button" class="btn btn-success" onclick="downloadDataAsExcel();" value="Download Excel"/>
            </form>
            </div>
	</div>
        <?php yii\widgets\Pjax::begin() ?>
        <div id="ajax-data">   
            <div class="col-md-8">
		<div class="row">
                    <?php foreach ($coupons as $coupon){ ?>
                        <div class="col-md-12 modal-content top-buffer">
                            <div class="row modal-header"> 
				<div class="col-md-8">
                                    <h3 class="modal-title">
                                        <?= $coupon->website->WebsiteName;?>
                                    </h3>
				</div>
                            <div class="col-md-4">
			</div>
                    </div>
                    <div class="row modal-body">
			<div class="col-md-12 card-detail">
                            <blockquote class="pull-right" style="height:auto">
                                <p class="word">
					<?= $coupon->Description;?>
				</p> 
                                <small>
                                    <cite>
                                        <?= $coupon->Title;?>
                                    </cite>
                                </small>
                            </blockquote>
			</div>
                    </div>
                    <div class="row modal-footer">
                        <div class="col-md-4 col-md-offset-7" align="right;" style="margin-bottom:10px">
                            <button type="button" class="btn btn-block btn-primary" onClick="window.open('<?= $coupon->website->WebsiteURL?>')" formtarget="_blank">
                                <?= (!$coupon->IsDeal)? empty($coupon->CouponCode)? "Empty" : $coupon->CouponCode : "GRAB DEAL"; ?>
                            </button>
			</div>
                    </div>
		</div>
                <?php } ?>
                <?= LinkPager::widget(['pagination' => $pagination]) ?>
                <?php yii\widgets\Pjax::end() ?>     
            </div>
        </div>
    </div>
    </div>
</div>
    