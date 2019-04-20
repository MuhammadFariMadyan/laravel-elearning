$(document).ready(function(){
    $('.wys-textarea').wysihtml5();
    $("#Estimasi_Durasi").slider({
        formater: function(value) {
            return 'estimasi: ' + value + ' menit';
        }
    });

    $('textarea').autosize({append: "\n"});

    $('.popover-hover').popover(
        {
            html: true,
            placement: 'auto left',
            trigger: 'hover',
            container: 'body'
        }
    )

    $('#countdown').countdown($('#until').html(), function(event) {
        $(this).html(event.strftime('%H Jam %M Menit %S Detik'));
    });
});