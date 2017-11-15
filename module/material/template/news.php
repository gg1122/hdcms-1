<extend file="resource/view/site"/>
<block name="content">
    <link rel="stylesheet" href="{{MODULE_TEMPLATE_PATH}}/css.css">
    <ul class="nav nav-tabs" role="tablist">
        <li><a href="{!! url('site/image') !!}">图片素材列表</a></li>
        <li class="active"><a href="{!! url('site/news') !!}">图文消息列表</a></li>
    </ul>
    <div class="panel panel-default">
        <div class="panel-heading clearfix">
            <h3 class="panel-title pull-left" style="line-height: 2em;">图文列表</h3>

            <div class="btn-group pull-right" role="group" aria-label="...">
                <a href="{!! url('site/postNews') !!}" class="btn btn-success btn-sm ">
                    <i class="fa fa-plus"></i> 新建图文消息
                </a>
                <a href="{!! url('site/syncNews') !!}" class="btn btn-default btn-sm ">
                    <i class="fa fa-cloud-download"></i>与微信服务器同步
                </a>
            </div>
        </div>
        <div class="panel-body" v-cloak id="app">
            <div class="news">
                <div v-for="(m,n) in data" class="lists">
                    <ul>
                        <li v-for="(v,i) in m.data.articles" v-if="i==0">
                            <div class="pic"
                                 :style="{'backgroundImage':'url('+(v.pic?v.pic:'resource/images/nopic.jpg')+')'}">
                                <h3 v-html="v.title"></h3>
                            </div>
                        </li>
                        <!--子图文-->
                        <li class="small clearfix" v-for="(v,i) in m.data.articles" @click="setActionItem(i)"
                            v-if="i>0">
                            <p v-html="v.title"></p>
                            <div class="pic"
                                 :style="{'backgroundImage':'url('+(v.pic?v.pic:'resource/images/nopic.jpg')+')'}"></div>
                        </li>
                        <li class="action">
                            <a :href="'{!! url('site/PostNews') !!}&id='+m.id"><i class="fa fa-trash-o"></i> 编辑</a>&nbsp;&nbsp;
                            <a href="javascript:;" @click="remove(m.id)"><i class="fa fa-pencil-square-o"></i> 删除</a>&nbsp;&nbsp;
                            <a href="javascript:;" @click="send(m.id)"><i class="fa fa-paper-plane-o"></i> 群发</a>&nbsp;&nbsp;
                            <a href="javascript:;" @click="preview(m.id)"><i class="fa fa-eye"></i> 预览</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script>
        require(['hdjs', 'vue'], function (hdjs, Vue) {
            new Vue({
                el: "#app",
                data: {
                    data: <?php echo $data;?>
                },
                methods: {
                    //群发图文
                    send: function (id) {
                        hdjs.confirm('确定发送消息吗?', function () {
                            $.post('{!! url("site/sendNews") !!}', {id: id}, function (res) {
                                if (res.valid == 1) {
                                    hdjs.message(res.message, '', 'success');
                                } else {
                                    hdjs.message(res.message, '', 'error');
                                }
                            }, 'json');
                        });
                    },
                    //发送预览
                    preview: function (id) {
                        var modalobj = hdjs.modal({
                            content: ['{!! url("site.users") !!}'],//加载的远程地址
                            title: '选择发送图文消息的粉丝',
                            width: 800,
                            show: true,
                            id: "preview",
                            events: {
                                'shown.bs.modal': function () {
                                    $("button.user").click(function () {
                                        var uid = $(this).attr('uid');
                                        $.post('{!! url("site/preview") !!}', {id: id, uid: uid}, function (res) {
                                            if (res.valid == 1) {
                                                hdjs.message(res.message, '', 'success');
                                            } else {
                                                hdjs.message(res.message, '', 'error');
                                            }
                                        }, 'json');
                                        modalobj.modal('hide');
                                    })
                                },
                                'hide.bs.modal': function () {
                                }
                            }
                        });
                    },
                    //删除图文
                    remove: function (id) {
                        hdjs.confirm('确定删除图文消息吗?', function () {
                            var loading = hdjs.loading();
                            $.post('{!! url("site/delNews") !!}', {id: id}, function (res) {
                                loading.modal('hide');
                                if (res.valid == 1) {
                                    hdjs.message(res.message, 'refresh', 'success');
                                } else {
                                    hdjs.message(res.message, '', 'error');
                                }
                            }, 'json');
                        });
                    }
                }
            })
        })
    </script>
</block>