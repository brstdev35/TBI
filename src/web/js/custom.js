$(function () {
    $('#imgupdate').val(0);
    var imgcheck = $('#imgcheck').val();
    if (imgcheck == 1)
    {
        $('#browse').hide();
        $('#removeimage').show();
        $('#remove').show();
    } else {
        $('#browse').show();
        $('#removeimage').hide();
        $('#remove').hide();
    }
    $('body').on('click', '#remove', function (e) {
// $('#remove').click(function(e) {
        $('#removeimage').hide();
        $('#remove').hide();
        $('#browse').show().val('');
        $('#imgupdate').val(1);
        e.preventDefault();
    });
    $("#browse").change(function () {
        readURL(this);
    });
});
function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#removeimage').attr('src', e.target.result).show();
            $('#remove').show();
            $('#browse').hide();
        }

        reader.readAsDataURL(input.files[0]);
    }
}