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

var week_1 = new ApexCharts(document.querySelector("#week_1"), barOptions);
var week_2 = new ApexCharts(document.querySelector("#week_2"), barOptions);
var week_3 = new ApexCharts(document.querySelector("#week_3"), barOptions);
var week_4 = new ApexCharts(document.querySelector("#week_4"), barOptions);

var mont_1 = new ApexCharts(document.querySelector("#mont_1"), barOptions);
var mont_2 = new ApexCharts(document.querySelector("#mont_2"), barOptions);
var mont_3 = new ApexCharts(document.querySelector("#mont_3"), barOptions);
var mont_4 = new ApexCharts(document.querySelector("#mont_4"), barOptions);

week_1.render();
week_2.render();
week_3.render();
week_4.render();

mont_1.render();
mont_2.render();
mont_3.render();
mont_4.render();
