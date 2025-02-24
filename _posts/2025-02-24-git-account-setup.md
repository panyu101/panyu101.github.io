---
layout: post
title: git account setup with .envrc
date: 2025-02-24 10:00:00
description: git account setup with .envr and .ssh/config to avoid extra command typing
tags: apan tech
categories: git
featured: false
---
When you have multiple Github/BitBucket accounts on the same computer, you may need to set up them this way to avoid swiching manually.

**Config ssh**
```bash
cat ~/.ssh/config

Host github-ox0
    HostName github.com
    User git
    IdentityFile /opt/key/ox0.github.rsa
    IdentitiesOnly yes

Host github-ratox
    HostName github.com
    User git
    IdentityFile /opt/key/rat-ox.github.rsa
    IdentitiesOnly yes

Host github-panyu101
    HostName github.com
    User git
    IdentityFile /opt/key/panyu101.github.rsa
    IdentitiesOnly yes

Host bitbucket-apox0
    HostName bitbucket.org
    User git
    IdentityFile /opt/key/apox0.bitbucket.rsa
    IdentitiesOnly yes

Host bitbucket-apox1
    HostName bitbucket.org
    User git
    IdentityFile /opt/key/apox1.bitbucket.rsa
    IdentitiesOnly yes

Host bitbucket-ox0ca
    HostName bitbucket.org
    User git
    IdentityFile /opt/key/ox0ca.bitbucket.rsa
    IdentitiesOnly yes

Host *
    AddKeysToAgent yes
```

**Make directory the same name as the repo**
Add .envrc to each directory
```bash
cat .envrc

#!/bin/bash

git config user.email "FIRST.LAST@XXXX.XX"
git config user.name "ox0"
```

**Add this into .gitignore**
```bash
.envrc
```

**Specify user/account when clone the repo**
```bash
# instead of using normal SSH clone commond like this:
git clone git@github.com:panyu101/panyu101.github.io.git

# Use this to specify the user/account
git clone git@github-panyu101:panyu101/panyu101.github.io.git
```
**Make sure the difference in two commond above!**

**Verify the user/account**
```bash
# git remote -v
origin  git@github-ox0:ox0/ox0.github.io.git (fetch)
origin  git@github-ox0:ox0/ox0.github.io.git (push)

# ssh -T git@github-ox0
Hi ox0! You've successfully authenticated, but GitHub does not provide shell access.
```
