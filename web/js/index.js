/*	function calculateInterest () {
		var current_month= new Date().getMonth();
		var current_year= new Date().getFullYear();
		var months = new Array();
		months[0] = "January";
		months[1] = "February";
		months[2] = "March";
		months[3] = "April";
		months[4] = "May";
		months[5] = "June";
		months[6] = "July";
		months[7] = "August";
		months[8] = "September";
		months[9] = "October";
		months[10] = "November";
		months[11] = "December";
		
		var loan=parseFloat($("#loan-amount_needed").val());
		var duration=parseInt($("#loan-duration").val());
		var interest=parseFloat($("#loan-max_interest").val());
		
		if(isNaN(loan) || isNaN(duration) || isNaN(interest) ){
			if(isNaN(loan)){$("#loan-amount_needed").parent().addClass('has-error');}
			if(isNaN(duration)){$("#loan-duration").parent().addClass('has-error');}
			if(isNaN(interest)){$("#loan-max_interest").parent().addClass('has-error');}
			return false;
		}
		
		$(".step-3 .interest-heading").html('Loan Requested - '+loan+' Interest Rate - '+interest+'%'+' + 5% Admin Charges '+' For '+duration+' months' + '<b>Current Month : '+months[current_month]+'-'+(new Date()).getFullYear());
		var interest= parseFloat(((loan*duration*(interest+5))/(100*12)).toFixed(2));
		
		var totalAmount = loan + interest;
		
		var monthlyAmount = parseFloat(( totalAmount / duration ));
		var tabledata='<table class="table table-hover"><tr><th>Month Name</th><th>Amount(in Rs.)</th></tr>';
		for(var i=1;i<=duration;i++){
			current_month++;
			if(current_month>11){
				current_month=0;
				current_year++;
			}
			tabledata+="<tr><td>"+months[current_month]+'-'+current_year+"</td><td>"+monthlyAmount.toFixed(2)+'</td></tr>';
		}
		$(".monthly-distribution").html(tabledata+"<tr style='border-top:2px solid black;'><td>Total Amount</td><td>"+totalAmount.toFixed(2)+"</td></tr></table>");
		return true;
	}*/
