<?php
/*
echo "<pre>";
print_r($page);die();
echo "</pre>";
die();
*/

$item = $page->p;
?>

<script src="<?=SITE_URL;?>public/scripts/summernote/summernote.min.js" type="text/javascript"></script>
<!-- Chosen -->
<script src="<?=base_url()?>public/assets/js/plugins/chosen/chosen.jquery.js"></script>
<script src="<?=base_url()?>public/assets/scripts/jquery-ui/jquery-ui.min.js"></script>
<script src="<?=base_url()?>public/assets/vendors/croppiejs/croppie.min.js"></script>

<script type="text/javascript">
$(document).ready(function()
{
	window.APPLICATION = window.APPLICATION ? window.APPLICATION : {};
	(
		function(o)
		{
			var obj = {};

			obj.dialog = {
				add_image : window.document.getElementById('images-add-new'),

				y : window.document.getElementById('dialog-images'),

				imager : {

					data : '<?=(!is_null($imager) ? 'JSON.parse(\'' .json_encode($imager). '\')' : null)?>',

					upload_image : window.document.getElementById('imager-upload-image'),
					remove_optimal_sizes : window.document.getElementById('imager-removeoptimalsizes'),
					apply_optimal_sizes : window.document.getElementById('imager-applyoptimalsizes'),

					imager_wrap : window.document.getElementById('imager-upload-wrap'),

					imager_message : window.document.getElementById('imager-upload-message'),
					imager_croppie : window.document.getElementById('imager-croppie'),

					croppie : null,
					file_ext : null,

					form : window.document.getElementById('imager-form'),
				}
			}

			obj.dialog.imager.initCroppie = function(resizeable = false, enforceboundary = false, h = null, w = null) {
				let height = h !== null ? h : this.data[0].height;
				let width = w !== null ? w : this.data[0].width;

				let b_height = parseInt(height) +50;
				let b_width = parseInt(width) +50;

				this.croppie = new Croppie(this.imager_croppie, {
					viewport : { height : parseInt(height), width : parseInt(width) },
					boundary : { height : b_height, width : b_width },
					enableExif: true,
					enableResize : resizeable,
					enforceBoundary : enforceboundary
				});

				// console.log(this.croppie);
			};

			obj.dialog.imager.toggleOptimalSizes = function(trigger) {
				let data_url = this.croppie.data.url;
				let original_image_height = this.croppie._originalImageHeight;
				let original_image_width = this.croppie._originalImageWidth;

				this.croppie.destroy();
				switch(trigger)
				{
					case 'remove':
						$(this.remove_optimal_sizes).css('display', 'none');
						$(this.apply_optimal_sizes).css('display', 'block');

						let height = null;
						let width = null;
						if(this.data[0].height > original_image_height || this.data[0].width > original_image_width)
						{
							height = original_image_height;
							width = original_image_width;
						}
						this.initCroppie(true, true, height, width);
						break;

					case 'apply':
						$(this.apply_optimal_sizes).css('display', 'none');
						$(this.remove_optimal_sizes).css('display', 'block');

						this.initCroppie();
						break;
				}
				this.croppie.bind({ url : data_url });
			}


			function readFile(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						get_file_type = input.files[0].type.match(/image\/=?(png|jpeg)/);
						if(get_file_type === null)
						{
							alert('Fisierul nu este valid. Foloseste fisiere de tip JPG/PNG..');
							return false;
						} else {
							obj.dialog.imager.file_ext = get_file_type[1];
						}

						obj.dialog.imager.croppie.bind({ url : e.target.result })
						.then(function() {
							$(obj.dialog.imager.imager_wrap).css('display', 'block');
							$(obj.dialog.imager.imager_message).css('display', 'none');

							$(obj.dialog.imager.remove_optimal_sizes).css('display', 'block');
							$(obj.dialog.imager.apply_optimal_sizes).css('display', 'none');

							obj.dialog.imager.croppie.bind();

							// console.log('bounded..');
						});

					}

					reader.readAsDataURL(input.files[0]);
				}
				else {
					alert("Sorry - you're browser doesn't support the FileReader API");
				}
			}

			/*
			events binding
			*/
			$(obj.dialog.add_image).on('click', function() {
				$(obj.dialog.y).dialog('open');
				this.initCroppie();
			}.bind(obj.dialog.imager));//uploadimage

			$(obj.dialog.imager.upload_image).on('change', function () {
				readFile(this);
			});//readfile

			$(obj.dialog.imager.remove_optimal_sizes).on('click', function() {
				obj.dialog.imager.toggleOptimalSizes('remove');

			});//removeoptimalsizes

			$(obj.dialog.imager.apply_optimal_sizes).on('click', function() {
				obj.dialog.imager.toggleOptimalSizes('apply');

			});//applyoptimalsizes

			/*
			self-invoked
			*/

			/*
			prerequisites
			*/
			$(obj.dialog.y).dialog({
				autoOpen: false,
				// height: 500,
				// width: 600,
				height: $( window ).height() -10,
				width: $( window ).width() -10,
				modal: true,
				resizeable: false,
				buttons: {
					"Gata.. salveaza imaginea!" : function() {

						let postdata = new FormData();
						postdata.append('air_id', 14);
						postdata.append('imager', JSON.stringify(obj.dialog.imager.data));
						// result({ type, size, format, quality, circle }) Promise
						// obj.dialog.imager.croppie.result({ type : 'blob', format : obj.dialog.imager.file_ext }).then(function(result) {
						obj.dialog.imager.croppie.result('blob').then(function(result) {

							if(result === null)
							{
								alert('Nu ai procesat nicio imagine..');
								return false;
							}

							postdata.append('data', result);

							$.ajax({
								// context : this.context,
								url: '<?=base_url()?>imager_banners/ajax_upcreateimages/<?=$uri->id?>',
								data: postdata,
								dataType: "JSON",
								type: 'POST',
								cache: false,
								processData: false,
								contentType: false,
								mimeTypes: "multipart/form-data",
								beforeSend: function() {
									// showloader();
								},
								error: function () {
									// location.reload();
								},
								complete: function() {
									// if(dom.loader)
									// {
										// hideloader();=]
										// dom.loader = false;
									// }
								},
								success: function(response) {
									if(response.status)
									{
										// do something
										$(obj.dialog.y).dialog('close');
										upFileSuccess(response.id, response.img);
										// hideloader();
									}
								}
							});
						});
					},
					Cancel: function() {
						$(this).dialog("close");
					}
				},
				close: function() {
					// do something
					obj.dialog.imager.croppie.destroy();

					$(obj.dialog.imager.imager_wrap).css('display', 'none');
					$(obj.dialog.imager.imager_message).css('display', 'block');

					$(obj.dialog.imager.remove_optimal_sizes).css('display', 'none');
					$(obj.dialog.imager.apply_optimal_sizes).css('display', 'none');
				}
			});
		}
	)
	(window.APPLICATION);
}, false);
</script>

<script type="text/javascript">
var idpage = <?=$page->p->atom_id;?>;
var images = <?=count($page->i);?>;
var uploadtf = null;
var filetarget = null;
var fileref = null;

$(document).ready(function() {
	$('.chosen-sl-pages').chosen({width: "100%"});
	$('.choose_breadcrumbs').chosen({width: "100%"});

	$('.chosen-sl-pages').on('change', function(evt, params) {
		// console.log(evt, params);

		request_page_assoc(params);
	});
	$('.choose_breadcrumbs').on('change', function(evt, params) {
		// console.log(evt, params);

		insert_breadcrumbs_assoc(params);
	});
});

<?php if(!is_null($page)): ?>
function request_page_assoc(params) {
	$.ajax({
	url: '<?=base_url()?>pagini/chosen_request_page_assoc/',
	dataType: "JSON",
	type: 'POST',
	data: { id_page : <?=$page->p->atom_id?>, params : params },
	beforeSend: function() {
		showloader();
	},
	success: function( data ) {
	  if(data.status == 1) {
		hideloader();
	  } else if(data.status == 0) {
		// do something
	  }

	}
	});
}
<?php endif; ?>

<?php if(!is_null($page)): ?>
function insert_breadcrumbs_assoc(params) {

	$.ajax({
	url: '<?=base_url()?>pagini/insert_breadcrumbs_assoc/',
	dataType: "JSON",
	type: 'POST',
	data: { id_page : <?=$page->p->atom_id?>, params : params },
	beforeSend: function() {
		showloader();
	},
	success: function( data ) {

	  if(data.status == 1) {
		hideloader();
	  } else if(data.status == 0) {
		// do something

	  }

	}
	});
}
<?php endif; ?>

function bannerfdata(refbanner) {
  var url = "<?=base_url().$controller_ajax;?>/bannerformdata/id/" +idpage;
	var ti = $("input[name='" +refbanner+ "ti']").val();
	var sti = $("input[name='" +refbanner+ "sti']").val();
	var href1 = $("input[name='" +refbanner+ "href1']").val();
	var thref1 = $("input[name='" +refbanner+ "thref1']").val();

  $.ajax({
    url: url,
    dataType: "JSON",
    data: { ref : refbanner, ti: ti, sti: sti, href1: href1, thref1: thref1, },
    type: 'POST',
    beforeSend: function() {
			showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
        hideloader();
				notif("success", refbanner, "Modificarile tale au fost salvate!");
        // $(divimgs+id).fadeOut(300, function() { $(this).remove() });
				// upImagesStatus();

      } else if(data.status == 0) {
        //
      }
    }
  });
}

function ajxdelimg(id, ref) {
  // console.log(id, ref);return false;

  var url = "<?=base_url().$controller_ajax;?>/d/id/" +idpage;
  $.ajax({
    url: url,
    dataType: "JSON",
    data: { fileid:id, fileref:ref },
    type: 'POST',
    beforeSend: function() {
			showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
        hideloader();
        removediv("p_img" +ref+ " #img" +ref+ "-" +id, ref);
        // $(divimgs+id).fadeOut(300, function() { $(this).remove() });
				// upImagesStatus();

      } else if(data.status == 0) {
        //
      }
    }
  });
}

function removediv(id, ref) {
  $("#" +id).fadeOut(300, function() { $(this).remove() });

  // only for banners(the upload button will hide)
  if (ref.indexOf("banner") !=-1) {
    // console.log("button#" +ref+ "btnup");
    $("button#" +ref+ "btnup").attr("style", "visibility:visible");
    $("#" +ref+ "formdata").attr("style", "visibility:hidden");
  }
}

function filesetvars(target, ref = null) {
  filetarget = target;
  fileref = ref;
}
/**
 * [upfile description]
 * @param  [type] id [description]
 * @return [type]    [description]
 */
function upfile(id = null) {
  var inputfile = ("input[name=inpfile]");
  if($(inputfile).val() == "") {
    alert("Selecteaza un fisier");
    return false;
  }
  var fmuf = new FormData($("#fmodalupfile")[0]);
  fmuf.append("filetarget", filetarget);
  fmuf.append("fileref", fileref);

  var url = "<?=base_url().$controller_ajax;?>/upimg/id/" +id;
  // console.log(url);return;
  var divimgs = "#pagina #p_imgs";
  $.ajax({
    url: url,
    dataType: "JSON",
    data: fmuf,
    mimeTypes: "multipart/form-data",
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    beforeSend: function() {
			$('#inpfileModal').modal('hide');
			// showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
        //PATH_IMG_BANNERS
        upFileSuccess(data.id, data.img);
        $(inputfile).val("");//CLEANINPUTVALUE
      } else if(data.status == 0) {
        //
      }

    }
  });
}

function upFileSuccess(id, img) {
  var div = "p_img" +fileref;
  var imgpath = null;
  if(fileref == "poza") imgpath = "<?=$imgpathpage;?>";
  else imgpath = "<?=$imgpathbanner;?>";
  var html =
  '<div id="img' +fileref+ "-" +id+ '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">\
    <div class="img-thumbnail" style="padding:2px;">\
      <img class="img-responsive" src="' +imgpath+img+ '">\
      <div class="thumbfooter">\
        <a href="javascript:void(0)" onClick="return ajxdelimg(' +id+ ', \'' +fileref+ '\');return false"><code-remove>Elimina</code-remove></a>\
      </div>\
    </div>\
  </div>';
  $("#" +div).append(html).hide().fadeIn(700);

  // only for banners(the upload button will hide)
  if (fileref.indexOf("banner") !=-1) {
    $("button#" +fileref+ "btnup").hide();// $("button#" +fileref+ "btnup").hide();
		$("#" +fileref+ "formdata").attr("style", "visibility:visible");//showform
  }
  hideloader();
}

function upImagesStatus() {
	if(images == 0) $("p#p_imgnoimg").text("Nu exista imagini incarcate");
	else if(images > 1) $("p#p_imgnoimg").text("");
}

$(document).ready(function() {
  hideloader();
	$('#ncontentro').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['code', ['code']],
			['view', ['fullscreen', 'codeview', 'help']],
			['insert', ['picture', 'hr', 'link']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});

	$('#ncontenten').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['code', ['code']],
			['view', ['fullscreen', 'codeview', 'help']],
			['insert', ['picture', 'hr', 'link']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
});
</script>




<!--script luat din views/buletine_meteo/js_item.php -->


<script type="text/javascript">

const pdf = {
	file : <?=(!empty($item->pdf_file) ? "'" . $item->pdf_file . "'" : 'null')?>,
	form : document.getElementById('fmodalupfilepdf'),
	modal : document.getElementById('inpfilePdfModal'),
	
	documents_path : '<?=SITE_URL.'public/upload/'.$air->air_documents_path?>',
	y : document.getElementById('pdf-container')
};
$(document).ready(function() {
	pdf.render_empty_item = function() {
		let html = '\
		<div class="file-box">\
			<div class="file">\
				<a href="#">\
					<span class="corner"></span>\
					<div class="icon">\
						<i class="fa fa-file-pdf-o"></i>\
					</div>\
					<div class="file-name">\
						<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#inpfilePdfModal">Incarca fisier</button>\
						<br/>\
						<small>Nu exista fisier incarcat</small>\
					</div>\
				</a>\
			</div>\
		</div>\
		';
		
		//$(this.y).html(html);
                 $(this.y).append(html);
	};
	
	pdf.render_item = function() {
		let html = '\
		<div class="file-box">\
			<div class="file">\
				<a href="' + this.documents_path + '/' + this.file + '" target="_blank">\
					<span class="corner"></span>\
					<div class="icon">\
						<i class="fa fa-file-pdf-o"></i>\
					</div>\
				</a>\
					<div class="file-name">\
						<a href="' + this.documents_path + '/' + this.file + '" target="_blank">' + this.file + '</a>\
						<button class="btn btn-link btn-sm" style="color:red;" onClick="pdf.removefile(<?=$item->atom_id?>);">Sterge fisier</button>\
					</div>\
			</div>\
		</div>\
		';
		
		$(this.y).html(html);
	};
	
	pdf.removefile = function(atom_id) {
		var url = "<?=base_url().$controller_ajax;?>/delpdf/id/" +atom_id;
		
	  $.ajax({
		url: url,
		dataType: "JSON",
		type: 'GET',
		beforeSend: function() {
				showloader();
		},
		success: function( data ) {
		  if(data.status == 1) {
			  pdf.file = null;
			  pdf.render_empty_item();
				hideloader();
			// removediv("p_img" +ref+ " #img" +ref+ "-" +id, ref);
			// $(divimgs+id).fadeOut(300, function() { $(this).remove() });
					// upImagesStatus();

		  } else if(data.status == 0) {
			//
		  }
		}
	  });
	}
	
	pdf.upfile = function(atom_id) {
	  var inputfile = ("input[name=inpfilepdf]");
	  if($(inputfile).val() == "") {
		alert("Selecteaza un fisier");
		return false;
	  }
	  var fmuf = new FormData($(this.form)[0]);

	  var url = "<?=base_url().$controller_ajax;?>/uppdf/id/" +atom_id;
	  $.ajax({
		url: url,
		dataType: "JSON",
		data: fmuf,
		mimeTypes: "multipart/form-data",
		cache: false,
		contentType: false,
		processData: false,
		type: 'POST',
		beforeSend: function() {
				$(pdf.modal).modal('hide');
				showloader();
		},
		success: function( data ) {
		  if(data.status == 1) {
			//PATH_IMG_BANNERS
			pdf.file = data.file;
			pdf.render_item();
			hideloader();
			$(inputfile).val("");//CLEANINPUTVALUE
		  } else if(data.status == 0) {
			
			hideloader();
			alert(data.error);
		  }

		}
	  });
	}
	
	//render item
	if(pdf.file !== null)
	{
		pdf.render_item();
	}

	else
	{
		//pdf.render_empty_item();
	}

	pdf.render_empty_item();

	$('.choose_breadcrumbs').chosen({width: "100%"});
	$('.choose_breadcrumbs').on('change', function(evt, params) {
		// console.log(evt, params);
		
		insert_breadcrumbs_assoc(params);
	});	
});




$(document).ready(function() {
	
	$('.chosen-sl-investitii').chosen({width: "100%"});
	
	$('.chosen-sl-investitii').on('change', function(evt, params) {
		// console.log(evt, params);
		
		request_proiect_assoc(params);
	});	
	
	$('.chosen-sl-links').chosen({width: "100%"});
  $('.chosen-sl-links').on('change', function(evt, params) {
    console.log(evt, params);

		// console.log("idcontent", idcontent_object);
		
		// console.log($(this).find('option:selected'));
		
		linkRequest(params);
  });
  
	$('#ncontentro').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'hr']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
	
	$('#ncontenten').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'hr']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
	
	$('#ncontentanunturi').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'hr']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
	
	$('#ncontentlucrari_programate').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'hr']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
	
	$('#ncontentprogram_caserie').summernote({
		toolbar: [
			['style', ['style']],
			['fontsize', ['fontsize']],
			['font', ['bold', 'italic', 'underline', 'clear']],
			['fontname', ['fontname']],
			['color', ['color']],
			['para', ['ul', 'ol', 'paragraph']],
			['height', ['height']],
			['insert', ['picture', 'hr']],
			['table', ['table']]
		],
		height: 300,                 // set editor height
		minHeight: null,             // set minimum height of editor
		maxHeight: null,             // set maximum height of editor
	});
});

<?php if(!is_null($item)):?>
function linkRequest(params) {
  var url = "<?=base_url().AIRDROP_CONTROLLER;?>airdrop_request/id/" + "<?=$uri->id?>";
  $.ajax({
    url: url,
    dataType: "JSON",
    type: 'POST',
	data: { air_id: <?=$air->air_id?>, params: params },
    beforeSend: function() {
		showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
		hideloader();
      } else if(data.status == 0) {
        // do something
      }

    }
  });
}
<?php endif; ?>


function ajxdelimg(id, ref) {
  var url = "<?=base_url().$controller_ajax;?>d/id/" +"<?=$uri->id?>";
  $.ajax({
    url: url,
    dataType: "JSON",
    data: { fileid:id, fileref:ref },
    type: 'POST',
    beforeSend: function() {
			showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
        hideloader();
        removediv("p_img" +ref+ " #img" +ref+ "-" +id, ref);
        // $(divimgs+id).fadeOut(300, function() { $(this).remove() });
				// upImagesStatus();

      } else if(data.status == 0) {
        //
      }
    }
  });
}

function removediv(id, ref) {
  $("#" +id).fadeOut(300, function() { $(this).remove() });

  // only for banners(the upload button will hide)
  if (ref.indexOf("banner") !=-1) {
    console.log("button#" +ref+ "btnup");
    $("button#" +ref+ "btnup").attr("style", "visibility:visible");
  }
}

function filesetvars(target, ref = null) {
  filetarget = target;
  fileref = ref;
}
/**
 * [upfile description]
 * @param  [type] id [description]
 * @return [type]    [description]
 */
function upfile(id = null) {
  var inputfile = ("input[name=inpfile]");
  if($(inputfile).val() == "") {
    alert("Selecteaza un fisier");
    return false;
  }
  var fmuf = new FormData($("#fmodalupfile")[0]);
  fmuf.append("filetarget", filetarget);
  fmuf.append("fileref", fileref);

  var url = "<?=base_url().$controller_ajax;?>upimg/id/" +id;
  // console.log(url);return;
  var divimgs = "#pagina #p_imgs";
  $.ajax({
    url: url,
    dataType: "JSON",
    data: fmuf,
    mimeTypes: "multipart/form-data",
    cache: false,
    contentType: false,
    processData: false,
    type: 'POST',
    beforeSend: function() {
			$('#inpfileModal').modal('hide');
			// showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
        //PATH_IMG_BANNERS
        upFileSuccess(data.id, data.img);
        $(inputfile).val("");//CLEANINPUTVALUE
      } else if(data.status == 0) {
        //
      }

    }
  });
}

function upFileSuccess(id, img) {
  var div = "p_img" +fileref;
  var imgpath = null;
  if(fileref == "poza") imgpath = "<?=$imgpathitem;?>";
	
  var html =
  '<div id="img' +fileref+ "-" +id+ '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">\
    <div class="img-thumbnail" style="padding:2px;">\
      <img class="img-responsive" src="' +imgpath+img+ '">\
      <div class="thumbfooter">\
        <a href="javascript:void(0)" onClick="return ajxdelimg(' +id+ ', \'' +fileref+ '\');return false"><code-remove>Elimina</code-remove></a>\
      </div>\
    </div>\
  </div>';
  $("#" +div).append(html).hide().fadeIn(700);

  // only for banners(the upload button will hide)
  if (fileref.indexOf("banner") !=-1) {
    $("button#" +fileref+ "btnup").hide();// $("button#" +fileref+ "btnup").hide();
  }
  hideloader();
}
</script>

<!--script luat din views/buletine_meteo/js_item.php -->