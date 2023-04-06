$(function() {
	'use strict';
	$.plot('#salesbar', [{
		data: {{ json_encode($sales) }},
		bars: {
			show: true,
			lineWidth: 0,
			fillColor: '#efeff5',
			barWidth: 0.3,
            align: 'left'
		},
		label: 'Sales',
		color: '#efeff5'
	}, {
		data: {{ json_encode($orders) }}
        ,
		bars: {
			show: true,
			lineWidth: 0,
			fillColor: '#5646ff',
			barWidth: .3,
            align: 'right'
		},
		label: 'Orders',
		color: '#5646ff'
	}], {
		grid: {
			borderWidth: 1,
			borderColor: '#eee'
		},
		yaxis: {
			tickColor: '#eee',
			font: {
				color: '#999',
				size: 10
			}
		},
		xaxis: {
            ticks: [
                [0, "Jan"],
                [1, "Feb"],
                [2, "Mar"],
                [3, "Apr"],
                [4, "May"],
                [5, "Jun"],
                [6, "Jul"],
                [7, "Aug"],
                [8, "Sep"],
                [9, "Oct"],
                [10, "Nov"],
                [11, "Dec"]
            ],
			tickColor: '#eee',
			font: {
				color: '#999',
				size: 10
			},		
        }
	});
});