---
layout: post
title: Git diff output
date: 2025-03-08 08:50:00
description: git diff output
tags: apan tech
categories: git
featured: false
---
git diff command output is vi style by default under Alpine Linux, but you can change this:  
```bash
git diff

git config --global --get core.pager
git config --global core.pager "more"

git diff
```
