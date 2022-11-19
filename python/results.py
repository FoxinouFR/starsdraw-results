
import hashlib
import hmac
import math

#Drawing parameters available on https://starsdraw.net/draws
transactionHash = "295C01381270EDB5C0B6E961D5E81F365F723F5FB0968E97F2D5D006A82842D7"
gasUsed = "266891"
height = "4640884"
maxTokens = 85


def draw(index, transactionHash, gasUsed, height, maxTokens):
	
	STRING1 = str(index)+transactionHash+gasUsed;
	STRING2 = gasUsed+height+str(index);
	
	hash = hmac.new(STRING2.encode(), STRING1.encode(), hashlib.sha512).hexdigest()
	hash = hash[0:8]
	
	number = int(hash,16)
	
	diviser = 4294967295 / maxTokens
	
	nftId = 1 + (number / diviser)
	
	nftId = math.floor(nftId)
	
	return str(nftId)


print ("First winner: " + draw(1, transactionHash, gasUsed, height, maxTokens))
print ("Second winner: " + draw(2, transactionHash, gasUsed, height, maxTokens))
print ("Third Winner: " + draw(3, transactionHash, gasUsed, height, maxTokens))
