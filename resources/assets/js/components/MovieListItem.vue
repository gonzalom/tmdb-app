<template>
    <div class="movies-item">
        <router-link :class="{'no-image': noImage}" :to="{ name: 'movie', params: { movie: movie.id }}">
            <div class="card">
                <figure>
                    <img class="img-responsive img-rounded" v-if="!noImage" src="/images/placeholder.png" v-img="poster()" alt="">
                    <img class="img-responsive img-rounded" v-if="noImage" src="/images/no-image.png" alt="">
                </figure>
                <div class="card-content text-center movies-item__title">
                    <p>{{ movie.title }}</p>
                </div>
            </div>
        </router-link>
        <!--<pre>{{ movie }}</pre>-->
    </div>
</template>

<style lang="scss">
    .movies-item {
        text-align: center;

        &__content {
            padding-top: 5px;
        }

        &__title {
            height: 80px;
            overflow: hidden;
        }
    }

    .movies-item img {
        margin: auto;
    }
</style>

<script>
    import storage from '../storage.js'
    import img from '../directives/v-image.js'

    export default{
        props: {
            movie: {
              type: Object,
              required: true
            }
        },
        directives: {
            img: img
        },
        data(){
            return {
                noImage: false
            }
        },
        methods: {
            poster() {
                if(this.movie.poster_path) {
                    return 'https://image.tmdb.org/t/p/w370_and_h556_bestv2' + this.movie.poster_path;
                } else {
                    this.noImage = true;
                }
            },
            openMoviePopup(id, event) {
                //eventHub.$emit('openMoviePopup', id, event);
            }
        }
    }
</script>
