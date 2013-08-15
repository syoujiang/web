var $uploadURL = '<?php echo $uptoken; ?>';
$(function () {
    'use strict';
    // Initialize the jQuery File Upload widget:
    $('#fileupload').fileupload({
        dataType: 'json',
        redirect:'http://example.org/result.html?%s',
        done:function(e,data){
            var that = $(this).data('blueimp-fileupload') ||
                    $(this).data('fileupload'),
                template,
                deferred;
            if (data.result) 
            {
                var objs=JSON.stringify(data.result);
                alert(data.result.hash);
                var postData = {
                      "action": "insert",
                      "file_key": data.result.hash
                    };

                // 通过AJAX异步向网站业务服务器POST数据
                  $.ajax({
                    type: "POST",
                    url: 'uploadtest/callback',
                    processData: true,
                    data: postData,
                    dataType: "json",
                    beforeSend: function(){},
                    complete: function(xhr, textStatus){
                      if(xhr.readyState ==4)
                      {
                        if(xhr.status ==200)
                        {
                          var obj=JSON.parse(xhr.responseText);
                          // alert(obj.preview);
                          // alert(data.result.name);
                            var file = {
                                  "url": obj.preview,
                                  "thumbnailUrl": obj.preview,
                                  "name":data.result.name

                                };
                            deferred = that._addFinishedDeferreds();
                            that._transition($(this)).done(
                                function () {
                                    var node = $(this);
                                    template = that._renderDownload([file])
                                    .replaceAll(node);
                                    that._forceReflow(template);
                                    that._transition(template).done(
                                    function () {
                                        // data.context = $(this);
                                        that._trigger('completed', e, data);
                                        that._trigger('finished', e, data);
                                        deferred.resolve();
                                    }
                                    );
                                }
                            );
                        }
                      }
                    },
                    success:function(resp){
                    }
                  });       
                // data.context.each(function (index) 
                // {
                    // var file = files[index] ||
                    //         {error: 'Empty file upload result'};
                    // deferred = that._addFinishedDeferreds();
                    // that._transition($(this)).done(
                    //     function () {
                    //         var node = $(this);
                    //         template = that._renderDownload([file])
                    //             .replaceAll(node);
                    //         that._forceReflow(template);
                    //         that._transition(template).done(
                    //             function () {
                    //                 data.context = $(this);
                    //                 that._trigger('completed', e, data);
                    //                 that._trigger('finished', e, data);
                    //                 deferred.resolve();
                    //             }
                    //         );
                    //     }
                    // );
                // });
            } 
            else 
            {
                    template = that._renderDownload(files)[
                        that.options.prependFiles ? 'prependTo' : 'appendTo'
                    ](that.options.filesContainer);
                    that._forceReflow(template);
                    deferred = that._addFinishedDeferreds();
                    that._transition(template).done(
                        function () {
                            data.context = $(this);
                            that._trigger('completed', e, data);
                            that._trigger('finished', e, data);
                            deferred.resolve();
                        }
                    );
                }
        },
        // done: function (e, data) {
        //     console.log(JSON.stringify(data.result)); 
        // }
        // add:function(e,data){
        //      alert("add");
        //     //  var jqXHR=data.submit()
        //     // .success(function (result, textStatus, jqXHR) {
        //     //     alert(textStatus);
        //     //     alert(jqXHR.readyState);
        //     //     // writeObj(jqXHR);
        //     //     var objs=JSON.parse(jqXHR.responseText);
        //     //     alert(objs.hash);
        //     // })
        //     // .error(function (jqXHR, textStatus, errorThrown) {alert("error");/* ... */})
        //     // .complete(function (result, textStatus, jqXHR) {/* ... */});
        // }
    });
});