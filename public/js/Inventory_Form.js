
$(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
});

$("#submitCreate").click(function(){
	alert("HERE");
	var itemName = document.getElementById("itemName").value;
	var itemPrice = document.getElementById("itemPrice").value;
	var itemDesc = document.getElementById("itemDesc").value;
    $.ajax({
        type: "POST",
        url: "create",
        data: "item.strItemName="+itemName+"&item.dblPrice="+itemPrice+
        	"&item.strItemDesc="+itemDesc,
       	dataType: "json",
        async: true,
        success: function(data){
        	alert("success");
        },
        error: function(data){
        	alert("error");
        }
    });

    return false;
});

$('#modal1').closeModal();
