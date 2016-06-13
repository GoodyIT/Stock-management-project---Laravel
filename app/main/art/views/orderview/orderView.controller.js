(function ()
{
    'use strict';

    angular
            .module('app.art')
            .controller('orderViewController', orderViewController);

    /** @ngInject */
    function orderViewController($document, $window, $timeout, $mdDialog)
    {
        var vm = this;
        vm.createNewScreen = createNewScreen;
        vm.generateArtForm = generateArtForm;
        //Dummy models data
        vm.screensetPOinfo = {
            "client": "Client Name",
            "orderName": "12345",
            "orderDate": "12/05/2016",
            "contract": "Joshi Goodman",
            "affiliate": "Affiliate Name",
            "affiliateArrival": "xx/xx/xxxx",
            "affiliateDeadline": "xx/xx/xxxx"
        };
        vm.screensetinfo = [
            {"Position": "Front", "NumberColors": "30", "FrameSize": "32", "Width": "10", "PrintLocation": "Top", "NumberScreens": "10", "LinesPerInch": "10", "Height": "20"},
            {"Position": "Front", "NumberColors": "30", "FrameSize": "32", "Width": "10", "PrintLocation": "Top", "NumberScreens": "10", "LinesPerInch": "10", "Height": "20"},
            {"Position": "Front", "NumberColors": "30", "FrameSize": "32", "Width": "10", "PrintLocation": "Top", "NumberScreens": "10", "LinesPerInch": "10", "Height": "20"}
        ];
        function createNewScreen(ev, settings) {
            $mdDialog.show({
                controller: 'createNewScreenController',
                controllerAs: 'vm',
                templateUrl: 'app/main/art/dialogs/createScreen/createScreen-dialog.html',
                parent: angular.element($document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    event: ev
                }
            });
        }
        function generateArtForm(ev, settings) {
            $mdDialog.show({
                controller: 'generateArtController',
                controllerAs: 'vm',
                templateUrl: 'app/main/art/dialogs/generateArtForm/generateArtForm-dialog.html',
                parent: angular.element($document.body),
                targetEvent: ev,
                clickOutsideToClose: true,
                locals: {
                    event: ev
                }
            });
        }
        //        Datatable Options
       
        var originatorEv;
        vm.openMenu = function ($mdOpenMenu, ev) {
            originatorEv = ev;
            $mdOpenMenu(ev);
        };
        vm.dtInstanceCB = dtInstanceCB;
        //methods
        function dtInstanceCB(dt) {
            var datatableObj = dt.DataTable;
            vm.tableInstance = datatableObj;
        }
    }
})();
