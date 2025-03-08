---
layout: post
title: My favirate bash profile
date: 2025-03-08 09:45:00
description: My favirate bash profile
tags: apan tech
categories: bash
featured: false
---
My favirate bash profile:  
```bash
# 99+

# export PS1="\[\e[31m\][\[\e[m\]\[\e[38;5;172m\]\u\[\e[m\]@\[\e[38;5;153m\]\h\[\e[m\] \[\e[38;5;214m\]\W\[\e[m\]\[\e[31m\]]\[\e[m\]\\$ "
# W - for current working directory
export PS1="\[\e[31m\][\[\e[m\]\[\e[38;5;172m\]\u\[\e[m\]@\[\e[38;5;153m\]\h\[\e[m\] \[\e[38;5;214m\]\w\[\e[m\]\[\e[31m\]]\[\e[m\]\\$ "
# w - for current working directory, absolute FULL path from / (root)

alias rm='rm -fv' ll='ls -al ' gg='grep --color ' hh='history 33' nn='nano -w ' w='ps aux|grep -v grep|grep "pts/"' u='uptime'

export LS_COLORS=${LS_COLORS}:'zz=04;31'   # ONLY works for ls --color, not for busybox ls.
export EDITOR=nano

eval "$(direnv hook bash)"

# 99+.
```
