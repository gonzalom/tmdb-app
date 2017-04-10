<template>
    <div>
        <div class="loading-page" v-if="!listLoaded">Loading...</div>
        <div class="movie movie__bg" :style="{ 'background-image': 'url(' + movieBackdropSrc + ')' }" v-if="listLoaded">
            <div class="card">
                <div class="card-content">
                    <div>
                        <h1>
                            {{ movie.title }}
                            <span v-if="movie.tagline">{{ movie.tagline }}</span>
                        </h1>
                    </div>
                    <p v-if="movie.overview">{{ movie.overview }}</p>
                    <p v-if="movie.release_date">Release Date: {{ movie.release_date }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
<style lang="scss">
    .movie {
        padding: 20px;

        &__bg {
            display: block;
            min-height: 500px;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: 50% 50%;
            background-color: #333;
        }
    }

    .movie h1 {
        color: #2ca02c;
    }

    .movie .card {
        width: 80%;
        margin: auto;
    }
</style>
<script>
    import axios from 'axios'
    import img from '../directives/v-image.js'
    import storage from '../storage.js'

    export default{
        data(){
            return{
                movie: {},
                results: '',
                moviePosterSrc: '',
                movieBackdropSrc: '',
                listLoaded: false
            }
        },
        computed: {
            pageTitle() {
                return this.movie.title + storage.pageTitlePostfix;
            },
            request() {
                return `/api/movie/`+this.$route.params.movie;
            }
        },
        methods: {
            fetchMovie() {
                console.debug(this.request);
                axios.get(this.request)
                .then(function(resp) {
                    console.debug('resp', resp);
                    //this.movie = storage.movies[resp.data.id] = resp.data;
                    this.movie = resp.data;
                    this.listLoaded = true;

                    this.poster();
                    this.backdrop();

                    // Change Page title
                    document.title = this.movie.title;
                }.bind(this))
                .catch(function(error) {
                    console.log('error', error);
                    this.$router.push({ name: '404' });
                }.bind(this));
            },
            poster() {
                if(this.movie.poster_path){
                    this.moviePosterSrc = 'https://image.tmdb.org/t/p/w600_and_h900_bestv2' + this.movie.poster_path;
                }
            },
            backdrop(){
                if(this.movie.backdrop_path){
                    this.movieBackdropSrc = 'https://image.tmdb.org/t/p/w500' + this.movie.backdrop_path;
                }
            }
        },
        created() {
            // Load Movie
                this.fetchMovie();
            //if (storage.movies[this.$route.params.movie]) {
            //    this.movie = storage.movies[this.$route.params.movie];
            //    this.listLoaded = true;
            //} else {
            //    this.fetchMovie();
            //}
        }
    }
</script>
