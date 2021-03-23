#!/usr/bin/python

import sys
import os
import shutil
from icecream import ic

def filler(number):
	i = number
	if i < 10 and i >= 0 :
		return str('00')
	elif i < 100 and i >= 10 :
		return str('0')
	elif i < 1000 and i >= 100 :
		return str('')

data_home = '/var/nginx/html/pub/SJ/data/'
# mp - master piece
mps = os.listdir(data_home)
mps = sorted(mps)
last_mp = mps[-1]
new_mp = int(last_mp) + 1
new_mp = filler(new_mp) + str(new_mp)
os.makedirs(data_home + new_mp)
#ic(last_mp)
#ic(new_mp)

items = ['a','b','d','c','e']
for item in items:
  src = data_home+last_mp+'/'+last_mp+item+'.txt'
  des = data_home+new_mp+'/'+new_mp+item+'.txt'
  #ic(src)
  #ic(des)
  shutil.copy(src, des)
