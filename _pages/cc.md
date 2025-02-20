---
layout: page
permalink: /culture/
title: Chinese Culture
nav: true
nav_order: 1
---

{% if site.data.cc.tian-gan %}
  <h3>{{ site.data.cc.tian-gan.title }}</h3>
  <p>{{ site.data.cc.tian-gan.message }}</p>
  <ol>
    {% for item in site.data.cc.tian-gan.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ol>
{% endif %}

{% if site.data.cc.di-zhi %}
  <h3>{{ site.data.cc.di-zhi.title }}</h3>
  <p>{{ site.data.cc.di-zhi.message }}</p>
  <ol>
    {% for item in site.data.cc.di-zhi.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ol>
{% endif %}

{% if site.data.cc.sheng-xiao %}
  <h3>{{ site.data.cc.sheng-xiao.title }}</h3>
  <p>{{ site.data.cc.sheng-xiao.message }}</p>
  <ol>
    {% for item in site.data.cc.sheng-xiao.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ol>
{% endif %}
