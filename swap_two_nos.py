def main():
	a,b=input("Enter two numbers\n").split(' ')
	a,b=[int(a),int(b)]
	if a==0:
		vala='zero'
	elif a>0:
		vala='positive'
	else:
		vala='negative'
	if b==0:
		valb='zero'
	elif b>0:
		valb='positive'
	else:
		valb='negatve'
	print("A is "+vala+" and B is "+valb)
	print("Before swapping a="+str(a)+" and b="+str(b))
	a,b=b,a
	print("After swapping a="+str(a)+" and b="+str(b))

if __name__ == '__main__':
	main()