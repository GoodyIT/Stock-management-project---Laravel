(function ()
{
    'use strict';

    angular
        .module('app.shipping', ['ngTasty'])
        .config(config);

    /** @ngInject */
    function config($stateProvider, $translatePartialLoaderProvider, msApiProvider, msNavigationServiceProvider)
    {
        // State
        $stateProvider
            .state('app.shipping', {
                resolve: {
                        checksession : function (sessionService,$stateParams,$state)
                        {
                            
                           return sessionService.AccessService('ALL','true');
                        },
                        shippingData: function (msApi)
                        {
                            return msApi.resolve('shipping@get');
                        }
                    },
                url    : '/shipping',
                views  : {
                    'content@app': {
                        templateUrl: 'app/main/shipping/shipping.html',
                        controller : 'shippingController as vm'
                    }
                }
            }).state('app.shipping.orderwaitship', {
                resolve: {
                        checksession : function (sessionService,$stateParams,$state)
                        {
                            
                           return sessionService.AccessService('ALL','true');
                        }
                    },
                url  : '/orderwaitship/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/shipping/views/orderwaitship/orderwaitship.html',
                        controller : 'orderWaitController as vm'
                    }
                }
            }).state('app.shipping.shipmentdetails', {
                resolve: {
                        checksession : function (sessionService,$stateParams,$state)
                        {
                            
                           return sessionService.AccessService('ALL','true');
                        }
                    },
                url  : '/shipmentdetails/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/shipping/views/shipmentdetails/shipmentdetails.html',
                        controller : 'shipmentController as vm'
                    }
                }
            }).state('app.shipping.boxingdetail', {
                resolve: {
                        checksession : function (sessionService,$stateParams,$state)
                        {
                            
                           return sessionService.AccessService('ALL','true');
                        }
                    },
                url  : '/boxingdetail/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/shipping/views/boxingdetail/boxingdetail.html',
                        controller : 'boxingdetailController as vm'
                    }
                }
            }).state('app.shipping.shipmentoverview', {
                resolve: {
                        checksession : function (sessionService,$stateParams,$state)
                        {
                            
                           return sessionService.AccessService('ALL','true');
                        }
                    },
                url  : '/shipmentoverview/:id',
                views: {
                    'content@app': {
                        templateUrl: 'app/main/shipping/views/shipmentoverview/shipmentoverview.html',
                        controller : 'shipmentOverviewController as vm'
                    }
                }
            });

       // Translation
        $translatePartialLoaderProvider.addPart('app/main/shipping');

        // Api
        msApiProvider.register('shipping', ['app/data/shipping/shipping.json']);
        // Navigation
        msNavigationServiceProvider.saveItem('fuse', {
            title : '',
            group : true,
            weight: 1
        });

        msNavigationServiceProvider.saveItem('fuse.shipping', {
            title    : 'Shipping',
            icon     : 'icon-truck',
            state    : 'app.shipping',
            /*stateParams: {
                'param1': 'page'
             },*/
            weight   : 9
        });
    }
})();