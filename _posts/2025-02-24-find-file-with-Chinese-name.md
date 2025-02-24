---
layout: post
title: find file with Chinese name
date: 2025-02-24 16:00:00
description: Search and find a file with Chinese filename
tags: apan tech
categories: linux
featured: false
---

This example shows how to use envrc in an aws cli to go through all directories to run the same aws cli:
```bash
find /var/www/html/Pan/ -type f | grep --color=auto -P '[^\x00-\x7F]'

# or this one which also works under Alpine Linux
find /var/www/html/Pan/ -type f | grep --color=auto '[^ -~]'
```
