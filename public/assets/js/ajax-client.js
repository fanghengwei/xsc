define(['jquery','layer'],function ($,Layer) {
    var AjaxClient = {
        get: function (options, ctx) {
            var success = options.success || $.noop;
            var fail    = options.fail || $.noop;
            delete options.success;
            delete options.fail;
            var index;
            var xhr = $.ajax({
                data: options.data,
                dataType: options.dataType || 'json',
                method: 'GET',
                timeout: options.timeout,
                url: options.url,
                beforeSend: function () {
                    index = Layer.load(2);
                    $('#pagination').hide()
                }
            });

            xhr.done(function (data) {
                Layer.close(index);
                $('#pagination').show();
                if (data.code== 1) {
                    success.call(ctx, data);
                } else{
                    fail.call(ctx, data);
                }
            });
            xhr.fail(function (data) {
                Layer.close(index);
                Toastr.error('参数错误！');
                //1.这里可以对服务器端返回出错时候进行一个公共处理
                // 略
                //2.回调客户端程序具体的请求错误处理
                fail.call(ctx, data);
            });

            return xhr;
        },
        post: function (options, ctx) {
            var success = options.success || $.noop;
            var fail    = options.fail || $.noop;
            delete options.success;
            delete options.fail;
            var index;
            var xhr = $.ajax({
                data: options.data,
                dataType: options.dataType || 'json',
                method: 'POST',
                timeout: options.timeout,
                url: options.url,
                beforeSend: function () {
                    index = Layer.load(2);
                    $('#pagination').hide()
                }
            });

            xhr.done(function (data) {
                Layer.close(index);
                $('#pagination').show();
                if (data.code== 1) {
                    success.call(ctx, data);
                } else{
                    fail.call(ctx, data);
                }
            });
            xhr.fail(function (data) {
                Layer.close(index);
                Toastr.error(data.msg ? data.msg: '参数错误！');
                fail.call(ctx, data);
            });

            return xhr;
        }
    }
    return AjaxClient
})