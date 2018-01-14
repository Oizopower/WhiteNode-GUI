$(function () {
    new Clipboard('#copyaddress');
    $('[id^=select]').click(function () {
        $('#copyaddress').show();
        $('#signature-btn').show();

        $('#copyaddress').attr('data-clipboard-target','#copy'+$(this).attr('id').substring(6));
        $('.signature-address').val($(this).attr('id').substring(7));
        $(this).addClass('select-item');
        $(this).siblings().removeClass('select-item');
    });

    $('[id^=edit]').dblclick(function(){
        var id = 'input'+$(this).attr('id').substring(4);
        $(this).hide();
        $('#'+id).show();
        $('#'+id).focus();
        // alert(id);
    });

    $('[id^=input]').blur(function(){
        var id = 'edit'+$(this).attr('id').substring(5);
        label = $(this).val();

        var $data = {
            action:  'editaddresslabel',
            newaddress: id.substring(5),
            newlabel: label
        };
        // console.log($data);
        var $success = function ($json)
        {
           location.reload();
        };
        action($data, $success, 'json');
    });

    $('#signature-message-btn').click(function () {
        var $data = {
            action:  'signmessage',
            whitecoinAddress: $('#whitecoin-address').val(),
            signMessage: $('#sign-message').val()
        };
        var $success = function ($json)
        {
            if($json.message === 'success'){
                console.log($json.signature);
                $('#signature').val($json.signature);
            }else{
                alert('error');
            }
        };
        action($data, $success, 'json');
    });

    $('#validation-message-btn').click(function () {
        var $data = {
            action:  'verifymessage',
            whitecoinAddress: $('#whitecoin-address-v').val(),
            signMessage: $('#sign-message-v').val(),
            signature: $('#signature-v').val()
        };
        var $success = function ($json)
        {
            if($json.message === 'success'){
                alert("ok");
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