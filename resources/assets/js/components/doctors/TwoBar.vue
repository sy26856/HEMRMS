<template>
	<ul id="twobar">
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
            <h3><i class="el-icon-date"></i><span>&nbsp;就诊</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-plus"></i>&nbsp;就诊</router-link></li>
                <li><router-link to="/doc/todayrecord"><i class="el-icon-document"></i>&nbsp;就诊记录</router-link></li>
                <!-- <li><router-link to="/doc/passrecord"><i class="el-icon-more"></i>&nbsp;过往就诊记录</router-link></li> -->
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-date"></i><span>&nbsp;检查项目</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-plus"></i>&nbsp;检查</router-link></li>
                <!-- <li><router-link to="/doc/todayrecord"><i class="el-icon-document"></i>&nbsp;今日检查记录</router-link></li>
                <li><router-link to="/doc/passrecord"><i class="el-icon-more"></i>&nbsp;过往检查记录</router-link></li> -->
            </ul>
        </li>
        <li>
            <h3><i class="el-icon-date"></i><span>&nbsp;住院</span></h3>
            <ul class="sub_menu">
                <li><router-link to="/doc/writerecord"><i class="el-icon-plus"></i>&nbsp;住院手续办理</router-link></li>
                <li><router-link to="/doc/todayrecord"><i class="el-icon-document"></i>&nbsp;出院手续批复</router-link></li>
                <!-- <li><router-link to="/doc/passrecord"><i class="el-icon-more"></i>&nbsp;住院信息查询</router-link></li> -->
            </ul>
        </li>
    </ul>
</template>	