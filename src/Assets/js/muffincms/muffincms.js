$(document).ready(function(){
	$(".opt-div a.delete").click(function(e){
		var path = $(this).attr('href');
		var mod = $(this).attr('data-mod');
		e.preventDefault();
			swal({
			  title: "Are you sure?",
			  text: "You are about to delete this "+mod,
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


	// top nav click
	$(".top-nav>li").click(function(){
		var i = $(this).find('.dropdown-menu');
		toggleClassExcept('.top-nav .dropdown-menu', 'rmv', 'active', i);
		i.toggleClass("active");
	});

	/**  toggle a certain class except the given object
		* works with li and lists
		* @param id identifier
		* @param a action
		* @param c class
		* @param ex object
		*/
	function toggleClassExcept(id, a, c, ex){
		$(id).each(function(){
			switch(a){
				case 'remove':
				case 'rmv':
					if(!$(this).is(ex)) $(this).removeClass(c);
					break;
				case 'add':
					if(!$(this).is(ex)) $(this).addClass(c);
					break;
				default:
					break;
			}
		});
	}

});
