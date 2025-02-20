---
layout: page
permalink: /culture/
title: Chinese Culture
nav: true
nav_order: 1
---

{% if site.data.sample.tian-gan %}
  <h1>{{ site.data.sample.tian-gan.title }}</h1>
  <p>{{ site.data.sample.tian-gan.message }}</p>
  <ol>
    {% for item in site.data.sample.tian-gan.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ol>
{% endif %}

{% if site.data.sample.di-zhi %}
  <h1>{{ site.data.sample.di-zhi.title }}</h1>
  <p>{{ site.data.sample.di-zhi.message }}</p>
  <ol>
    {% for item in site.data.sample.di-zhi.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ol>
{% endif %}
