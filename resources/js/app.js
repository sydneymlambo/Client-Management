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

function PrintElem(elem) {
    Popup(jQuery(elem).html());
}

function Popup(data) {
    var mywindow = window.open('', 'my div', 'height=1000,width=1000');
    mywindow.document.write('<html><head><title></title>');
    mywindow.document.write('<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">');
    mywindow.document.write('</head><body>');
    mywindow.document.write(data);
    mywindow.document.write('</body></html>');
    mywindow.document.close();
    mywindow.print();
}

$(".print-btn").on('click', function (e) {
    e.preventDefault();
    window.print();
})