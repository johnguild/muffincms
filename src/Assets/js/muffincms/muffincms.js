$(document).ready(function(){

	$(".opt-div a.delete, .w-conf a.delete, .w-conf-hvr a.delete").click(function(e){
		var path = $(this).attr('href');
		var mod = $(this).attr('data-mod');
		// e.preventDefault();
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
		return false;
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

	var editing = true;

	if(editing){
		$(".muff").mouseover(function() {
			$("#muff-opt").remove();
		    muffShowOptions($(this));               
		});
	}


	function muffShowOptions( e ){
		var t = "";
		var id = e.attr("data-muff-id");
		var title = e.attr("data-muff-title");
		var p = e.offset();
		var opttop = p.top + 15;
		var optleft = p.left + 25;

		if(e.hasClass("muff-div")){	t="div";
		}else if(e.hasClass("muff-text")){	t="text";
		}else if(e.hasClass("muff-a")){	t="link";
		}else if(e.hasClass("muff-img")){	t="image";
		}

		if(!title){ title = t;}

		 // <div id="muff-opt" class="">
   //    <a href="#" class="mbtn edit"></a>
   //    <a href="#" class="mbtn delete"></a>
   //    <span>Sample title</span>
   //  </div>

		var opt = "<div id='muff-opt' style='position:absolute;top:"+opttop+"px;left:"+optleft+"px;z-index:99998;display:none;'>";
		opt += "<a href='/"+t+"/edit/"+id+"' class='mbtn edit'></a>";
		opt += "<a href='/"+t+"/delete/"+id+"' class='mbtn delete' data-mod='"+t+"'></a>";
		opt += "<span>"+title+"</span>";
		opt += "</div>";

		$("body").prepend(opt);
		$("#muff-opt").slideDown(300);

		$("body").find("#muff-opt > a.delete").click(function(e){
			var path = $(this).attr('href');
			var mod = $(this).attr('data-mod');
			// e.preventDefault();
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
			return false;
		});
		
	}

});









