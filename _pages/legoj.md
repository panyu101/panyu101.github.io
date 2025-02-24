---
layout: page
permalink: /legoj/
title: LegoJ
description: Lego Jie Sets Collection
nav: false
_styles: >
.hover-container {
  position: relative;
  display: inline-block;
}

.hover-image {
  display: none;
  position: absolute;
  z-index: 100;
  max-width: 120px; /* Adjust size as needed */
  top: 100%;
  left: 0;
  border: 1px solid #ccc;
  box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.hover-container:hover .hover-image {
  display: block;
}
---
<table>
  <thead>
    <tr>
      <th>Set Number</th>
      <th>Set Name</th>
      <th>Purchase Date</th>
      <th>Price</th>
      <th>Order</th>
    </tr>
  </thead>
  <tbody>
    {% for set in site.data.legoj.lego_sets | sort: 'order' | reverse %}
    <tr>
      <td><a href="{{ set.url }}">{{ set.set_number }}</a></td>
      <td>
        <div class="hover-container">
          <a href="{{ set.image }}" target="_blank" class="set-name">{{ set.set_name }}</a>
          <img src="{{ set.image }}" class="hover-image" alt="{{ set.set_name }}">
        </div>
      </td>
      <td>{{ set.purchase_date }}</td>
      <td>{{ set.price }}</td>
      <td>{{ set.order }}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
