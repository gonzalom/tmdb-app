import VueRouter from 'vue-router';

const Foo = { template: '<div>foo</div>' };
const Bar = { template: '<div>bar</div>' };

import Genre from './components/Genre.vue'
import Movie from './components/Movie.vue'
import MovieList from './components/MovieList.vue'

let routes = [
    { path: '/app', redirect: '/app/genre' },

    //{ name: 'movies', path: '/app/movie', component: MovieList },
    { name: 'movie', path: '/app/movie/:movie', component: Movie },
    { name: 'genres', path: '/app/genre', component: Genre },

    {
        name: 'genre',
        path: '/app/genre/:genre/movies',
        components: {
            'genre-router-view': MovieList
        }
    },

    {
        name: 'search',
        path: '/app/search/movie/:query',
        components: {
            'search-router-view': MovieList
        }
    },

    { name: '404', path: '/404', component: require('./components/404.vue') },
    { path: '*', redirect: '/404' }
];

const router =  new VueRouter({
    mode: 'history',
    routes,
    linkActiveClass: 'is-active'
});

router.beforeEach((to, from, next) => {
    // Toggle mobile nav
    if(document.querySelector('.nav__hamburger--active')){
        document.querySelector('.nav__hamburger').classList.remove('nav__hamburger--active');
        document.querySelector('.nav__list').classList.remove('nav__list--active');
    }
    next();
});

export default router;
