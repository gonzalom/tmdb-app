<template>
    <div>
        <div class="loading-page" v-if="!listLoaded">Loading...</div>
        <div class="genres" v-if="listLoaded && genres.length">
            <h2>Genres</h2>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" v-for="(genre, index) in genres">
                    <div class="card">
                        <router-link :to="{ name: 'genre', params: { id: genre.id }}">
                        <div class="card-content text-center">
                            <h3>{{ genre.name }}</h3>
                        </div>
                        </router-link>
                    </div>
                </div>
            </div>

        </div>
        <section v-if="listLoaded && !genres.length" class="not-found">
            <div>
                <h2>Nothing Found</h2>
            </div>
        </section>
    </div>
</template>
<style>

</style>
<script>
    import axios from 'axios'
    import storage from '../storage.js'

    export default{
        data() {
            return {
                genres: [],
                results: '',
                listLoaded: false
            }
        },
        computed: {
            pageTitle() {
                return 'Genres' + storage.pageTitlePostfix;
            },
            request() {
                return `/api/genre`;
            },
            countResults() {
                if(this.results > 1) {
                    return numeral(this.results).format('0,0') + ' results';
                } else {
                    return numeral(this.results).format('0,0') + ' result';
                }
            }
        },
        methods: {
            fetchGenres() {
                axios.get(this.request)
                .then(function(resp) {
                    this.genres = storage.genres = resp.data.genres;
                    this.listLoaded = true;

                    // Create genres names
                    storage.genres.forEach(function(genre){
                        storage.genresNames[genre.id] = genre.name;
                    });
                }.bind(this))
                .catch(function(error) {
                    console.log('error', error);
                    //this.$router.push({ name: '404' });
                }.bind(this));
            }
        },
        created() {
            // Change Page title
            document.title = this.pageTitle;

            // Load Genres
            if (storage.genres.length) {
                this.genres = storage.genres;
                this.listLoaded = true;
            } else {
                this.fetchGenres();
            }
        }
    }
</script>
