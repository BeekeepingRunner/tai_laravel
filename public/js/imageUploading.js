$().ready(function() {
    
    $('[type="file"]').change(function() {
        
        alert('change');
        var fileInput = $(this);
        var isValid = false;
        if (fileInput.length && fileInput[0].files && fileInput[0].files.length)
        {
            isValid = true;
            var url = window.URL || window.webkitURL;
            var image = new Image();
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
    
    if (fileInput.length && fileInput[0].files && fileInput[0].files.length)
    {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            $('#img-preview').removeAttr('hidden');
            if( $('#old-img-preview').length) {
                $('#old-img-preview').attr('hidden', true);
            }
        };
        reader.readAsDataURL(fileInput[0].files[0]);
    }
}