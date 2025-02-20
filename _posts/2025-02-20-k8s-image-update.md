---
layout: post
title: k8s image update
date: 2025-02-20 13:10:00
description: Update k8s image
tags: apan tech
categories: k8s
featured: false
---
Check kube-proxy "insightStatus"
```bash
aws eks list-insights --cluster-name panel-eks-prod|gg -C9 -i proxy
```

Check the current version at the EKS Cluster
```bash
kubectl describe daemonset kube-proxy -n kube-system | gg Image
```
You should see the output like this:
> Image:      602401143452.dkr.ecr.us-east-1.amazonaws.com/eks/kube-proxy:v1.31.2-eksbuild.3

Or use this commandL
```bash
kubectl get daemonset kube-proxy -n kube-system -o jsonpath='{.spec.template.spec.containers[?(@.name=="kube-proxy")].image}';echo
```
And you should have output like this:
> 602401143452.dkr.ecr.us-east-1.amazonaws.com/eks/kube-proxy:v1.31.2-eksbuild.3

Both outputs above, should be the same version.

Find out compatiable build with this command:
```bash
aws eks describe-addon-versions --addon-name kube-proxy --kubernetes-version 1.31 --output text
```
Say it is "v1.31.1-eksbuild.2"

The set this image to the daemonset
```bash
kubectl set image daemonset kube-proxy kube-proxy=602401143452.dkr.ecr.us-east-1.amazonaws.com/eks/kube-proxy:v1.31.1-eksbuild.2 -n kube-system
```
After set, you may run all check commands above to verify.
