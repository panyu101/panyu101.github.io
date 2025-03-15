---
layout: post
title: EKS service account
date: 2025-03-07 12:55:00
description: EKS service account
tags: apan tech
categories: k8s
featured: false
---
When the pod running under AWS EKS, if it needs to use the resouce at AWS, then the service account is required to set up.  
The following is a sample of calling the module to set this service account called "ds-kafka-consumer" up.  It is usually in file: service-accounts.tf
```terraform
module "eks_serviceaccount_iam_prod" {
  providers = {
    kubernetes = kubernetes.kubernetes-prod
  }
  source  = "app.terraform.io/company-profiles/eks-serviceaccount-iam/aws"
  version = "1.1.0"

  cluster_name = module.qubed_eks_fargate_prod.cluster_name
  region       = var.region
  namespace    = "qubed"

  service_account_name = "ds-kafka-consumer"
  role_name    = "ds-kafka-consumer-prod"

  role_policy_arns = {
    policy = aws_iam_policy.invoke_lambda.arn
  }
}
```
Later, this "ds-kafka-consumer" can be used somewhere like this (in deployment.yaml file):  
```yaml
processes:
  - command: ["python", "-u", "main.py"]
    cpuRequest: 2000m
    memoryRequest: 2096Mi
    maxReplicas: 8
    minReplicas: 2
    targetCPUUtilizationPercentage: 60
    targetMemoryUtilizationPercentage: 70        
serviceAccountName: ds-kafka-consumer
```
The very **last line** uses the service account defined.
