<template>
	<div id="TodayRecord">
		<!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link> &raquo; 今日就诊记录
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>今日就诊记录</h3>
            </div>
        </div>
		
		<div class="result_wrap">
		  <el-table
		    :data="tableData"
		    style="width: 100%">
		    <el-table-column type="expand">
		      <template scope="props">
		        <p>医生建议: {{ props.row.suggest }}</p>
		        <p>就诊时间: {{ props.row.data }}</p>
		        <p>药物: {{ props.row.drugs }}</p>
		        <p>检查项目: {{ props.row.pros }}</p>
		      </template>
		    </el-table-column>
		    <el-table-column
		      label="挂号"
		      prop="regid">
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
            	tableData: [{
			          date: '2017-04-17 21:25:38',
			          name: '刘二三',
			          suggest: '测试数据1',
			          pros: '急诊项目1,急诊项目3,急诊项目4',
			          drugs: '急诊药物1,急诊药物2,急诊药物3,急诊药物5',
			          regid: '069654829300170416',
			        }, {
			          date: '2017-04-17 21:25:38',
			          name: '张三',
			          suggest: '测试数据2',
			          pros: '急诊项目1,急诊项目2,急诊项目4',
			          drugs: '急诊药物4,急诊药物5',
			          regid: '069654829300170417',
			        },  {
			          date: '2017-04-17 21:25:38',
			          name: '李四',
			          suggest: '测试数据3',
			          pros: '急诊项目3,急诊项目5',
			          drugs: '急诊药物1,急诊药物2',
			          regid: '069654829300170419',
			        }]
            }
        },
        props: ['user'],
        methods:{
			open(msg) {
                this.$alert(msg, '今日就诊记录', {
                    confirmButtonText: '确定',
                });
            },
            initData(){
            	// this.$http({
             //        params: {'uid': this.user['id'],'depid': this.user['departmentID']},
             //        url: "/api/doc/getTodayRecord"
             //    }).then(function(res){
             //        if(res.data.status == 1){
             //            this.tableData = res.data.data;
             //        }else{
             //            this.open('修改个人信息失败');
             //        }
             //    }).catch(function(){
             //        alert("请求出错，请联系管理员")
             //    });
            }
        },
        mounted(){
            this.initData();
        }
    }
</script>