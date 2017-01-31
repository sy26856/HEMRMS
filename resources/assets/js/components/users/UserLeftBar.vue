<template>
    <ul id="userleftbar">
        <li>
            <h3><i class="el-icon-menu"></i><span>&nbsp;个人信息</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/user/inforead"><i class="el-icon-information"></i>&nbsp;个人信息查询</router-link></li>
                <li><router-link to="/user/infoedit"><i class="el-icon-setting"></i>&nbsp;修改个人信息</router-link></li>
                <li><a href="list.html" target="main"><i class="el-icon-more"></i>&nbsp;过往就医记录</a></li>
                <li><a href="tab.html" target="main"><i class="el-icon-edit"></i>&nbsp;修改登录密码</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-date"></i><span>&nbsp;挂号信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-plus"></i>&nbsp;挂号</a></li>
                <li><a href="list.html" target="main"><i class="el-icon-search"></i>&nbsp;挂号信息查询</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-view"></i><span>&nbsp;门诊信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-view"></i>&nbsp;需要检查的项目</a></li>
                <li><a href="add.html" target="main"><i class="el-icon-document"></i>&nbsp;检查项目结果</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-view"></i><span>&nbsp;住院信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-plus"></i>&nbsp;办理住院手续</a></li>
                <li><a href="add.html" target="main"><i class="el-icon-view"></i>&nbsp;需要检查的项目</a></li>
                <li><a href="add.html" target="main"><i class="el-icon-document"></i>&nbsp;检查项目结果</a></li>
                <li><a href="list.html" target="main"><i class="el-icon-check"></i>&nbsp;办理出院手续</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-document"></i><span>&nbsp;取药信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-message"></i>&nbsp;医生开药</a></li>
                <li><a href="list.html" target="main"><i class="el-icon-share"></i>&nbsp;个人取药信息</a></li>
            </ul>
        </li>
    </ul>
</template>
<script>
    export default {
    }
</script>
