---
layout: page
permalink: /sample/
title: Sample
nav: true
nav_order: 1
---

{% if site.data.sample.greeting %}
  <h1>{{ site.data.sample.greeting.title }}</h1>
  <p>{{ site.data.sample.greeting.message }}</p>
  <ul>
    {% for item in site.data.sample.greeting.items %}
      <li>{{ item }}</li>
    {% endfor %}
  </ul>
{% endif %}
