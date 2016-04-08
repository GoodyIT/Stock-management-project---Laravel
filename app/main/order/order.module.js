(function ()
{
    'use strict';

    angular
        .module('app.order', [])
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {
        // State
        $stateProvider
            .state('app.order', {
                url    : '/order',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/order/order.html',
                        controller : 'OrderController as vm'
                    }
                },
                resolve: {
                    OrderData: function (msApi)
                    {
                       
                         var order_list_data = {};
                         order_list_data.cond ={company_id :'28'};

                       return msApi.resolve('order@post',order_list_data);
                    }
                }
            }).state('app.order.order-info', {
                url  : '/order-info/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/order/views/order-info/order-info.html',
                        controller : 'OrderInfoController as vm'
                    }
                }
            }).state('app.order.design', {
                url  : '/design/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/order/views/design/design.html',
                        controller : 'DesignController as vm'
                    }
                }
            });

        // Translation
        $translatePartialLoaderProvider.addPart('app/main/order');

        // Api
      //  msApiProvider.register('order', ['app/data/order/order.json']);
      msApiProvider.register('order',['api/public/order/listOrder',null, {post:{method:'post'}}]);

        // Navigation
        msNavigationServiceProvider.saveItem('fuse', {
            title : '',
            group : true,
            weight: 1
        });

        msNavigationServiceProvider.saveItem('fuse.order', {
            title    : 'Orders',
            icon     : 'icon-content-paste',
            state    : 'app.order',
            /*stateParams: {
                'param1': 'page'
             },*/
            
            weight   : 1
        });
    }
})();