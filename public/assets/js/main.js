document.addEventListener("DOMContentLoaded", function() {

    vm = new Vue({
        el: "#app",
        data: {
            account: '',
            password: '',
            passwordConfirm: '',
            accountError: '',
            passwordError: '',
            passwordConfirmError: '',

            login: {
                acocunt: '',
                password: '',
                failMsg: ''
            }
        },
        methods:{
            loginSubmit: function(e) {
                e.preventDefault();
                var vm = this;

                axios({
                    method: 'get',
                    url: '/',
                }).then(function(res) {
                    window.location.href = '/profile.html';
                }).catch(function(error) {
                    vm.login.failMsg = 'wrong account or password';
                });
            },
            registerSubmit: function(e) {
                e.preventDefault();
                if (this.account === '') {
                    this.accountError = 'account can\'t be empty';
                }
                if (this.password === '') {
                    this.passwordError = 'password can\'t be empty';
                }
                if (this.passwordConfirm === '') {
                    this.passwordConfirmError = 'password confirm can\'t be empty';
                }
                var accountError = this.accountError === '',
                    passwordError = this.passwordError === '',
                    passwordConfirmError = this.passwordConfirmError === '';

                if (accountError && passwordError && passwordConfirmError) {
                    console.log('pass!');
                    window.location.href = '/profile.html';
                } else {
                    console.log('fail!');
                }
            },
        },
        watch: {
            account: function(input) {
                this.accountError = '';
                if (!/^[a-z]*[A-Z]*[0-9]*$/.test(input) || input == '') {
                    this.accountError = 'account syntax error!';
                }
            },
            password: function(input) {
                this.passwordError = '';
                this.passwordConfirmError = '';
                if (input.length < 8) {
                    this.passwordError = 'password should at least 8 words!';
                }
                if (this.password !== input) {
                    this.passwordConfirmError = 'password confirm not match!';
                }
            },
            passwordConfirm: function(input) {
                this.passwordConfirmError = '';
                if (this.password !== input) {
                    this.passwordConfirmError = 'password confirm not match!';
                }
            }
        },
        components: {
            componentHeader: componentHeader
        },
        mounted: function() {
            $('.accordion').accordion({
                onOpening: function() {
                    $('.ui.accordion .title').css({
                        opacity: 0,
                        pointerEvents: 'none'
                    });
                }
            });
        },
    });


});