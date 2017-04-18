<template>
	<ul id="threebar">
		<!-- 科室医生 -->
        <li>
            <h3><i class="el-icon-menu"></i><span>&nbsp;医生个人信息</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/inforead"><i class="el-icon-information"></i>&nbsp;个人信息查询</router-link></li>
                <li><router-link to="/doc/changepsw"><i class="el-icon-edit"></i>&nbsp;修改登录密码</router-link></li>
                <li><router-link to="/doc/infoedit"><i class="el-icon-setting"></i>&nbsp;修改个人信息</router-link></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-plus"></i><span>&nbsp;费用</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-plus"></i>&nbsp;充值</router-link></li>
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-document"></i><span>&nbsp;取药</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-document"></i>&nbsp;取药信息</router-link></li>
            </ul>
        </li>
        <!-- <li>
            <h3><i class="el-icon-date"></i><span>&nbsp;床位</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-date"></i>&nbsp;床位分配</router-link></li>
            </ul>
        </li> -->
    </ul>
</template>