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
                        <input type="text" name="phoneNum" v-model="docphoneNum" ><span id="phoneMsg" style="display:none"></span>
                    </td>
                </tr>
                <tr>
                    <th width="120">性别:</th>
                    <td>
                        <div>
                            <el-radio class="radio" v-model="docsex" label="m">男性
                            </el-radio>
                            <el-radio class="radio" v-model="docsex" label="f">
                                女性
                            </el-radio>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th width="120">医生详细情况:</th>
                    <td>
                        <el-input type="textarea" v-model="docinfo"></el-input>
                         <span id="docinfoMsg" style="display:none"></span>
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
                docphoneNum:'',
                docsex:'',
                docinfo:''
            }
        },
        props: ['user'],
        methods:{
            initData(){
                this.docphoneNum = this.user['docphoneNum'];
                this.docsex = this.user['docsex'];
                this.docinfo = this.user['docinfo'];
            },
            open(msg) {
                this.$alert(msg, '个人信息修改', {
                    confirmButtonText: '确定',
                });
            },
            submitData(){
            	var flags = 0;
            	var checkMobile = /^1\d{10}$/;
            	if(this.docphoneNum === ''){
			        $('#phoneMsg').text('电话号码不能为空');
			        $('#phoneMsg').addClass('red').show();
			    }else if(!checkMobile.test(this.docphoneNum)){
			        $('#phoneMsg').text('电话号码格式不正确');
			        $('#phoneMsg').addClass('red').show();
			    }else{
			        $('#phoneMsg').hide();
			        flags += 1;
			    }
			    if (this.docinfo == '') {
			    	$('#docinfoMsg').text('情况介绍不能为空');
			        $('#docinfoMsg').addClass('red').show();
			    }else{
			    	$('#docinfoMsg').hide();
			        flags += 1;
			    }
			    if (flags == 2) {
			    	this.$http({
                        params: {'userid': this.user['id'],'docphoneNum': this.docphoneNum,'docsex':this.docsex,'docinfo':this.docinfo},
                        url: "/api/doc/changeinfo"
                    }).then(function(res){
                        if(res.data.status == 1){
                            this.open('修改个人信息成功,请重新登陆查看修改结果');
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