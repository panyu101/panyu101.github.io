---
layout: post
title: EKS service account setup
date: 2025-03-22 20:35:00
description: EKS service account setup
tags: apan tech
categories: k8s
featured: false
---
When the pod running under AWS EKS, if it needs to use the resouce at AWS, then the service account is required to set up.  
The following is a sample of calling the module to set this service account called "ds-graph" up.  It is usually in file: service-accounts.tf  
```terraform
module "eks_serviceaccount_ds_graph" {
  source  = "app.terraform.io/company-profiles/eks-serviceaccount-iam/aws"
  version = "1.1.0"

  cluster_name = var.cluster_name
  region       = data.aws_region.current.name
  namespace    = "qubed"

  service_account_name = "ds-graph"
  role_name    = "ds-graph-${var.environment}"

  role_policy_arns = {
    neptune_full_access = "arn:aws:iam::aws:policy/NeptuneFullAccess"
  }
}
```
**Before** you call the module, the provider should be added somewhere first, like this:  
```terraform
provider "kubernetes" {
  host                   = data.aws_eks_cluster.qubed.endpoint
  cluster_ca_certificate = base64decode(data.aws_eks_cluster.qubed.certificate_authority[0].data)
  exec {
    api_version = "client.authentication.k8s.io/v1beta1"
    args        = ["eks", "get-token", "--cluster-name", data.aws_eks_cluster.qubed.id]
    command     = "aws"
  }
}
```
**Usage:** the very **last line** uses the service account defined.  
```yaml
... ...
processes:
  - command: ["/home/myuser/.local/bin/gunicorn", "-w", "4", "-b", "0.0.0.0:3000", "main:app"]
    cpuRequest: 1000m
    maxReplicas: 2
    minReplicas: 1
    targetCPUUtilizationPercentage: 60
    targetMemoryUtilizationPercentage: 70       
    envSpecific:
      demo:
        hostname: qubed-ds-graph.demo.qubed.ai
        memoryRequest: 512Mi
      prod:
        hostname: qubed-ds-graph.prod.qubed.ai
        memoryRequest: 512Mi
serviceAccountName: ds-graph
```
