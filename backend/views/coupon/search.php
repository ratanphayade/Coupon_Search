<?php
use yii\widgets\LinkPager;

?>
        <?php yii\widgets\Pjax::begin() ?>
        <div id="ajax-data">   
            <div class="col-md-8">
		<div class="row">
                    <?php foreach ($coupons as $coupon){ ?>
                        <div class="col-md-12 modal-content top-buffer">
                            <div class="row modal-header"> 
				<div class="col-md-8 card-heading">
                                    <h3 class='modal-title'>
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
                <?php yii\widgets\Pjax::end() ?>                  