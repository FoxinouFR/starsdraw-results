
const CryptoJS = require("crypto-js");

//Drawing parameters available on https://starsdraw.net/draws
const transactionHash = '295C01381270EDB5C0B6E961D5E81F365F723F5FB0968E97F2D5D006A82842D7';
const gasUsed = '266891';
const height = '4640884';
const maxTokens = '85';

function draw(index, transactionHash, gasUsed, height, maxTokens)
{
	let STRING1 = index+transactionHash+gasUsed;
	let STRING2 = gasUsed+height+index;
	
	let hash = CryptoJS.HmacSHA512(STRING1, STRING2);
	hash = (hash+'').substr(0, 8).replace(/[^a-f0-9]/gi, '');
	
	let number = parseInt(hash, 16);
	
	let diviser = 4294967295 / maxTokens;
	
	nftId = 1 + (number / diviser);
	
	nftId = Math.floor(nftId);
	
	return nftId;
}

console.log('First winner: '+draw(1, transactionHash, gasUsed, height, maxTokens));
console.log('Second winner: '+draw(2, transactionHash, gasUsed, height, maxTokens));
console.log('Third Winner: '+draw(3, transactionHash, gasUsed, height, maxTokens));
