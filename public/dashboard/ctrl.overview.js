(function(){
	
	'use strict';
	angular.module('app')
		.controller('ctrl.overview', function($scope, $rootScope, Overview){

			var vm 			=	$scope;
			Overview.get({
				dateFilter 		: 	moment().format('MMMM D, YYYY')
			}).$promise.then(function(data){

				vm.reportList 		=	data.reportList;
				vm.monthList 		=	data.reportMonth;
				changeChartData(data.reportList);

			});

			vm.dateNow 				=	moment().format('MMMM D, YYYY h:m a');

			var changeChartData 	=	function(reportList){

				vm.dataChart 		=	[
		            {
		                name: 'Unit Purchases',
		                data: [],
		                color: '#b3e5fc'
		            },
		            {
		                name: 'Collection',
		                data: [],
		                color: '#fff59d'
		            },
		            {
		                name: 'Manage Unit',
		                data: [],
		                color: '#aed581'
		            },
					{
		                name: 'Service Purchases',
		                data: [],
		                color: '#4dd0e1'
		            }
		            ];

				angular.forEach(reportList, function(report){

					vm.dataChart[0].data.push(report.deciTotalUnitPurchase);
					vm.dataChart[1].data.push(report.deciTotalCollection);
					vm.dataChart[2].data.push(report.deciTotalManageUnit);
					vm.dataChart[3].data.push(report.deciTotalServicePurchase);

				});
				updateChart();

			}//end function

			var updateChart 		=	function(){

				$('#salesReport').highcharts({
		            credits: {
		                enabled: false
		            },
		            exporting: { enabled: false },
		            chart: {
		                polar: true,
		            },
		            chart: {
		                backgroundColor: '#0097a7',
		                type: 'column'
		            },
		            title: {
		                text: ''
		            },
		            xAxis: {
		                labels: {
		                    style: {
		                        color: 'white',
		                        font: 'roboto3'
		                    }
		                },
		                categories: vm.monthList
		            },
		            yAxis: {
		                labels: {
		                    style: {
		                        color: 'white',
		                        font: 'roboto3'
		                    }
		                },
		                min: 0,
		                title: {
		                    text: 'Total Sales',
		                    style: {
		                        color: 'white',
		                        font: 'roboto3'
		                    }
		                },
		                stackLabels: {
		                    enabled: false,
		                    style: {
		                        fontWeight: 'bold',
		                        color: (Highcharts.theme && Highcharts.theme.textColor) || 'gray'
		                    }
		                }
		            },
		            legend: {
		                align: 'right',
		                x: -10,
		                verticalAlign: 'top',
		                y: -10,
		                floating: true,
		                backgroundColor: (Highcharts.theme && Highcharts.theme.background2) || 'white',
		                borderColor: '#CCC',
		                borderWidth: 1,
		                shadow: false
		            },
		            tooltip: {
		                headerFormat: '<b>{point.x}</b><br/>',
		                pointFormat: '{series.name}: P {point.y:,.2f}<br/>Total: P {point.stackTotal:,.2f}',
		                useHTML: true
		            },
		            plotOptions: {
		                column: {
		                    stacking: 'normal',
		                    dataLabels: {
		                        enabled: false,
		                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white',
		                        style: {
		                            textShadow: '0'
		                        }
		                    }
		                }
		            },
		            series: vm.dataChart
		        });

			}//end function

		});

})();