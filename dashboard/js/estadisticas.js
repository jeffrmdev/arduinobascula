const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
const users = document.getElementById('usersArea');
const materiales = document.getElementById('materialesPie');

$(document).ready(function () {
  let colores = [];
  let datos = [];
  let year = $('#year').val();
  let cantidad = [];
  let mes = [];

  $(document).on('change', '#year', () => {
    datos = [];
    mes = [];
    year = $('#year').val();
    console.log(year);
    $.ajax({
      url: './php/config_estadisticas.php',
      type: 'POST',
      data: {
        year: year,
      },
      success: (datas) => {
        let info = JSON.parse(datas);
        $.each(info, (i, item) => {
          datos.push(info[i]);
        })

        $.each(datos, (i, item) => {
          switch (datos[i].mes) {
            case '1':
              mes.push("Enero");
              cantidad.push(datos[i].cantidad)
              colores.push("#C0392B")
              break;

            case '2':
              mes.push("Febrero");
              cantidad.push(datos[i].cantidad)
              colores.push("#512E5F")
              break;
            case '3':
              mes.push("Marzo");
              cantidad.push(datos[i].cantidad)
              colores.push("#154360")
              break;

            case '4':
              mes.push("Abril");
              cantidad.push(datos[i].cantidad)
              colores.push("#0E6251")
              break;
            case '5':
              mes.push("Mayo");
              cantidad.push(datos[i].cantidad)
              colores.push("#186A3B")
              break;

            case '6':
              mes.push("Junio");
              cantidad.push(datos[i].cantidad)
              colores.push("#7D6608")
              break;
            case '7':
              mes.push("Julio");
              cantidad.push(datos[i].cantidad)
              colores.push("#E67E22")
              break;

            case '8':
              mes.push("Agosto");
              cantidad.push(datos[i].cantidad)
              colores.push("#CACFD2")
              break;
            case '9':
              mes.push("Septiembre");
              cantidad.push(datos[i].cantidad)
              colores.push("#C39BD3")
              break;

            case '10':
              mes.push("Octubre");
              cantidad.push(datos[i].cantidad)
              colores.push("#73C6B6")
              break;
            case '11':
              mes.push("Noviembre");
              cantidad.push(datos[i].cantidad)
              colores.push("#52BE80")
              break;

            case '12':
              mes.push("Diciembre");
              cantidad.push(datos[i].cantidad)
              colores.push("#D98880")
              break;
          }
          console.log("Mes: " + datos[i].mes + " Cantidad: " + datos[i].cantidad);

        })

        const data = {
          labels: mes,
          datasets: [
            {
              label: 'Usuarios',
              data: cantidad,
              backgroundColor: colores,
              borderColor: '#17202A',
              borderWidth: 2,
            }
          ]
        };

        const config = {
          type: 'bar',
          data: data,
          options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
              yAxes: [{
                ticks: {
                  stepSize: 1,
                  beginAtZero: true,
                }
              }],
            },
            legend: {
              display: false,
            },
          }
        };
        if (window.chart1) {
          window.chart1.clear();
          window.chart1.destroy();
        }

        window.chart1 = new Chart(users, config);
      }
    })
  })

  $.ajax({
    url: './php/config_estadisticas.php',
    type: 'POST',
    data: {
      year: year,
    },
    success: (datas) => {
      let info = JSON.parse(datas);
      $.each(info, (i, item) => {
        datos.push(info[i]);
      })

      $.each(datos, (i, item) => {
        switch (datos[i].mes) {
          case '1':
            mes.push("Enero");
            cantidad.push(datos[i].cantidad)
            colores.push("#C0392B")
            break;

          case '2':
            mes.push("Febrero");
            cantidad.push(datos[i].cantidad)
            colores.push("#512E5F")
            break;
          case '3':
            mes.push("Marzo");
            cantidad.push(datos[i].cantidad)
            colores.push("#154360")
            break;

          case '4':
            mes.push("Abril");
            cantidad.push(datos[i].cantidad)
            colores.push("#0E6251")
            break;
          case '5':
            mes.push("Mayo");
            cantidad.push(datos[i].cantidad)
            colores.push("#186A3B")
            break;

          case '6':
            mes.push("Junio");
            cantidad.push(datos[i].cantidad)
            colores.push("#7D6608")
            break;
          case '7':
            mes.push("Julio");
            cantidad.push(datos[i].cantidad)
            colores.push("#E67E22")
            break;

          case '8':
            mes.push("Agosto");
            cantidad.push(datos[i].cantidad)
            colores.push("#CACFD2")
            break;
          case '9':
            mes.push("Septiembre");
            cantidad.push(datos[i].cantidad)
            colores.push("#C39BD3")
            break;

          case '10':
            mes.push("Octubre");
            cantidad.push(datos[i].cantidad)
            colores.push("#73C6B6")
            break;
          case '11':
            mes.push("Noviembre");
            cantidad.push(datos[i].cantidad)
            colores.push("#52BE80")
            break;

          case '12':
            mes.push("Diciembre");
            cantidad.push(datos[i].cantidad)
            colores.push("#D98880")
            break;
        }
        console.log("Mes: " + datos[i].mes + " Cantidad: " + datos[i].cantidad);

      })
      const data = {
        labels: mes,
        datasets: [
          {
            label: 'Usuarios',
            data: cantidad,
            backgroundColor: colores,
            borderColor: '#17202A',
            borderWidth: 2,
          }
        ]
      };

      const config = {
        type: 'bar',
        data: data,
        options: {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            yAxes: [{
              ticks: {
                stepSize: 1,
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false,
          },
        }
      };
      if (window.chart1) {
        window.chart1.clear();
        window.chart1.destroy();
      }

      window.chart1 = new Chart(users, config);
    }
  })
})