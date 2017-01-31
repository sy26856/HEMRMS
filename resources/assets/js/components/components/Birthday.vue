<template>
    <div class="col-md-6">
        <div class="block">
            <el-date-picker
                    v-model="birth"
                    type="date"
                    placeholder="请选择日期"
                    name="birth"
            >
            </el-date-picker>
            <input type="hidden" id="birthday" name="birthday" v-model="birth">
        </div>
    </div>
</template>
<script>
    export default {
        data() {
            return {
                birth:'',
            }
        }
    }
</script>