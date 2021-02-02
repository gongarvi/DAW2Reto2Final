

if(window.$==null){
    require("./bootstrap.js");
}
window.Vue = require('vue');


const vue = new Vue({
    el: '#formulario',
    data:{
        email_regex:'^[\\w-\\.]+@([\\w-]+\\.)+[\\w-]{2,4}$',
        password_regex: "^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.{8,})"
    },
    methods: {
        actualizarDatosPerfil(event){
            let name=$(event.target).find("input[name=name]").val();
            //let email=$(event.target).find("input[name=email]").val();
            let password=$(event.target).find("input[name=password]").val();
            console.log(password==="" || name==="")
            if(password==="" || !(regex.test(password)) || name===""){
                event.preventDefault();
            }
        },
        actualizarPassword(event){
            let password_actual=$(event.target).find("input[name=password_actual]").val();
            let password_nueva=$(event.target).find("input[name=password_nueva]").val();
            let repassword=$(event.target).find("input[name=password_confirmar]").val();
            var regex=new RegExp(this.password_regex);
            if(!(regex.test(password_nueva))|| password_nueva==="" || password_nueva!==repassword  || password_actual===""){
                event.preventDefault();
            }
        },
        registerPerfil(event){
            event.preventDefault();
            let name=$(event.target).find("input[name=name]").val();
            //let email=$(event.target).find("input[name=email]").val();
            let password=$(event.target).find("input[name=password]").val();
            let repassword=$(event.target).find("input[name=password_confirmation]").val();
            //var emailregex = new RegExp(this.email_regex);
            var regex=new RegExp(this.password_regex);
            console.log(name+","+password+","+repassword);
            //console.log(emailregex.test(email));
           console.log(password!==repassword || password==="" || name==="");
            if(password!==repassword || password==="" || name===""){
                event.preventDefault();
            }
        }
    }
});

