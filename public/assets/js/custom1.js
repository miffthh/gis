$("#photo2").change(function (){
    previewImage2(this);
});

function previewImage2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-view2').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
