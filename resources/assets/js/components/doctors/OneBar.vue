<template>
	<ul id="onebar">
        <li>
            <h3><i class="el-icon-menu"></i><span>&nbsp;个人信息</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/inforead"><i class="el-icon-information"></i>&nbsp;个人信息查询</router-link></li>
                <li><router-link to="/doc/infoedit"><i class="el-icon-setting"></i>&nbsp;修改个人信息</router-link></li>
                <li><router-link to="/doc/changepsw"><i class="el-icon-edit"></i>&nbsp;修改登录密码</router-link></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-setting"></i><span>&nbsp;医院基本信息</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/docinfo"><i class="el-icon-message"></i>&nbsp;医生基本情况</router-link></li>
                <li><router-link to="/doc/depinfo"><i class="el-icon-edit"></i>&nbsp;科室基本情况</router-link></li>
                <li><router-link to="/doc/bedinfo"><i class="el-icon-menu"></i>&nbsp;床位基本情况</router-link></li>
                <li><router-link to="/doc/proinfo"><i class="el-icon-star-on"></i>&nbsp;项目基本情况</router-link></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-date"></i><span>&nbsp;挂号信息</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/guahaostatisic"><i class="el-icon-plus"></i>&nbsp;挂号信息统计</router-link></li>
                <li><router-link to="/doc/guahaoinfo"><i class="el-icon-search"></i>&nbsp;挂号信息查询</router-link></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-view"></i><span>&nbsp;门诊信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-view"></i>&nbsp;门诊情况查看</a></li>
                <li><a href="add.html" target="main"><i class="el-icon-document"></i>&nbsp;门诊项目统计</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-view"></i><span>&nbsp;住院信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-plus"></i>&nbsp;住院手续查看</a></li>
                <li><a href="add.html" target="main"><i class="el-icon-view"></i>&nbsp;住院情况查看</a></li>
                <li><a href="list.html" target="main"><i class="el-icon-check"></i>&nbsp;出院手续查看</a></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-document"></i><span>&nbsp;取药信息</span></h3>
            <ul class="sub_menu">
                <li><a href="add.html" target="main"><i class="el-icon-message"></i>&nbsp;药物信息查看</a></li>
                <li><a href="list.html" target="main"><i class="el-icon-share"></i>&nbsp;取药信息查看</a></li>
            </ul>
        </li>
    </ul>
</template>