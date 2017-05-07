var illumine = illumine || {};

$(document).ready(function() {
    // directly assign a nested namespace
    illumine.ClickRequest = function($root_selector) {
        var $_root = this;
        $_root.element = $root_selector;
        $_root.container = $_root.element.closest('div');
        $_root.method = $_root.element.data('ajax-method');
        $_root.token = $_root.element.data('ajax-token');
        $_root.url = $_root.element.data('ajax-url');
        $_root.values = $_root.element.data('ajax-values');
        $_root.default = $_root.element.html();
        $_root.loading = '<i class="fa fa-circle-o-notch fa-spin"></i> loading...';
        $_root.init = function() {
            console.log('ClickRequest: initializing...');
            $_root.event();
            $_root.values._method = $_root.method;

            if($_root.method === 'put'){
                $_root.method = 'post';
            }
            if($_root.token){
                $_root.values._token = $_root.token;
            }
        };
        $_root.event = function($element){
            var $_this = $(this);
            $_this.root = $_root;
            console.log('ClickRequest: attaching event...');
            $_this.root.element.click(function(event) {
                event.preventDefault();
                $_root.request();
            });
        };
        $_root.progress = function($state){
            var $_this = $(this);
            $_this.root = $_root;
            if($state === true){
                $_root.element.html($_root.loading);
                console.log('ClickRequest: loading...');
            }else{
                $_root.element.html($_root.default);
                console.log('ClickRequest: finished loading.');
            }
        };
        $_root.request = function() {
            var $_this = $(this);
            $_this.root = $_root;
            $_this.root.progress(true);

            if($_this.root.hasOwnProperty('attempts')) {
                $_this.root.attempts = ++$_this.root.attempts;
            }else{
                $_this.root.attempts = 1;
            }
            console.log('ClickRequest: attempt '+$_this.root.attempts);
            $.ajax({
                url:$_this.root.url+'?'+Math.random(),
                type:$_this.root.method,
                data:$_this.root.values,
                success:function($data){
                    setTimeout(function(){ $_this.root.progress(false); }, 300);

                    $_this.root.response(true);
                    console.log('ClickRequest: completed successfully.');
                },
                error: function ($data) {
                    console.log('server error!');
                    console.log($data);

                    if($_this.root.attempts < 3){
                        $_this.root.request(); // Try again.
                        console.log('ClickRequest: attempt failed, trying again...');
                    }else{ // Max 3 tries.
                        console.log('ClickRequest: last attempt failed!');
                        $_this.root.progress(false);
                        //alert('Network Error! We tried to save multiple times without success.');
                    }
                }
            });
        };
        $_root.response = function($status){
            var $_this = $(this);
            $_this.root = $_root;
            $_this.root.status = $status;
            console.log('ClickRequest: responding...');

            if($_this.root.status === true){
                console.log('ClickRequest: response -> positive.');
            }else{
                console.log('ClickRequest: response -> negative.');
            }
        };
        $_root.init();
    };

    $.extend(true, illumine, {
        notificationsMenu: {
            init: function () {
                var $_root = illumine.notificationsMenu;
                $_root.selector = $('.notification-item .ajax-ClickRequest');
                $_root.items = [];
                $_root.count = 0;
                $_root.counter = $('#notification-center .bubble');
                $_root.element = $_root.selector.closest('.notification-panel');
                $.each($_root.selector, function($i) {
                    var $_this = $(this);
                    $_this.root = $_root;
                    $_this.request = new illumine.ClickRequest($_this);
                    $_this.request.container = $_this.parent('.notification-item');
                    $_this.request.id = $_this.request.container.data('ajax-id');
                    $_this.request.response = function($status){
                        $_this.root = $_root;
                        if($status === true) {
                            $_this.root.count = $_root.counter.html() - 1;
                            if($_this.root.count > 0){
                                $_root.counter.html($_this.root.count);
                            }else{
                                $_root.counter.remove();
                                $_root.element.parent('.dropdown').removeClass('open')
                            }
                            $('.notification-item[data-ajax-id="'+$_this.request.id+'"]').remove();
                        }
                    };
                    $_this.request.progress = function($enabled){
                        var $_this = $(this);
                        $_this.root = $_root;
                        $_this.root.element.portlet({
                            progress: 'circle',
                            refresh: $enabled,
                            onRefresh: function() {
                            }
                        });
                    };
                    $_this.root.items.push($_this.request);
                    $_this.root.count = $_root.count + 1;
                });
                $(document).on('click', '.notification-toggle', function (e) {
                    e.stopPropagation();
                });
            }
        }
    });
    illumine.notificationsMenu.init();
});