<template>
	<div id="DocWriteRecord">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 就诊
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>就诊</h3>
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
                        <th width="120">科室:</th>
                        <td>
                            {{department}}
                        </td>
                    </tr>
                    <tr>
                        <th width="120">需要检查的项目:</th>
                        <td>
                            <el-select v-model="selectProject" multiple placeholder="请选择">
                            <el-option
                              v-for="item in projects"
                              :label="item.proname"
                              :value="item.id"
                              size="large">
                            </el-option>
                          </el-select>
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
                        <th width="120">医生建议:</th>
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
                    重置
                </el-button>
            </div>
        </div>
	</div>
</template>
<style>
	#DocWriteRecord{
		height:100%;
		overflow-y: auto;
	}
    .nb{
        border: none;
    }
    .el-btn{
        margin-left: 5%;
    }
    .btn{
        margin-top: 20px; 
    }
</style>
<script>
    export default{
        data() {
            return {
                regid:'',
                suggest:'',
                department:'',
                projects:'',
                selectProject:'',
                drugs:'',
                selectDrug:''
            }
        },
        props: ['user'],
        methods:{
            initData(){
                // 查询科室,项目,药物
                this.$http({
                    params: {'uid': this.user['id'],'departmentID':this.user['departmentID']},
                    url: "/api/doc/setinitdata"
                }).then(function(res){
                    if(res.data.status == 1){
                        var data = res.data.data;
                        this.department = data.depName[0]['depname'];
                        this.projects = data.projects;
                        this.drugs = data.drugs;
                        console.log(this.drugs);
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
                    'selectDrug':this.selectDrug,
                    'selectProject':this.selectProject,
                    'docid':this.user['id'],
                    'depid':this.user['departmentID'],
                    'suggest':this.suggest},

                    url: "/api/doc/writeRecord"
                }).then(function(res){
                    if(res.data.status == 1){
                        location.href = "/doc/writerecord"
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
                }
            },
            resetData(){
                this.selectDrug = '';
                this.selectProject = '';
                this.suggest = '';
            }
        },
        mounted(){
            this.initData();
        }
    }
</script>