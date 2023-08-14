const sign_in_btn = document.querySelector("#sign-in-btn");
const sign_up_btn = document.querySelector("#sign-up-btn");
const container = document.querySelector(".container-auth");
const content1 = document.querySelector("#content1");
const content2 = document.querySelector("#content2");
const sign_in_form = document.querySelector(".sign-in-form");
const sign_up_form = document.querySelector(".sign-up-form");

// const signup_username = document.querySelector("#signup_username")
const signup_email = document.querySelector("#signup_email")
// const signup_password1 = document.querySelector("#signup_password1")
// const signup_password2 = document.querySelector("#signup_password2")
// const small1 = document.querySelector("#small1");
// const small2 = document.querySelector("#small2");
// const small3 = document.querySelector("#small3");
// const small4 = document.querySelector("#small4");


sign_up_btn.addEventListener('click', ()=>{
    container.classList.add("sign-up-mode");
})

sign_in_btn.addEventListener('click', ()=>{
    container.classList.remove("sign-up-mode");
})

// sign_up_form.addEventListener('submit', (e) =>{
//     e.preventDefault();
    
//     const usernameVal = signup_username.value.trim();
//     const emailVal = signup_email.value.trim();
//     const pass1Val = signup_password1.value.trim();
//     const pass2Val = signup_password2.value.trim();
    
//     username = "gagal";
//     email = "gagal";
//     password1 = "gagal";
//     password2 = "gagal"
    
//     // cek username
//     if (usernameVal === ''){
//         small1.innerText = "username";
//         username="gagal";
//     }else{
//         small1.innerText = ""
//         username="sukses"
//     }
    
//     // cek email
//     if(emailVal === ''){
//         small2.innerText = "email";
//         email="gagal";
//     }
//     else{
//         small2.innerText = ""
//         email="sukses"
//     }
    
//     // cek password
//     if(pass1Val === ''){
//         small3.innerText = "email";
//         password1="gagal";
//     }
//     else{
//         small3.innerText = ""
//         password1="sukses"
//     }

//     // cek confirm password
//     if(pass2Val === ''){
//         small4.innerText = "Please input password";
//         password2="gagal";
//     }else if(pass1Val === pass2Val){
//         small4.innerText = ""
//         password2="sukses";
//     }
//     else if(pass1Val!==pass2Val){
//         small4.innerText = "Please enter the match password"
//         signup_password1.value = "";
//         signup_password2.value = "";
//         password2="gagal"
//     }

//     if(username!=="sukses" || email!=="sukses" || password1!=="sukses" || password2!=="sukses"){
//         e.preventDefault();
//     }
// })

$("#sign-up-form").validate({
    rules:{
        sgusername:{
            required : true,
            minlength: 8,
        },
        sgemail:{
            required: true,
            email: true,
            remote: {
                url: '/cekEmail',
                type: 'post',
                data: {
                    sgemail: function() {
                      return $( "#sgemail" ).val();
                    }
                }
            },
        },
        sgpassword1:{
            required: true,
            minlength: 8,
        },
        sgpassword2:{
            required: true,
            equalTo: "#sgpassword1"
        },
    },
    messages: {
        sgusername:{
            required: "Input username",
            minlength: "Input at least 8 character"
        },
        sgemail:{
            required: "Input email",
            email: "Input a valid email address",
            remote: "Email is already registered"
        },
        sgpassword1:{
            required: "Input password",
            minlength: "Input password at least 8 character"
        },
        sgpassword2:{
            required: "Input confirm password",
            equalTo: "Input match password"
        },
    },

    highlight: function(element) {
        $(element).parent().addClass('error')
    },

    unhighlight: function(element) {
        $(element).parent().removeClass('error')
    },
    
    submitHandler: function(form) {
      form.submit();
    }
   });

$("#sign-in-form").validate({
rules:{
    email:{
        required : true,
        email: true,
    },
    password:{
        required: true,
    },
},
messages: {
    email:{
        required: "Input email",
        email: "Input a valid email address",
    },
    password:{
        required: "Input password",
    },
},

highlight: function(element) {
    $(element).parent().addClass('error')
},

unhighlight: function(element) {
    $(element).parent().removeClass('error')
},

submitHandler: function(form) {
    form.submit();
}
});

{/* <form action="/" method="post" class="sign-in-form" id="sign-in-form">
                <h2 class="tittle">Sign In to HetHet Amenities</h2>
                <div class="container-input-field">
                    <div class="input-field form-control <?= ($validation->hasError('email')) ? 'is-invalid' : ''; ?>">
                        <i class="icons" data-feather="mail"></i>
                        <input type="text" id="email" name="email" placeholder="Email" autocomplete="off" value="<?= set_value('email') ?>">
                    </div>
                    <div class=" invalid-feedback">
                        <?= $validation->getError('email') ?>
                    </div>
                </div>
                <div class="container-input-field">
                    <div class="input-field form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>">
                        <i class="icons" data-feather="lock"></i>
                        <input type="password" id="password" name="password" placeholder="Password">
                    </div>
                    <div class="invalid-feedback">
                        <?= $validation->getError('password') ?>
                    </div>
                </div>
                <button class="btn-solid" type="submit">Sign In</button>
            </form> */}