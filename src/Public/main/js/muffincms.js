$(document).ready(function(){

	var toggleMuffEditor = function(stat=false){
		$("#muff-opt").remove();
		// bind event
		if(stat){
			$(".muff").mouseover(function() {
				$("#muff-opt").remove();
			    muffShowOptions($(this));
			    $(window).scroll(function(){
			        $("#muff-opt").remove();
			    })          
			});
		}else{// unbind event
			$(".muff").unbind("mouseover");
		}
	};


	function muffShowOptions( e ){
		var t = "";
		var id = e.attr("data-muff-id");
		var title = e.attr("data-muff-title");
		var p = e.offset();
		var opttop = p.top + 15;
		var optleft = p.left + 5;

		if(e.hasClass("muff-div")){	t="div";
		}else if(e.hasClass("muff-text")){	t="text";
		}else if(e.hasClass("muff-a")){	t="link";
		}else if(e.hasClass("muff-img")){	t="image";
		}

		if(!title){ title = t;}

		// check position is beyond document
		if((p.left + 25 + 75) > $(window).width()){
			optleft -= 75;
		}
		

		var opt = "<div id='muff-opt' style='position:absolute;top:"+opttop+"px;left:"+optleft+"px;z-index:99998;display:none;'>";
		opt += "<a href='admin/"+t+"/"+id+"/edit' class='mbtn edit'></a>";
		opt += "<a href='admin/"+t+"/delete/' class='mbtn delete' data-mod='"+t+"' data-id='"+id+"'></a>";
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
						// window.location.href = path;
						proceedDelete(path, id);
					} 
				});
			return false;
		});
	}

	toggleMuffEditor(false);

	// set checkbox editor event
	$("input[name=cb-muff-editor]").click(function(){
		if($(this).is(':checked')){ toggleMuffEditor(true);  }
		else{ toggleMuffEditor(false) } 
	});


	function proceedDelete(path, id){
		var newForm = jQuery('<form>', {
				        'action': path,
				        'method': 'POST',
				        'target': '_top'
				    }).append(jQuery('<input>', {
				        'name': '_token',
				        'value': $("meta[name=csrf-token]").attr("content"),
				        'type': 'hidden'
				    })).append(jQuery('<input>', {
				        'name': 'id',
				        'value': id,
				        'type': 'hidden'
				    }));
				    
		newForm.hide().appendTo("body").submit();
	}


	// $(".opt-div a.delete, .w-conf a.delete, .w-conf-hvr a.delete").click(function(e){
	// 	var path = $(this).attr('href');
	// 	var mod = $(this).attr('data-mod');
	// 	// e.preventDefault();
	// 		swal({
	// 		  title: "Are you sure?",
	// 		  text: "You are about to delete this "+mod,
	// 		  type: "warning",
	// 		  showCancelButton: true,
	// 		  confirmButtonColor: "#DD6B55",
	// 		  confirmButtonText: "Yes, delete it!",
	// 		  cancelButtonText: "Cancel",
	// 		  closeOnConfirm: true,
	// 		  closeOnCancel: true
	// 		},
	// 		function(isConfirm){
	// 			if (isConfirm) {
	// 				window.location.href = path;
	// 			} 
	// 		});
	// 	return false;
	// });


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

	$(".w-add .muff-add").click(function(event){
		event.preventDefault();
		var b = $(this);
	    var newForm = jQuery('<form>', {
	        'action': b.data('href'),
	        'method': 'GET',
	        'target': '_top'
	    }).append(jQuery('<input>', {
	        'name': '_token',
	        'value': $("meta[name=csrf-token]").attr("content"),
	        'type': 'hidden'
	    })).append(jQuery('<input>', {
	        'name': 'url',
	        'value': $("meta[name=muffin-url]").attr("content"),
	        'type': 'hidden'
	    })).append(jQuery('<input>', {
	        'name': 'location',
	        'value': b.data("loc"),
	        'type': 'hidden'
	    }));
	    // console.log(newForm);
	    newForm.hide().appendTo("body").submit();

	})

	// TAGs

	//var tagArea = '.tag-area';
	if($('.tagarea')[0]){
		var backSpace;
		var close = '<a class="close"></a>'; 
		var PreTags = $('.tagarea').val().trim().split(" ");

		$('.tagarea').after('<ul class="tag-box"></ul>');

		for (i=0 ; i < PreTags.length; i++ ){
		  	var pretag = PreTags[i].split("_").join(" ");
		  	if($('.tagarea').val().trim() != "" )
		  		$('.tag-box').append('<li class="tags"><input type="hidden" name="tags[]" value="'+pretag+'">'+pretag+close+'</li>');
		}

		$('.tag-box').append('<li class="new-tag"><input class="input-tag" type="text"></li>');

		// unbind submit form when pressing enter
		$('.input-tag').on('keyup keypress', function(e) {
		  	var keyCode = e.keyCode || e.which;
		  	if (keyCode === 13) { 
		    	e.preventDefault();
		    	return false;
		  	}
		});

		// Taging 
		$('.input-tag').bind("keydown", function (kp) {
		    var tag = $('.input-tag').val().trim();
		    if(tag.length > 0){
		  		$(".tags").removeClass("danger");
		        if(kp.keyCode  == 13 || kp.keyCode == 9){
		          $(".new-tag").before('<li class="tags"><input type="hidden" name="tags[]" value="'+tag+'">'+tag+close+'</li>');
		           $(this).val('');
		    }}
		  		
		    else {if(kp.keyCode == 8 ){
		      	if($(".new-tag").prev().hasClass("danger")){
			        $(".new-tag").prev().remove(); 
		      	}else{
		      		$(".new-tag").prev().addClass("danger");
		      	}
		    }
		   }
		});

		  //Delete tag
		$(".tag-box").on("click", ".close", function()  {
		  $(this).parent().remove();
		});
		$(".tag-box").click(function(){
		 	$('.input-tag').focus();
		});
		// Edit
		$('.tag-box').on("dblclick" , ".tags", function(cl){
			var tags = $(this); 
		  	var tag = tags.text().trim();
		  	$('.tags').removeClass('edit');
		  	tags.addClass('edit');
		  	tags.html('<input class="input-tag" value="'+tag+'" type="text">')
		  	$(".new-tag").hide();
		  	tags.find('.input-tag').focus();
		  
		 	tag = $(this).find('.input-tag').val() ;
		 	$('.tags').dblclick(function(){ 
		    	tags.html(tag + close);
		   		$('.tags').removeClass('edit');
		    	$(".new-tag").show();
		  	});
		  
		  	tags.find('.input-tag').bind("keydown", function (edit) {
		    	tag = $(this).val() ;
		      	if(edit.keyCode  == 13){
		          	$(".new-tag").show();
		          	$('.input-tag').focus();
		          	$('.tags').removeClass('edit');
		          	if(tag.length > 0){
		            	tags.html('<input type="hidden" name="tags[]" value="'+tag+'">'+tag + close);
		          	}
		          	else{
		            	tags.remove();
		          	}
		      	}
			});  
		});
	}


	// sorting
	// $(function() {
	// $( ".tag-box" ).sortable({
	// items: "li:not(.new-tag)",
	//   containment: "parent",
	//   scrollSpeed: 100
	// });
	// $( ".tag-box" ).disableSelection();
	// });

});









