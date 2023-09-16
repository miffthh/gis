$("#photo3").change(function (){
    previewImage3(this);
});

function previewImage3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-view3').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
