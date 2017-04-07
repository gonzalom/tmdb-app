<template>
    <div class="movies-item">
        <a :class="{'no-image': noImage}" :href="'/movie/' + movie.id" @click.prevent="openMoviePopup(movie.id, true)">
            <figure>
                <img class="img-responsive img-rounded" v-if="!noImage" src="/images/placeholder.png" v-img="poster()" alt="">
                <img class="img-responsive img-rounded" v-if="noImage" src="/images/no-image.png" alt="">
            </figure>
            <div class="movies-item__content">
                <h4 class="movies-item__title">{{ movie.title }}</h4>
            </div>
        </a>
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
            height: 40px;
            overflow: hidden;
        }
    }

    .movies-item img {
        margin: auto;
    }
</style>

<script>
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
