---
layout: page
permalink: /legoj/
title: Lego J Set
description: Lego Jie Sets Collection
nav: true
nav_order: 1
_styles: |
  .tooltip {
    position: relative;
    display: inline-block;
    cursor: pointer;
  }
  .tooltip .tooltiptext {
    visibility: hidden;
    width: 200px;
    background-color: #555;
    color: #fff;
    text-align: center;
    padding: 5px;
    border-radius: 6px;
    position: absolute;
    z-index: 9999; /* Increased from 1000 */
    top: -150px; /* Try positioning above the text instead of below */
    bottom: 125%;
    left: 50%;
    margin-left: -100px;
    opacity: 0;
    transition: opacity 0.3s;
  }
  .tooltip .tooltiptext img {
    max-width: 20%;
    height: auto;
    display: block;
  }
  .tooltip:hover .tooltiptext {
    visibility: visible !important;
    opacity: 1 !important;
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
        <div class="tooltip">
          {{ set.set_name }}
          <span class="tooltiptext">
            <img src="{{ set.image }}" alt="{{ set.set_name }}">
          </span>
        </div>
      </td>
      <td>{{ set.purchase_date }}</td>
      <td>{{ set.price }}</td>
      <td>{{ set.order }}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
