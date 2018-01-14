$(function() {
    (function(name) {
        var $success = function ($json)
        {
            if($json.message === 'success'){
                var container = $('#pagination-' + name);
                var sources = $json.transactions;

                var options = {
                    dataSource: sources,
                    callback: function (response, pagination) {
                        //console.log(response);
                        var dataHtml = '<table class="table table-striped">\n' +
                            '                            <thead>\n' +
                            '                                <th>date</th>\n' +
                            '                                <th>account</th>\n' +
                            '                                <th>amount</th>\n' +
                            '                                <th>confirmations</th>\n' +
                            '                                <th>category</th>\n' +
                            '                                <th>explore</th>\n' +
                            '                            </thead>\n' +
                            '                            <tbody>';
                        response.forEach(function (item) {
                            dataHtml += '<tr>';
                            dataHtml += '<td>'+timeFormat(item.time)+'</td>';
                            dataHtml += '<td>'+(item.account != '' ? item.account : item.address)+'</td>';
                            dataHtml += '<td>'+item.amount+'</td>';
                            dataHtml += '<td>'+item.confirmations+'</td>';
                            dataHtml += '<td>'+item.icon+'</td>';
                            dataHtml += '<td><a href="'+response.block_explorer+item.txid+'" target="_blank"><i class="fa fa-external-link" aria-hidden="true"></i></a></td>';
                            dataHtml += '</tr>';
                        });
                        dataHtml += '</tbody></table>';
                        container.prev().html(dataHtml);
                    }
                };


                /*container.addHook('beforeInit', function () {
                    window.console && console.log('beforeInit...');
                });*/

                container.pagination(options);

                /*container.addHook('beforePageOnClick', function () {
                    window.console && console.log('beforePageOnClick...');
                });*/
            }
            else
            {
                alert('error');
            }
        };
        var $data = {
            action: 'listtransaction'
        };

        action($data, $success, 'json');

    })('transaction');

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

function timeFormat(timestamp)
{
    var date = new Date(timestamp * 1000);
    Y = date.getFullYear() + '-';
    M = (date.getMonth()+1 < 10 ? '0'+(date.getMonth()+1) : date.getMonth()+1) + '-';
    D = date.getDate() + ' ';
    h = date.getHours() + ':';
    m = date.getMinutes() + ':';
    s = date.getSeconds();
    time = Y+M+D+h+m+s;
    return time;
}