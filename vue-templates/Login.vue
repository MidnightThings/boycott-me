<template>
   <div>
       <form action="/login" method="post">
            <label for="username">Email:</label>
            <input type="text" id="mail" name="mail" v-model="last_username"/>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password"/>

            <input type="hidden" name="_target_path" value="/"/>

            <button type="submit">login</button>
        </form>
   </div>
</template>
<script>
    export default {
        name: "login",
        props: {last_username: {type: String}}
    }
</script>
<style scoped>

</style>