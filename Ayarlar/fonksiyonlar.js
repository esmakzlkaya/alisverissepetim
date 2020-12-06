$(document).ready(function(){

	$.cevapgoster=function(ElemanID){

		var soruID=ElemanID;
		var islenecekalan="#" + ElemanID;

		$(".cevapalani").slideUp();
		$(islenecekalan).parent().find(".cevapalani").slideToggle();
	}

		$.urundetayresmidegistir=function(klasor,resimdegeri){

		var resimdosyayolu="Resimler/UrunResimleri/" + klasor +"/"+ resimdegeri; 
		$("#buyukresim").attr("src",resimdosyayolu);
		
	}

	$.kredikartisecildi=function(){
		$(".KKalanlari").css("display","block");
		$(".BHalanlari").css("display","none");
	}
	$.havalesecildi=function(){
		$(".KKalanlari").css("display","none");
		$(".BHalanlari").css("display","block");
	}
});