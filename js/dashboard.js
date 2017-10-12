$(document).ready(function() {

    function getData() {

        var formData = {
            'id': 1
        };

        console.log(formData['id']);

        $.ajax({
            type: 'POST',
            url: '',
            data: formData,
            async: false,
            beforeSend: function (xhr) {
                if (xhr && xhr.overrideMimeType) {
                    xhr.overrideMimeType('application/json;charset=utf-8');
                }
            },
            dataType: 'json',
            success: function (data) {
            //Do stuff with the JSON data
            }
        });
    }

    getData();

});