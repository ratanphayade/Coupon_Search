<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;
?>

        <?php yii\widgets\Pjax::begin() ?>
        <div id="ajax-data">   
            <div class="col-md-8">
		<div class="row">
        <?php if($status == '0'){ ?>
          <div class="col-md-12 modal-content top-buffer">
              <div class="row modal-header">
                  <h3 class='modal-title'>Oops.... </h3>
              </div>
              <div class="row modal-body">
                  No Result For This Search....:(
              </div>
          </div>
        <?php die(); } ?>            
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
                        <div class='col-md-1'>
                            <?php 
                                $total = ($coupon->CountSuccess+$coupon->CountFail); 
                                $val = ($total)? ($coupon->CountSuccess/$total)*100 : 0;
                            ?>
                            <input type="button" class="test btn btn-info active" value='<?= round($val,1) ?>% Success'/>
                        </div>
                        <div class='col-md-4 col-md-offset-1' style='margin-top: 5px'>
                            <b> Added On : <?= $coupon->DateAdded ?></b>
                        </div>
                        <div class="col-md-3 col-md-offset-3" align="right" style="margin-bottom:10px">                           
                            <?= Html::button((!$coupon->IsDeal)? empty($coupon->CouponCode)? "Empty" : $coupon->CouponCode : "GRAB DEAL",
                                        [
                                            'class'=> 'btn btn-block btn-primary',
                                            'id'=> 'openWindow',
                                            'value'=>$coupon->website->WebsiteURL,
                                            'formtarget' => '_blank',
                                        ] 
                                        );
                            ?> 
			</div>
                    </div>
		</div>
                <?php } ?>
                </div>
                <div align="center">
                    <?= LinkPager::widget(['pagination' => $pagination]) ?>
                </div>
                </div>
        </div>
                <?php yii\widgets\Pjax::end() ?>     
