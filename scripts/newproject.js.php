<?php
	session_start();

?>
	function makeid()
	{
		var text = '';
		var possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

		for( var i=0; i <= 10; i++ )
			text += possible.charAt(Math.floor(Math.random() * possible.length));

		return text;
	}
	$(function() {
		var uID;
		$('#file_upload').uploadify({
			'formData'     : {
				'timestamp' : '<?=$timestamp?>',
				'token'     : '<?=md5('unique_salt' . $timestamp)?>'
			},
			'hideButton' : true,
			'wmode'      : 'transparent', 
			'swf'      : '/scripts/uploadify/uploadify.swf',
			'uploader' : '/scripts/uploadify/uploadify.php',
			'fileTypeDesc' : 'Image Files',
			'fileTypeExts' : '*.jpg; *.JPG; *.jpeg; *.JPEG; *.png; *.PNG;',
			'onSelect' : function(file) {
				$('#sortable').append("<li id='preview_" + file.id + "' class='preview ui-state-default'><div class='descriptionText' id='description_" + file.id 
				+ "'><span></span></div><div id='remove_"+ file.id + "' class='removeFile'></div><div class='progressText' id='progress_" + file.id + "'></div></li>");
			},
			'onSelectError' : function() {
            alert('The file ' + file.name + ' returned an error and was not added to the queue.');
	        },
			'onCancel' : function(file) {
				$('#preview_' + file.id ).fadeOut(function(){this.remove()});
			},
			'onUploadError' : function(file, errorCode, errorMsg, errorString) {
				$('#preview_' + file.id ).fadeOut(function(){this.remove()});
				alert('The file ' + file.name + ' could not be uploaded: ' + errorString);
			},
			'onUploadProgress' : function(file, bytesUploaded, bytesTotal, totalBytesUploaded, totalBytesTotal) {
				var percentage = Math.round((totalBytesUploaded / totalBytesTotal) * 100);
				$('#progress_' + file.id).html(percentage + '%');
			},
			'onUploadSuccess' : function(file,data) {
				//alert('The file ' + file.name + ' finished processing.');
				//console.log(file);
				$('#progress_' + file.id).hide();
				//$('#sortable').append('<li class=\'ui-state-default\'><img width=\'100%\' height=\'100%\' id=\'theImg\' src=\'/img/' + data + '\' /></li>')
				data = $.parseJSON(data);
				$("#preview_" + file.id ).append("<img data-org='" + data.orig + "' data-thumb='" + data.thumb + "' width='100%' height='100%' id='theImg' src='/uploads/" + data.thumb + "' />");
			}
		});
		$( '#sortable' ).sortable();
		$( '#sortable' ).disableSelection();
		$("#sortable").on({
			mouseenter: function(){
				$(this).children(".removeFile").show();
				$(this).children(".descriptionText").show();
			}, 
			mouseleave: function(){
				$(this).children(".removeFile").hide();	
				$(this).children(".descriptionText").hide();	
			}
		}, "li");

		$("#sortable").on("click","li .removeFile", function(){
			console.log('yay');
			$(this).parent().hide(function(){$(this).remove();});
		});

		$("#sortable").on("click","li .descriptionText", function(){
			if(!$(this).children().is("input")){
				var input = $('<input />', {'type': 'text', 'value': $(this).children('span').html()});
				$(this).children('span').replaceWith(input);
				input.focus();
			}
		});

		$("#sortable").on("blur","li .descriptionText", function(){
			if($(this).children().is("input")){
				var span = $('<span />');
				$(this).children('input').replaceWith(span.html($(this).children('input').val()));
				
			}
		});

		$("#sortable").on("keypress",'.descriptionText input', function(e){
			if (e.which == 13) {
				$(this).blur();
			}
		});

		/*$('body').keypress(function (e) {
			if (e.which == 13) {
				
				submitProject();
				return false;
			}
		});*/

		$('#saveProject').click(function(){
			submitProject();
		});
		$('#updateProject').click(function(){
			updateProject();
		});

	});

	function submitProject(){
		if($('#projectTitle').val()==''){
			alert('Please enter a project title before proceeding');	
		}else if($( '#sortable' ).sortable( 'toArray' ).length <1){
			alert('Please upload images first.');
		}else{
			var title = $('#projectTitle').val();
			var sortedIDs = $( '#sortable' ).sortable( 'toArray' );
			
			var obj = [];
			$.each(sortedIDs, function(index, value){
				obj.push({
					'image' : $('#' + value + ' img').data('org'),
					'thumbnail' :  $('#' + value + ' img').data('thumb'),
					'description' : $('#' + value + ' .descriptionText').children().text()
				});

			});

			console.log(obj);

			$.ajax({
				type: 'POST',
				url: 'saveproject',
				dataType: 'text',
				data: {
					'action': 'saveproject',
					'title': title,
					'images' : obj

				},
				success: function(msg){
					alert('Project successfully posted. You will now be redirected.');
					window.location.href = "/adminhome";

				}
			});
		}
	}

	function updateProject(){
		if($('#projectTitle').val()==''){
			alert('Please enter a project title before proceeding');	
		}else if($( '#sortable' ).sortable( 'toArray' ).length <1){
			alert('Please upload images first.');
		}else{
			var title = $('#projectTitle').val();
			var projectID = $('#projectID').val();
			var sortedIDs = $( '#sortable' ).sortable( 'toArray' );
			
			var obj = [];
			$.each(sortedIDs, function(index, value){
				obj.push({
					'image' : $('#' + value + ' img').data('org'),
					'thumbnail' :  $('#' + value + ' img').data('thumb'),
					'description' : $('#' + value + ' .descriptionText').children().text()
				});

			});

			console.log(obj);

			$.ajax({
				type: 'POST',
				url: 'updateproject',
				dataType: 'text',
				data: {
					'action': 'updateproject',
					'projectID': projectID,
					'title': title,
					'images' : obj

				},
				success: function(msg){
					alert('Project successfully update. You will now be redirected.');
					window.location.href = "/adminhome";

				}
			});
		}
	}