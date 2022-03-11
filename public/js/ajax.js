$('#bulan').change(function(){
    $('#jurnal').html(''),
    $.ajax({
        type: "GET",
        url: "posneraca/jurnal/"+$('#bulan').val(),
        dataType: "html",
        success: function (response) {
            $('#jurnal').html(response)
        }
    });
})