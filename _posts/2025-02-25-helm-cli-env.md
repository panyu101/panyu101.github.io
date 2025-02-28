---
layout: post
title: helm cli env
date: 2025-02-25 12:4:00
description: helm cli environment setup
tags: apan tech
categories: k8s
featured: false
---
If needs to run helm cli based on current repo, make sure the correct EKS settings is in place
```bash
echo $KUBECONFIG
/root/.kube/config.qubed-eks-prod

# otherwise, change it to the correct one:
KUBECONFIG='/root/.kube/config.busi-eks-demo'

echo $KUBECONFIG
/root/.kube/config.busi-eks-demo
```
You also need to source /opt/aws/EKS/busi-demo/.envrc, which has ALL EKS settings.
