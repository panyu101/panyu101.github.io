#!/usr/bin/python3

import re
import cgi

photo_home = '/var/nginx/html/photo'
thumb_home = '/var/nginx/html/pub/photo/thumb'

print('Content-Type: text/html')
print('')
print('<meta charset="utf-8">')

fs = cgi.FieldStorage()
# photo - basename of the photo, *.jpg
# tag  - tag to be added into photo, *.txt

photo = fs['photo'].value
tag = fs['tag'].value

title = 'Add tag'
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
tag   = re.sub('"', '', tag)

target = thumb_home+'/'+year+'/'+folder+'/'+photo+'.txt'

print(target)

f = open(target, "w")
f.write(tag)
f.close()

text = """\
  <h3> {year} </h3>
  <h3> {folder} </h3>
  <h3> {photo} </h3>
  <h3> {tag} </h3>
  <h3> {target} </h3>
  """.format(year=year, folder=folder, photo=photo, tag=tag, target=target)

tail = """\
  </body>
  </html>
"""

print(head + text + tail)
