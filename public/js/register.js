$('#regbtn').click(function () {
    var flags = 0;
    var checkMobile = /^1\d{10}$/;
    var checkChinese = /^[\u4e00-\u9fa5]+$/;
    var checkIDCard = /^\d{17}(\d|x)$/i;
    if($('#name').val() === ''){
        $('#nameMsgContent').text('用户姓名不能为空');
        $('#nameMsg').show();
    }else if (!checkChinese.test($('#name').val())){
        $('#nameMsgContent').text('用户姓名只能为中文');
        $('#nameMsg').show();
    }else{
        $('#nameMsg').hide();
        flags += 1;
    }
    if($('#phoneNum').val() === ''){
        $('#phoneNumMsgContent').text('电话号码不能为空');
        $('#phoneNumMsg').show();
    }else if(!checkMobile.test($('#phoneNum').val())){
        $('#phoneNumMsgContent').text('电话号码格式不正确');
        $('#phoneNumMsg').show();
    }else{
        $('#phoneNumMsg').hide();
        flags += 1;
    }
    //验证身份证
    if($('#IDCard').val() === ''){
        $('#IDCardMsgContent').text('身份证号码不能为空');
        $('#IDCardMsg').show();
    }else if(!checkIDCard.test($('#IDCard').val())){
        $('#IDCardMsgContent').text('身份证格式不正确');
        $('#IDCardMsg').show();
    }else{
        $('#IDCardMsg').hide();
        flags += 1;
    }
    //验证生日不能为空
    if($('#birthday').val() === ''){
        $('#birthMsgContent').text('生日不能为空');
        $('#birthMsg').show();
    }else{
        $('#birthMsg').hide();
        flags += 1;
    }
    //验证两次登陆密码是否相同
    var password = $('#password').val();
    var passConfirm = $('#password-confirm').val();

    if(password === ''){
        $('#pswMsgContent').text('用户密码不能为空');
        $('#pswMsg').show();
    }else if (password.length < 6){
        $('#pswMsgContent').text('密码不能小于6位');
        $('#pswMsg').show();
    }else{
        $('#pswMsg').hide();
        flags += 1;
    }

    if(passConfirm !== password || passConfirm.length == 0){
        $('#pswConMsgContent').text('两次输入密码不相同');
        $('#pswConMsg').show();
    }else {
        $('#pswConMsg').hide();
        flags += 1;
    }
    if(flags === 6){
        return true;
    }else{
        return false;
    }
})