---
layout: post
title: sample page creation
date: 2025-02-20 09:20:00
description: set up a sample page
tags: apan tech
categories: web
featured: false
---

Step 1: Create a Data File

First, create a YAML data file in the _data folder of your al-folio project. Name it sample.yml and add some simple data, like this:
````
```bash
# _data/sample.yml

greeting:
  title: "Welcome to My Site!"
  message: "This is a sample message from my data file."
  items:
    - "Item 1"
    - "Item 2"
    - "Item 3"
```
````
This file defines a greeting object with a title, message, and a list of items.

Step 2: Create or Edit a Page to Display the Data

Al-folio uses Jekyll, so we’ll create a new page or modify an existing one (e.g., index.md or a new _pages/sample.md) to display this data. Let’s create a new page for clarity.

Create _pages/sample.md

Add a new file in the _pages folder called sample.md with the following content:
````
```bash
---
layout: page
permalink: /sample/
title: Sample Page
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
```
````
