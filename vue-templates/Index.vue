<template>
   <div>
       <p>{{ testFnc() }}</p>
   </div>
</template>
<script>
    export default {
        name: "idx",
        props: {test: {type: String}},
        data(props) {
            function testFnc(){
                return "hello";
            }

           return {testFnc}
        }
    }
</script>
<style scoped>

</style>