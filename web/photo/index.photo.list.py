#!/usr/bin/python3

import re
#from icecream import ic
import cgi
import glob

title = 'Photo List by year'

print('Content-Type: text/html')
print('')
print('<meta charset="utf-8">')

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

years = ['1945', \
         '1950', '1951', '1952', '1953', '1954', '1955', '1956', '1957', '1958', '1959', \
         '1960', '1961', '1962', '1963', '1964', '1965', '1966', '1967', '1968', '1969', \
         '1970', '1971', '1972', '1973', '1974', '1975', '1976', '1977', '1978', '1979', \
         '1980', '1981', '1982', '1983', '1984', '1985', '1986', '1987', '1988', '1989', \
         '1990', '1991', '1992', '1993', '1994', '1995', '1996', '1997', '1998', '1999', \
         '2000', '2001', '2002', '2003', '2004', '2005', '2006', '2007', '2008', '2009', \
         '2010', '2011', '2012', '2013', '2014', '2015', '2016', '2017', '2018', '2019', \
         '2020', '2021']
years = sorted(years, reverse=True)

text = ''
for year in years:
  folders = glob.glob('/var/nginx/html/photo/'+year+'/'+'*')
  folder_count = len(folders)
  if folder_count == 0:
    continue
  photo_count = 0
  for folder in folders:
    folder = re.sub('/.*/', '', folder)
    photos = glob.glob('/var/nginx/html/photo/'+year+'/'+folder+'/'+'*.jpg')
    photo_count += len(photos)
  text = text + '<br>'
  this = """\
  <a href="app.php?year={year}"> {year} </a><qspan> {folder_count} / {photo_count} </qspan>
  """.format(year=year, folder_count=folder_count, photo_count=photo_count)
  text = text + this

tail = """\
  </body>
  </html>
"""

print(head + text + tail)
