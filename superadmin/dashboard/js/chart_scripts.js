

// Generate month labels from January to the current month
const currentMonthIndex = new Date().getMonth(); // Current month (0-based index)
const monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
const months = monthNames.slice(0, currentMonthIndex + 1); // Slice array up to the current month


// Total Patients Chart (Doughnut)
const patientsCtx = document.getElementById('patientsChart').getContext('2d');
const totalPatients = [120, 80, 50, 150].reduce((acc, val) => acc + val, 0); // Summing up data

document.getElementById('total_patients').textContent = totalPatients;
var inpatients = 120;
var emergency_patients = 80;
var outpatients =50;
var walkin_patients =150;
new Chart(patientsCtx, {
  type: 'doughnut',
  data: {
    labels: ['Inpatients:'+inpatients, 'Emergency patients:'+emergency_patients, 'Outpatients:'+outpatients, 'Walkin Patients:'+walkin_patients], // Only the categories
    datasets: [{
      label: 'Total Patients',
      data: [120, 80, 50, 150],
      backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', 'green'],
    }]
  },
  options: {
    responsive: true,
    plugins: {
      legend: {
        labels: {
          color: '#fff' // Legend text color to white
        }
      },
      tooltip: {
        bodyColor: '#fff', // Tooltip text color to white
        titleColor: '#fff' // Tooltip title color to white
      }
    }
  },
  plugins: [
    {
      id: 'customText',
      beforeDraw: (chart) => {
        const { width, height } = chart;
        const ctx = chart.ctx;

        ctx.save();
        ctx.font = '16px Arial'; // Set the font style and size
        ctx.fillStyle = '#fff'; // Set the text color
        ctx.textAlign = 'center'; // Horizontally center the text
        ctx.textBaseline = 'middle'; // Vertically center the text
        ctx.restore();
      }
    }
  ]
});

// Total Staffs Chart (Bar)
const staffsCtx = document.getElementById('staffsChart').getContext('2d');

// Assigning total staff count to an element (update total staff count here)
var totalStaff = 30 + 45 + 15 + 10 + 5 + 8 + 4 + 12 + 18 + 14 + 9 + 20 + 25 + 7; // Example total staff count
document.getElementById('total_staff').textContent = totalStaff; // Make sure this element exists in your HTML

// Staff counts for each role (update if needed)
var staffData = {
  'Doctors': 30,
  'Nurses': 45,
  'Surgeons': 15,
  'Surgical Suite Manager': 10,
  'Health and Info Manager': 5,
  'Staff Manager': 8,
  'Morgue Worker': 4,
  'Emergency Worker': 12,
  'Lab Scientist': 18,
  'Radiology Scientist': 14,
  'Maternity Manager': 9,
  'Pharmacists': 20,
  'Accountants': 25,
  'Anesthesiologists': 7
};

new Chart(staffsCtx, {
  type: 'bar',
  data: {
    labels: Object.keys(staffData),  // Using keys as labels
    datasets: [{
      label: 'Staff Count',
      data: Object.values(staffData), // Using values as data
      backgroundColor: [
        '#4CAF50', '#FFC107', '#F44336', '#2196F3', '#9C27B0', '#FF5722',
        '#03A9F4', '#8BC34A', '#CDDC39', '#FF9800', '#673AB7', '#009688', 
        '#795548', '#607D8B'
      ],
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          color: '#fff' // Legend text color to white
        }
      },
      tooltip: {
        bodyColor: '#fff', // Tooltip body text color to white
        titleColor: '#fff' // Tooltip title color to white
      }
    },
    scales: {
      x: {
        ticks: {
          color: '#fff' // x-axis ticks color to white
        },
        grid: {
          color: '#fff' // x-axis grid lines color to white
        }
      },
      y: {
        ticks: {
          color: '#fff' // y-axis ticks color to white
        },
        grid: {
          color: '#fff' // y-axis grid lines color to white
        }
      }
    }
  }
});

//#region  account


// Example income data for each month
const incomeData = [5000, 8000, 6000, 7000, 12000, 15000, 18000, 20000, 22000, 25000, 28000, 30000]; 
const currentIncomeData = incomeData.slice(0, currentMonthIndex + 1); // Data up to the current month

// Total Income Chart (Line)
const incomeCtx = document.getElementById('incomeChart').getContext('2d');

new Chart(incomeCtx, {
  type: 'line',
  data: {
    labels: months, // Months from January to the current month
    datasets: [{
      label: 'Monthly Income ($)', // Chart label
      data: currentIncomeData, // Data corresponding to the months
      borderColor: '#3e95cd', // Line color
      fill: false // No fill under the line
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        labels: {
          color: '#fff' // Legend text color to white
        }
      },
      tooltip: {
        bodyColor: '#fff', // Tooltip body text color to white
        titleColor: '#fff' // Tooltip title color to white
      }
    },
    scales: {
      x: {
        ticks: {
          color: '#fff' // x-axis ticks color to white
        },
        grid: {
          color: '#fff' // x-axis grid lines color to white
        }
      },
      y: {
        ticks: {
          color: '#fff' // y-axis ticks color to white
        },
        grid: {
          color: '#fff' // y-axis grid lines color to white
        }
      }
    }
  }
});
//#endregion


//#region  pharmacy
    // Pharmacy Sales Chart (Pie)
    const pharmacyCtx = document.getElementById('pharmacyChart').getContext('2d');
    new Chart(pharmacyCtx, {
    type: 'pie',
    data: {
        labels: ['Medicine', 'Supplies', 'Equipment'],
        datasets: [{
        label: 'Sales',
        data: [200, 150, 50],
        backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'],
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            labels: {
            color: '#fff' // Legend text color to white
            }
        },
        tooltip: {
            bodyColor: '#fff', // Tooltip body text color to white
            titleColor: '#fff' // Tooltip title color to white
        }
        }
    }
    });

//#endregion

    
//#region  surgery
    // Surgery Rates Chart (Pie)
    const surgeryRateCtx = document.getElementById('surgery_rate').getContext('2d');

    new Chart(surgeryRateCtx, {
    type: 'pie',
    data: {
        labels: ['Successful Surgeries', 'Unsuccessful Surgeries', 'Mortality Rate'], // Updated labels
        datasets: [{
        label: 'Surgery Outcomes',
        data: [70, 20, 10], // Example data: Successful (70%), Unsuccessful (20%), Mortality (10%)
        backgroundColor: ['#4CAF50', '#FF5722', '#F44336'], // Colors for each segment
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            labels: {
            color: '#fff' // Legend text color to white
            }
        },
        tooltip: {
            bodyColor: '#fff', // Tooltip body text color to white
            titleColor: '#fff' // Tooltip title color to white
        }
        }
    }
    });
//#endregion

//#region radilogogy
    // Example data for radiology appointments
    const radiologyAppointmentData = [15, 25, 20, 30, 40, 35, 50, 60, 45, 50, 65, 70]; // Data for all months
    const dataForCurrentMonths = radiologyAppointmentData.slice(0, currentMonthIndex + 1); // Data up to the current month

    // Radiology Appointments Chart (Line)
    const radiologyCtx = document.getElementById('radiology_appointments').getContext('2d');

    new Chart(radiologyCtx, {
    type: 'line', // Line chart type
    data: {
        labels: months, // Months from January to the current month
        datasets: [{
        label: 'Radiology Appointments', // Chart label
        data: dataForCurrentMonths, // Data corresponding to the months
        borderColor: '#FF6384', // Line color
        fill: true, // Fill under the line
        backgroundColor: 'rgba(255, 99, 132, 0.2)' // Semi-transparent background fill
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            labels: {
            color: '#fff' // Legend text color to white
            }
        },
        tooltip: {
            bodyColor: '#fff', // Tooltip body text color to white
            titleColor: '#fff' // Tooltip title color to white
        }
        },
        scales: {
        x: {
            ticks: {
            color: '#fff' // x-axis ticks color to white
            },
            grid: {
            color: '#fff' // x-axis grid lines color to white
            }
        },
        y: {
            ticks: {
            color: '#fff' // y-axis ticks color to white
            },
            grid: {
            color: '#fff' // y-axis grid lines color to white
            }
        }
        }
    }
    });

//#endregion


//#region  lab
    // Laboratory Appointments Chart (Line)
    const labAppointmentsCtx = document.getElementById('labouratory_appointments').getContext('2d');

    // Example data for appointments (adjust as needed)
    const labAppointmentData = [10, 15, 20, 25, 30, 35, 40, 45, 50, 55, 60, 65]; // Data for all months
    // const dataForCurrentMonths = labAppointmentData.slice(0, currentMonthIndex + 1); // Data up to the current month

    new Chart(labAppointmentsCtx, {
    type: 'line', // Line chart type
    data: {
        labels: months, // Months from January to the current month
        datasets: [{
        label: 'Laboratory Appointments', // Chart label
        data: dataForCurrentMonths, // Data corresponding to the months
        borderColor: '#FF6384', // Line color
        fill: true, // Fill under the line
        backgroundColor: 'rgba(255, 99, 132, 0.2)' // Semi-transparent background fill
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
        legend: {
            labels: {
            color: '#fff' // Legend text color to white
            }
        },
        tooltip: {
            bodyColor: '#fff', // Tooltip body text color to white
            titleColor: '#fff' // Tooltip title color to white
        }
        },
        scales: {
        x: {
            ticks: {
            color: '#fff' // x-axis ticks color to white
            },
            grid: {
            color: '#fff' // x-axis grid lines color to white
            }
        },
        y: {
            ticks: {
            color: '#fff' // y-axis ticks color to white
            },
            grid: {
            color: '#fff' // y-axis grid lines color to white
            }
        }
        }
    }
    });
//#endregion
