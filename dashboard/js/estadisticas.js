const meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
const users = document.getElementById('usersArea');
const materiales = document.getElementById('materialesPie');

$(document).ready(function(){
  let datos = [];
  let year = $('#year').val();
  let cantidad;
  let mes;

  $(document).on('change','#year',() => {
    datos = []
    year = $('#year').val();
    console.log(year);
    $.ajax({
      url:'./php/config_estadisticas.php',
      type:'POST',
      data:{
        year:year,
      },
      success: (data) => {
        let info = JSON.parse(data);
        $.each(info, (i, item) =>{
          datos.push(info[i]);
        })

        $.each(datos, (i, item) =>{
          console.log("Mes: "+datos[i].mes + " Cantidad: "+ datos[i].cantidad);
        })
      }
    })
  })

  $.ajax({
    url:'./php/config_estadisticas.php',
    type:'POST',
    data:{
      year:year,
    },
    success: (data) => {
      let info = JSON.parse(data);
      $.each(info, (i, item) =>{
        datos.push(info[i]);
      })  

      $.each(datos, (i, item) =>{
        console.log("Mes: "+datos[i].mes + " Cantidad: "+ datos[i].cantidad);
      })  
    }
  })


const data = {
  labels: meses,
  datasets: [
    {
      label: 'Usuarios',
      data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
    }
  ]
};

const config = {
  type: 'line',
  data: data,
  options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            ticks: {
                beginAtZero:true
            }
        }]
    }
  }
};

new Chart(users, config);
})