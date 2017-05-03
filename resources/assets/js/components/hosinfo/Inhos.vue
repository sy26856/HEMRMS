<template>
	<div id="inhos">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 住院手续办理
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>住院手续办理</h3>
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
                        <th width="120">医生姓名:</th>
                        <td>
                            {{user['docname']}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">患者姓名:</th>
                        <td>
                            {{username}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">空余的床位:</th>
                        <td>
                            <el-select v-model="selectBed" clearable placeholder="请选择">
                            <el-option
                              v-for="item in beds"
                              :label="item.bedsite"
                              :value="item.id"
                              size="large">
                            </el-option>
                          </el-select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120">床位备注:</th>
                        <td>
                            <el-input
                              type="textarea"
                              :autosize="{ minRows: 4, maxRows: 8}"
                              placeholder="请输入备注"
                              v-model="mark">
                            </el-input>
                        </td>
                    </tr>
                </table>
                <el-button type="primary" class="btn" @click="formSubmit">
                    同意
                </el-button>
                <el-button type="danger" class="btn" @click="resetData">
                    不同意
                </el-button>
            </div>
        </div>
	</div>
</template>
<style scoped>
	#inhos{
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
                beds:'',
                username:'',
                selectBed:'',
                mark:''
            }
        },
        props: ['user'],
        methods:{
            initData(){
                // 查询床位空余
                this.$http({
                    params: {},
                    url: "/api/bed/bedSpare"
                }).then(function(res){
                    if(res.data.status == 1){
                        this.beds = res.data.data;
                       	
                    }else{
                        this.open('请刷新页面');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
            },
            open(msg) {
                this.$alert(msg, '就诊', {
                    confirmButtonText: '确定',
                });
            },
            formSubmit(){
                this.$http({
                    method: "post",
                    params: {
                    'regid': this.regid,
                    'bedids':this.selectBed,
                    'uid':this.user['id'],
                    'mark':this.mark},
                    url: "/api/bed/addInfo"
                }).then(function(res){
                    if(res.data.status == 1){
                        location.reload();
                    }else{
                        this.open('输入插入出错,请重新填写');
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
                        url: "/api/doc/checkHosReg"
                    }).then(function(res){
                        if(res.data.status == 1){
                        	this.$http({
		                        params: {'regid': this.regid},
		                        url: "/api/user/checkBed"
		                    }).then(function(res){
		                        if(res.data.status == 1){
		                        	this.open('已有床位,不可重复申请')
		                        }else{
		                            $('.reg_txt').css('display','block');
		                            $('.reg_input').css('display','none');
		                            $('.add_block').css('display','block');
		                            this.tableData = res.data.data
		                        }
		                    }).catch(function(){
		                        alert("请求出错，请联系管理员")
		                    });
                            
                        }else{
                            this.open('挂号ID不是可用的住院ID!!!');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                    // 获得患者姓名
                    this.$http({
                        params: {'regid': this.regid},
                        url: "/api/doc/getName"
                    }).then(function(res){
                        if(res.data.status == 1){
                            this.username = res.data.data[0]['name'];
                        }else{
                            this.open('挂号ID不可用!!请重新输入');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                }
            },
            resetData(){
            	$('.reg_txt').css('display','none');
                $('.reg_input').css('display','block');
                $('.add_block').css('display','none');
                this.regid= '',
                this.beds = '';
                this.username = '';
                this.selectBed = '';
                this.mark = '';
            }
        },
        mounted(){
            this.initData();
        }
    }
</script>