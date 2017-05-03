<template>
	<div id="checkPro">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 检查项目
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>检查项目</h3>
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
            	<el-table
			    :data="tableData"
			    border
			    style="width: 100%">
			    <el-table-column
			      label="日期"
			      width="200">
			      <template scope="scope">
			        <el-icon name="time"></el-icon>
			        <span style="margin-left: 10px">{{ scope.row.created_at }}</span>
			      </template>
			    </el-table-column>
			    <el-table-column
			      prop="name"
			      label="姓名"
			      width="180">
			    </el-table-column>
			    <el-table-column
			      prop="proname"
			      label="项目"
			      width="180">
			    </el-table-column>
			    <el-table-column label="操作">
			      <template scope="scope">
			        <el-button
			          size="small"
			          v-show="!scope.row.outprodocID"
			          @click="handleEdit(scope.row.id, scope.row.proname,scope.row.name,scope.row.outdepID)">检查</el-button>
			          <el-button
			          size="small"
			          type="success"
			          v-show="scope.row.outprodocID"
			          @click="handleRead(scope.row.id, scope.row.proname,scope.row.name)">查看</el-button>
			      </template>
			    </el-table-column>
			  </el-table>
            </div>

            <div class="check_block" style="display:none;width:100%">
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
                            {{checkName}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">检查的项目:</th>
                        <td>
                            {{checkProName}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">药物:</th>
                        <td>
                            <el-select v-model="selectDrug" multiple placeholder="请选择">
                            <el-option
                              v-for="index in drugs"
                              :label="index.drugname"
                              :value="index.id">
                            </el-option>
                          </el-select>
                        </td>
                    </tr>
                    <tr>
                        <th width="120">检查结果:</th>
                        <td>
                            <el-input
                              type="textarea"
                              :autosize="{ minRows: 4, maxRows: 8}"
                              placeholder="请输入建议"
                              v-model="suggest">
                            </el-input>
                        </td>
                    </tr>
                </table>
                <el-button type="primary" class="btn" @click="formSubmit">
                    提交
                </el-button>
                <el-button type="danger" class="btn" @click="resetData">
                    返回
                </el-button>
            </div>

            <div class="read_block" style="display:none;width:100%">
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
                            {{checkName}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">检查的项目:</th>
                        <td>
                            {{checkProName}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">检查结果:</th>
                        <td>
                            {{readtable['outresult']}}
                        </td>
                    </tr>
                </table>
                <el-button type="danger" class="btn" @click="readresetData">
                    返回
                </el-button>
            </div>

        </div>
	</div>
</template>
<style scoped>
	#checkPro{
		height:100%;
		overflow-y: auto;
	}
	.add_block,.check_block,.read_block{
		margin-top: 20px;
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
			open(msg) {
                this.$alert(msg, '检查项目', {
                    confirmButtonText: '确定',
                });
            },
            formSubmit(){
            	this.$http({
                    params: {'regid':this.regid,'id':this.checkID,'uid': this.user['id'],'drugs':this.selectDrug,'res':this.suggest},
                    url: "/api/doc/resCheck"
                }).then(function(res){
                    if(res.data.status == 1){
                        location.reload();
                    }else{
                        this.open('填写出错,请重新填写');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
            },
            handleEdit(id, proname,name,outdepID) {
            	$('.add_block').hide();
            	$('.check_block').show();
            	// 查询科室,项目,药物
            	this.checkID = id;
            	this.checkProName = proname;
            	this.checkName = name;
                this.$http({
                    params: {'uid': this.user['id'],'departmentID':outdepID},
                    url: "/api/doc/setinitdata"
                }).then(function(res){
                    if(res.data.status == 1){
                        this.readtable = res.data.data;
                    }else{
                        this.open('请刷新页面');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
		    },
		    handleRead(id, proname,name) {
            	$('.add_block').hide();
            	$('.read_block').show();
            	this.checkID = id;
            	this.checkProName = proname;
            	this.checkName = name;
		    	this.$http({
                    params: {'id':this.checkID},
                    url: "/api/doc/readPro"
                }).then(function(res){
                    if(res.data.status == 1){
                        this.readtable = res.data.data;
                    }else{
                        this.open('请刷新页面');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
		    },
		    resetData(){
		    	$('.add_block').show();
            	$('.check_block').hide();
            	this.checkID = '';
            	this.checkProName = '';
            	this.checkName = '';            	
            	this.selectDrug = '';
            	this.suggest = '';
		    },
		    readresetData(){
				$('.add_block').show();
            	$('.read_block').hide();
            	this.checkID = '';
            	this.checkProName = '';
            	this.checkName = ''; 
            	this.readtable = [];
		    },
            findRegID(){
            	if (this.regid == '') {
                    this.open('挂号ID不能为空')
                }else{
                    this.$http({
                        params: {'regid': this.regid},
                        url: "/api/doc/checkReg"
                    }).then(function(res){
                        if(res.data.status == 1){
                            $('.reg_txt').css('display','block');
                            $('.reg_input').css('display','none');
                            $('.add_block').css('display','block');
                        }else{
                            this.open('挂号ID不可用!!请重新输入');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });

                    this.$http({
                        params: {'regid': this.regid,'depid':this.user['departmentID'],'uid':this.user['id']},
                        url: "/api/doc/checkPro"
                    }).then(function(res){
                        if(res.data.status == 1){
                            this.tableData = res.data.data
                        }else{
                            this.open('该挂号没有要检查的项目!!');
                        }
                    }).catch(function(){
                        alert("请求出错，请联系管理员")
                    });
                }
            }
        },
        mounted(){
            // this.initData();
        }
    }
</script>