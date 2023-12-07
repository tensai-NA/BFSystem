new Vue({
    el:'#app',
    data(){
        return{
            // email: document.getElementById('mail').value,
            // postnum: document.getElementById('postnum').value
            email:'',
            postnum:''
        };
    },
    computed:{
        isInValidEmail(){
            const regex = new RegExp(/^[-a-z0-9~!$%^&*_=+}{\'?]+(\.[-a-z0-9~!$%^&*_=+}{\'?]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i)
            return !regex.test(this.email);
        },
        isInValidPost(){
            const post = this.postnum;
            const isErr = post.length != 7 || isNaN(Number(post));
            return isErr;
        }
    }
});