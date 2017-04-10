<template>
    <div>
        <div class="loading-page" v-if="!listLoaded">Loading...</div>
        <div class="movies" v-if="listLoaded && movies.length">
            <h2>{{ listTitle }}</h2>

            <div class="row">
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-2" v-for="(movie, index) in movies">
                    <movie-list-item :movie="movie"></movie-list-item>
                </div>
            </div>

            <div v-if="!shortList" :class="{'is-hidden' : currentPage == pages}">
                <button @click="loadMore" class="button">Load More</button>
            </div>
        </div>
        <section class="not-found" v-if="listLoaded && !movies.length">
            <div>
                <h2>Nothing Found</h2>
            </div>
        </section>
    </div>
</template>
<style>
    .movies {
        padding-left: 10px;
        padding-right: 10px;
    }

    .movies ul {
        padding: 0;
        margin: 0;
        list-style: none;
        display: flex;
        flex-wrap: wrap;
    }

    .movies li {
        padding: 10px;
    }
</style>
<script>
    import axios from 'axios'
    import numeral from 'numeral'
    import storage from '../storage.js'
    import MovieListItem from './MovieListItem.vue'

    export default{
        props: {
            type: {
              type: String,
              default: 'page'
            },
            mode: {
              type: String,
              default: 'genre'
            },
            genre: Number,
            shortList: {
              type: Boolean,
              default: false
            }
        },
        components: {
            MovieListItem
        },
        data(){
            return{
                listTitle: '',
                movies: [],
                pages: '',
                results: '',
                currentPage: 1,
                listLoaded: false
            }
        },
        computed: {
            pageTitle(){
                return this.listTitle + storage.pageTitlePostfix;
            },
            query(){
                return '';
                //return this.$route.params.query || '';
            },
            request(){
                //let category = this.$route.params.category || this.category;
                let genre = false;

                if(this.mode == 'all'){
                    return `/api/movie?page=${this.currentPage}`;
                }

                if(this.mode == 'search'){
                    return `/api/search/movie?query=${this.query}&page=${this.currentPage}`;
                }

                if(genre){
                    return `/api/genre/${genre}?page=${this.currentPage}`;
                }

                return `/api/movie?page=${this.currentPage}`;
            },
            countResults(){
                if(this.results > 1){
                    return numeral(this.results).format('0,0') + ' results';
                } else {
                    return numeral(this.results).format('0,0') + ' result';
                }
            }
        },
        methods: {
            fetchMovies(){
                console.log('fetch', this.request);
                axios.get(this.request)
                .then(function(resp){
                    console.log('resp', resp);
                    let data = resp.data;
                    if(this.shortList){
                        this.movies = data.results.slice(0, 5);
                        this.pages = 1;
                        this.results = 5;
                    } else {
                        this.movies = data.results;
                        this.pages = data.total_pages;
                        this.results = data.total_results;
                    }
                    this.listLoaded = true;
                    // Change Page title
                    if(this.type == 'page'){
                        document.title = this.pageTitle;
                    }
                }.bind(this))
                .catch(function(error) {
                    console.log('error', error);
                    //this.$router.push({ name: '404' });
                }.bind(this));
            },
            loadMore(){
                this.currentPage++;
                axios.get(this.request)
                .then(function(resp){
                    let data = resp.data;
                    let newData = this.movies.concat(data.results);
                    this.movies = newData;
                }.bind(this));
            }
        },
        watch: {
            query(value){
                this.fetchMovies(value);
            }
        },
        created(){
            // Set List Title
            this.listTitle = 'hello';
            if(this.mode == 'search'){
                //this.listTitle = storage.categories['search'];
                //eventHub.$emit('setSearchQuery');
            } else if(this.mode == 'genre') {
                let genre = this.$route.params.genre || this.genre;
                this.listTitle = storage.genresNames[genre];
            }
            this.fetchMovies();
        }
    }
</script>
