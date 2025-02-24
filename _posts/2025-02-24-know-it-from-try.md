---
layout: post
title: know it from try
date: 2025-02-24 14:45:00
description: know this Al-Folio framwork from trying
tags: apan tech
categories: web
featured: false
---

**_config.yml file defines lots of variables, and can be used as site.VAR**

For example, these two variables
```bash
blog_name: Blog     # blog_name will be displayed in your blog page
blog_description: a simple whitespace theme for academics
```
are used in file _post/blog.md as this way:
```liquid
{% raw %}
{% if blog_name_size > 0 or blog_description_size > 0 %}

  <div class="header-bar">
    <h3>{{ site.blog_name }}</h3>
    <h4>{{ site.blog_description }}</h4>
  </div>
  {% endif %}
{% endraw %}
```
