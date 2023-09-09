export default {
    methods: {
<<<<<<< HEAD
        formatPrice: function (price) {
            return parseInt(price);
=======
        currentRoute() {
            return route().current();
        },
        isRoute(routeName) {
            return this.currentRoute()?.includes(routeName);
>>>>>>> de338ebe63126b500a2b80679b3203f7d82ff98d
        },
    }
}
