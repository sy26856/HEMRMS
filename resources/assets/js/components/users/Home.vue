<template>
    <div id="userhome">
        这里是首页
        <br>
        <el-button type="primary" @click="get">请求数据</el-button>

        <!-- 事件委托(给子组件的所有加上get函数)
			<mybutton @click.native="get"></mybutton>
         -->
         <div id="myMessage">
         	{{myMessage}}
         </div>
    </div>
</template>
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