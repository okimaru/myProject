$(document).ready(function(){
    $('#login').click(function(){
        var email = $("#e_mail").val();
        var password = $("#pass3").val();
        if (email=="") {
            $("#errorMessageHere1").html("check if email is filled").hide().fadeIn(1500);
        }
        else if( password==""){
            $("#errorMessageHere1").html("check if passwords are filled").hide().fadeIn(1500);
        }
        else{
            datastream='&login='+1+'&email='+email+'&password='+password
            $.ajax({
                method:"POST",
                url:"login.php",
                data:datastream,
                cache:false,
                beforeSend:function()
                {
                    $('#status').html("<img src='image/ajax-loader.gif'>").fadeOut(10000);
                    $('button').hide().fadeIn(15000);
                    //$('#response').fadeOut();

                },
                success:function(data){

                    $("#errorMessageHere1").html("<div  style='text-transform: uppercase'>"+data+"</div>").hide().fadeIn(3000);
                   if(data>=0){
                       setTimeout('window.location.href =("home.php");',800);
                   }
                    else{
                       $("#errorMessageHere1").html("Wrong credentials  <a href='forgot.php'>Click here to reset password</a>");
                   }

                },
                dataType:'text'
            });
        }
    });
});
