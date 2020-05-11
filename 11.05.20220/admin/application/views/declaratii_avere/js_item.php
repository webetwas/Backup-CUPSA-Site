<script src="<?=SITE_URL;?>public/scripts/summernote/summernote.min.js" type="text/javascript"></script>
<!-- Chosen -->
<script src="<?=base_url()?>public/assets/js/plugins/chosen/chosen.jquery.js"></script>

<script type="text/javascript">


const pdf = {
	file : <?=(!empty($item->cv_pdf) ? "'" . $item->cv_pdf . "'" : 'null')?>,
	form : document.getElementById('fmodalupfilepdf'),
	modal : document.getElementById('inpfilePdfModal'),
	
	documents_path : '<?=SITE_URL.PATH_DECLARATII_AVERE.'cv_folder';?>',
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
		
		$(this.y).html(html);
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
						<button class="btn btn-link btn-sm" style="color:red;" onClick="pdf.removefile(<?=$item->id_item?>);">Sterge fisier</button>\
					</div>\
			</div>\
		</div>\
		';
		
		$(this.y).html(html);
	};
	
	pdf.removefile = function(atom_id) {
		var url = "<?=base_url().$controller_ajax;?>delpdf/id/" +atom_id;
		
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

	  var url = "<?=base_url().$controller_ajax;?>uppdf/id/" +atom_id;
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
		pdf.render_empty_item();
	}
});


$(document).ready(function() {
	
	$('.chosen-sl-links').chosen({width: "100%"});
    $('.chosen-sl-links').on('change', function(evt, params) {
    console.log(evt, params);

		// console.log("idcontent", idcontent_object);
		
		// console.log($(this).find('option:selected'));
		
		linkRequest(params);
  });
	
	<?php if(!is_null($item)):?>
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
	<?php endif; ?>
});

<?php if(!is_null($item)):?>
function linkRequest(params) {
  var url = "<?=base_url().$controller_ajax;?>linkrequest/id/" + "<?=$uri->id?>";
  $.ajax({
    url: url,
    dataType: "JSON",
    type: 'POST',
		data: { params: params },
    beforeSend: function() {
			showloader();
    },
    success: function( data ) {
      if(data.status == 1) {
				// console.log(data);
				hideloader();
        // $(dimglogo).fadeOut(300, function() { $(this).empty() });
        // $(dimglogo).empty();
        // $(dimglogo).html(btnup).fadeIn(700);
				// upImagesStatus();
      } else if(data.status == 0) {
        //
      }
      // $.map(data, function(item) {
      //  // var = item.item;
      // })

    }
  });
}
<?php endif; ?>


function ajxdelimg(id, ref, an) {
    var url = "<?=base_url().$controller_ajax;?>d/id/" +"<?=$uri->id?>";
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
                removediv("pdf_" +ref+ "_" + an + " #pdf_" +ref+ "-" +id, ref);
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

function removediv(id, ref)
{
    $("#" +id).fadeOut(300, function() { $(this).remove() });
    
    // only for banners(the upload button will hide)
    // if (ref.indexOf("banner") !=-1)
    // {
        // console.log("button#" +ref+ "btnup");
        // $("button#" +ref+ "btnup").attr("style", "visibility:visible");
    // }
    location.reload();
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
function upfile(id = null)
{
    var inputfile_avere = ("input[name=inpfile_avere]");
    var inputfile_interes = ("input[name=inpfile_interes]");
    var select_an = $('#select-an').val();

    if($(inputfile_avere).val() == "" && $(inputfile_interes).val() == "")
    {
        alert("Selecteaza un fisier!");
        return false;
    }

    if(select_an.length === 0)
    {
        alert("Selecteaza anul!");
        return false;
    }

    var fmuf = new FormData($("#fmodalupfile")[0]);
    fmuf.append("filetarget", filetarget);
    fmuf.append("fileref", fileref);
    fmuf.append("an", select_an);

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
          if(data.status == 1)
          {
            //PATH_IMG_BANNERS
            upFileSuccess(data.id, data.pdf_avere, data.pdf_interes, data.an);
            $(inputfile_avere).val("");//CLEANINPUTVALUE
            $(inputfile_interes).val("");//CLEANINPUTVALUE
          }
          else if(data.status == 0)
          {
            //
          }
        }
    });
}

function upFileSuccess(id, pdf_avere, pdf_interes, an)
{
    var div = "";
    var fileref = "";
    var pdf_link = ""

    if(typeof pdf_avere !== 'undefined')
    {
        div = "pdf_avere_" + an;
        fileref = "avere";
        pdf_link = pdf_avere;
        
        var html =
        '<div id="pdf_' +fileref+ "-" +id+ '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">\
            <div style="padding:2px;">\
            <a href="<?=SITE_URL.PATH_DECLARATII_AVERE;?>'+pdf_link+'" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>\
            <div class="thumbfooter">\
            <a href="javascript:void(0)" onClick="return ajxdelimg(' +id+ ', \'' +fileref+ '\', \'' +an+ '\');return false"><code-remove>Elimina</code-remove></a>\
            </div>\
            </div>\
        </div>';

        $("#" + div).append(html).hide().fadeIn(700);
    }

    if(typeof pdf_interes !== 'undefined')
    {
        div = "pdf_interes_"  + an;
        fileref = "interes";
        pdf_link = pdf_interes;

        var html =
        '<div id="pdf_' +fileref+ "-" +id+ '" class="col-lg-2 col-md-4 col-xs-6 col-xs-12 thumb-nomg">\
            <div style="padding:2px;">\
            <a href="<?=SITE_URL.PATH_DECLARATII_AVERE;?>'+pdf_link+'" style="color:red;font-size:20px;" target="_blank"><i class="fa fa-file-pdf-o"></i></a>\
            <div class="thumbfooter">\
            <a href="javascript:void(0)" onClick="return ajxdelimg(' +id+ ', \'' +fileref+ '\', \'' +an+ '\');return false"><code-remove>Elimina</code-remove></a>\
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