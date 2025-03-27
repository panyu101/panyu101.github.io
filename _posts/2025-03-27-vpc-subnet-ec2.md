---
layout: post
title: AWS VPC subnet to EC2
date: 2025-03-27 10:05:00
description: AWS VPC subnet to EC2, one Terraform file
tags: apan tech
categories: terraform
featured: false
---
One Terraform sample code here to generate everything from VPC to a Windows server.  
You need to generate key pair and provide pub key in the code.  
```terraform
provider "aws" {
  region  = "REGION_NAME"
  profile = "PROFILE_NAME"  # Replace with your actual AWS profile name
}

data "aws_ami" "windows_2022" {
  most_recent = true
  owners      = ["amazon"]

  filter {
    name   = "name"
    values = ["Windows_Server-2022-English-Full-Base-*"]
  }

  filter {
    name   = "virtualization-type"
    values = ["hvm"]
  }

  filter {
    name   = "root-device-type"
    values = ["ebs"]
  }
}

resource "aws_key_pair" "ap_test_key" {
  key_name   = "KEY_NAME"
  public_key = "ssh-rsa AAAAB3NzaC1yc2E...your-public-key-here..."  # Replace with your actual public key
}

resource "aws_vpc" "ap_test_vpc" {
  cidr_block           = "10.99.0.0/16"
  enable_dns_hostnames = true
  enable_dns_support   = true
  tags = { Name = "ap-test" }
}

resource "aws_internet_gateway" "ap_test_igw" {
  vpc_id = aws_vpc.ap_test_vpc.id
  tags   = { Name = "ap-test-igw" }
}

resource "aws_route_table" "ap_test_rt" {
  vpc_id = aws_vpc.ap_test_vpc.id
  route {
    cidr_block = "0.0.0.0/0"
    gateway_id = aws_internet_gateway.ap_test_igw.id
  }
  tags = { Name = "ap-test-rt" }
}

resource "aws_subnet" "ap_test_subnet_1" {
  vpc_id                  = aws_vpc.ap_test_vpc.id
  cidr_block              = "10.99.1.0/24"
  availability_zone       = "cn-northwest-1a"
  map_public_ip_on_launch = true
  tags                    = { Name = "ap-test-subnet-1" }
}

resource "aws_subnet" "ap_test_subnet_2" {
  vpc_id                  = aws_vpc.ap_test_vpc.id
  cidr_block              = "10.99.2.0/24"
  availability_zone       = "cn-northwest-1b"
  map_public_ip_on_launch = true
  tags                    = { Name = "ap-test-subnet-2" }
}

resource "aws_route_table_association" "ap_test_rta_1" {
  subnet_id      = aws_subnet.ap_test_subnet_1.id
  route_table_id = aws_route_table.ap_test_rt.id
}

resource "aws_route_table_association" "ap_test_rta_2" {
  subnet_id      = aws_subnet.ap_test_subnet_2.id
  route_table_id = aws_route_table.ap_test_rt.id
}

resource "aws_security_group" "ap_test_sg" {
  name        = "ap-test-sg"
  description = "Security group for Windows instance"
  vpc_id      = aws_vpc.ap_test_vpc.id
  ingress {
    from_port   = 3389
    to_port     = 3389
    protocol    = "tcp"
    cidr_blocks = ["0.0.0.0/0"]
  }
  egress {
    from_port   = 0
    to_port     = 0
    protocol    = "-1"
    cidr_blocks = ["0.0.0.0/0"]
  }
  tags = { Name = "ap-test-sg" }
}

resource "aws_instance" "ap_test_win" {
  ami                         = data.aws_ami.windows_2022.id
  instance_type               = "t3.xlarge"
  subnet_id                   = aws_subnet.ap_test_subnet_1.id
  vpc_security_group_ids      = [aws_security_group.ap_test_sg.id]
  key_name                    = aws_key_pair.ap_test_key.key_name
  associate_public_ip_address = true
  root_block_device {
    volume_size = 199
    volume_type = "gp3"
  }
  tags = { Name = "ap-test-win" }
}

output "windows_public_ip" {
  value       = aws_instance.ap_test_win.public_ip
  description = "Public IP address of the Windows instance"
}

output "vpc_id" {
  value       = aws_vpc.ap_test_vpc.id
  description = "VPC ID"
}

output "subnet_1_id" {
  value       = aws_subnet.ap_test_subnet_1.id
  description = "Subnet 1 ID"
}

output "subnet_2_id" {
  value       = aws_subnet.ap_test_subnet_2.id
  description = "Subnet 2 ID"
}

output "ami_id_used" {
  value       = data.aws_ami.windows_2022.id
  description = "The AMI ID actually used for the Windows instance"
}

```
