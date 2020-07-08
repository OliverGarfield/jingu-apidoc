<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>接口开放平台</title>
    <link rel="stylesheet" href="../css/public.css" type="text/css">
    <link rel="stylesheet" href="../css/index.css" type="text/css">
    <script src="../js/jquery-3.2.1.min.js"></script>
    <script src="../js/vue.js"></script>
    <script src="../js/public.js"></script>
    <script src="../js/index.js"></script>
</head>
<body>
    <div id="div_body">
        <div id="top">
            <div class="top_center max_div center_div">
                <div class="top_center_left">
                    <div class="div_logo">
                        <img src="../img/logo.png" alt="">
                    </div>
                    <div class="div_title">
                        接口开放平台
                    </div>
                </div>
                <div class="top_center_right">
                    <div class="div_login">
                        <div>登录</div>
                        <div>注册</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="type">
            <div class="type_center max_div center_div">
                <ul>
                    <li v-for="(value,key) in InterfaceList" v-bind:class="{'li_show':type_ID==value.id}" v-on:click="type_ID=value.id">${ value.id }</li>
                </ul>
            </div>
        </div>
        <div id="content">
            <div class="content_center max_div center_div">
                <div v-for="(value,key) in InterfaceList" v-bind:class="{'div_show':type_ID==value.id}" v-bind:id="'div_platformInterface_'+key" v-bind:data="key">
                    <div class="div_menu">
                        <div class="div_menu_input">
                            <div>
                                <div class="div_input">
                                    <div>
                                        <div class="div_icon">
                                            <img src="../img/shousuo.png" alt="">
                                        </div>
                                        <input type="text" v-model="searchData" autocomplete="off" placeholder="搜索......">
                                    </div>
                                </div>
                                <div class="div_button" v-if="if_search" v-on:click="search_button(value.id,key)">
                                    取消
                                </div>
                            </div>
                        </div>
                        <div class="div_menu_list">
                            <div class="div_scrollbar">
                                <ul v-if="!if_search">
                                    <li v-for="(menu,index) in value.dataList">
                                        <div class="li_title li_check " v-bind:class="{'li_show':menu.show}" v-on:click="clickJump(getMadianIdByTitle(index,value.id),value.id,index,null,'div_platformInterface_'+key)">${ menu.title }</div>
                                        <ul class="li_ul">
                                            <li class="li_check" v-for="(menu_li,index2) in menu.data"  v-bind:class="{'li_show':menu_li.show}" v-on:click="clickJump(getMadianIdByTitle_t(index,index2,value.id),value.id,null,index+'_'+index2,'div_platformInterface_'+key)"><div>${ menu_li.title }</div></li>
                                        </ul>
                                    </li>
                                </ul>
                                <ul v-if="if_search" class="ul_shousuo">
                                    <li v-for="(menu,index) in value.dataList">
                                        <ul class="li_ul">
                                            <li class="li_check" v-for="(menu_li,index2) in menu.data" v-if="menu_li.title_show"  v-bind:class="{'li_show':menu_li.show}" v-on:click="clickJump(getMadianIdByTitle_t(index,index2,value.id),value.id,null,index+'_'+index2,'div_platformInterface_'+key)"><div>${ menu_li.title }</div></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="div_list div_scrollbar">
                        <div>
                            <ul>
                                <li  v-for="(li,index) in value.dataList" v-bind:id="getMadianIdByTitle(index,value.id)">
                                    <div class="li_title">${ li.title }</div>
                                    <div class="li_text" >
                                        <ul>
                                            <li v-for="(li_d,index2) in li.data" v-bind:id="getMadianIdByTitle_t(index,index2,value.id)">
                                                <div class="li_name">${ li_d.title }</div>
                                                <div class="li_description">${ li_d.description }</div>
                                                <div class="li_mode">
                                                    <div>
                                                        <div>${ li_d.type }</div>
                                                    </div>
                                                    <div>${ li_d.url }</div>
                                                </div>
                                                <div class="li_tit" v-if="ifShowParameter(li_d.input)">入参</div>
                                                <div class="li_table" v-if="ifShowParameter(li_d.input)">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>字段</th>
                                                            <th>类型</th>
                                                            <th>是否必填</th>
                                                            <th>描述</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="t in li_d.input">
                                                            <td>${ t.key }</td>
                                                            <td>${ t.type }</td>
                                                            <td>${ t.required }</td>
                                                            <td v-html="t.describe">${ t.describe }</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <br/>
                                                <div class="li_tit" v-if="ifShowParameter(li_d.output)">出参</div>
                                                <div class="li_table" v-if="ifShowParameter(li_d.output)">
                                                    <table>
                                                        <thead>
                                                        <tr>
                                                            <th>字段</th>
                                                            <th>类型</th>
                                                            <th>描述</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr v-for="t in li_d.output">
                                                            <td>${ t.key }</td>
                                                            <td>${ t.type }</td>
                                                            <td v-html="t.describe">${ t.describe }</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var vm = new Vue({
            //改变默认变量模板
            delimiters : ['${', '}'],
            el:"#div_body",
            data:{
                searchData:'',
                if_search:false,
                type_ID:0,
                InterfaceList:[]
            },
            created:function(){
                //初始化页面
                this.getTypeId();
                //获取平台接口
                this.getDate();
            },
            computed:{

            },
            methods:{
                getTypeId:function(){
                    var file = this.readFile('./menu.json');
                    for (var key in file)
                    {
                        this.type_ID = key;
                        break;
                    }
                },
                getDate:function () {
                    var file = this.readFile('./menu.json');
                    var data = [];
                    for (var key in file)
                    {
                        data.push({
                            id:key,
                            Scroll:0,
                            dataList:file[key]
                        });
                    }
                    //获取平台接口
                    this.InterfaceList = data;
                },
                //判断Parameter是否为空，为空就隐藏
                ifShowParameter:function (obj) {
                    return obj.length>0?true:false;
                },
                //获取一级标题锚点id
                getMadianIdByTitle:function (index,id) {
                    return "api_"+id+"_"+index;
                },
                //获取二级标题锚点id
                getMadianIdByTitle_t:function (index,index2,id) {
                    return "api_"+id+"_"+index+"_"+index2;
                },
                //点击菜单右边跳转到指定内容位置
                clickJump:function (id,type,index,index2,dom){
                    var h = Math.abs($("#"+id).position().top);
                    $("#"+dom+" .div_list").animate({
                        scrollTop : h
                    },300);
                },
                //取消
                search_button:function(t,key){
                    this.searchData="";
                    this.InterfaceList[key].if_search=false;
                },
                handleScroll:function(e){
                    var key = $(e.target).parent().attr("data");
                    this.InterfaceList[key].Scroll = e.target.scrollTop;
                },
                readFile(filePath) {
                    // 创建一个新的xhr对象
                    let xhr = null
                    if (window.XMLHttpRequest) {
                    xhr = new XMLHttpRequest()
                    } else {
                    // eslint-disable-next-line
                    xhr = new ActiveXObject('Microsoft.XMLHTTP')
                    }
                    const okStatus = document.location.protocol === 'file' ? 0 : 200
                    xhr.open('GET', filePath, false)
                    xhr.overrideMimeType('text/json;charset=utf-8')
                    xhr.send(null)
                    return xhr.status === okStatus ? JSON.parse(xhr.responseText) : null
                },
            },
            mounted:function () {
                window.addEventListener('scroll',this.handleScroll,true)
            },
            watch:{
                searchData(val,oldval) {
                    var _this = this;
                    var data = "";
                    for(var key in _this.InterfaceList)
                    {
                        if(_this.type_ID==_this.InterfaceList[key].id)
                        {
                            data = _this.InterfaceList[key];
                            break;
                        }
                    }
                    if(!_this.if_search){
                        var search = eval("/^.*?"+val+".*?$/");
                        $.each(data.dataList,function (k,v) {
                            $.each(v.data,function (k1,v1) {
                                if(search.test(v1.title)){
                                    console.log(v1.title);
                                    v1.title_show = true;
                                }else{
                                    v1.title_show = false;
                                }
                            });
                        });
                    }
                    if(val.length>0){
                        _this.if_search = true;
                    }else{
                        _this.if_search = false;
                    }
                }
            }
        })
    </script>
</body>
</html>