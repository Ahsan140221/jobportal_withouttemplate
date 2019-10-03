<template>
    <div>
            <button v-if="show" @click.prevent="unsave()"  class="btn btn-dark" style="width:100%;">
                Un Save
            </button>
            <button v-else @click.prevent="save()" class="btn btn-primary" style="width:100%;">Save Job</button>



    </div>
</template>

<script>
    export default {
        props:['jobid','favorited'],
        mounted() {
            console.log('Component mounted.')
        },
        data() {
            return {
                'show':true
            }
        },
        mounted(){
            this.show = this.jobFavorited ? true:false;

        },
        computed:{
            jobFavorited(){
                return this.favorited
            }
        },
        methods:{
            save(){
                axios.post('/save/'+this.jobid).then(response=>this.show=true).catch(error=>alert('error'))
            },
            unsave(){
                axios.post('/unsave/'+this.jobid).then(response=>this.show=false).catch(error=>alert('error'))
            }
        }

    }
</script>
