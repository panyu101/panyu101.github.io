---
layout: page
permalink: /sample/
title: Sample
nav: true
nav_order: 1
---

{% if site.data.sample.tian-gan %}
  <h1>{{ site.data.sample.tian-gan.title }}</h1>
  <p>{{ site.data.sample.tian-gan.message }}</p>
  <ul>
    {% for item in site.data.sample.tian-gan.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ul>
{% endif %}
