<template>
    <div>
        <div>404 - Page not found</div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        created() {
        document.title = '404 - Page not found' + storage.pageTitlePostfix;
        }
    }
</script>
