<template>
	<div id="DocPassRecord">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 过往就诊记录
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>过往就诊记录</h3>
            </div>
        </div>

        <div class="result_wrap">
		  <el-table
		    :data="tableData"
		    style="width: 100%">
		    <el-table-column type="expand">
		      <template scope="props">
		        <p>省: {{ props.row.province }}</p>
		        <p>市: {{ props.row.city }}</p>
		        <p>住址: {{ props.row.detailAddress }}</p>
		        <p>邮编: {{ props.row.zip }}</p>
		      </template>
		    </el-table-column>
		    <el-table-column
		      label="挂号"
		      prop="date">
		    </el-table-column>
		    <el-table-column
		      label="患者姓名"
		      prop="name">
		    </el-table-column>
		  </el-table>
		</div>
	</div>
</template>
<style scoped>
	
</style>
<script>
    export default{
        data() {
            return {
            	tableData:'',
            }
        },
        props: ['user'],
        methods:{
			open(msg) {
                this.$alert(msg, '过往就诊记录', {
                    confirmButtonText: '确定',
                });
            },
            initData(){
            	alert('pass')
            }
        },
        mounted(){
            this.initData();
        }
    }
</script>