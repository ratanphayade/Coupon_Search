
<?php
use yii\helpers\Html;
use yii\widgets\LinkPager;


$this->title = "Coupon Search";
?>
<style>
    .top-buffer { margin-top:20px; }
    option {
        height: 25px;
        font-size: 16px;
    }
    option:active{
        height: 28px;
        -webkit-appearance: none;
    }
</style>

<div class="container-fluid" style="margin-top:-10px;">
    <div class="row">
        <div class="col-md-4" >
            <div class="panel-group" id="" style="position:fixed; width:300px">
                <h1><?= "Coupon Search" ?></h1>
                <form role="form" onchange="refreshWithUpdatedDetails();">
                <div id="accordion" class="panel-group">
                    <div class="panel panel-default modal-content">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class='modal-head' data-parent="#accordion" href="#collapseOne">Coupon Type</a>
                            </h4>
                        </div>
                        <div id="collapseOne" class="panel-collapse collapse">
                            <div class="panel-body modal-body">
                                <label>
                                        <select name='couponType' id='couponType' multiple size='3' class='selectpicker' style='width: 250px;'>
                                            <option value='all' selected>Select All</option>
                                            <option value='1'>Deal</option>
                                            <option value='0'>Coupon</option>
                                        </select>                                        
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default modal-content">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class='modal-head' data-parent="#accordion" href="#collapseTwo">Store</a>
                            </h4>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse">
                            <div class="panel-body modal-body">
                                <label>
                                        <select name='Stores' id='Stores' multiple='multiple' size='15' class='selectpicker' style='width: 250px;'>
                                            <option value='all' selected> Select All </option>                                                           
                                            <?php foreach ($stores as $website) { ?>
                                            <option value='<?= $website->WebsiteID ?>'><?= $website->WebsiteName ?></option>
                                            <?php } ?> 
                                        </select>  
                                    </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default modal-content">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a data-toggle="collapse" class='modal-head' data-parent="#accordion" href="#collapseThree">Category</a>
                            </h4>
                        </div>
                        <div id="collapseThree" class="panel-collapse collapse">
                            <div class="panel-body modal-body">
                                    <label>
                                        <select name='Category' id='Category' multiple='multiple' size='15' class='input-medium' style='width: 250px;'>
                                            <option value='all' selected> Select All </option>                                                           
                                            <?php foreach ($category as $cat) { ?>
                                            <option value='<?= $cat->CategoryID ?>'><?= $cat->Name ?></option>
                                            <?php } ?> 
                                        </select> 
                                    </label>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class='panel-body col-md-offset-3'>
                        <input type="button" class="btn btn-success" onclick="downloadDataAsExcel();" value="Download Excel"/>
                    </div>                
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
                        <div class='col-md-1'>
                            <?php 
                                $total = ($coupon->CountSuccess+$coupon->CountFail); 
                                $val = ($total!=0)? ($coupon->CountSuccess/$total)*100 : 0;
                            ?>
                            <input type="button" class="btn btn-info active" value='<?= round($val,1) ?>% Success'/>
                        </div>
                        <div class='col-md-4 col-md-offset-1' style='margin-top: 5px'>
                            <b> Added On : <?= $coupon->DateAdded ?></b>
                        </div>
                        <div class="col-md-3 col-md-offset-3" style="margin-bottom:10px">
                            <button type="button" class="btn btn-block btn-primary" onClick="window.open('<?= $coupon->website->WebsiteURL?>')" formtarget="_blank">
                                <?= (!$coupon->IsDeal)? empty($coupon->CouponCode)? "Empty" : $coupon->CouponCode : "GRAB DEAL"; ?>
                            </button>
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
    </div>
</div>
    