
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */


require('../bootstrap');

window.Vue = require('vue');


require('../../../../node_modules/jquery-match-height/jquery.matchHeight.js');

$(document).ready(function() {
	//match height//
	$('.mh').matchHeight();

	//google chart//
	if ($( "#piechart" ).length) {   
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
    }	  
  }
	//file input preview image

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

	//payment checked

	// if($(".form-check-input").attr('checked')) {
 //        $(".form-check").addClass("checked");
 //    }else{
 //    	$(".form-check").removeClass("checked");
 //    }

	//  if($(".form-check-input").is(':checked'))
	//     $(".form-check").addClass("checked");  // checked
	// else
	//     $(".form-check").removeClass("checked");  // unchecked

	// $(".form-check-input").click(function() {
	// 	(".form-check").removeClass("checked");
	// 	$(this).parent(".form-check").addClass("checked");  // checked
	// });
});

const files = require.context('./../components/', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key)));

const app = new Vue({   
  el: '#client-app'
});   
 