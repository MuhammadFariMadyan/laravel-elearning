$(function(){


        $('#tambahProdi').click(function(){
            $('input+small').text('');
            $('input').parent().removeClass('has-error');
            $('select').parent().removeClass('has-error');

            $('#myModal').modal('show');
            console.log('test');
            return false;
        });


       
        $(document).on('submit', '#formProdi', function(e) {  
            e.preventDefault();
             
            $('input+small').text('');
            $('input').parent().removeClass('has-error');           
             
            $.ajax({
                method: $(this).attr('method'),
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json"
            })
            .done(function(data) {
                $('.alert-success').removeClass('hidden');
                $('#myModal').modal('hide');
                window.location('/prodi');
            })
            .fail(function(data) {
                console.log(data.responeJSON);
                $.each(data.responseJSON, function (key, value) {
                    var input = '#formProdi input[name=' + key + ']';
                    
                    $(input + '+small').text(value);
                    $(input).parent().addClass('has-error');
                });
            });
        });
 
    })