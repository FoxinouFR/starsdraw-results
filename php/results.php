<?php

//Drawing parameters available on https://starsdraw.net/draws
$transactionHash = '295C01381270EDB5C0B6E961D5E81F365F723F5FB0968E97F2D5D006A82842D7';
$gasUsed = '266891';
$height = '4640884';
$maxTokens = '85';

function draw($index, $transactionHash, $gasUsed, $height, $maxTokens)
{
	
	$STRING1 = $index.$transactionHash.$gasUsed;
	$STRING2 = $gasUsed.$height.$index;
	
	$hash = hash_hmac('sha512', $STRING1, $STRING2);
	
	$number = hexdec(substr($hash, 0, 8));
	
	$diviser = 4294967295 / $maxTokens;
	
	$nftId = 1 + ($number / $diviser);
	
	$nftId = floor($nftId);
	
	return $nftId;
}

echo 'First winner: '.draw(1, $transactionHash, $gasUsed, $height, $maxTokens)."\n";
echo 'Second winner: '.draw(2, $transactionHash, $gasUsed, $height, $maxTokens)."\n";
echo 'Third Winner: '.draw(3, $transactionHash, $gasUsed, $height, $maxTokens)."\n";
