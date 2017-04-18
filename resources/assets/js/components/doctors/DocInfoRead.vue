<template>
	<div id="DocInfoRead">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 医生个人信息查询
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
                    <th width="120">医生姓名:</th>
                    <td>
                        {{user['docname']}}
                    </td>
                </tr>
                <tr>
                    <th width="120">医生工号:</th>
                    <td>
                        {{user['docID']}}
                    </td>
                </tr>
                <tr>
                    <th width="120">身份证:</th>
                    <td>
                        {{user['docIDCard']}}
                    </td>
                </tr>
                <tr>
                    <th width="120">手机号:</th>
                    <td>
                        {{user['docphoneNum']}}
                    </td>
                </tr>
                <tr>
                    <th width="120">性别:</th>
                    <td>
                        {{sex}}
                    </td>
                </tr>
                <tr>
                    <th width="120">医生所处科室:</th>
                    <td>
                        {{department}}
                    </td>
                </tr>
                <tr>
                    <th width="120">医生情况介绍:</th>
                    <td>
                        <p>{{user['docinfo']}}</p>
                    </td>
                </tr>
                <tr>
                    <th width="120">医生入职时间:</th>
                    <td>
                        {{user['created_at']}}
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <router-link to="/doc/infoedit">
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
                sex:'',
                department:""
            }
        },
        props:['user'],
        methods:{
            checkSex(){
                var sex = this.user['docsex'];
                if (sex == 'f'){
                    this.sex = '女性';
                }else if(sex == 'm'){
                    this.sex = '男性';
                }else{
                    this.sex = '未知';
                }
            },
            getDepartmentName(){
            	this.$http({
                        params: {'departmentid': this.user['departmentID']},
                        url: "/api/doc/getDepartmentName"
                    }).then(function(res){
                        if(res.data.status == 1){
                            this.department = res.data.departmentName;
                        }else{
                            this.department = "未知"
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
            }
        },
        mounted(){
            this.checkSex();
            this.getDepartmentName();
        }
    }
</script>





