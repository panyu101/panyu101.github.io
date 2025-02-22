---
layout: page
permalink: /legoj/
title: LegoJ
description: Lego Jie Sets Collection
nav: false
#nav_order: 1
---

<style>
  .tooltip {
    position: relative;
    display: inline-block;
    cursor: pointer;
  }

  .tooltip .tooltip-image {
    visibility: hidden;
    width: 200px; /* Adjust as needed */
    height: auto;
    background-color: white;
    border: 1px solid #ddd;
    padding: 5px;
    position: absolute;
    z-index: 100;
    top: 100%;
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  }

  .tooltip:hover .tooltip-image {
    visibility: visible;
  }
</style>

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
        <div class="tooltip">
          {{ set.set_name }}
          <img src="{{ set.image }}" alt="{{ set.set_name }}" class="tooltip-image">
        </div>
      </td>
      <td>{{ set.purchase_date }}</td>
      <td>{{ set.price }}</td>
      <td>{{ set.order }}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
