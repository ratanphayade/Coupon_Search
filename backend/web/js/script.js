
 
 function getAjaxRequestObject(){
    var xmlhttp;
    if (window.XMLHttpRequest) 
        xmlhttp=new XMLHttpRequest();
    else 
        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
 
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState==4 && xmlhttp.status==200)
            document.getElementById("ajax-data").innerHTML=xmlhttp.responseText;
    }
    return xmlhttp;
}

function refreshWithUpdatedDetails(){
    var obj = getAjaxRequestObject();
    obj.open("GET","index.php?r=coupon/search&coupontype="+$("#couponType").val()+"&store="+$('#Stores').val()+"&category="+$('#Category').val(),true);
    obj.send();
}        

function downloadDataAsExcel() {
   window.open("index.php?r=coupon/download&coupontype="+$("#couponType").val()+"&store="+$('#Stores').val()+"&category="+$('#Category').val(), '_blank');        
}
    





