/**
 * Created by audric on 12/06/17.
 */
$(document).ready(function () {

    // alert ('mes couilles');
    $('#imgur_select').html(
        '<form method="POST" id="test" novalidate="novalidate" enctype="multipart/form-data">'+
        '<label for="imgur_img" class="control-label">Uploader votre image</label>'+
        '<input type="file" id="imgur_img" class="form-control">'+
        '</form>');

    $('#imgur_img').change(function () {

        // var form = new FormData($('#test'));
        //
        // var settings = {
        //     "async": true,
        //     "crossDomain": true,
        //     "url": "https://api.imgur.com/3/image",
        //     "method": "POST",
        //     "headers": {
        //         "authorization": "Client-ID 68fae771c81dac4"
        //     },
        //     "processData": false,
        //     "contentType": false,
        //     "mimeType": "multipart/form-data",
        //     "data": {image : $('#imgur_img').prop("files")["name"]}
        // };
        $.ajax({
            url: 'https://api.imgur.com/3/image',
            headers: {
                'Authorization': 'Client-ID 68fae771c81dac4'
            },
            type: 'POST',
            data: {
                'image': $('#imgur_img').prop("files")["name"]
            },
            success: function() { console.log('cool'); }
        });
        $.ajax(settings).done(function (response) {
            console.log(response);
        });
    })

});