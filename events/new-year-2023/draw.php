<?php

/**
 * Special draw for the New Year 2023
 *
 * Use of a CSV file containing the list of pirate owners at the time of the draw
 * instead of the usual transaction hash.
 *
**/

//Loading the CSV file
$sCsvFile = file_get_contents('./holders.csv');
//CSV lines
$aCsv = file('./holders.csv');

//Hash of the CSV file instead of the transaction hash
$csvHash = hash('sha512', $sCsvFile);
//Number of addresses in the CSV file
$maxHolders = count($aCsv);

//Information of the transaction made at the passage of the new year
$gasUsed = '267497';
$height = '6235508';

//Number of prizes
$numberPrizes = 21;

//Winners
$aWinners = [];

function draw($index, $csvHash, $gasUsed, $height, $maxHolders)
{
	
	$STRING1 = $index.$csvHash.$gasUsed;
	$STRING2 = $gasUsed.$height.$index;
	
	$hash = hash_hmac('sha512', $STRING1, $STRING2);
	
	$number = hexdec(substr($hash, 0, 8));
	
	$diviser = 4294967295 / $maxHolders;
	
	$nftId = 1 + ($number / $diviser);
	
	$nftId = floor($nftId);
	
	return $nftId;
}

//Draw index
$iDrawIndex = 1;

//Do the draws until all the winners are in
while(count($aWinners) < $numberPrizes)
{
	//Find winner
	$iWinner = draw($iDrawIndex, $csvHash, $gasUsed, $height, $maxHolders);
	
	if(!in_array($iWinner, $aWinners))
		$aWinners[] = $iWinner;
	
	$iDrawIndex += 1;
}

echo 'Total loop: '.$iDrawIndex."\n";

//Print results
foreach($aWinners as $index => $iWinner)
{
	echo 'Winner #'.($index +1).': '.trim($aCsv[$iWinner - 1])."\n";
}
