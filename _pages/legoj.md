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
    text-decoration: underline;
    color: blue;
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
    top: 120%; /* Adjusted to prevent overlap */
    left: 50%;
    transform: translateX(-50%);
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    opacity: 0;
    transition: opacity 0.2s ease-in-out;
  }

  .tooltip:hover .tooltip-image {
    visibility: visible;
    opacity: 1;
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
        <span class="tooltip">
          {{ set.set_name }}
          <img src="{{ set.image }}" alt="{{ set.set_name }}" class="tooltip-image">
        </span>
      </td>
      <td>{{ set.purchase_date }}</td>
      <td>{{ set.price }}</td>
      <td>{{ set.order }}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
