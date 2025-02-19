---
layout: post
title: customize post template
date: 2025-02-19 09:00:00
description: customize post template to remove these no need
tags: apan tech
categories: web
featured: false
---

To customize post template, this file needs to be modified:

https://github.com/panyu101/panyu101.github.io/blob/main/_layouts/post.liquid

Cut AFTER "  </article>" and BEFORE "</div>"from file: _layouts/post.liquid to remove these links and info AFTER normal POST.

These are the lines removed from the original file:
````
```html

  {% if page.citation %}
    {% include citation.liquid %}
  {% endif %}

  {% if page.related_publications %}
    <h2>References</h2>
    <div class="publications">
      {% bibliography --group_by none --cited_in_order %}
    </div>
  {% endif %}

  {% if site.related_blog_posts and site.related_blog_posts.enabled %}
    {% if page.related_posts == null or page.related_posts %}
      {% include related_posts.liquid %}
    {% endif %}
  {% endif %}

  {% if site.disqus_shortname and page.disqus_comments %}
    {% include disqus.liquid %}
  {% endif %}
  {% if site.giscus and page.giscus_comments %}
    {% include giscus.liquid %}
  {% endif %}

```
````
