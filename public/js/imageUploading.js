$().ready(function() {
    
    $('[type="file"]').change(function() {
        
        var fileInput = $(this);
        var isValid = false;
        if (fileInput.length && fileInput[0].files && fileInput[0].files.length)
        {
            isValid = true;
            var url = window.URL || window.webkitURL;
            var image = new Image();
            image.onload = function() {
                alert('Valid Image');
            };
            image.onerror = function() {
                alert('Invalid image');
                isValid = false;
            };

            image.src = url.createObjectURL(fileInput[0].files[0]);
        }

        if (isValid === true) {
            readURL(fileInput);
        }
    });
});


function readURL(fileInput) {
    
    if (fileInput.length && fileInput[0].files && fileInput[0].files.length) {
        
        alert('if worked');
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            $('#img-preview').removeAttr('hidden');
        };
        reader.readAsDataURL(fileInput[0].files[0]);
    }
}