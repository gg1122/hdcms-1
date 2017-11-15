/**
 |--------------------------------------------------------------------------
 | 会员相关组件库
 |--------------------------------------------------------------------------
 */
define(['hdjs'], function (hdjs) {
    return {
        //获取会员列表
        lists: function (callback, siteid) {
            var modalobj = hdjs.modal({
                content: ['?s=component/member/lists&siteid=' + window.system.siteid],
                title: '选择前台会员',
                width: 800,
                show: true,
                footer: '<button type="button" class="btn btn-default" data-dismiss="modal">取消</button>'
            });
            window._selectMemberUser = function (user) {
                if ($.isFunction(callback)) {
                    callback(user);
                    modalobj.modal('hide');
                }
            }
        }
    }
});