 Chart.defaults.global.legend = {
     enabled: false
 };
 // Doughnut chart
 var allTotal = parseFloat($('.allTotal').text());
 var labelallTotal = $('.labelallTotal').text();
 var labelallPay = $('.labelallPay').text();
 var labelallWait = $('.labelallWait').text();
 var labelallNo = $('.labelallNo').text();
 var allPay = parseFloat($('.allPay').text());
 var allWait = parseFloat($('.allWait').text());
 var allNo = parseFloat($('.allNo').text());

 var ctx = document.getElementById("canvasDoughnut");
 var data = {
     labels: [
     labelallTotal,
     labelallPay,
     labelallWait,
     labelallNo
     ],
     datasets: [{
         data: [allTotal, allPay, allWait, allNo],
         backgroundColor: [
         "#6A0888",
         "#01DF01",
         "#FFFF00",
         "#DF0101"
         ],
         hoverBackgroundColor: [
         "#34495E",
         "#B370CF",
         "#CFD4D8",
         "#36CAAB"
         ]
         
     }]
 };
 
 var canvasDoughnut = new Chart(ctx, {
     type: 'doughnut',
     tooltipFillColor: "rgba(51, 51, 51, 0.55)",
                                data: data
 });
 
 // Line chart
 var ctx = document.getElementById("lineChart");
 var lineChart = new Chart(ctx, {
     type: 'line',
     data: {
         labels: ["January", "February", "March", "April", "May", "June", "July"],
         datasets: [{
             label: "My First dataset",
             backgroundColor: "rgba(38, 185, 154, 0.31)",
                           borderColor: "rgba(38, 185, 154, 0.7)",
                           pointBorderColor: "rgba(38, 185, 154, 0.7)",
                           pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                           pointHoverBackgroundColor: "#fff",
                           pointHoverBorderColor: "rgba(220,220,220,1)",
                           pointBorderWidth: 1,
                           data: [31, 74, 6, 39, 20, 85, 7]
         }, {
             label: "My Second dataset",
             backgroundColor: "rgba(3, 88, 106, 0.3)",
                           borderColor: "rgba(3, 88, 106, 0.70)",
                           pointBorderColor: "rgba(3, 88, 106, 0.70)",
                           pointBackgroundColor: "rgba(3, 88, 106, 0.70)",
                           pointHoverBackgroundColor: "#fff",
                           pointHoverBorderColor: "rgba(151,187,205,1)",
                           pointBorderWidth: 1,
                           data: [82, 23, 66, 9, 99, 4, 2]
         }]
     },
 });
