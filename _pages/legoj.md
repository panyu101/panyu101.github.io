---
layout: page
permalink: /legoj/
title: Lego J Set
nav: true
nav_order: 1
---

# Lego J Sets Collection

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

<style>
.tooltip {
  position: relative;
  display: inline-block;
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
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -100px;
  opacity: 0;
  transition: opacity 0.3s;
}

.tooltip .tooltiptext img {
  max-width: 100%;
  height: auto;
}

.tooltip:hover .tooltiptext {
  visibility: visible;
  opacity: 1;
}
</style>
