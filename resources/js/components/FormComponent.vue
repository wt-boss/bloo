<template>
    <div>
        <form class="ui reply form" @submit.prevent="submitComment">

        </form>
    </div>

</template>

<script>

    export default {

        data(){
            return {
                form:{
                    name: '',
                    body: '',
                    url: window.location.href,
                },
                errors: {},
            }
        },
        methods : {
            submitComment(){
                axios.post('/commentaire', this.form
                ).then( ({data}) =>{
                    this.$emit('Newcommentaire',data);
                    this.form.body = "";
                    this.errors = {};
                })
                    .catch(error => {
                        this.errors = error.response.data.errors;
                    })
            },
        }
    }

</script>
