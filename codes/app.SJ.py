#!/usr/bin/python3

import re
#from icecream import ic
import cgi

fs = cgi.FieldStorage()
# masterpiece - mp
mp = fs['mp'].value
mp = 'data/' + mp + '/' + mp

a = open(mp+"a.txt", "r")
tops = a.readlines()
b = open(mp+"b.txt", "r")
lines = b.readlines()
c = open(mp+"c.txt", "r")
notes = c.read()
d = open(mp+"d.txt", "r")
indexs = d.readlines()
e = open(mp+"e.txt", "r")
pinyin = e.read()


print('Content-Type: text/html')
print('')
print('<meta charset="utf-8">')

head = """\
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="sj.css">
    <title>{title} {name}</title>
  </head>
  <body style="text-align:center; background-color: #E1E0C7;">
  <a href="{ref}" target=_blank><h2>{name}</h2></a>
  <h5>{author}</h5>
""".format(title=tops[0], ref=tops[1], name=tops[2], author=tops[3])

text = ''
for index in indexs:
  #ic(index)
  note = ''
  text = text + '<br>'
  splitted_words = re.split('\^', index) 
  #ic(splitted_words)
  for word in splitted_words:
    #ic(word)
    note = re.findall('(?:^|\n){}(?:|(.*))：(.*)。'.format(word), notes)
    #ic(note)
    if word.strip() and note:
      note = word + str(note)
      note = re.sub('\[|\]|\(|\)|\'', '', note)
      #ic(word + '---------' + note)
      this = """\
      <div class="tooltip">{word}
        <span class="tooltiptext">{note}</span>
      </div>
      """.format(word=word, note=note)
      text = text + this
    elif not note:
      #ic(word)
      that = """\
          <div class="tooltip">{word}
          </div>
      """.format(word=word)
      text = text + that


tail = """\
  <br><br>{mp}<br><br>
  <audio controls>
  <source src="{mp}.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
  </audio>
  <br><br><br>{pinyin}<br><br>
  </body>
  </html>
""".format(mp=mp, pinyin=pinyin)

print(head + text + tail)