
$('#login').click(function(){
    var username=$("#username").val();
    var password=$("#password").val();
    if(username && password){
        $.ajax({
            type: "POST",
            url: "/user/login",
            data: username,password,
            success: function(data){
                if(data){
                    console.log("Data correcta")                 
                }
                else   {
                //Shake animation effect.
                }
            }
        });
    }
    return false;
});
