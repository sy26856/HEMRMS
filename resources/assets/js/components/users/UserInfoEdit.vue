<template>
    <div id="userinfoedit">
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/home">首页</router-link> &raquo; 个人信息修改
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>个人信息查询</h3>
            </div>
        </div>
        <!--结果集标题与导航组件 结束-->

        <div class="result_wrap">
            <table class="add_tab">
                <tr>
                    <th width="120">手机号:</th>
                    <td>
                        <input type="text" class="disabledInput" name="phoneNum" v-model="phoneNum" disabled="disabled" autocomplete="off"> <span>手机号码不能修改</span>
                    </td>
                </tr>
                <tr>
                    <th width="120">用户名:</th>
                    <td>
                        <input type="text" name="name" v-model="name"> <span id="nameMsg" class="red" style="display:none"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120">性别:</th>
                    <td>
                        <div>
                            <el-radio class="radio" v-model="sex" label="m">男性
                            </el-radio>
                            <el-radio class="radio" v-model="sex" label="f">
                                女性
                            </el-radio>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th width="120">生日:</th>
                    <td>
                        <div class="block">
                            <el-date-picker
                                    v-model="birthday"
                                    type="date"
                                    placeholder="请选择日期"
                                    name="birth"
                            >
                            </el-date-picker>
                            <input type="hidden" v-model="birthday" id="birth" name="">
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <el-button type="primary" class="el-btn" @click="submitData">
                            <span class="btnMsg">
                                提交修改
                            </span>
                        </el-button>
                        <el-button type="warning" class="el-btn" @click="initData">
                            <span class="btnMsg">
                                重置修改
                            </span>
                        </el-button>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
<style scoped>
    .el-btn{
        margin-left: 5%;
    }
    .btnMsg{
        margin-left: -10px;
        color: #fff;
    }
    .disabledInput{
        background-color: #eef1f6;
        border-color: #d1dbe5;
        color: #bbb;
        cursor: not-allowed;
    }
    .red{
        color: red;
    }
    .radio + .radio, .checkbox + .checkbox {
         margin-top: 5px; 
    }
</style>
<script>
    export default{
        data() {
            return {
                name:'',
                phoneNum:'',
                sex:'',
                birthday:'',
                birthdata:''
            }
        },
        props: ['user'],
        methods:{
            initData(){
                this.name = this.user.name;
                this.phoneNum = this.user.phoneNum;
                this.birthday = this.user.birthday;
                this.sex = this.user.sex;
            },
            open(msg) {
                this.$alert(msg, '个人信息修改', {
                    confirmButtonText: '确定',
                });
            },
            submitData(){
                this.birthdata = $('#birth').val();
                var flags = 0;
                var checkChinese = /^[\u4e00-\u9fa5]+$/;
                if(this.name === ''){
                    $('#nameMsg').text('用户姓名不能为空');
                    $('#nameMsg').show();
                }else if (!checkChinese.test(this.name)){
                    $('#nameMsg').text('用户姓名只能为中文');
                    $('#nameMsg').show();
                }else{
                    $('#nameMsg').hide();
                    flags += 1;
                }
                //验证生日不能为空
                if($('#birthday').val() === ''){
                    this.birthday = this.user.birthday;
                }

                if (flags) {
                    this.$http({
                        params: {'userid': this.user.id,'name':this.name,'phoneNum':this.phoneNum,'sex':this.sex,'birthday':this.birthdata},
                        url: "/api/user/changeinfo"
                    }).then(function(res){
                        if(res.data.status == 1){
                            this.open('修改个人信息成功');
                            setTimeout(function(){  
                                window.location.reload();//页面刷新
                            },2000);
                        }else{
                            this.open('修改个人信息失败');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                }
            }
        },
        mounted(){
            this.initData();
        }
    }
</script>