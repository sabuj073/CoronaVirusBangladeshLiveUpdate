window.onload = function () {
  // Infected people chart with time (line chart)

  var chart = new CanvasJS.Chart("infectionWithDate", {
    exportEnabled: true,
    animationEnabled: true,
    title: {
      text: "Number of infection with time",
    },
    axisX: {
      title: "Date",
      valueFormatString: "DD MMM",
    },
    axisY: {
      title: "Number of People",
      includeZero: false,
    },
    data: [
      {
        type: "line",
        xValueFormatString: "DD MMM",
        color: "#0288d1",
        dataPoints: [
          { x: new Date(2020, 02, 8), y: 3 },
          { x: new Date(2020, 02, 14), y: 2 },
          { x: new Date(2020, 02, 16), y: 3 },
          { x: new Date(2020, 02, 17), y: 2 },
          { x: new Date(2020, 02, 18), y: 4 },
          { x: new Date(2020, 02, 19), y: 4 },
          { x: new Date(2020, 02, 20), y: 2 },
          { x: new Date(2020, 02, 21), y: 4 },
          { x: new Date(2020, 02, 22), y: 3 },
          { x: new Date(2020, 02, 23), y: 6 },
          { x: new Date(2020, 02, 24), y: 6 },
          { x: new Date(2020, 02, 26), y: 5 },
          { x: new Date(2020, 02, 27), y: 4 },
          { x: new Date(2020, 02, 30), y: 1 },
          { x: new Date(2020, 02, 31), y: 2 },
          { x: new Date(2020, 03, 1), y: 3 },
          { x: new Date(2020, 03, 2), y: 2 },
          { x: new Date(2020, 03, 3), y: 5 },
          { x: new Date(2020, 03, 4), y: 9 },
          { x: new Date(2020, 03, 5), y: 18 },
          { x: new Date(2020, 03, 6), y: 35 },
          { x: new Date(2020, 03, 7), y: 41 },
          { x: new Date(2020, 03, 8), y: 54 },
          { x: new Date(2020, 03, 9), y: 112 },
          { x: new Date(2020, 03, 10), y: 94 },
          { x: new Date(2020, 03, 10), y: 58 }
        ],
      },
    ],
  });


  

  // Dead people chart with time (spline chart)

  var chart2 = new CanvasJS.Chart("deathWithDate", {
    exportEnabled: true,
    animationEnabled: true,
    title: {
      text: "Number of death with time",
      color: "#de4536",
    },
    axisY: {
      title: "Number of death",
      includeZero: false,
    },
    axisX: {
      title: "Date",
      valueFormatString: "DD MMM",
    },
    data: [
      {
        yValueFormatString: "#,Death ### ",
        xValueFormatString: "DD MMM",
        type: "spline",
        color: "#de4536",
        dataPoints: [
          { x: new Date(2020, 02, 18), y: 1 },
          { x: new Date(2020, 02, 21), y: 1 },
          { x: new Date(2020, 02, 23), y: 1 },
          { x: new Date(2020, 02, 24), y: 1 },
          { x: new Date(2020, 02, 25), y: 1 },
          { x: new Date(2020, 03, 1), y: 1 },
          { x: new Date(2020, 03, 4), y: 2 },
          { x: new Date(2020, 03, 5), y: 1 },
          { x: new Date(2020, 03, 6), y: 3 },
          { x: new Date(2020, 03, 7), y: 5 },
          { x: new Date(2020, 03, 8), y: 3 },
          { x: new Date(2020, 03, 9), y: 1 },
          { x: new Date(2020, 03, 10), y: 6 },
          { x: new Date(2020, 03, 11), y: 3 }
        ],
      },
    ],
  });

  // Infected disctrict (pie chart)

  var chart3 = new CanvasJS.Chart("infectedDistrict", {
    exportEnabled: true,
    animationEnabled: true,
    title: {
      text: "Infected People in Division",
    },
    legend: {
      cursor: "pointer",
      itemclick: explodePie,
    },
    data: [
      {
        type: "pie",
        showInLegend: true,
        toolTipContent: "{name}: <strong>{y}</strong>",
        indexLabel: "{name} - {y}",
        dataPoints: [
          { y: 351, name: "Dhaka", exploded: true },
          { y: 14, name: "Chattagram" },
          { y: 11, name: "Rangpur" },
          { y: 4, name: "Mymensingh" },
          { y: 2, name: "Sylhet" },
          { y: 1, name: "Khulna" },
        ],
      },
    ],
  });

  var chart4 = new CanvasJS.Chart("infectedArea", {
    exportEnabled: true,
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title: {
      text: "Infected people in District/City",
    },
    axisX: {
      interval: 1,
    },
    axisY: {
      title: "No. of case",
    },
    data: [
      {
        type: "bar",
        axisYType: "secondary",
        dataPoints: [
          { y: 247, label: "Dhaka City" },
          { y: 13, label: "Dhaka(District)" },
          { y: 2, label: "Gazipur" },
          { y: 3, label: "Jamalpur" },
          { y: 1, label: "Kishoreganj" },
          { y: 11, label: "Madaripur" },
          { y: 3, label: "Manikganj" },
          { y: 83, label: "Naraynganj" },
          { y: 4, label: "Narshingdi" },
          { y: 1, label: "Rajbari" },
          { y: 2, label: "Tangail" },
          { y: 1, label: "Shariotpur" },
          { y: 2, label: "Sherpur" },
          { y: 9, label: "Chattagram" },
          { y: 1, label: "Cox's bazar" },
          { y: 4, label: "Cumilla" },
          { y: 1, label: "Moulovi bazar" },
          { y: 1, label: "Sylhet" },
          { y: 2, label: "Rangpur" },
          { y: 8, label: "Gaibandha" },
          { y: 1, label: "Nilphamari" },
          { y: 1, label: "Chuadanga" },
          { y: 4, label: "Mymensingh" },
        ],
      },
    ],
  });

   var chart5 = new CanvasJS.Chart("gender", {
    exportEnabled: true,
    animationEnabled: true,
    title: {
      text: "GENDER DISTRIBUTION OF CONFIRMED PATIENTS",
    },
    legend: {
      cursor: "pointer",
      itemclick: explodePie,
    },
    data: [
      {
        type: "pie",
        showInLegend: true,
        toolTipContent: "{name}: <strong>{y}</strong>",
        indexLabel: "{name} - {y}",
        dataPoints: [
          { y: 338, name: "Male", exploded: true },
          { y: 144, name: "Female" },
        ],
      },
    ],
  });

   var chart6 = new CanvasJS.Chart("infected_Area", {
    exportEnabled: true,
    animationEnabled: true,
    theme: "light2", // "light1", "light2", "dark1", "dark2"
    title: {
      text: "Infected people in Area",
    },
    axisX: {
      interval: 1,
    },
    axisY: {
      title: "No. of case",
    },
    data: [
      {
        type: "bar",
        axisYType: "secondary",
        dataPoints: [
          { y: 2, label: "Agargaon" },
          { y: 1, label: "Adabor" },
          { y: 8, label: "Mohammadpur" },
          { y: 1, label: "Bosila" },
          { y: 13, label: "Dhanmondi" },
          { y: 1, label: "Jigatala" },
          { y: 1, label: "Central Road" },
          { y: 3, label: "Green Road" },
          { y: 2, label: "Shahbag" },
          { y: 2, label: "Hatir pool" },
          { y: 1, label: "Buet Area" },
          { y: 4, label: "Azimpur" },
          { y: 3, label: "Hazari Bag" },
          { y: 3, label: "Urdu Road" },
          { y: 3, label: "Chawk Bazar" },
          { y: 8, label: "Lalbag" },
          { y: 3, label: "Babu Bazar" },
          { y: 2, label: "Islampur" },
          { y: 2, label: "Laxmibazar" },
          { y: 1, label: "Narinda" },
          { y: 1, label: "Doyaganj" },
          { y: 3, label: "Shodor Ghat" },
          { y: 10, label: "Wari" },
          { y: 1, label: "Dholaikhal" },
          { y: 1, label: "Kotowali" },
          { y: 4, label: "Bongshal" },
          { y: 6, label: "Jatrabari" },
          { y: 1, label: "Sonir akhra" },
          { y: 1, label: "Mugda" },
          { y: 2, label: "Purana Paltan" },
          { y: 1, label: "Rajarbagh" },
          { y: 1, label: "Eskaton" },
          { y: 3, label: "Baily Road" },
          { y: 2, label: "Mogbazar" },
          { y: 2, label: "Shantinagar" },
          { y: 11, label: "Basabo" },
          { y: 1, label: "Rampura" },
          { y: 1, label: "Hatir jhil" },
          { y: 1, label: "Shahjahanpur" },
          { y: 2, label: "Badda" },
          { y: 3, label: "Bashundhora" },
          { y: 1, label: "Nikunja" },
          { y: 1, label: "Manikdi" },
          { y: 1, label: "shkona" },
          { y: 16, label: "Uttara" },
          { y: 1, label: "Beribadh" },
          { y: 6, label: "Gulshan" },
          { y: 1, label: "Banani" },
          { y: 2, label: "Mohakhali" },
          { y: 1, label: "Begunbari" },
          { y: 2, label: "Tejgaon" },
          { y: 1, label: "Kazi para" },
          { y: 3, label: "Mirpur-10" },
          { y: 6, label: "Mirpur-11" },
          { y: 2, label: "Mirpur-12" },
          { y: 1, label: "Mirpur-13" },
          { y: 11, label: "Mirpur-1" },
          { y: 2, label: "Shah Ali Bag" },
          { y: 2, label: "Pirerbag" },
          { y: 8, label: "Tolarbag" },
          { y: 6, label: "Uttar Tolarbag" },

        ],
      },
    ],
  });

  // var chart4 = new CanvasJS.Chart("infectedArea", {
  //   exportEnabled: true,
  //   animationEnabled: true,
  //   title: {
  //     text: "Infected people in District/City",
  //   },
  //   axisY: {
  //     title: "No. of cases",
  //   },
  //   legend: {
  //     cursor: "pointer",
  //     itemclick: toggleDataSeries,
  //   },
  //   toolTip: {
  //     shared: true,
  //     content: toolTipFormatter,
  //   },
  //   data: [
  //     {
  //       type: "bar",
  //       showInLegend: true,
  //       name: "Gold",
  //       color: "gold",
  //       dataPoints: [
  //         { y: 243, label: "Italy" },
  //         { y: 236, label: "China" },
  //         { y: 243, label: "France" },
  //         { y: 273, label: "Great Britain" },
  //         { y: 269, label: "Germany" },
  //         { y: 196, label: "Russia" },
  //         { y: 1118, label: "USA" },
  //       ],
  //     },
  //     {
  //       type: "bar",
  //       showInLegend: true,
  //       name: "Silver",
  //       color: "silver",
  //       dataPoints: [
  //         { y: 212, label: "Italy" },
  //         { y: 186, label: "China" },
  //         { y: 272, label: "France" },
  //         { y: 299, label: "Great Britain" },
  //         { y: 270, label: "Germany" },
  //         { y: 165, label: "Russia" },
  //         { y: 896, label: "USA" },
  //       ],
  //     },
  //     {
  //       type: "bar",
  //       showInLegend: true,
  //       name: "Bronze",
  //       color: "#A57164",
  //       dataPoints: [
  //         { y: 236, label: "Italy" },
  //         { y: 172, label: "China" },
  //         { y: 309, label: "France" },
  //         { y: 302, label: "Great Britain" },
  //         { y: 285, label: "Germany" },
  //         { y: 188, label: "Russia" },
  //         { y: 788, label: "USA" },
  //       ],
  //     },
  //   ],
  // });

  chart.render();
  chart2.render();
  chart3.render();
  chart4.render();
  chart5.render();
  chart6.render();
};

function explodePie(e) {
  if (
    typeof e.dataSeries.dataPoints[e.dataPointIndex].exploded === "undefined" ||
    !e.dataSeries.dataPoints[e.dataPointIndex].exploded
  ) {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = true;
  } else {
    e.dataSeries.dataPoints[e.dataPointIndex].exploded = false;
  }
  e.chart4.render();
}

// function toolTipFormatter(e) {
//   var str = "";
//   var total = 0;
//   var str3;
//   var str2;
//   for (var i = 0; i < e.entries.length; i++) {
//     var str1 =
//       '<span style= "color:' +
//       e.entries[i].dataSeries.color +
//       '">' +
//       e.entries[i].dataSeries.name +
//       "</span>: <strong>" +
//       e.entries[i].dataPoint.y +
//       "</strong> <br/>";
//     total = e.entries[i].dataPoint.y + total;
//     str = str.concat(str1);
//   }
//   str2 = "<strong>" + e.entries[0].dataPoint.label + "</strong> <br/>";
//   str3 =
//     '<span style = "color:Tomato">Total: </span><strong>' +
//     total +
//     "</strong><br/>";
//   return str2.concat(str).concat(str3);
// }

// function toggleDataSeries(e) {
//   if (typeof e.dataSeries.visible === "undefined" || e.dataSeries.visible) {
//     e.dataSeries.visible = false;
//   } else {
//     e.dataSeries.visible = true;
//   }
//   chart4.render();
// }
