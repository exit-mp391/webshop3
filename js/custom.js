$(document).ready(function() {



	console.log("spreman sam");
	
	//klikom na malu sliku
	$("#male-slike img").on("click", function() {
		
		//smestamo njen atribut big-img u promenljivu
		var velikaslika = $(this).attr('big-img');
		
		//taj atribut postavljamo kao `img` atribut za veliku sliku 
		$("#velika-slika img").attr('src', velikaslika);

	});

	$(".all-comments").on("click", function() {

		var productid = $(this).attr("productid");
		//console.log(productid);
		console.log("Klik klik.");

		$.get("ajax-comments.php?id=" + productid, function(data) {
			$("#komentari1").html(data);
			$(".all-comments").hide();
		});

	});


	function gettotal() {
		var suma=0;
		$(".ukupno").each(function() {
			suma+=parseInt($(this).html());
		});
		$("#total1").html(suma);
	}
	$(".cart-quantity").on('input', function() {
		var quantity = parseInt($(this).val());
		var price = parseInt($(this).parent().prev().html());
		$(this).parent().next().html(quantity*price);
		gettotal();
	});

});