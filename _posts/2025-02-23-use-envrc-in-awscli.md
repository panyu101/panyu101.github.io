---
layout: post
title: use envrc in awscli
date: 2025-02-23 10:00:00
description: Sample of usage of envrc in awscli
tags: apan tech
categories: aws
featured: false
---

This example shows how to use envrc in an aws cli to go through all directories to run the same aws cli:
```bash
for i in $(ls -d *|grep -v zz);do cd $i;source .envrc;aws eks list-insights --cluster-name $EKS_CLUSTER|gg -A9 "kube-proxy version skew"|gg "status";cd -;done
```
