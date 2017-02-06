<template>
    <el-button type="text" @click="confirm">
        退出登录
    </el-button>
</template>

<script>
    export default {
        methods: {
            confirm() {
                this.$confirm('是否确定退出登陆?', '提示', {
                    confirmButtonText: '确定',
                    cancelButtonText: '返回',
                    type: 'warning'
                }).then(() => {
                    this.$message({
                    type: 'success',
                    message: '退出登陆成功!'
                });
                $('#logout-form').submit();
            }).catch(() => {
            });
            }
        }
    }
</script>
<style>

</style>