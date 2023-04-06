$(function() {
	'use strict';
	$.plot('#salesbar', [{
		data: [
			[0, 10],
			[1, 15],
			[2, 25],
			[3, 22],
			[4, 18],
			[5, 27],
			[6, 34],
			[7, 35],
			[8, 48],
            [9, 27],
			[10, 34],
            [11, 34],
		],
		bars: {
			show: true,
			lineWidth: 0,
			fillColor: '#efeff5',
			barWidth: 0.3,
            align: 'left'
		}
	}, {
		data: [
			[0, 8],
			[1, 3],
			[2, 20],
			[3, 34],
			[4, 18],
			[5, 27],
			[6, 34],
			[7, 35],
			[8, 48],
            [9, 27],
			[10, 34],
            [11, 34],
		],
		bars: {
			show: true,
			lineWidth: 0,
			fillColor: '#5646ff',
			barWidth: .3,
            align: 'right'
		}
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