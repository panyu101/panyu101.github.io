---
layout: page
permalink: /sample/
title: Sample
nav: true
nav_order: 1
---

{% if site.data.sample.greeting %}
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card p-4 shadow-sm">
          <h1 class="card-title text-center">{{ site.data.sample.greeting.title }}</h1>
          <p class="card-text">{{ site.data.sample.greeting.message }}</p>
          <ul class="list-group list-group-flush">
            {% for item in site.data.sample.greeting.items %}
              <li class="list-group-item">{{ item }}</li>
            {% endfor %}
          </ul>
        </div>
      </div>
    </div>
  </div>
{% endif %}
