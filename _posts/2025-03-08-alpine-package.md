---
layout: post
title: Alpine package info
date: 2025-03-08 07:45:00
description: Alpine package info
tags: apan tech
categories: alpine
featured: false
---
Right after completion of Alpine installation, do this to save a default_packages.txt  
```bash
apk info > default_packages.txt
```
After that, you may use apk add to install any package.  
When you want to know what packages have been installed other than these installed by default, you can do:  
```bash
apk info > installed_packages.txt
```
Then compare these two files:  
```bash
diff default_packages.txt installed_packages.txt
```


