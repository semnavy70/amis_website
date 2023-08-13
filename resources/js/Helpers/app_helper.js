export default {
    methods: {
        currentRoute() {
            return route().current();
        },
        isRoute(routeName) {
            return this.currentRoute()?.includes(routeName);
        },
    }
}
