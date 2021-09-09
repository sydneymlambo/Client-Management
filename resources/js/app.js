require('./bootstrap');

$(function () {
    $(".modal-btn").on('click', function (e) {
        e.preventDefault();
        $(".modal").removeClass("hide");
    })

    $(".close").on('click', function(e) {
        e.preventDefault();
        $(".modal").addClass("hide");
    })
    
    $(".date").on('change keyup paste', function () {
        alert('dasdasd');
        let date = $(".date").val();
        $('.company_renewal').val(date);
    })

    $('input').attr('autocomplete','off');

    $("#search").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#table tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(document).ready(function(){
        $('select').formSelect();
    });

    $('input#input_text, textarea#textarea2').characterCounter();

    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
})