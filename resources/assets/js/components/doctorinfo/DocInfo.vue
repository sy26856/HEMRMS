<template>
	<div id="docinfo" style="position:absolute;width:100%; height:100%; overflow:auto">
		<div class="crumb_warp">
			<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
			<i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 医院基本情况 &raquo; 医生基本情况
		</div>
		<!--面包屑导航 结束-->

		<!--结果集标题与导航组件 开始-->
		<div class="result_wrap">
			<div class="result_title">
				<h3>医生基本情况</h3>
			</div>
		</div>
		<!--结果集标题与导航组件 结束-->
		<!--结果页快捷搜索框 开始-->
		<div class="search_wrap">
            <table class="search_tab">
                <tr>
                    <th width="70">姓名:</th>
                    <td><el-input icon="search" v-model="searchName" placeholder="请输入姓名"></el-input></td>
                    <td><el-button @click="searchByName" type="primary">查询</el-button></td>
                </tr>
            </table>
	    </div>

	    <div class="result_wrap">
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                	<router-link to="/doc/adddoc"><i class="el-icon-plus"></i>&nbsp;新增医生</router-link>
                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="doctorsTab">
            <el-table
                    :data="tableData"
                    border
                    style="width: 100%;text-align: center"
                    @selection-change="handleSelectionChange">
                <el-table-column
                        type="selection"
                        width="50">
                </el-table-column>
                <el-table-column
                		prop="docname"
                        label="医生姓名"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="docID"
                        label="医生工号"
                        width="140">
                </el-table-column>
                <el-table-column
                        prop="docphoneNum"
                        label="医生电话"
                        width="140">
                </el-table-column>
                <el-table-column
                        prop="docsex"
                        label="性别"
                        width="100">
                </el-table-column>
                <el-table-column
                        prop="depname"
                        label="科室"
                        width="100">
                </el-table-column>
                <el-table-column label="操作" width="200">
			      <template scope="scope">
			        <el-button
			          size="small"
			          @click="handleEdit(scope.$index, scope.row)">查看</el-button>
			        <el-button
			          size="small"
			          type="danger"
			          @click="handleDelete(scope.$index, scope.row)">删除</el-button>
			      </template>
			    </el-table-column>
            </el-table>
        </div>
        <el-button class="delAll" type="danger">删除所选</el-button>
	</div>
</template>
<style scoped>
	.short_wrap{
		line-height: 30px;
	}
    .doctorsTab{
        margin-top: 30px;
    }
    .delAll{
    	margin-top: 20px;
    	margin-bottom: 30px;
    }
</style>
<script>
	 export default{
	 	data() {
            return {
                searchName:'',
                tableData: [],
                multipleSelection: []
            }
        },
        props: ['user'],
        methods:{
            open(msg) {
                this.$alert(msg, '医生信息查询', {
                    confirmButtonText: '确定',
                });
            },
            handleSelectionChange(val) {
                this.multipleSelection = val;
            },
            initData() {
                this.$http({
                    params: {},
                    url: "/api/doc/getdocinfo"
                }).then(function(res){
                    if(res.data.status == 1){
                        var data = res.data.data;
                        data.forEach(function(item){
							if(item['docsex'] == 'f'){
								item['docsex'] = '女';
							}else{
								item['docsex'] = '男';
							}
						});
                        this.tableData = data;
                    }else{
                        this.open('查询个人信息医生失败');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
            },
            handleEdit(index, row) {
		      console.log(index, row);
		    },
		    handleDelete(index, row) {
		      console.log(index, row);
		    },
		    searchByName(){
		    	if (this.searchName == '') {
		    		this.open('姓名不能为空');
		    		return false;
		    	}
		    	this.$http({
                    params: {'searchName':this.searchName},
                    url: "/api/doc/getonedocinfo"
                }).then(function(res){
                    if(res.data.status == 1){
                        var data = res.data.data;
                        data.forEach(function(item){
							if(item['docsex'] == 'f'){
								item['docsex'] = '女';
							}else{
								item['docsex'] = '男';
							}
						});
                        this.tableData = data;
                    }else{
                        this.open('查询个人信息医生失败');
                    }
                }).catch(function(){
                    alert("请求出错，请联系管理员")
                });
		    	
		    }
        },
         mounted(){
             this.initData();
         }
	 }
</script>