
//Grafico de Barra
let grafico = document.getElementById('horizontalBar').getContext('2d');
    let chart = new Chart(grafico, {
        type: 'horizontalBar',
        data: {
            labels: ['Jan', 'Fev', 'Mar', 'Abr'],
            datasets: [{
                label: 'Boletins Ativos',
                data: [ 25, 10, 25, 14 ],
                // borderColor:'#' ,
                borderWidth: 0,
                backgroundColor: ['rgb(255, 0, 0)', 'rgba(0,0,55)', 'rgba(0,0,55)', 'rgba(0,0,55)'],
                lineColor: 'transparent',
                tickLength: 0,
                gridLines: {
                display: false
                }
            }],
            
        },
        options : {
            legend: {
                display: false
            },
            scales : {
                xAxes : [ {
                    gridLines : {
                        display : false,
                        offsetGridLines: false
                    }
                }],
                yAxes : [ {
                    gridLines : {
                        display : false
                    }
                }],
            }
        }
    });
    //Gráfico de pizza
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
        labels: ["Africa", "Asia", "Europe", "Latin America", "North America"],
        datasets: [
            {
                label: "Population (millions)",
                backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850"],
                data: [2478,5267,734,784,433],
                borderWidth: 0,
            }
        ]
        },
        options: {
            legend: {
                display: false
            },
            
        }
    });
