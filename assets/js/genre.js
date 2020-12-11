import Vue from "vue";

export default new Vue({
    el: "#app",
    data: {
        movies: [],
        trailer: null,
        triggered: false
    },
    methods: {
        onClickGenre(genre) {
            if (genre != undefined && genre != '') {
                var value = genre;
                var appBaseUrl = process.env.APP_BASE_URL;
                fetch(`${appBaseUrl}/api/moviesByGenre/${value}`)
                    .then(result => result.json())
                    .then(result => {
                        var datas = [];
                        console.log(result)
                        if (result.results && result.results.length > 0) {
                            result.results.map(function (movie) {
                                datas.push({
                                    title: movie.title,
                                    originalTitle: movie.originalTitle,
                                    id: movie.id,
                                    overview: movie.overview,
                                    releaseYear: movie.releaseYear,
                                    voteAverage: movie.voteAverage,
                                    voteCount: movie.voteCount,
                                    posterPath: movie.posterPath,
                                    tailerKey: movie.trailer ? movie.trailer.key : null
                                })
                            })
                        }
                        this.movies = datas;
                        this.triggered = true
                        document.querySelector('#movies-container').style.display = 'none';
                    }, error => {
                        console.error(error);
                    });
            }
        },
        populateTrailer(id) {
            if (id != undefined && id != '') {
                this.trailer = null;
                var value = id;
                var appBaseUrl = process.env.APP_BASE_URL;
                fetch(`${appBaseUrl}/api/movieTrailer/${value}`)
                    .then(result => result.json())
                    .then(result => {
                        var datas = [];
                        this.trailer = result.key
                    }, error => {
                        console.error(error);
                    });
            }
        }
    }
});
