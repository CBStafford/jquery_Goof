// $( document ).ready(function() {
//     console.log( "ready!" );
// });

function login(){
    event.preventDefault();
    var url = "controller/login.php";
    var postEmail;
    var postPassword;
    formData = $("#myForm").serializeArray();
    $.each( formData, function( index, value ){
        console.log(value.name);
        console.log(value.value);
        if(value.name == 'email'){
            postEmail = value.value
        }
        if(value.name == 'password'){
            postPassword = value.value
        }

    });

    postDdata ={
        email:      postEmail, 
        password:   postPassword
    }

    console.log(postDdata);

    $.ajax({ 
        type: 'POST', 
        url: url, 
        data: postDdata , 
        success: function(data){ 
            //alert(data); 
            console.log('success:', data); 
            var obj = JSON.parse(data);
            if(obj.count > 0){
                navbar();
            }
            user_id = obj.user_id;
            $(".res").html(`<h2>Your Results</h2> 
            ${obj.res}
            ` );            
        }, 
        error: function() { 
            alert("Ajax Broke!"); 
        } 
    });
    
        
}

function getUser(){
    //alert(user_id);
    event.preventDefault();
    var url = "controller/users.php";

    formData = {
        userID: user_id, 
        proc: 1,
    };

    $.ajax({ 
        type: 'POST', 
        url: url, 
        data: formData , 
        success: function(data){ 
            //alert(data); 
            console.log('success:', data); 
            load_page(data);            
        }, 
        error: function() { 
            alert("Ajax Broke!"); 
        } 
    });
}

function load_page(dataIn){
    var obj = JSON.parse(dataIn);
    var xx = null;
    $.ajax({
        url : "user.html",
        dataType: "text",
        success : function (data) {
            $(".user_div").html(`
                <div class="mush">
                    ${data}
                    ${obj.user_name}
                    ${obj.email}
                </div>

            `);
            $(".user_section").show();
        },
        error: function() { 
            alert("Ajax Broke!"); 
        }
    });
    //alert("LOADING page");
    //alert("LOADING " + user_id);
}

function updateUser(){
    //alert("Yo!");
    event.preventDefault();
    var url = "controller/users.php";
    formData = $("#user_form").serializeArray();
    formData.push({name:"user_id", value: user_id}, {name:"proc", value: 2});
    // formData = {
    //     userID: user_id, 
    //     proc: 2,
    // };

    $.ajax({ 
        type: 'POST', 
        url: url, 
        data: formData , 
        success: function(data){ 
            //alert(data); 
            console.log('success:', data); 
            load_page(data);            
        }, 
        error: function() { 
            alert("Ajax Broke!"); 
        } 
    });    
}