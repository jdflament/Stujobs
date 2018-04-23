// Global widget alert function
function alertWidget(div, message, type, duration) {
    $(div).fadeIn();
    $(div).html('<div class="alert '+ type +'" style="cursor:pointer;" onclick="closeAlert(this)">' + message + '</div>');
    setTimeout(function(){
        $(div).fadeOut();
    }, duration);
}

// Global widget alert close function
function closeAlert(div) {
    $(div).fadeOut();
}

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

$(document).ready(function(event) {
    $.ajax({
        type: 'GET',
        url: '/dashboard/offers/contracttype',
        success: function(response) {
            var values = [];
            var labels = [];
            var mapping = {
                "nc": 'Non précisé',
                'sj': 'Job Étudiant',
                'ctt': 'Intérim',
                'stage': 'Stage',
                'ca': 'Contrat d\'apprentissage',
                'cp': "Contrat de professionnalisation",
                'cdd': 'CDD',
                'cdi': "CDI"
            };

            $.each(response, function(index, value) {
                values.push(value);
                labels.push(mapping[index]);
            });

            // Store datas
            var data = {
                datasets: [{
                    data: values,
                    backgroundColor: ["#5580e5", "#ffb64d", "#26dad2", "#fc6180", "#74b9ff", "#e17055", "#e84393", "#a29bfe"],
                }],

                labels: labels
            };

            // Store options
            var options = {
                scales: {
                    xAxes: [{
                        display: false,
                    }],
                    yAxes: [{
                        display: false,
                    }]
                }
            };

            var ctx = document.getElementById("pieContractType");
            var pieContractType = new Chart(ctx,{
                type: 'pie',
                data: data,
                options: options
            });
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue</strong> pendant l'upload des données de type de contrat.", "alert-danger", 4000);
        }
    });
});

$(document).ready(function(event) {
    $.ajax({
        type: 'GET',
        url: '/dashboard/offers/informations',
        success: function(response) {
            var values = [];
            var labels = [];
            var mapping = {
                'total': 'Total',
                'complete': 'Clôturée',
                'incomplete': 'En cours',
                'valid': 'Validée',
                'invalid': 'Invalidée'
            };

            $.each(response, function(index, value) {
                values.push(value);
                labels.push(mapping[index]);
            });

            // Store datas
            var data = {
                datasets: [{
                    data: values,
                    backgroundColor: ["#5580e5", "#ffb64d", "#26dad2", "#fc6180", "#74b9ff", "#e17055", "#e84393", "#a29bfe"],
                }],

                labels: labels
            };

            // Store options
            var options = {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            };

            var ctx = document.getElementById("pieOffersInfos");
            var pieOffersInfos = new Chart(ctx,{
                type: 'bar',
                data: data,
                options: options
            });
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue</strong> pendant l'upload des données des offres.", "alert-danger", 4000);
        }
    });
});

$(document).ready(function(event) {
    $.ajax({
        type: 'GET',
        url: '/dashboard/offers/rates',
        success: function(response) {
            var values = [];
            var labels = [];

            $.each(response, function(index, value) {
                values.push(value);
                labels.push(index);
            });

            // Store datas
            var data = {
                datasets: [{
                    data: values,
                    backgroundColor:"rgba(85, 128, 229, 0.8)",
                    borderDash:[],
                    borderDashOffset:0,
                    borderWidth:1,
                    pointBackgroundColor:"#fff",
                    pointBorderWidth:1,
                    pointHoverRadius:5,
                    pointHoverBorderColor:"rgba(220,220,220,1)",
                    pointHoverBorderWidth:2,
                    pointRadius:3,
                    pointHitRadius:0
                }],

                labels: labels
            };

            // Store options
            var options = {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            };

            var ctx = document.getElementById("lineOffersRates");
            var lineOffersRates = new Chart(ctx,{
                type: 'line',
                data: data,
                options: options
            });
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue</strong> pendant l'upload des données des offres (nombre total).", "alert-danger", 4000);
        }
    });
});


$(document).ready(function(event) {
    $.ajax({
        type: 'GET',
        url: '/dashboard/applies/informations',
        success: function(response) {
            var values = [];
            var labels = [];
            var mapping = {
                'total': 'Total',
                'pending': 'En attente',
                'valid': 'Validée',
                'refuse': 'Refusée'
            };

            $.each(response, function(index, value) {
                values.push(value);
                labels.push(mapping[index]);
            });

            // Store datas
            var data = {
                datasets: [{
                    data: values,
                    backgroundColor: ["#5580e5", "#ffb64d", "#26dad2", "#fc6180", "#74b9ff", "#e17055", "#e84393", "#a29bfe"],
                }],

                labels: labels
            };

            // Store options
            var options = {
                legend: {
                    display: false,
                },
                scales: {
                    xAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            };

            var ctx = document.getElementById("horizontalBarAppliesInfos");
            var horizontalBarAppliesInfos = new Chart(ctx,{
                type: 'horizontalBar',
                data: data,
                options: options
            });
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue</strong> pendant l'upload des données des candidatures.", "alert-danger", 4000);
        }
    });
});

$(document).ready(function(event) {
    $.ajax({
        type: 'GET',
        url: '/dashboard/applies/rates',
        success: function(response) {
            var values = [];
            var labels = [];

            $.each(response, function(index, value) {
                values.push(value);
                labels.push(index);
            });

            // Store datas
            var data = {
                datasets: [{
                    data: values,
                    backgroundColor:"rgba(85, 128, 229, 0.8)",
                    borderDash:[],
                    borderDashOffset:0,
                    borderWidth:1,
                    pointBackgroundColor:"#fff",
                    pointBorderWidth:1,
                    pointHoverRadius:5,
                    pointHoverBorderColor:"rgba(220,220,220,1)",
                    pointHoverBorderWidth:2,
                    pointRadius:3,
                    pointHitRadius:0
                }],

                labels: labels
            };

            // Store options
            var options = {
                legend: {
                    display: false,
                },
                scales: {
                    yAxes: [{
                        stacked: true,
                        ticks: {
                            stepSize: 1
                        }
                    }]
                }
            };

            var ctx = document.getElementById("lineAppliesRates");
            var lineAppliesRates = new Chart(ctx,{
                type: 'line',
                data: data,
                options: options
            });
        },
        error: function (response) {
            console.error(response);
            alertWidget("#alerts" ,"<strong>Une erreur est survenue</strong> pendant l'upload des données des candidatures (nombre total).", "alert-danger", 4000);
        }
    });
});