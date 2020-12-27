<?php
if (isset($_SESSION["yonetici"])) {

	if(isset($_POST["siteadi"])){
		$gelensiteadi=Guvenlik($_POST["siteadi"]);	
	}else{
		$gelensiteadi="";
	}
	if(isset($_POST["sitebaslik"])){
		$gelensitebaslik=Guvenlik($_POST["sitebaslik"]);	
	}else{
		$gelensitebaslik="";
	}
	if(isset($_POST["sitetanim"])){
		$gelensitetanim=Guvenlik($_POST["sitetanim"]);	
	}else{
		$gelensitetanim="";
	}
	if(isset($_POST["siteanahtarkelimeler"])){
		$gelensiteanahtarkelimeler=Guvenlik($_POST["siteanahtarkelimeler"]);	
	}else{
		$gelensiteanahtarkelimeler="";
	}
	if(isset($_POST["sitecopyright"])){
		$gelensitecopyright=Guvenlik($_POST["sitecopyright"]);	
	}else{
		$gelensitecopyright="";
	}
	if(isset($_POST["siteemail"])){
		$gelensiteemail=Guvenlik($_POST["siteemail"]);	
	}else{
		$gelensiteemail="";
	}
	if(isset($_POST["sitesifre"])){
		$gelensitesifre=Guvenlik($_POST["sitesifre"]);	
	}else{
		$gelensitesifre="";
	}
	if(isset($_POST["siteemailHostAdresi"])){
		$gelensiteemailHostAdresi=Guvenlik($_POST["siteemailHostAdresi"]);	
	}else{
		$gelensiteemailHostAdresi="";
	}
	if(isset($_POST["sitelinki"])){
		$gelensitelinki=Guvenlik($_POST["sitelinki"]);	
	}else{
		$gelensitelinki="";
	}
	if(isset($_POST["facebooklinki"])){
		$gelenfacebooklinki=Guvenlik($_POST["facebooklinki"]);	
	}else{
		$gelenfacebooklinki="";
	}
	if(isset($_POST["insatgramlinki"])){
		$geleninsatgramlinki=Guvenlik($_POST["insatgramlinki"]);	
	}else{
		$geleninsatgramlinki="";
	}
	if(isset($_POST["linkedinlinki"])){
		$gelenlinkedinlinki=Guvenlik($_POST["linkedinlinki"]);	
	}else{
		$gelenlinkedinlinki="";
	}
	if(isset($_POST["youtubelinki"])){
		$gelenyoutubelinki=Guvenlik($_POST["youtubelinki"]);	
	}else{
		$gelenyoutubelinki="";
	}
	if(isset($_POST["twitterlinki"])){
		$gelentwitterlinki=Guvenlik($_POST["twitterlinki"]);	
	}else{
		$gelentwitterlinki="";
	}
	if(isset($_POST["pinterestlinki"])){
		$gelenpinterestlinki=Guvenlik($_POST["pinterestlinki"]);	
	}else{
		$gelenpinterestlinki="";
	}
	if(isset($_POST["dolarkuru"])){
		$gelendolarkuru=Guvenlik($_POST["dolarkuru"]);	
	}else{
		$gelendolarkuru="";
	}
	if(isset($_POST["eurokuru"])){
		$geleneurokuru=Guvenlik($_POST["eurokuru"]);	
	}else{
		$geleneurokuru="";
	}
	if(isset($_POST["ucretsizkargobarajı"])){
		$gelenucretsizkargobarajı=Guvenlik($_POST["ucretsizkargobarajı"]);	
	}else{
		$gelenucretsizkargobarajı="";
	}
	if(isset($_POST["clientID"])){
		$gelenclientID=Guvenlik($_POST["clientID"]);	
	}else{
		$gelenclientID="";
	}
	if(isset($_POST["storeKey"])){
		$gelenstoreKey=Guvenlik($_POST["storeKey"]);	
	}else{
		$gelenstoreKey="";
	}
	if(isset($_POST["apikullanicisi"])){
		$gelenapikullanicisi=Guvenlik($_POST["apikullanicisi"]);	
	}else{
		$gelenapikullanicisi="";
	}
	if(isset($_POST["apisifresi"])){
		$gelenapisifresi=Guvenlik($_POST["apisifresi"]);	
	}else{
		$gelenapisifresi="";
	}

	$GelenSiteLogosu				=	$_FILES["siteLogosu"];
	if(($gelensiteadi !="") and ($gelensitebaslik !="") and ($gelensitetanim !="") and ($gelensiteanahtarkelimeler !="") and ($gelensitecopyright !="") and ($gelensiteemail !="") and ($gelensitesifre !="") and ($gelensiteemailHostAdresi !="") and ($gelensitelinki !="") and ($gelenfacebooklinki !="")and ($geleninsatgramlinki !="") and ($gelenlinkedinlinki !="") and ($gelenyoutubelinki !="") and ($gelentwitterlinki !="") and ($gelenpinterestlinki !="") and ($gelendolarkuru !="") and ($geleneurokuru !="") and ($gelenucretsizkargobarajı !="") and ($gelenclientID !="") and ($gelenstoreKey !="") and ($gelenapikullanicisi !="") and ($gelenapisifresi !="")){

		$ayarlarGuncelleSorgusu=$DBConnection->prepare("UPDATE ayarlar SET siteAdi=?, siteTitle=?, siteDescription=?, siteKeywords=?, siteCopyrightMetni=?, siteEmail=?, siteMailSifre=?, siteemailHostAdresi=?,sitelinki=?, facebooklinki=?, insatgramlinki=?, linkedinlinki=?,youtubelinki=?, twitterlinki=?, pinterestlinki=?, dolarkuru=?, eurokuru=?, ucretsizkargobarajı=?, clientID=?, storeKey=?, apikullanicisi=?, apisifresi=?");
		$ayarlarGuncelleSorgusu->execute([$gelensiteadi, $gelensitebaslik, $gelensitetanim, $gelensiteanahtarkelimeler,$gelensitecopyright,$gelensiteemail, $gelensitesifre, $gelensiteemailHostAdresi, $gelensitelinki, $gelenfacebooklinki, $geleninsatgramlinki, $gelenlinkedinlinki, $gelenyoutubelinki, $gelentwitterlinki, $gelenpinterestlinki, $gelendolarkuru, $geleneurokuru, $gelenucretsizkargobarajı, $gelenclientID, $gelenstoreKey, $gelenapikullanicisi, $gelenapisifresi]);
		


		if(($GelenSiteLogosu["name"]!="") and ($GelenSiteLogosu["type"]!="") and ($GelenSiteLogosu["tmp_name"]!="") and ($GelenSiteLogosu["error"]==0) and ($GelenSiteLogosu["size"]>0)){
			$SiteLogosuYukle	=	new upload($GelenSiteLogosu, "tr-TR");
				if($SiteLogosuYukle->uploaded){
				   $SiteLogosuYukle->mime_magic_check		=	true;
				   $SiteLogosuYukle->allowed				=	array("image/*");
				   $SiteLogosuYukle->file_new_name_body		=	"logo";
				   $SiteLogosuYukle->file_overwrite			=	true;
				   $SiteLogosuYukle->image_convert			=	"png";
				   $SiteLogosuYukle->image_quality			=	100;
				   $SiteLogosuYukle->image_background_color	=	null;
				   $SiteLogosuYukle->image_resize			=	true;
				   $SiteLogosuYukle->image_y				=	35;
				   $SiteLogosuYukle->image_x				=	192;
				   $SiteLogosuYukle->process($veroticinklasoryolu);
					
					if($SiteLogosuYukle->processed){
						$SiteLogosuYukle->clean();
					}else{
						header("Location:index.php?SKD=0&SKI=4");
						exit();
					} 
				}
		}


		/*
		if(($gelensitelogosu["name"]!="") and ($gelensitelogosu["type"]!="") and ($gelensitelogosu["tmp_name"]!="") and ($gelensitelogosu["error"]==0) and ($gelensitelogosu["size"]>0)){
			$SiteLogosuYukle	=	new upload($gelensitelogosu, "tr-TR");
			if($SiteLogosuYukle->uploaded){
				$SiteLogosuYukle->mime_magic_check		=	true;
				$SiteLogosuYukle->allowed				=	array("image/*");
				$SiteLogosuYukle->file_new_name_body		="logo";
				$SiteLogosuYukle->file_overwrite			=	true;
				$SiteLogosuYukle->image_convert			=	"png";
				$SiteLogosuYukle->image_quality			=	100;
				$SiteLogosuYukle->image_background_color	=	null;
				$SiteLogosuYukle->image_resize			=	true;
				$SiteLogosuYukle->image_y				=	35;
				$SiteLogosuYukle->image_x				=	192;
				$SiteLogosuYukle->process($veroticinklasoryolu);

				if($SiteLogosuYukle->processed){
					$SiteLogosuYukle->clean();
				}else{
					header("Location:index.php?SKD=0&SKI=4");
					exit();
				} 
			}
		} */

		header("Location:index.php?SKD=0&SKI=3");
		exit();
	}else{
		header("Location:index.php?SKD=0&SKI=4");
		exit();
	}
}else{
	header("Location:index.php?SKD=0&SKI=0");
	exit();
}
?>