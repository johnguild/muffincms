$(document).ready(function(){
	$(".opt-div a.delete").click(function(e){
		var path = $(this).attr('href');
		e.preventDefault();
			swal({
			  title: "Are you sure?",
			  text: "You are about to delete this text",
			  type: "warning",
			  showCancelButton: true,
			  confirmButtonColor: "#DD6B55",
			  confirmButtonText: "Yes, delete it!",
			  cancelButtonText: "Cancel",
			  closeOnConfirm: true,
			  closeOnCancel: true
			},
			function(isConfirm){
			  if (isConfirm) {
			  	window.location.href = path;
			  } 
			});

	});

});
