<template>
	<div id="DocInfoEdit">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 医生个人信息修改
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>个人信息修改</h3>
            </div>
        </div>
        <!--结果集标题与导航组件 结束-->
        <div class="result_wrap">
            <table class="add_tab">
                <tr>
                    <th width="120">手机号:</th>
                    <td>
                        <input type="text" class="disabledInput" name="phoneNum" v-model="phoneNum" > <span></span>
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
    }
</script>	