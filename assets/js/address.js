$(function () {
    new Clipboard('#other-address-copy');

    $('[id^=other-address-select]').click(function () {
        $('#other-address-copy').show();
        $('#other-address-delete').show();
        $('#other-address-for-delete').val($(this).attr('id').substring(21));
        $('#other-address-copy').attr('data-clipboard-target','#other-address_value_'+$(this).attr('id').substring(21));
        $(this).addClass('select-item');
        $(this).siblings().removeClass('select-item');
    });


    $('#other-address-delete').click(function(){
        var addr = $('#other-address-for-delete').val();

        var $data = {
            action:  'deleteotheraddress',
            address: addr
        };

        var $success = function ($json)
        {
            if($json.message === 'success'){
                //alert('success');
                location.reload();
            }else{
                alert('error');
            }
        };

        if(confirm("Dletet confirm"))
        {
            action($data, $success, 'json');
        }

    });

    $('#other-address-commit').click(function () {

        var $data = {
            action:  'addaddress',
            addlabel:   $('#other-address-lable').val(),
            addaddress: $('#ohter-address-value').val()
        };

        var $success = function ($json)
        {
            if($json.message === 'success'){

                location.reload();
            }else{
                alert('error');
            }
        };

        action($data, $success, 'json');

    });
});

function action($data, $success, $type)
{

    $.ajax({
        type:     'POST',
        url:      "/Operators/Action.php",
        data:     $data,
        dataType: $type,
        cache:    false,
        success:  $success
    });
}