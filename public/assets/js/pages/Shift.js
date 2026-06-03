var barOptions = {
  series: [
    {
      name: "A1",
      data: [44, 55, 57, 56],
    },
    {
      name: "M1",
      data: [76, 85, 101, 98],
    },
  ],
  chart: {
    type: "bar",
    height: 180,
  },
  plotOptions: {
    bar: {
      horizontal: false,
      columnWidth: "55%",
      endingShape: "rounded",
    },
  },
  dataLabels: {
    enabled: false,
  },
  stroke: {
    show: true,
    width: 2,
    colors: ["transparent"],
  },
  xaxis: {
    categories: ["ip1", "ip2", "ip3", "ip4"],
  },
  yaxis: {
    title: {
      text: "$ (thousands)",
    },
  },
  fill: {
    opacity: 1,
  },
  tooltip: {
    y: {
      formatter: function(val) {
        return "$ " + val + " thousands";
      },
    },
  },
};

var bar1 = new ApexCharts(document.querySelector("#shift_1"), barOptions);
var bar2 = new ApexCharts(document.querySelector("#shift_2"), barOptions);
var bar3 = new ApexCharts(document.querySelector("#shift_3"), barOptions);
var bar_now = new ApexCharts(document.querySelector("#now_shift"), barOptions);
var bar_stock = new ApexCharts(document.querySelector("#stock"), barOptions);

bar1.render();
bar2.render();
bar3.render();
bar_now.render();
bar_stock.render();
