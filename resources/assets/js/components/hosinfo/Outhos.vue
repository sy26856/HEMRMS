<template>
	<div id="outhos">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 出院手续办理
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>出院手续办理</h3>
            </div>
        </div>
        <!--结果集标题与导航组件 结束-->
        <div class="result_wrap nb">
            <div class="regid">
                <label for="" class="reg_input">
                <span>挂号ID:</span>
                <el-input
                  placeholder="请输入挂号ID"
                  icon="search"
                  v-model="regid"
                  :on-icon-click="findRegID">
                </el-input>
                </label>
                <label for="" class="reg_txt" style="display:none;">
                    <span>挂号ID:</span>
                    <span style="color: #ff0000;">{{regid}}</span>
                </label>
            </div>
            <div class="add_block" style="display:none;width:100%">
            	<table class="add_tab">
                    <tr>
                        <th width="120">患者姓名:</th>
                        <td>
                            {{tableData['name']}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">床位信息:</th>
                        <td>
                            {{tableData['bedsite']}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">床位备注:</th>
                        <td>
                            {{tableData['biremark']}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">住院状态:</th>
                        <td>
                            申请出院
                        </td>
                    </tr>
                </table>
                <el-button type="success" class="btn" @click="submitData">
                    同意出院
                </el-button>
                <el-button type="danger" class="btn" @click="readresetData">
                    返回
                </el-button>
            </div>
        </div>
	</div>
</template>
<style scoped>
	#outhos{
		height:100%;
		overflow-y: auto;
	}
	.nb{
        border: none;
        margin-top: 10px;
    }
</style>
<script>
	export default{
        data() {
            return {
            	regid:'',
            	tableData: [],
            	checkID:'',
            	checkProName:'',
            	checkName:'',
            	drugs:[],
            	selectDrug:'',
            	suggest:'',
            	readtable:''
            }
        },
        props: ['user'],
        methods:{
        	readresetData(){
				location.reload();
		    },
			open(msg) {
                this.$alert(msg, '办理住院手续', {
                    confirmButtonText: '确定',
                });
            },
            submitData(){
				this.$http({
                    params: {'regid': this.regid},
                    url: "/api/doc/outHos"
                }).then(function(res){
                    if(res.data.status == 1){
                    	this.$alert('已经同意出院申请', '出院申请', {
			          confirmButtonText: '确定',
			          callback: action => {
			            location.reload();
			          }
			        });
                    }else{
                        this.open('同意出错,请重新同意');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
            },
            findRegID(){
            	if (this.regid == '') {
                    this.open('挂号ID不能为空')
                }else{
                    this.$http({
                        params: {'regid': this.regid},
                        url: "/api/user/checkInReg"
                    }).then(function(res){
                        if(res.data.status == 1){

		                    this.$http({
		                        params: {'regid': this.regid},
		                        url: "/api/user/checkBed"
		                    }).then(function(res){
		                        if(res.data.status == 1){
		                        	$('.reg_txt').css('display','block');
		                            $('.reg_input').css('display','none');
		                            $('.add_block').css('display','block');
		                            this.tableData = res.data.data
		                        }else{
		                            this.open('该挂号ID没有住院信息');
		                        }
		                    }).catch(function(){
		                        alert("请求出错，请联系管理员")
		                    });
                            
                        }else{
                            this.open('挂号ID不可用!!请重新输入');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                }
            }
        }
    }
</script>