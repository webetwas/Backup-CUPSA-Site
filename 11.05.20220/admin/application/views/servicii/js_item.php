<script src="<?=SITE_URL;?>public/scripts/summernote/summernote.min.js" type="text/javascript"></script>
<!-- Chosen -->
<script src="<?=base_url()?>public/assets/js/plugins/chosen/chosen.jquery.js"></script>

<script type="text/javascript">
$(document).ready(function() {
	
	$('.chosen-sl-links').chosen({width: "100%"});
  $('.chosen-sl-links').on('change', function(evt, params) {
    console.log(evt, params);

		// console.log("idcontent", idcontent_object);
		
		// console.log($(this).find('option:selected'));
		
		linkRequest(params);
  });
$('.choose_breadcrumbs').chosen({width: "100%"});
$('.choose_breadcrumbs').on('change', function(evt, params) {
	// console.log(evt, params);
	
	insert_breadcrumbs_assoc(params);
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
});
<?php if(!is_null($item)): ?>
function insert_breadcrumbs_assoc(params) {
	
	$.ajax({
	url: '<?=base_url()?>servicii/insert_breadcrumbs_assoc/',
	dataType: "JSON",
	type: 'POST',
	data: { id_page : <?=$item->atom_id?>, params : params },
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

<?php if(!is_null($item)): ?>
function request_proiect_assoc(params) {
	$.ajax({
	url: '<?=base_url()?>servicii/chosen_request_page_assoc/',
	dataType: "JSON",
	type: 'POST',
	data: { atom_id : <?=$item->atom_id?>, params : params },
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

// PDF
function ajxdelpdf(id, ref, an) {
    var url = "<?=base_url().$controller_ajax;?>delete_pdf/id/" +"<?=$uri->id?>";
    $.ajax({
        url: url,
        dataType: "JSON",
        data: { fileid:id, fileref:ref, an:an },
        type: 'POST',
        beforeSend: function() {
                showloader();
        },
        success: function( data )
        {
            if(data.status == 1)
            { 
                hideloader();
                removedivpdf("pdf_" + id, ref);
                // $(divimgs+id).fadeOut(300, function() { $(this).remove() });
                        // upImagesStatus();
            }
          else if(data.status == 0)
            {
                //
            }
        }
    });
}

function removedivpdf(id, ref)
{
    $("#" +id).fadeOut(300, function() { $(this).remove() });
    location.reload();
}


/**
 * [upfile description]
 * @param  [type] id [description]
 * @return [type]    [description]
 */
function upfilePdf(id = null)
{
    var inpfile_pdf = ("input[name=inpfile_pdf]");

    if($(inpfile_pdf).val() == "")
    {
        alert("Selecteaza un fisier!");
        return false;
    }

    var fmuf = new FormData($("#fmodalupfilepdf")[0]);
    fmuf.append("filetarget", filetarget);
    fmuf.append("fileref", fileref);

    var url = "<?=base_url().$controller_ajax;?>upload_pdf/id/" +id;

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
            $('#inpfileModalPDF').modal('hide');
            // showloader();
        },
        success: function( data ) {
          if(data.status == 1)
          {
                //PATH_IMG_BANNERS
                upFileSuccessPdf(data.id, data.pdf);
                $(inpfile_pdf).val("");//CLEANINPUTVALUE
                $('#upload__pdf').hide();
          }
          else if(data.status == 0)
          {
            //
          }
        }
    });
}

function upFileSuccessPdf(id, pdf)
{
    var div = "";
    var fileref = "";
    var pdf_link = ""

    if(typeof pdf !== 'undefined')
    {
        div = "file_pdf";
        fileref = "avere";
        pdf_link = pdf;
        
        var html =
        '<div id="pdf_' +id+ '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">\
            <div style="padding:2px;">\
            <a href="<?=SITE_URL.PATH_SERVICII_PDF;?>'+pdf_link+'" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>\
            <div class="thumbfooter">\
            <a href="javascript:void(0)" onClick="return ajxdelpdf(' +id+ ', \'pdf\',);return false"><code-remove>Elimina</code-remove></a>\
            </div>\
            </div>\
        </div>';

        $("#" + div).append(html).hide().fadeIn(700);
    }

    // only for banners(the upload button will hide)
        // if (fileref.indexOf("banner") !=-1)
        // {
            // $("button#" +fileref+ "btnup").hide();// $("button#" +fileref+ "btnup").hide();
        // }
    hideloader();
}
</script>