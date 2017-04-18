<template>
    <div id="guahaoinfo">
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/home">首页</router-link> &raquo; 挂号信息 &raquo; 挂号信息查询
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>挂号信息查询</h3>
            </div>
        </div>
        <!--结果集标题与导航组件 结束-->

        <div class="guahaotable">
            <el-table
            :data="tableData"
            border
            style="width: 100%">
            <el-table-column
              prop="registID"
              label="挂号ID"
              width="180">
            </el-table-column>
            <el-table-column
              prop="diagnose"
              label="挂号情况"
              width="180">
            </el-table-column>
            <el-table-column
              prop="status"
              label="挂号信息"
              width="180">
            </el-table-column>
            <el-table-column
              prop="created_at"
              label="挂号时间"
              width="180">
            </el-table-column>
          </el-table>
        </div>
    </div>
</template>
<style scoped>
#guahaoinfo{
    position:absolute;width:100%; height:100%; overflow:auto
}
</style>
<script>
	export default{
        data() {
            return {
                tableData: [],
            }
        },
        props:['user'],
        methods:{
            initData(){
                this.$http({
                    params: {'uid':this.user['id']},
                    url: "/api/user/getguahaoinfo"
                }).then(function(res){
                    if(res.data.status == 1){
                        var data = res.data.data;
                        data.forEach(function(item){
                            if(item['diagnose'] == 1){
                                item['diagnose'] = '住院';
                            }else{
                                item['diagnose'] = '门诊';
                            }
                            if(item['status'] == 1){
                                item['status'] = '可用';
                            }else{
                                item['status'] = '不可用';
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