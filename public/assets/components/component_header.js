var componentHeader = Vue.component("component-header", {
    template: "#component_header",
    methods: {
        registerBtnTrigger: function() {
            $('.accordion').accordion('open', 0);
        },
        loginBtnTrigger: function() {
            $('.login_modal').modal('show');
        },
        logout: function() {
            /* clear cookie */
            window.location.href = '/index.html';
        }
    },
    props: ['loginStatus'],
    data: function() {
        return {};
    },
    mounted: function() {
        console.log(this.loginStatus);
    }
});