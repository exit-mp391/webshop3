$(document).ready(function(){
	console.log("spreman sam");
$("#male-slike img").on("click",function(){
	var velikaslika = $(this).attr(big-img);
	$("#velika-slika img").attr('src', velikaslika);
    });

$("all-comments").on("click", function(){

	
  var productid = $(this).atrr("productid");
  console.log("klik klik.");
  

	$get("ajax-comments.php?id=" + productid, function(data){
   $("#komentari1").html(data);
   $(".all-comments").hide();
	});
});
});
