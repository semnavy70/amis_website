export default {
    methods: {
        formatPrice: function (price) {
            return parseInt(price);
        },
        currentRoute() {
            return route().current();
        },
        isRoute(routeName) {
            return this.currentRoute()?.includes(routeName);
        },
    }
}
