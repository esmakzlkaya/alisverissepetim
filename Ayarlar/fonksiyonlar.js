$(document).ready(function(){
	$.cevapgoster=function(ElemanID){

		var soruID=ElemanID;
		var islenecekalan="#" + ElemanID;

		$(".cevapalani").slideUp();
		$(islenecekalan).parent().find(".cevapalani").slideToggle();
	}
});