<script type="text/javascript">
<?php
    if(isset($uri->item) && $uri->item == 'i')
    {
?>
function generatePasswordAddUser()
{
    var url = "<?=base_url().$controller_pass;?>";

    $.ajax({
        url: url,
        dataType: "JSON",
        data: { fileid:"x" },
        cache: false,
        type: 'POST',
        success: function( data )
        {
            if(data.status == 1)
            {
                $('#new__password').val(data.new_password );
            }
        }
    });
}
generatePasswordAddUser();


$(document).ready(function() {
    $('.iCheck-helper').on('click', function(event){
        if($('input[name="sendemail__to_user"]').is(':checked'))
        {
            $('#sendemail__to_user').val('1');
        }
        else
        {
            $('#sendemail__to_user').val('0');
        }
    });
});

<?php
    }
    if(isset($uri->item))
    {
?>
$('.hide__password, .cancel__password').hide();
function generatePassword()
{
    var url = "<?=base_url().$controller_pass;?>";

    $.ajax({
        url: url,
        dataType: "JSON",
        data: { fileid:"x" },
        cache: false,
        type: 'POST',
        beforeSend: function()
        {
            showloader();
        },
        success: function( data )
        {
            if(data.status == 1)
            {
                hideloader();
                $('.generate__password').hide();
                $('#new__password').clone().attr({ type: 'text', value: data.new_password }).insertAfter('#new__password').prev().remove();
                $('.hide__password, .cancel__password ').show();
            }
            else if(data.status == 0)
            {

            }
        }
    });
}

function hidePassword(event)
{
    if($('#new__password').hasClass("ascuns"))
    {
        $('#new__password').attr('type', 'text');
        $('#new__password').removeClass('ascuns');
        $(event).html('').html('<i class="fa fa-eye-slash"></i> Ascunde');
    }
    else
    {
        $('#new__password').attr('type', 'password');
        $('#new__password').addClass('ascuns');
        $(event).html('').html('<i class="fa fa-eye"></i> Arată');
    }
}

function cancelPassword(event)
{
    $('.hide__password, .cancel__password ').hide();
    $('.generate__password').show();
    $('#new__password').attr('type', 'hidden');
}

// document.getElementById("uploadBtn").onchange = function () {
    // document.getElementById("uploadFile").value = this.value;
// };

function filesetvars(target, ref = null)
{
  filetarget = target;
  fileref = ref;
}

function upfile(id = null)
{
    var inputfile = ("input[name=inpfile]");
    if($(inputfile).val() == "")
    {
        alert("Selecteaza un fisier!");
        return false;
    }

    var fmuf = new FormData($("#fmodalupfile")[0]);
    fmuf.append("filetarget", filetarget);
    fmuf.append("fileref", fileref);

    var url = "<?=base_url().$controller_ajax;?>upimg/id/" +id;

    $.ajax({
        url: url,
        dataType: "JSON",
        data: fmuf,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        beforeSend: function() {
            showloader();
        },
        success: function( data )
        {
            if(data.status == 1)
            {
                hideloader();
                $('#inpfileModal').modal('hide');
                $('#inpfileModal').on('hidden.bs.modal', function () {
                    $("#utilizator__poza__profil").find('img').attr('src', '<?=$imgpathlogo;?>' + data.img);
                    $("#remove__profile_picture").show();
                    $(inputfile).val("");
                });
            }
            else if(data.status == 0)
            {
            //
            }
        }
    });
}

function ajxdelimg(id, ref)
{
    var url = "<?=base_url().$controller_ajax;?>d/id/" +"<?=(isset($uri->id) ? $uri->id : '');?>";

    $.ajax({
        url: url,
        dataType: "JSON",
        data: { fileid:id, fileref:ref },
        type: 'POST',
        beforeSend: function() {
            showloader();
        },
        success: function( data )
        {
            if(data.status == 1)
            {
                hideloader();
                removediv(id, ref);
                // location.reload();
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
    // $("#utilizator__poza__profil").find('img').fadeOut(300, function() { $(this).remove() });
    $("#utilizator__poza__profil").find('img').attr('src', '<?=$imgpathlogo;?>' + 'no-photo.png');
    $("#remove__profile_picture").hide();

    if (ref.indexOf("banner") !=-1)
    {
        console.log("button#" +ref+ "btnup");
        $("button#" +ref+ "btnup").attr("style", "visibility:visible");
    }
}
<?php
    }
    if(!isset($uri->item))
    {
?>
function deleteUser(id = null)
{
    var url = "<?=base_url().$controller_fake;?>/item/d/id/" + id;

    $.ajax({
        url: url,
        dataType: "JSON",
        data: { fileid:id },
        type: 'POST',
        beforeSend: function() {
            // showloader();
        },
        success: function( data )
        {
            if(data.status == 1)
            {
                // hideloader();
                window.location = "<?=base_url() . $controller_fake;?>";
            }
            else if(data.status == 0)
            {

            }
        }
    });
}
$('.sterge__utilizator').click(function () {
    var id = $(this).attr('id');
    swal({
        title: "Eşti sigur?",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Da, şterge!",
        closeOnConfirm: true
    }, function () {
        window.location = "<?=base_url().$controller_fake;?>/item/d/id/" + id;
    });
});
<?php
    }
?>
</script>