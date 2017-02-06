<template>
	<div id="regist">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/home">首页</router-link> &raquo; 在线挂号
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>在线挂号</h3>
            </div>
        </div>
        <!--结果集标题与导航组件 结束-->
        <div class="result_wrap">
        	<div id="outMsg" style="display:none">
            	<el-alert
				    title="您有可用的门诊/急诊挂号号码,不需要再挂门诊/急诊号(前往挂号信息查询)"
				    type="info"
				    description= ''
				    show-icon>
				  </el-alert>
            </div>
            <div id="innerMsg" style="display:none">
            	<el-alert
				    title="您有可用的住院挂号号码,不需要再挂住院号(前往挂号信息查询)"
				    type="info"
				    description= ""
				    show-icon>
				</el-alert>
            </div>
            <div id="showAlert">
            	<el-alert title="账号费用已经低于10元" type="warning" close-text="知道了"></el-alert>
            </div>
            <div class="right mar_ten">
            	<h4>账号余额:<span id="money">{{user.money}}</span>元</h4>
            </div>
            <div class="left">
            	<div class="mar_ten">
            		<h4>挂号姓名: {{user.name}}</h4>
            	</div>
            	<div class="mar_ten" >
	            	<h4>挂号类型:</h4>
	            	<el-select v-model="diagnose" name="diagnose" clearable placeholder="请选择">
					    <el-option
					      v-for="item in options"
					      :label="item.label"
					      :value="item.value">
					    </el-option>
					</el-select>
					<span class="red" id="diagnoseMsg" style="display:none;">
						&nbsp;请先选择挂号类型
					</span>
	            </div>
                <div class="mar_ten">
                    <h4>挂号ID:&nbsp;</h4>
                    <span id="registID">
                        {{registID}}
                    </span>
                </div>
                <el-button type="primary" class="el-btn" @click="submitData">&nbsp;
                    <span class="btnMsg">
                        生成挂号ID
                    </span>
                </el-button>
            </div>
            <div id="errorMsg" class="mar_ten" style="display:none">
            	<el-alert
				    title="挂号失败,请联系工作人员"
				    type="error"
				    :closable="false"
				    show-icon>
				</el-alert>
            </div>
            
        </div>
	</div>
</template>
<style scoped>
    h4{
        display: inline;
    }
    .mar_ten{
        margin-top: 10px;
    }
	.left{
		float: left;
        color:#1F2D3D;
        margin-left: 5%;
	}
    .red{
        color: #FF4949;
    }
	.right{
		float: right;
        color:#1F2D3D;
        margin-right: 5%;
	}
    .el-btn{
        margin-top: 10px;
    }
    .btnMsg{
        margin-left: 0px;
        color: #fff;
    }
    #showAlert{
    	display: none;
    }
</style>
<script>
    export default{
        data() {
            return {
            	options: [
            	{
		          value: '0',
		          label: '门诊'
		        },
            	{
		          value: '0',
		          label: '急诊'
		        }, {
		          value: '1',
		          label: '住院'
		        }],
                diagnose: '',
                registID:'还未生成',
                errorID:'',
            }
        },
        props: ['user'],
        mounted(){
        	if(parseFloat(this.user.money) <= 10){
        		$('#showAlert').show();
        	};
        	this.issetRegID();
        },	
        methods:{
        	issetRegID(){
        		this.$http({
                    params: {'userid': this.user.id},
                    url: "/api/user/checkRegID"
                }).then(function(res){
                	if(res.data.status == 1){
                		console.log(res.data.regInnerID);
                		if(res.data.regInnerID !== null){
                			$("#innerMsg").show();
                		}else{
                			$("#innerMsg").hide();
                		}
                		if (res.data.regOutID !== null) {
                			$("#outMsg").show();
                		}else{
                			$("#outMsg").hide();
                		}
                	}
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
        	},
            open(msg,text) {
                this.$alert(msg, '挂号', {
                    confirmButtonText: text,
                });
            },
            submitData(){
            	if (this.user.money < 5) {
            		this.open('请先去充值,账户余额少于挂号费用 !','知道了');
            	}else if (this.diagnose == '') {
                	$('#diagnoseMsg').show();
                }else{
                	$('#diagnoseMsg').hide();
                	this.$http({
                        params: {'userid': this.user.id,'diagnose':this.diagnose,'phoneNum':this.user.phoneNum},
                        url: "/api/user/makeregister"
                    }).then(function(res){
                    	if(res.data.status == 1){
                    		$("#money").text(parseFloat(this.user.money) - 5);
                    		this.registID = res.data.registID;
                    		$("#registID").addClass('red');
                    		$('#registID').text(this.registID);
                    		this.open('挂号成功','确定');
                    	}else{
                    		this.errorID = res.data.id;
                    		$('#errorMsg').show()
                    	}
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                }
            }
        }
    }
</script>