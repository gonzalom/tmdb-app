let storage = {
    pageTitlePostfix: ' — ' + document.title,
    genres: [],
    genresNames: {},
    movies: {},
    // For Browser History
    backTitle: '',
    moviePath: '',
    createMoviePopup: false,
    moviePopupOnHistory: false
};

export default storage;