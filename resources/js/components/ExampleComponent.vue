<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        <button :type="type" v-text="perkataan"></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },

        data: function(){
            return {
                test : 'My Button'
            }
        },
        props: [
            'perkataan', 'type'
        ]
    }
</script>
