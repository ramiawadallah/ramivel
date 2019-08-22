$("#checkAll").click(function () {
 	$('input:checkbox').not(this).prop('checked', this.checked);
});

$(document).ready(function() {
  var title = '';
  $("#title").bind('blur', function() {
    title = $(this).val();
        title = title.replace(/\s+/g,'-').replace(/[^a-zA-Z0-9-]/g,'').toLowerCase(); 
    $("#slug").val(title);
  });
});

$(document).ready(function() {
    var name = '';
  $("#name").bind('blur', function() {
    name = $(this).val();
        name = name.replace(/\s+/g,'-').replace(/[^a-zA-Z0-9-]/g,'').toLowerCase(); 
    $("#uri").val(name);
  });
});


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreview').css('background-image', 'url('+e.target.result +')');
            $('#imagePreview').hide();
            $('#imagePreview').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUpload").change(function() {
    readURL(this);
});

function readURLOne(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#imagePreviewOne').css('background-image', 'url('+e.target.result +')');
            $('#imagePreviewOne').hide();
            $('#imagePreviewOne').fadeIn(650);
        }
        reader.readAsDataURL(input.files[0]);
    }
}

$("#imageUploadOne").change(function() {
    readURLOne(this);
});