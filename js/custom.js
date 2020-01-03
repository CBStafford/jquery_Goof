$( document ).ready(function() {
    console.log( "ready!" );

    let user_id;

    $(".user_section").on("click", "#editUser_btn", function(){
       $(".userEditStuff").show();
    });

    $("#login").on("click", function(){
        $(".res").empty();
        $(".user_div").empty();
        $(".nav").empty();
        $(".login_div").hide();
        $(".login_field").val('');
    });

    $(".user_section").on("click", '.clicky',function(){
        $(".user_section .mush").hide();
        updateUser();
    });
});

function navbar(){
    $(".nav").html(`
        <ul>
            <li><a class="btn btn-primary" id="home-page">Home</a></li>
            <li> | <a class="btn btn-warning" id="user-page" onClick="getUser()">User Profile</a></li>
            <li> | <a class="btn btn-danger" id="user-page" onClick="logOut()">LogOUt</a></li>
        </ul>
    `);
    $("li").css("display", "inline")
}

function logOut(){
    location.reload(); 
}
