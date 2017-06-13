/**
 * Created by banquo on 13/06/17.
 */
$(document).ready(function () {

    // alert ('mes couilles');
    //on insere un champs fictif dans le formulaire
    $('#imgur_select').html(
        '<label for="imgur_img" class="control-label">Uploader votre image</label>' +
        '<input type="file" id="image_selector" class="form-control col-sm-8">' +
        '<div class="row">'+
        '<img src="' + $('#form_image_url').val() + '" id="image_preview" class="thumbnail col-sm-4" width="100%"/>' +
        '</div>'
    );

    //quant il y a action sur l'uploader
    $("#image_selector").change(function() {
        //on commence par montrer le "sablier
        $("#image_preview").attr("src", "https://media.giphy.com/media/sYj2vTqDbMli/giphy.gif");
        //on instancie le reader
        var reader = new FileReader();
        //quant le reader est chargé
        reader.onload = function(e) {
            //on place dans la variable data un gros bordel
            var data = e.target.result.substr(e.target.result.indexOf(",") + 1, e.target.result.length);
            //puis on lance notre requete ajax
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
                    //si ca marche, on fait s'afficher la preview
                    $("#image_preview").attr("src", e.target.result);
                    //et on remplit le champs caché pour la bdd de symfony
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