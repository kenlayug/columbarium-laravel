(function(){
	'use strict';
	angular.module('app')
		.controller('ctrl.unitStatus', function($scope, $rootScope, $filter, Unitv2){

			var vm 		=	$scope;
			var rs 		=	$rootScope;

			Unitv2.get({
				method 		: 	'status'
			}).$promise.then(function(data){

				vm.unitStatusList 		=	data.unitStatusList;

				Highcharts.setOptions({
				        colors: ['#f44336', '#ffe082', '#aed581', '#4db6ac', '#00695c']
				    });
				$('#unitPie').highcharts({
		            credits: {
		                enabled: false
		            },
		            exporting: { enabled: false },
		            chart: {
		                plotBackgroundColor: null,
		                plotBorderWidth: null,
		                plotShadow: false,
		                type: 'pie'
		            },
		            title: {
		                text: ''
		            },
		            tooltip: {
		                formatter: function() {
		                    return '<b>'+ this.point.name +'</b>: '+ this.point.y ;
		                }
		            },
		            legend: {
		                align: 'right',
		                layout: 'vertical',
		                verticalAlign: 'top',
		                x: -30,
		                y: 15
		            },
		            plotOptions: {
		                pie: {
		                    allowPointSelect: true,
		                    cursor: 'pointer',
		                    dataLabels: {
		                        enabled: false
		                    },
		                    showInLegend: true
		                }
		            },
		            series: [{
		                name: 'Units',
		                colorByPoint: true,
		                data: [{
		                    name: 'Available',
		                    y: vm.unitStatusList.available,
		                    color: 'green'
		                }, {
		                    name: 'Reserved',
		                    y: vm.unitStatusList.reserved,
		                    color: 'skyblue',
		                    sliced: true,
		                    selected: true
		                }, {
		                    name: 'At Need',
		                    y: vm.unitStatusList.atNeed,
		                    color: 'yellow'
		                }, {
		                    name: 'Owned',
		                    y: vm.unitStatusList.owned,
		                    color: 'red'
		                }, {
		                    name: 'Under Maintenance',
		                    y: vm.unitStatusList.underMaintenance,
		                    color: 'orange'
		                }, {
		                	name: 'Partially Owned',
		                	y: vm.unitStatusList.partiallyOwned,
		                	color: 'pink'
		                }]
		            }]
		        });

			});

		});

})();