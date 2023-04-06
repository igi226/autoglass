$(function() {
	'use strict'

	$('#reservation').daterangepicker()
	$(document).ready(function() {
		$('.select2-no-search').select2({
			minimumResultsForSearch: Infinity,
			placeholder: 'Choose one'
		});
	});

	/** CHARTS **/
	var ctx1 = document.getElementById('Barchart1').getContext('2d');
	new Chart(ctx1, {
		type: 'bar',
		data: {
			labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
			datasets: [{
				data: [ 12, 25, 18, 22, 25, 20],
				backgroundColor: '#5646ff'
			}, {
				data: [25, 30, 20, 25, 22, 30],
				backgroundColor: '#edecfb'
			}]
		},
		options: {
			maintainAspectRatio: false,
			responsive: true,
			legend: {
				display: false,
				labels: {
					display: false
				}
			},
			scales: {
				yAxes: [{
					display: false,
					ticks: {
						beginAtZero: false,
						fontSize: 10,
						max: 60,
						padding: 0
					}
				}],
				xAxes: [{
					gridLines: {
						display: false,
						borderDash: [10, 4],
						color: '#edecfb',
						drawBorder: false
					},
					barPercentage: 0.6,
					ticks: {
						beginAtZero: true,
						fontSize: 11,
						fontFamily: 'Arial'
					}
				}]
			}
		}
	});
	// Datepicker found in left sidebar of the page
	var highlightedDays = ['2018-5-10', '2018-5-11', '2018-5-12', '2018-5-13', '2018-5-14', '2018-5-15', '2018-5-16'];
	var date = new Date();
	$('.fc-datepicker').datepicker({
		showOtherMonths: true,
		selectOtherMonths: true,
		dateFormat: 'yy-mm-dd',
		beforeShowDay: function(date) {
			var m = date.getMonth(),
				d = date.getDate(),
				y = date.getFullYear();
			for (var i = 0; i < highlightedDays.length; i++) {
				if ($.inArray(y + '-' + (m + 1) + '-' + d, highlightedDays) != -1) {
					return [true, 'ui-date-highlighted', ''];
				}
			}
			return [true];
		}
	});

	var plot1 = $.plot('#flotChart', [{
		data: flotSampleData5,
		color: '#5646ff'
	}], {
		series: {
			shadowSize:5,
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0.4
					}]
				}
			}
		},
		grid: {
			borderWidth: 0,
			borderColor: '#969dab',
			labelMargin: 5,
			markings: [{
				xaxis: {
					from: 10,
					to: 10
				},
				color: '#f6f5f9'
			}]
		},
		yaxis: {
			show: false,
			color: '#ced4da',
			tickLength: 10,
			min: 0,
			max: 110,
			font: {
				size: 11,
				color: '#969dab'
			},
			tickFormatter: function formatter(val, axis) {
				return val + 'k';
			}
		},
		xaxis: {
			show: false,
			position: 'bottom',
			color: 'rgba(0,0,0,0.1)'
		}
	});
	var mqSM = window.matchMedia('(min-width: 576px)');
	var mqSMMD = window.matchMedia('(min-width: 576px) and (max-width: 991px)');
	var mqLG = window.matchMedia('(min-width: 992px)');

	function screenCheck() {
		if (mqSM.matches) {
			plot1.getAxes().yaxis.options.show = true;
			plot1.getAxes().xaxis.options.show = true;
		} else {
			plot1.getAxes().yaxis.options.show = false;
			plot1.getAxes().xaxis.options.show = false;
		}
		if (mqSMMD.matches) {
			var tick = [
				[0, '<span>Nov<\/span><span>10<\/span>'],
				[15, '<span>Nov<\/span><span>12<\/span>'],
				[35, '<span>Nov<\/span><span>14<\/span>'],
				[45, '<span>Nov<\/span><span>16<\/span>'],
				[65, '<span>Nov<\/span><span>18<\/span>'],
				[95, '<span>Nov<\/span><span>19<\/span>'],
				[105, '<span>Nov<\/span><span>20<\/span>'],
				[125, '<span>Nov<\/span><span>23<\/span>']
			];
			plot1.getAxes().xaxis.options.ticks = tick;
		}
		if (mqLG.matches) {
			var tick = [
				[10, '<span>Nov<\/span><span>10<\/span>'],
				[20, '<span>Nov<\/span><span>11<\/span>'],
				[30, '<span>Nov<\/span><span>12<\/span>'],
				[40, '<span>Nov<\/span><span>13<\/span>'],
				[50, '<span>Nov<\/span><span>14<\/span>'],
				[60, '<span>Nov<\/span><span>15<\/span>'],
				[70, '<span>Nov<\/span><span>16<\/span>'],
				[80, '<span>Nov<\/span><span>17<\/span>'],
				[90, '<span>Nov<\/span><span>18<\/span>'],
				[100, '<span>Nov<\/span><span>19<\/span>'],
				[110, '<span>Nov<\/span><span>20<\/span>'],
				[120, '<span>Nov<\/span><span>21<\/span>'],
				[130, '<span>Nov<\/span><span>22<\/span>'],
				[140, '<span>Nov<\/span><span>23<\/span>']
			];
			plot1.getAxes().xaxis.options.ticks = tick;
		}
	}
	screenCheck();
	mqSM.addListener(screenCheck);
	mqSMMD.addListener(screenCheck);
	mqLG.addListener(screenCheck);
	plot1.setupGrid();
	plot1.draw();
	$.plot('#flotPie', [{
		label: 'Interested',
		data: [
			[1, 35]
		],
		color: '#3bb001'
	}, {
		label: 'Going',
		data: [
			[1, 28]
		],
		color: '#5646ff'
	}, {
		label: 'Maybe',
		data: [
			[1, 18]
		],
		color: '#8500ff'
	}, {
		label: 'Not Going',
		data: [
			[1, 12]
		],
		color: '#f10075'
	}, {
		label: 'Not Going',
		data: [
			[1, 8]
		],
		color: '#ffc107'
	}], {
		series: {
			pie: {
				show: true,
				radius: 1,
				innerRadius: 0.5,
				label: {
					show: true,
					radius: 3 / 4,
					formatter: labelFormatter
				}
			}
		},
		legend: {
			show: false
		}
	});

	var newCust = [
		[0, 40.42460652446133],
		[1, 39.746131861430484],
		[2, 35.95109348595284],
		[3, 33.295567798337025],
		[4, 28.87960054374564],
		[5, 28.498853797438535],
		[6, 24.44598918395687],
		[7, 20.218403695742982],
	];
	var retCust = [
		[0, 56.30265026531465],
		[1, 54.65369685879262],
		[2, 59.159497004318396],
		[3, 61.52890228654445],
		[4, 65.42115864654912],
		[5, 70.17659339534826],
		[6, 73.96323073101196],
		[7, 74.9799695221578],
	];
	var plot2 = $.plot($('#flotArea2'), [{
		data: newCust,
		color: '#5646ff '
	}, {
		data: retCust,
		color: '#f10075'
	}], {
		series: {
			lines: {
				show: true,
				lineWidth: 2,
				fill: true,
				fillColor: {
					colors: [{
						opacity: 0
					}, {
						opacity: 0.3
					}]
				}
			},
			shadowSize: 0
		},
		points: {
			show: true,
		},
		legend: {
			noColumns: 1,
			position: 'nw'
		},
		grid: {
			hoverable: true,
			clickable: true,
			borderColor: '#ddd',
			borderWidth: 0,
			labelMargin: 10,
			markings: [{
				xaxis: {
					from: 3,
					to: 4
				},
				color: '#f6f5f9'
			}]
		},
		yaxis: {
			color: '#ced4da',
			tickLength: 10,
			min: 0,
			max: 110,
			font: {
				size: 11,
				color: '#969dab'
			},
			tickFormatter: function formatter(val, axis) {
				return val + 'k';
			}
		},
		xaxis: {
			color: '#eee',
			font: {
				size: 12,
				color: '#999'
			},
			ticks: [
				[0, '2012'],
				[1, '2013'],
				[2, '2014'],
				[3, '2015'],
				[4, '2016'],
				[5, '2017'],
				[6, '2018'],
				[7, '2019'],
			],
			position: 'top',
		}
	});

	function labelFormatter(label, series) {
		return '<div style="font-size:11px; font-weight:500; text-align:center; padding:2px; color:white;">' + Math.round(series.percent) + '%<\/div>';
	}
});