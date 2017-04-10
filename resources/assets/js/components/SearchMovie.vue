<template>
    <div class="navbar-form navbar-left">
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Search for a movie..."
                   v-model.lazy.trim="searchQuery"  @keyup.enter="search" @blur="search">
        </div>
    </div>
</template>
<style>

</style>
<script>
    export default{
        data() {
            return {
                searchQuery: ''
            }
        },
        computed: {
            queryForRouter() {
                return encodeURI(this.searchQuery.replace(/ /g, "+"));
            }
        },
        methods: {
            // Search Methods
            search() {
                //console.debug('searchQuery', this.searchQuery);
                if(!this.searchQuery.length) return;
                this.$router.push({ name: 'search', params: { query: this.queryForRouter }});
            },
            setSearchQuery(clear) {
                if(clear) {
                    this.searchQuery = '';
                } else {
                    let query = decodeURIComponent(this.$route.params.query);
                    //console.debug('query', query, 'route', this.$route.query.query);
                    this.searchQuery =  query ? query.replace(/\+/g, " ") : '';
                }
            }
        },
        created() {
            eventHub.$on('setSearchQuery', this.setSearchQuery);
        }
    }

</script>
