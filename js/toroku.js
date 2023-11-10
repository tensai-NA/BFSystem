new Vue({
    el:'#app',
    data(){
        return{
            sei:'苗字',
            mei:'名前',
            email:'email',
            pass1:'',
            pass2:'',
            postnum:'11'
        };
    },
    computed:{
        isInValidEmail(){
            const regex = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i)
            return !regex.test(this.email);
        },
        isInValidPass(){
            const Err =  this.pass1 === this.pass2;
            return !Err;
        },
        isInValidPost(){
            const post = this.postnum;
            const isErr = post.length != 7 || isNaN(Number(post));
            return isErr;
        }
    }
});