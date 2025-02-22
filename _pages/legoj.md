---
layout: apan
permalink: /legoj/
title: LegoJ
description: Lego Jie Sets Collection
nav: false
#nav_order: 1
_styles: >
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            color: #fff;
            background-color: #33a;
            padding: 0px;
            border-radius: 0px;
        }
        .tooltip {
            position: relative;
            display: inline-block;
        }
        .tooltip .tooltiptext {
            visibility: hidden;
            width: 20%;
            max-width: 20%;
            background-color: #fff;
            color: #333;
            text-align: center;
            border-radius: 6px;
            padding: 5px;
            position: fixed;
            z-index: 1;
            top: 5%;
            left: 50%;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.1);
        }
        .tooltip:hover .tooltiptext {
            visibility: visible;
        }
        .tooltip-image {
            width: 200px;
            height: auto;
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
              <div class="tooltiptext">
                 <img src="{{ set.image }}" alt="{{ set.set_name }}" class="tooltip-image">
              </div>
          </div>
      </td>
      <td>{{ set.purchase_date }}</td>
      <td>{{ set.price }}</td>
      <td>{{ set.order }}</td>
    </tr>
    {% endfor %}
  </tbody>
</table>
