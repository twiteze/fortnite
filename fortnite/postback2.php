<?php

$ch1 = curl_init();
$ch = curl_init("https://zanerewards.com/login");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
$req = curl_exec($ch);
libxml_use_internal_errors( true );
$dom=new DOMDocument;
$dom->loadHTML($req);
libxml_clear_errors();
$tags = $dom->getElementsByTagName('input');
for($i = 0; $i < $tags->length; $i++) {
	$grab = $tags->item($i);
	if($grab->getAttribute('name') === '_csrf') {
		$csrf = $grab->getAttribute('value');

	}
}

#
$data = array(
	"email" => "semo123dami@gmail.com",
	"password" => "DAMI123DAMI",
	"_csrf" => $csrf,
);
//
curl_setopt($ch, CURLOPT_URL, "https://zanerewards.com/auth/login");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_COOKIEJAR, "cookie.txt");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$req = curl_exec($ch);

curl_setopt($ch, CURLOPT_URL, "https://zanerewards.com/");
$req = curl_exec($ch);

libxml_use_internal_errors( true );
$dom=new DOMDocument;
$dom->loadHTML($req);
libxml_clear_errors();
$tags = $dom->getElementsByTagName('input');
for($i = 0; $i < $tags->length; $i++) {
	$grab = $tags->item($i);
	if($grab->getAttribute('name') === '_csrf') {
		$csrf = $grab->getAttribute('value');

	}
}
 
 $data = array(
	"id" => "18",
	"_csrf" => $csrf,
);
#$fp = file_get_contents("https://zanerewards.com/rewards/account");
curl_setopt($ch, CURLOPT_URL, "https://zanerewards.com/rewards/redeem");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
$req = curl_exec($ch);
curl_setopt($ch, CURLOPT_URL, "https://zanerewards.com/rewards/account");
curl_setopt($ch, CURLOPT_POST, false);
$req = curl_exec($ch);

$dom = new DOMDocument();
$dom->loadHTML($req);

$xpath = new DOMXPath($dom);

$tags = $xpath->query('//input[@class="input"]');
foreach ($tags as $tag) {
    
    var_dump(trim($tag->getAttribute('value')));
    
}


curl_close($ch);

?>