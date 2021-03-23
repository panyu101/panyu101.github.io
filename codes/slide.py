#!/usr/bin/python3

import re
#from icecream import ic
import cgi
import glob
title = 'Photo Slideshow'
print('Content-Type: text/html')
print('')
print('<meta charset="utf-8">')
fs = cgi.FieldStorage()
# this - full name of this photo
this = fs['this'].value
paths  = re.split('\/', this)
this   = re.sub('"', '', this)
home   = '../../photo'
webhome= '../../ap/photo'
year   = re.sub('"', '', paths[0])
folder = re.sub('"', '', paths[1])
photo  = re.sub('"', '', paths[2])
photos = sorted(glob.glob(home+'/'+year+'/'+folder+'/'+'*.jpg'))

n      = len(photos)
current = photos.index('../../photo/'+this)

first    = photos[0]
first    = re.sub('.*photo/', '', first)
last     = photos[n-1]
last     = re.sub('.*photo/', '', last)
position_alert = ''

if current <= 0:
  previous = photos[0]
else:
  previous = photos[current-1]
previous = re.sub('.*photo/', '', previous)

if current >= n-1: 
  nextious = photos[-1]
else:
  nextious = photos[current+1]
nextious = re.sub('.*photo/', '', nextious)

message = year + '/' + folder + ' : ' + str(current+1) + ' / ' + str(n)

head = """\
  <!DOCTYPE html>
  <html>
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="slide.css">
    <title> {title} </title>
  </head>
{message}
""".format(title=title, message=message)

text = """\
  <div class="imap">
    <img src={pic}>
    <a href='slide.py?this="{first}"'    title="First"    style="top: 0%;  left: 0%;  width: 45%; height: 15%;"></a>
    <a href='slide.py?this="{last}"'     title="Last"     style="top: 0%;  left: 55%; width: 45%; height: 15%;"></a>
    <a href='slide.py?this="{previous}"' title="Previous" style="top: 20%; left: 0%;  width: 45%; height: 80%;"></a>
    <a href='slide.py?this="{nextious}"' title="Next"     style="top: 20%; left: 55%; width: 45%; height: 80%;"></a>
  </div>
""".format(pic=webhome+'/'+year+'/'+folder+'/'+photo, first=first, last=last, previous=previous, nextious=nextious)

tail = """\
  </body>
  </html>
"""

print(head + text + tail)
