/**
 * Created by audric on 12/06/17.
 */
$(document).ready(function () {

    // alert ('mes couilles');
    $('#imgur_select').html(
        '<label for="imgur_img" class="control-label">Uploader votre image</label>' +
        '<input type="file" id="image_selector" class="form-control">'+
        '<img src="none" id="image_preview" class="thumbnail" width="200px"/>'

    );

        $("#image_selector").change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                var data = e.target.result.substr(e.target.result.indexOf(",") + 1, e.target.result.length);
                $("#image_preview").attr("src", e.target.result);
                $.ajax({
                    url: 'https://api.imgur.com/3/image',
                    headers: {
                        'Authorization': 'Client-ID 68fae771c81dac4'
                    },
                    type: 'POST',
                    data: {
                        'image': data,
                        'type': 'base64'
                    },
                    success: function(response) {
                        $('#form_image_url').val( response.data.link);
                    },
                    error: function() {
                        alert("Error while uploading...");
                    }
                });
            };
            reader.readAsDataURL(this.files[0]);
        });
});