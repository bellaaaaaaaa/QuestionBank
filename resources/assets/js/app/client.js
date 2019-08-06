
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('../../../../node_modules/jquery-match-height/jquery.matchHeight.js');
require('../bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#client-app'
});

$(document).ready(function() {
	//match height//
	$('.mh').matchHeight();

	//google chart//
	google.charts.load('current', {'packages':['corechart']});
	google.charts.setOnLoadCallback(drawChart);

	function drawChart() {

	var data = google.visualization.arrayToDataTable([
	  ['Task', 'Percentage'],
	  ['Completed',     45],
	  ['Not Completed', 55]
	]);

	var options = {
      legend: 'none',
      tooltip: { trigger: 'none' },
      slices: {
        0: { color: '#036635' },
        1: { color: '#dedede' }
      }
    };

	var chart = new google.visualization.PieChart(document.getElementById('piechart'));

	chart.draw(data, options);
	}

	var dropdown = document.getElementsByClassName("dropdown-btn");
	var i;

	for (i = 0; i < dropdown.length; i++) {
	  dropdown[i].addEventListener("click", function() {
	  this.classList.toggle("active");
	  var dropdownContent = this.nextElementSibling;
	  if (dropdownContent.style.display === "block") {
	  dropdownContent.style.display = "none";
	  } else {
	  dropdownContent.style.display = "block";
	  }
	  });
	}

	function readURL(input) {
	  if (input.files && input.files[0]) {
	    var reader = new FileReader();
	    
	    reader.onload = function(e) {
	      $('#profile-img').attr('src', e.target.result);
	    }
	    
	    reader.readAsDataURL(input.files[0]);
	  }
	}

	$("#profileImg").change(function() {
	  readURL(this);
	});

});

