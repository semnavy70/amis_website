export default {
    methods: {
        getImage: function (path) {
            if(path.includes("http")){
                return  path;
            }
            let url = "https://storage.googleapis.com/indo-pacific/";
            return url + path;
        },
        getHomeImage: function (path) {
            if(path.includes("http")){
                return  path;
            }
            let url = "https://storage.googleapis.com/indo-pacific/";
            return url + path;
        },
        getMarketImage: function (path) {
            if(!path) {
                return  "/assets/img/amis-logo.png";
            }
          return "https://storage.googleapis.com/amis_market/" + path;
        },
    }
}
