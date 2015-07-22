
function refreshWithUpdatedDetails(){
    var deal = $("#deal").is(":checked"); 
    var coupon = $("#coupon").is(":checked"); 
  
    var store = $('input[name="Stores"]:checked').val();
    var category = $('input[name="Category"]:checked').val();
    var coupontype;
    if((deal && coupon) || (!deal && !coupon))
        coupontype="all";
    else if(!coupon) 
        coupontype="1";
    else if(!deal) 
        coupontype="0";
    requestDataFilter(coupontype,store,category);    
}        


function requestDataFilter(coupontype,store,category){
    var xmlhttp;
    if (window.XMLHttpRequest) 
        xmlhttp=new XMLHttpRequest();
    else 
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            document.getElementById("ajax-data").innerHTML=xmlhttp.responseText;
    }
    
    xmlhttp.open("GET","index.php?r=coupon/search&coupontype="+coupontype+"&store="+store+"&category="+category,true);
    xmlhttp.send();
}


function downloadDataAsExcel() {
    
    var deal = $("#deal").is(":checked"); 
    var coupon = $("#coupon").is(":checked"); 
  
    var store = $('input[name="Stores"]:checked').val();
    var category = $('input[name="Category"]:checked').val();
    var coupontype;

    if((deal && coupon) || (!deal && !coupon))
       coupontype='all';  
    else if(!coupon) 
       coupontype='1';
    else if(!deal) 
       coupontype='0';
   window.open("index.php?r=coupon/download&coupontype="+coupontype+"&store="+store+"&category="+category, '_blank');
          
}