new Vue({
    el:'#app',
    data(){
        return{
            sei:'苗字',
            mei:'名前',
            email:'email',
            pass1:'',
            pass2:'',
            post:'11'
        };
    },
    computed:{
        isInValidEmail(){
            const regex = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i)
            return !regex.test(this.email);
        },
        isInValidPass(){
            return this.pass1 == this.pass2
        },
        isInValidPost(){
            const post = this.post;
            const isErr = post.length != 7 || isNaN(Number(post));
        }
    }
});