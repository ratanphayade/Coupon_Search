
$("#downloadExcel").on('click', function(){
    window.open("index.php?r=coupon/download&couponType="+$("#couponType").val()+"&Stores="+$('#Stores').val()+"&Category="+$('#Category').val(), '_blank');        
});

$("#searchForm").on('change', function(){
    $.get("index.php?r=coupon/search",$(this).serialize() , function(data){
       $("#change").html(data);
    });
});
