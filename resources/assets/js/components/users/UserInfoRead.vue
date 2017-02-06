<template>
    <div id="userinforead">
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/home">首页</router-link> &raquo; 个人信息查询
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
                    <th width="120">用户名:</th>
                    <td>
                        {{user.name}}
                    </td>
                </tr>
                <tr>
                    <th width="120">身份证:</th>
                    <td>
                        {{user.IDCard}}
                    </td>
                </tr>
                <tr>
                    <th width="120">手机号:</th>
                    <td>
                        {{user.phoneNum}}
                    </td>
                </tr>
                <tr>
                    <th width="120">性别:</th>
                    <td>
                        {{sex}}
                    </td>
                </tr>
                <tr>
                    <th width="120">生日:</th>
                    <td>
                        {{user.birthday}}
                    </td>
                </tr>
                <tr>
                    <th width="120">账号费用:</th>
                    <td>
                        {{user.money}} 元
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <router-link to="/user/infoedit">
                            <el-button type="primary" id="el-btn">
                                <span class="btnMsg">
                                    修改个人信息
                                </span>
                            </el-button>
                        </router-link>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>
<style scoped>
    #el-btn{
        margin-left: 10%;
    }
    .btnMsg{
        margin-left: -10px;
        color: #fff;
    }
</style>
<script>
    export default{
        data() {
            return {
                sex:''
            }
        },
        props:['user'],
        methods:{
            checkSex(){
                var sex = this.user.sex;
                if (sex == 'f'){
                    this.sex = '女性';
                }else if(sex == 'm'){
                    this.sex = '男性';
                }else{
                    this.sex = '未知';
                }
            }
        },
        mounted(){
            this.checkSex();
        }
    }
</script>