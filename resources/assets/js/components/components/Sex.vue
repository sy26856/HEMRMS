<template>
    <div class="col-md-6">
        <el-radio class="radio" name="sex" v-model="radio" label="m">男性</el-radio>
        <el-radio class="radio" name="sex" v-model="radio" label="f">女性</el-radio>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                radio: 'm'
            };
        }
    }
</script>