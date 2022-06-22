$('#bulan').change(function(){
    $('#jurnal').html(''),
    $.ajax({
        type: "GET",
        url: "jurnal/jurnal/"+$('#bulan').val(),
        dataType: "html",
        success: function (response) {
            $('#jurnal').html(response)
        }
    });
})

$('.tanggal').change(function(){
    $('#jurnal').html(''),
    $.ajax({
        type: "GET",
        url: "jurnal/jurnal/"+$('#awal').val()+"/"+$('#akhir').val(),
        dataType: "html",
        success: function (response) {
            $('#jurnal').html(response)
        }
    });
})

$('#confirm').click(function (e) { 
    e.preventDefault();
    console.log("admin/validatepass/"+$('#oldpassword').val());
    $.ajax({
        type: "POST",
        url: "admin/validatepass/"+$('#oldpassword').val(),
        dataType: "dataType",
        statusCode: {
            202: function() {
              document.getElementById("update").name = $("#update").data("key");
              document.getElementById("update").value = $("#update").data("value");
              document.formsubmit.submit();
            },
            403: function() {
                document.getElementById("oldpassword").setCustomValidity("Password salah");
                document.formsubmit.reportValidity();
              }
          }
    });
});