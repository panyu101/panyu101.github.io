#!/usr/bin/python3

import re
import cgi
#import os
import os.path

photo_home = '/var/nginx/html/photo'
thumb_home = '/var/nginx/html/pub/photo/thumb'

print('Content-Type: text/html')
print('')
print('<meta charset="utf-8">')

fs = cgi.FieldStorage()
# photo - basename of the photo, *.jpg
# tag  - tag to be added into photo, *.txt

photo = fs['photo'].value

title = 'Hide this photo'
head = """\
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="photo.css">
    <title> {title} </title>
  </head>
  <body style="text-align:center; background-color: #E1E0C7;">
  <h3>{title}</h3>
""".format(title=title)

paths  = re.split('\/', photo)
year   = re.sub('"', '', paths[0])
folder = re.sub('"', '', paths[1])
photo  = re.sub('"', '', paths[2])

target = photo_home+'/'+year+'/'+folder+'/'+photo

#print(target)

if not os.path.isfile(target+'.JPG'):
  old_file = os.path.join(photo_home+'/'+year+'/'+folder, photo)
  new_file = os.path.join(photo_home+'/'+year+'/'+folder, photo+'.JPG')
  os.rename(old_file, new_file)
  print(old_file)
  print(new_file)

text = """\
  <h3> {year} </h3>
  <h3> {folder} </h3>
  <h3> {photo} </h3>
  <h3> {target} </h3>
  """.format(year=year, folder=folder, photo=photo, target=target)

tail = """\
  </body>
  </html>
"""

print(head + text + tail)
