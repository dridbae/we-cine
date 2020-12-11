import Vue from "vue";

export default new Vue({
    el: "#app-autocomplete-here",
    data: {
        input : '',
        suggestions: [],
        suggestionSelected : ''
    },
    methods: {
        onKeyPressEnter(e) {
            window.location.href = '/?search=' + this.input;
        },
        onKeypressSearchInput(e) {
            var value = this.input;
            var appBaseUrl = process.env.APP_BASE_URL;
            if (value != undefined && value != '') {
                fetch(`${appBaseUrl}/api/moviesBySearch/${value}`)
                    .then(result => result.json())
                    .then(result => {
                        var datas = [];
                        console.log(result)
                        if (result.results && result.results.length > 0) {
                            result.results.map(function (sug) {
                                datas.push({
                                    lib: sug.title,
                                    originalTitle: sug.originalTitle,
                                    id: sug.id
                                })
                            })
                        }
                        this.suggestions = datas;
                    }, error => {
                        console.error(error);
                    });
            } else {
                this.suggestions = []
            }

        },
        onClickSuggest(suggestion) {
            this.suggestionSelected = suggestion.lib;
            console.log('Suggestion selectionée  ::', suggestion);
            window.location.href = '/movie/' + suggestion.id;
            this.input = '';
            this.suggestions = [];
        }
    }
});
