$(function () {
      $('#myTab li:eq(0) a').tab('show');
   });
   $(function(){
$('body').on('beforeSubmit', 'form#bid-form', function () {
     var form = $(this);
      var loanid=$("#loanbid-loan_id").val();
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     $('.loading-img').show();
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
        	  $('.loading-img').hide();
               if(!response.success){
					var data = response.data;
					for (var key in data) {
						  if (data.hasOwnProperty(key)) {
						    $("#loanbid-"+key).parent().addClass('has-error');
						    $("#loanbid-"+key).next().html(data[key]);
						  }
					}
               } else {
            	   form[0].reset();
            	   alert(response.data);
            	   $('.bidding-box').load(SITE_URL+'bids/bidding/'+loanid);
               }
          },
          error:function(){
        	  alert('Error in applying Bid');
        	  $('.loading-img').hide();
          }
     });
     return false;
});

$('body').on('beforeSubmit', 'form#message-form', function () {
     var form = $(this);
     // return false if form still have some validation errors
     if (form.find('.has-error').length) {
          return false;
     }
     $('.loading-img').css('z-index',100000);
     $('.loading-img').show();
     
     // submit form
     $.ajax({
          url: form.attr('action'),
          type: 'post',
          data: form.serialize(),
          success: function (response) {
               if(!response.success){
            	     $('.loading-img').hide();

					var data = response.data;
					for (var key in data) {
						  if (data.hasOwnProperty(key)) {
						    $("#loanbid-"+key).parent().addClass('has-error');
						    $("#loanbid-"+key).next().html(data[key]);
						  }
					}
               } else {
            	   $('.loading-img').hide();
            	   form[0].reset();
            	   alert(response.data);
            	   $('#message-modal').modal('hide');
            	   $("#message-modal").on('hidden.bs.modal', function(event){
					var form = $("#message-form")[0].reset();
				   });
               }
          },error:function(){
        	  $('.loading-img').hide();
        	   alert('Error in sending message');
          }
     });
     return false;
});
$("#message-modal").on('hidden.bs.modal', function(event){
	var form = $("#message-form")[0].reset();
  });
});
   
  function sendMessage(lender_id) {
	  if(lender_id){
		  $("#message-receiverid").val(lender_id);
		  $('#message-modal').modal('show');
	  }
  }