<template>
    <div id="userhome">
        <!--面包屑导航 开始-->
        <div class="crumb_warp">
            <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
            <i class="fa fa-home"></i> <router-link to="/doc/index">首页</router-link>
        </div>
        <!--面包屑导航 结束-->

        <!--结果集标题与导航组件 开始-->
        <div class="result_wrap">
            <div class="result_title">
                <h3>首页</h3>
            </div>
        </div>
        <!-- <el-button type="primary" @click="get">请求数据</el-button> -->

        <!-- 事件委托(给子组件的所有加上get函数)
			<mybutton @click.native="get"></mybutton>
         -->
         <div class="result_wrap nb">
			<h1>医院电子病历管理系统</h1>
         </div>
    </div>
</template>
<style scoped>
	.nb{
		width: 100%;
		margin-top: 50px;
		text-align: center;
	}
</style>
<script>
	/**
	 * 使用axios要在这里引入axios,不然找不到
	 */
	import axios from 'axios'
	export default {
		data(){
			return {
				myMessage:'默认数据',
			}
		},
		methods:{
			get(){
				axios.get('/api/test').then(function(res){
					console.log(res.data);
				}).catch(function(err){
					console.log(err);
				})

				//vue-resource的写法  直接写vue-resource就好
				// this.$http({
				// 	// method: "get",
				// 	params: {'name': 'hello',}, 
				// 	url: "/api/test"
				// })
				// .then(function(res){
    //                console.log(res.data);
    //            }).catch(function(){
    //                alert("请求出错，请联系管理员")
    //            })
            	// $.ajax({
				// 	url:'/api/test',
				// 	data:{
				// 		msg:'返回数据'
				// 	},
				// 	dataType:"json",
				// 	success:function(data){
				// 		console.log(data);
				// 	}
				// })
			}
		}
	}
</script>