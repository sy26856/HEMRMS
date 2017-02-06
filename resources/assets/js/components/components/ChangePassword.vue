<template>
<div id="changePsw">
	<div class="crumb_warp">
		<!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
		<i class="fa fa-home"></i> <router-link to="/home">首页</router-link> &raquo; 修改密码
	</div>
	<!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
		<div class="result_title">
			<h3>修改密码</h3>
		</div>
	</div>
	<!--结果集标题与导航组件 结束-->

	<div class="result_wrap">
		<form method="post">
			<input type="hidden" name="_token" value="X25wGVjFqDXvq7vAUAJTjTAHfX0RhkGufucRdzGh">
			<table class="add_tab">
				<tbody>
				<tr>
					<th width="120"><i class="require">*</i>原密码：</th>
					<td>
						<input type="password" name="password_o" v-model="password_o"> <span id="psw_o">请输入原始密码</span>
					</td>
				</tr>
				<tr>
					<th><i class="require">*</i>新密码：</th>
					<td>
						<input type="password" name="password" v-model="password"> <span id="psw">新密码6-20位</span>
					</td>
				</tr>
				<tr>
					<th><i class="require">*</i>确认密码：</th>
					<td>
						<input type="password" name="password_c" v-model="password_c"> <span id="psw_c">请再次输入密码</span>
					</td>
				</tr>
				<tr>
					<th></th>
					<td>
						<el-button @click="submitData" type="primary">
							<span class="btnMsg">提&nbsp;交</span>
						</el-button>
						<el-button @click="resetData" type="warning">
							<span class="btnMsg">重&nbsp;置</span>
						</el-button>
					</td>
				</tr>
				</tbody>
			</table>
		</form>
	</div>
</div>
</template>
<style scoped>
	.btnMsg{
		margin-left: -10px;
		color: #fff;
	}
	.red{
		color: red;
	}
</style>
<script>
	export default {
		data(){
			return{
				password_o:'',
				password:'',
				password_c:'',
			}
		},
		props:['user'],
		methods:{
			resetData(){
				this.password_o = '';
				this.password = '';
				this.password_c = '';
			},
			submitData(){
				var flag = 0;
				if(this.password_o == ''){
					$('#psw_o').addClass('red');
				}else if(this.password_o !== '') {
					this.$http({
						params: {'userid': this.user.id,'password':this.password_o},
						url: "/api/user/checkpsw"
					})
					.then(function(res){
						if(res.data.status == 0){
							$('#psw_o').addClass('red');
							$('#psw_o').text('旧密码不正确,请重新填写');
						}else{
							$('#psw_o').removeClass('red');
							flag += 1;
							if(flag == 3){
								this.$http({
									params: {'userid': this.user.id,'password':this.password},
									url: "/api/user/changepsw"
								}).then(function(res){
									console.log(res.data.status);
									if(res.data.status == 1){
										this.open('修改密码成功');
									}else{
										this.open('修改密码失败');
									}
								}).catch(function(){
									alert("请求出错，请联系管理员")
								})
							}
						}
					}).catch(function(){
						alert("请求出错，请联系管理员")
					})
				}else {
					$('#psw_o').removeClass('red');
					flag += 1;
				};
				if(this.password == '' || this.password.length > 20 || this.password.length < 6){
					$('#psw').addClass('red');
				}else {
						$('#psw').removeClass('red');
						flag += 1;
				};
				if(this.password_c == '' || this.password_c !== this.password){
					$('#psw_c').addClass('red');
					$('#psw_c').text('输入密码不一致,请重新输入');
				}else{
					$('#psw_c').removeClass('red');
					flag += 1;
				};
			},
			open(msg) {
				this.$alert(msg, '标题名称', {
					confirmButtonText: '确定',
				});
			}
		}
	}
</script>