new Vue({
    el:'#app',
    data(){
        return{
            postnum:'00'
        };
    },
    computed:{
        posterror(){
            const num = this.postnum;
            return num.length != 7 || isNaN(Number(num));
        }
    }
});

