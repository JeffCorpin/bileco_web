const ctx = document.getElementById('myChart').getContext('2d');

fetch("script.php")
  .then(response => response.json())
  .then(data => {
    console.log("Fetched data:", data); // Debugging: Check if data is coming correctly
    createChart(data, 'line');
  })
  .catch(error => console.error("Error fetching data:", error));

function createChart(chartData, type) {
  
  new Chart(ctx, {
    type: type,
    data: {
      labels: chartData.map(row => row.date), // X-axis: Dates
      datasets: [{
        label: 'Electricity Bill (₱)',
        data: chartData.map(row => row.bill), // Y-axis: Bills
        borderWidth: 2,
        backgroundColor: 'rgb(26, 26, 106)',
        borderColor: 'rgb(26, 26, 106)',
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            callback: function(value) {
              return '₱' + value; // Display currency symbol
            }
          }
        }
      }
    }
  });
}
