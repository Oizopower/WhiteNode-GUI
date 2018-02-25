$(document).ready(function(){

    /*$.notify({
        icon: 'ti-pulse',
        message: "New block detected <b>307076</b> - Updating dashboard."

    },{
        type: 'success',
        timer: 3000
    });*/

    setInterval(function(){

        var $data = {
            action:  'updatesync'
        };

        var $success = function ($json)
        {
            $("progress.Progress-main").val($json.percentage);
            $("#js--sync").html("<strong>" + $json.percentage + "%</strong> (" + $json.blocks + " / " + $json.height + ")");
        };

        action($data, $success, 'json');

    }, 60000);


    $(document).on('show.bs.modal', function(event){
        var button = $(event.relatedTarget);  // Button that triggered the modal
        var titleData = button.data('title'); // Extract value from data-* attributes
        $(this).find('.modal-title').text(titleData);
    });

    $(document).on("click",'#submitpass',function(e)
    {
        var $formData = $("#unlockpassword").val();

        if($("#unlockpassword").val() != undefined)
        {
            var $data = {
                action:  'unlock',
                unlock: $formData
            };

            var $success = function ($json)
            {
                if($json.message != undefined)
                {
                    $("#js--unlock-error").text($json.message);
                } else {
                    $("#stakepassword").modal('hide');
                    $('.js--unlock-staking-button').hide();
                }
            };

            action($data, $success, 'json');
        }
        e.preventDefault();
    });

    $(document).on("click",'#submitencrypt',function(e)
    {
        var $formData = $("#encryptpassword").val();

        if($("#encryptpassword").val() != undefined)
        {

            var $data = {
                action:  'encrypt',
                encrypt: $formData
            };

            var $success = function ($json)
            {
                if($json.message != undefined)
                {
                    $("#js--encrypt-error").text($json.message);
                } else {
                    $("#encrypt").modal('hide');
                    $('.js--encrypt-button').hide();
                }
            };

            action($data, $success, 'json');
        }
        e.preventDefault();
    });

    $(document).on("click",'#submitchangepasswd',function(e)
    {
        var input = $("#oldpasswdvalue_input").val();
        var config = $("#oldpasswdvalue_conf").val();
        var passwd = $("#changepasswdvalue").val();
        var confirm = $("#confirmpasswdvalue").val();

        console.log("config="+config);
        
        if(input.length==0 || passwd.length ==0 ||confirm.length==0)
        {
            alert('输入为空');
            return;
        }

        if(passwd != confirm){
            alert('两次密码输入不一致');
            return;
        }
        
        
        if($("#changepasswdvalue").val() != undefined)
        {

            var data = {
                action:  'changepasswd',
                passwdinput: input,
                passwdconfig: config,
                passwdchange: passwd
            };

            var success = function (json)
            {
                if(json.message === 'success'){
                    alert('密码修改成功，请等候60秒');
                }else {
                    alert('密码修改失败，旧密码输入有误。');
                }
                $("#changepasswd").modal('hide');
            };

            action(data, success, 'json');
            $("#changepasswd").modal('hide');
        }
        e.preventDefault();
    });

    $(document).on("click",'#js--reboot',function(e)
    {
        var $data = {
            action:  'reboot'
        };

        var $success = function ($json){};

        action($data, $success, 'json');
        e.preventDefault();
    });

    $(document).on("click",'#js--shutdown',function(e)
    {
        var $data = {
            action:  'shutdown'
        };

        var $success = function ($json){};

        action($data, $success, 'json');
        e.preventDefault();
    });

    $(document).on("click",'#js--download',function(e)
    {
        var $data = {
            action:  'download'
        };

        var $success = function ($json){};

        action($data, $success, 'json');
        e.preventDefault();
    });

    // Stake calculator
    var delay = (function(){
        var timer = 0;
        return function(callback, ms){
            clearTimeout (timer);
            timer = setTimeout(callback, ms);
        };
    })();

    $(document).on("keyup",'#js--calc-xwc-amount',function(e)
    {
        delay(function(){
            var $data = {
                action:  'calculatestake',
                amount: $("#js--calc-xwc-amount").val()
            };

            var $success = function ($json)
            {
                var $calculated = $json.calculated
                $("#js--calc-xwc-interest").val(Math.floor($calculated));
            };

            action($data, $success, 'json');

        }, 400 );
    });

    $(document).on("click",'#js-language a',function(e)
    {console.log('lang start')
        var $data = {
            action:  'changelanguage',
            language:  $(this).attr('data-value')
        };

        var $success = function ($json)
        {
          window.location.reload();
        };

        action($data, $success, 'json');
        e.preventDefault();
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

});