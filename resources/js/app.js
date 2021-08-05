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
})