---
layout: post
title: git commit and push with random message tag
date: 2025-02-17 20:50:00
description: git commit and push with random message tag
tags: apan tech
categories: git
featured: true
---

```bash
# one line git commit and push
git add -A && git commit -a -m $(date +"%m-%d-%Y") && git push

# create a random string in 9 chracters WITHOUT special characters inside.
openssl rand -base64 48 | tr -dc 'A-Za-z0-9' | fold -w 9 | head -n 1

# git commit and push with random message tag
git add -A && git commit -a -m $(date +"%m-%d-%Y")_$(openssl rand -base64 48 | tr -dc 'A-Za-z0-9' | fold -w 9 | head -n 1) && git push

```
