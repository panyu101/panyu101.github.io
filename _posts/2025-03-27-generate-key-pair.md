---
layout: post
title: Generate key pair
date: 2025-03-27 09:25:00
description: Generate key pair with one line command
tags: apan tech
categories: bash
featured: false
---
Using the following **one** command to generate two files:  
**ap-test-key**  
**ap-test-key.pub**  
Both are in PEM format
```bash
ssh-keygen -t rsa -b 2048 -m PEM -f ap-test-key -N ''
```
