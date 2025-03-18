document.addEventListener('DOMContentLoaded', function () {
    // Supondo que 'expensesByCategory' está disponível globalmente (definido no Blade)

    const categories = Object.keys(expensesByCategory); // Extrai os nomes das categorias como labels
    const categories2 = Object.keys(incomesByCategory); // Extrai os nomes das categorias como labels
    // Converter os valores de string para números usando parseFloat()
    const expenseTotals = Object.values(expensesByCategory).map(value => parseFloat(value));
    const incomeTotals = Object.values(incomesByCategory).map(value => parseFloat(value));

    //console.log("Valor de expensesByCategory:", expensesByCategory);
    //console.log("Valor de categories:", categories);
    //console.log("Valor de expenseTotals (convertido para números):", expenseTotals);

    var options = {
        chart: {
            type: 'pie',
            height: 300,
            width: '100%',
        },
        series: expenseTotals, // Usa os totais de despesas como dados (agora números)
        labels: categories,    // Usa os nomes das categorias como labels

        title: {
            text: 'Despesas por Categoria',
            align: 'left'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    offset: -10
                }
            }
        }
    };

    var options2 = {
        chart: {
            type: 'pie',
            height: 300,
            width: '100%',
        },
        series: incomeTotals, // Usa os totais de despesas como dados (agora números)
        labels: categories2,    // Usa os nomes das categorias como labels

        title: {
            text: 'Receitas por Categoria',
            align: 'left'
        },
        plotOptions: {
            pie: {
                dataLabels: {
                    offset: -10
                }
            }
        }
    };

    var chart_apex = new ApexCharts(document.querySelector("#chart_apex"), options);
    chart_apex.render();

    var chart_apex_2 = new ApexCharts(document.querySelector("#chart_apex_2"), options2);
    chart_apex_2.render();
}); 