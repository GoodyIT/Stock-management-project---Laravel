'use strict';

/**
 * @ngdoc function
 * @name app.config:uiRouter
 * @description
 * # Config
 * Config for the router
 */
angular.module('app')
  .run(
    [           '$rootScope', '$state', '$stateParams','$location','$http',
      function ( $rootScope,   $state,  $stateParams ,$location,$http) {
        $rootScope.$state = $state;
        $rootScope.$stateParams = $stateParams;


          $http.get('api/public/auth/session').success(function(result, status, headers, config) {
        
              if(result.data.success == '0') {

                $location.url('/access/signin');
                return false;

              } else {

                $rootScope.username = result.data.username;

              }
        });


      }
    ]
  )
  .config(
    [          '$stateProvider', '$urlRouterProvider', 'MODULE_CONFIG',
      function ( $stateProvider,   $urlRouterProvider,  MODULE_CONFIG ) {
        $urlRouterProvider
          .otherwise('/app/dashboard');
        $stateProvider
          .state('app', {
            abstract: true,
            url: '/app',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })
            .state('app.dashboard', {
              url: '/dashboard',
              templateUrl: 'views/pages/dashboard.html',
              data : { title: 'Dashboard', folded: true },
             
              resolve: load(['scripts/controllers/chart.js','scripts/controllers/vectormap.js'])
              
            })
            .state('app.analysis', {
              url: '/analysis',
              templateUrl: 'views/pages/dashboard.analysis.html',
              data : { title: 'Analysis' },
              resolve: load(['scripts/controllers/chart.js','scripts/controllers/vectormap.js'])
            })
            .state('app.wall', {
              url: '/wall',
              templateUrl: 'views/pages/dashboard.wall.html',
              data : { title: 'Wall', folded: true }
            })
            .state('app.todo', {
              url: '/todo',
              templateUrl: 'apps/todo/todo.html',
              data : { title: 'Todo', theme: { primary: 'indigo-800'} },
              controller: 'TodoCtrl',
              resolve: load('apps/todo/todo.js')
            })
            .state('app.todo.list', {
                url: '/{fold}'
            })
            .state('app.note', {
              url: '/note',
              templateUrl: 'apps/note/main.html',
              data : { theme: { primary: 'blue-grey'} }
            })
            .state('app.note.list', {
              url: '/list',
              templateUrl: 'apps/note/list.html',
              data : { title: 'Note'},
              controller: 'NoteCtrl',
              resolve: load(['apps/note/note.js', 'moment'])
            })
            .state('app.note.item', {
              url: '/{id}',
              views: {
                '': {
                  templateUrl: 'apps/note/item.html',
                  controller: 'NoteItemCtrl',
                  resolve: load(['apps/note/note.js', 'moment'])
                },
                'navbar@': {
                  templateUrl: 'apps/note/navbar.html',
                  controller: 'NoteItemCtrl'
                }
              },
              data : { title: '', child: true }
            })
            .state('app.inbox', {
                url: '/inbox',
                templateUrl: 'apps/inbox/inbox.html',
                data : { title: 'Inbox', folded: true },
                resolve: load( ['apps/inbox/inbox.js','moment'] )
            })
            .state('app.inbox.list', {
                url: '/inbox/{fold}',
                templateUrl: 'apps/inbox/list.html'
            })
            .state('app.inbox.detail', {
                url: '/{id:[0-9]{1,4}}',
                templateUrl: 'apps/inbox/detail.html'
            })
            .state('app.inbox.compose', {
                url: '/compose',
                templateUrl: 'apps/inbox/new.html',
                resolve: load( ['textAngular', 'ui.select'] )
            })

          .state('ui', {
            url: '/ui',
            abstract: true,
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })
            // components router
            .state('ui.component', {
              url: '/component',
              abstract: true,
              template: '<div ui-view></div>'
            })
              .state('ui.component.arrow', {
                url: '/arrow',
                templateUrl: 'views/ui/component/arrow.html',
                data : { title: 'Arrows' }
              })
              .state('ui.component.badge-label', {
                url: '/badge-label',
                templateUrl: 'views/ui/component/badge-label.html',
                data : { title: 'Badges & Labels' }
              })
              .state('ui.component.button', {
                url: '/button',
                templateUrl: 'views/ui/component/button.html',
                data : { title: 'Buttons' }
              })
              .state('ui.component.color', {
                url: '/color',
                templateUrl: 'views/ui/component/color.html',
                data : { title: 'Colors' }
              })
              .state('ui.component.grid', {
                url: '/grid',
                templateUrl: 'views/ui/component/grid.html',
                data : { title: 'Grids' }
              })
              .state('ui.component.icon', {
                url: '/icons',
                templateUrl: 'views/ui/component/icon.html',
                data : { title: 'Icons' }
              })
              .state('ui.component.list', {
                url: '/list',
                templateUrl: 'views/ui/component/list.html',
                data : { title: 'Lists' }
              })
              .state('ui.component.nav', {
                url: '/nav',
                templateUrl: 'views/ui/component/nav.html',
                data : { title: 'Navs' }
              })
              .state('ui.component.progressbar', {
                url: '/progressbar',
                templateUrl: 'views/ui/component/progressbar.html',
                data : { title: 'Progressbars' }
              })
              .state('ui.component.streamline', {
                url: '/streamline',
                templateUrl: 'views/ui/component/streamline.html',
                data : { title: 'Streamlines' }
              })
              .state('ui.component.timeline', {
                url: '/timeline',
                templateUrl: 'views/ui/component/timeline.html',
                data : { title: 'Timelines' }
              })
              .state('ui.component.uibootstrap', {
                url: '/uibootstrap',
                templateUrl: 'views/ui/component/uibootstrap.html',
                resolve: load('scripts/controllers/bootstrap.js'),
                data : { title: 'UI Bootstrap' }
              })
            
            // material routers
            .state('ui.material', {
              url: '/material',
              template: '<div ui-view></div>',
              resolve: load('scripts/controllers/material.js')
            })
              .state('ui.material.button', {
                url: '/button',
                templateUrl: 'views/ui/material/button.html',
                data : { title: 'Buttons' }
              })
              .state('ui.material.color', {
                url: '/color',
                templateUrl: 'views/ui/material/color.html',
                data : { title: 'Colors' }
              })
              .state('ui.material.icon', {
                url: '/icon',
                templateUrl: 'views/ui/material/icon.html',
                data : { title: 'Icons' }
              })
              .state('ui.material.card', {
                url: '/card',
                templateUrl: 'views/ui/material/card.html',
                data : { title: 'Card' }
              })
              .state('ui.material.form', {
                url: '/form',
                templateUrl: 'views/ui/material/form.html',
                data : { title: 'Form' }
              })
              .state('ui.material.list', {
                url: '/list',
                templateUrl: 'views/ui/material/list.html',
                data : { title: 'List' }
              })
              .state('ui.material.ngmaterial', {
                url: '/ngmaterial',
                templateUrl: 'views/ui/material/ngmaterial.html',
                data : { title: 'NG Material' }
              })
            // form routers
            .state('ui.form', {
              url: '/form',
              template: '<div ui-view></div>'
            })
              .state('ui.form.layout', {
                url: '/layout',
                templateUrl: 'views/ui/form/layout.html',
                data : { title: 'Layouts' }
              })
              .state('ui.form.element', {
                url: '/element',
                templateUrl: 'views/ui/form/element.html',
                data : { title: 'Elements' }
              })              
              .state('ui.form.validation', {
                url: '/validation',
                templateUrl: 'views/ui/form/validation.html',
                data : { title: 'Validations' }
              })
              .state('ui.form.select', {
                url: '/select',
                templateUrl: 'views/ui/form/select.html',
                data : { title: 'Selects' },
                controller: 'SelectCtrl',
                resolve: load(['ui.select','scripts/controllers/select.js'])
              })
              .state('ui.form.editor', {
                url: '/editor',
                templateUrl: 'views/ui/form/editor.html',
                data : { title: 'Editor' },
                controller: 'EditorCtrl',
                resolve: load(['textAngular','scripts/controllers/editor.js'])
              })
              .state('ui.form.slider', {
                url: '/slider',
                templateUrl: 'views/ui/form/slider.html',
                data : { title: 'Slider' },
                controller: 'SliderCtrl',
                resolve: load('scripts/controllers/slider.js')
              })
              .state('ui.form.tree', {
                url: '/tree',
                templateUrl: 'views/ui/form/tree.html',
                data : { title: 'Tree' },
                controller: 'TreeCtrl',
                resolve: load('scripts/controllers/tree.js')
              })
              .state('ui.form.file-upload', {
                url: '/file-upload',
                templateUrl: 'views/ui/form/file-upload.html',
                data : { title: 'File upload' },
                controller: 'UploadCtrl',
                resolve: load(['angularFileUpload', 'scripts/controllers/upload.js'])
              })
              .state('ui.form.image-crop', {
                url: '/image-crop',
                templateUrl: 'views/ui/form/image-crop.html',
                data : { title: 'Image Crop' },
                controller: 'ImgCropCtrl',
                resolve: load(['ngImgCrop','scripts/controllers/imgcrop.js'])
              })
              .state('ui.form.editable', {
                url: '/editable',
                templateUrl: 'views/ui/form/xeditable.html',
                data : { title: 'Xeditable' },
                controller: 'XeditableCtrl',
                resolve: load(['xeditable','scripts/controllers/xeditable.js'])
              })
            // table routers
            .state('ui.table', {
              url: '/table',
              template: '<div ui-view></div>'
            })
              .state('ui.table.static', {
                url: '/static',
                templateUrl: 'views/ui/table/static.html',
                data : { title: 'Static', theme: { primary: 'blue'} }
              })
              .state('ui.table.smart', {
                url: '/smart',
                templateUrl: 'views/ui/table/smart.html',
                data : { title: 'Smart' },
                controller: 'TableCtrl',
                resolve: load(['smart-table', 'scripts/controllers/table.js'])
              })
              .state('ui.table.datatable', {
                url: '/datatable',
                data : { title: 'Datatable' },
                templateUrl: 'views/ui/table/datatable.html'
              })
              .state('ui.table.footable', {
                url: '/footable',
                data : { title: 'Footable' },
                templateUrl: 'views/ui/table/footable.html'
              })
              .state('ui.table.nggrid', {
                url: '/nggrid',
                templateUrl: 'views/ui/table/nggrid.html',
                data : { title: 'NG Grid' },
                controller: 'NGGridCtrl',
                resolve: load(['ngGrid','scripts/controllers/nggrid.js'])
              })
              .state('ui.table.uigrid', {
                url: '/uigrid',
                templateUrl: 'views/ui/table/uigrid.html',
                data : { title: 'UI Grid' },
                controller: "UiGridCtrl",
                resolve: load(['ui.grid', 'scripts/controllers/uigrid.js'])
              })
              .state('ui.table.editable', {
                url: '/editable',
                templateUrl: 'views/ui/table/editable.html',
                data : { title: 'Editable' },
                controller: 'XeditableCtrl',
                resolve: load(['xeditable','scripts/controllers/xeditable.js'])
              })
            // chart
            .state('ui.chart', {
              url: '/chart',
              templateUrl: 'views/ui/chart/chart.html',
              data : { title: 'Charts' },
              resolve: load('scripts/controllers/chart.js')
            })
            // map routers
            .state('ui.map', {
              url: '/map',
              template: '<div ui-view></div>'
            })
              .state('ui.map.google', {
                url: '/google',
                templateUrl: 'views/ui/map/google.html',
                data : { title: 'Gmap' },
                controller: 'GoogleMapCtrl',
                resolve: load(['ui.map', 'scripts/controllers/load-google-maps.js', 'scripts/controllers/googlemap.js'], function(){ return loadGoogleMaps(); })
              })
              .state('ui.map.vector', {
                url: '/vector',
                templateUrl: 'views/ui/map/vector.html',
                data : { title: 'Vector' },
                controller: 'VectorMapCtrl',
                resolve: load('scripts/controllers/vectormap.js')
              })

          .state('page', {
            url: '/page',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })
            .state('page.profile', {
              url: '/profile',
              templateUrl: 'views/pages/profile.html',
              data : { title: 'Profile', theme: { primary: 'green'} }
            })
            .state('page.settings', {
              url: '/settings',
              templateUrl: 'views/pages/settings.html',
              data : { title: 'Settings' }
            })
            .state('page.blank', {
              url: '/blank',
              templateUrl: 'views/pages/blank.html',
              data : { title: 'Blank' }
            })
            .state('page.document', {
              url: '/document',
              templateUrl: 'views/pages/document.html',
              data : { title: 'Document' }
            })
            .state('404', {
              url: '/404',
              templateUrl: 'views/pages/404.html'
            })
            .state('505', {
              url: '/505',
              templateUrl: 'views/pages/505.html'
            })
            .state('access', {
              url: '/access',
              template: '<div class="indigo bg-big"><div ui-view class="fade-in-down smooth"></div></div>'
            })
            .state('access.signin', {
              url: '/signin',
              templateUrl: 'views/pages/signin.html',
              controller: 'loginCtrl',
              resolve: load('scripts/controllers/login.js')
            })
            .state('access.signup', {
              url: '/signup',
              templateUrl: 'views/pages/signup.html'
            })
            .state('access.forgot-password', {
              url: '/forgot-password',
              templateUrl: 'views/pages/forgot-password.html'
            })
            .state('access.lockme', {
             url: '/signin',
              templateUrl: 'views/pages/signin.html',
              controller: 'logoutCtrl',
              resolve: load('scripts/controllers/logout.js')
            })

        .state('staff', {
              url: '/staff',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })
          .state('account', {
              url: '/account',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })

          .state('vendor', {
              url: '/vendor',
            views: {
              '': {
                templateUrl: 'views/layout.html'
              },
              'aside': {
                templateUrl: 'views/aside.html'
              },
              'content': {
                templateUrl: 'views/content.html'
              }
            }
          })

            .state('staff.list', {
              url: '/list',
              templateUrl: 'views/staff/staff.html',
              data : { title: 'Staff' },
              controller: 'staffListCtrl',
              resolve: load(['scripts/controllers/staff.js'])
            })

             .state('staff.add', {
              url: '/add',
              templateUrl: 'views/staff/staff-add.html',
              data : { title: 'Staff Add' },
               controller: 'staffAddEditCtrl',
              resolve: load(['scripts/controllers/bootstrap.js','scripts/controllers/staff.js'])
            })

             .state('staff.edit', {
              url: '/edit/:id',
              templateUrl: 'views/staff/staff-add.html',
              data : { title: 'Staff Edit' },
               controller: 'staffAddEditCtrl',
              resolve: load(['scripts/controllers/bootstrap.js','scripts/controllers/staff.js'])
            })

             .state('staff.note', {
              url: '/:staff_id/note',
              templateUrl: 'views/staff/note.html',
              data : { title: 'Note' },
              controller: 'noteListCtrl',
              resolve: load(['scripts/controllers/note.js'])
            })

             .state('staff.noteAdd', {
              url: '/:staff_id/note',
              templateUrl: 'views/staff/note-add.html',
              data : { title: 'Note Add' },
              controller: 'noteAddeditCtrl',
              resolve: load(['scripts/controllers/note.js'])
            })

             .state('staff.noteEdit', {
              url: '/:staff_id/note/:note_id',
             templateUrl: 'views/staff/note-add.html',
              data : { title: 'Staff Edit' },
                controller: 'noteAddeditCtrl',
              resolve: load(['scripts/controllers/note.js'])
            })

           .state('staff.timeoff', {
            url: '/:staff_id/timeoff',
            templateUrl: 'views/staff/timeoff.html',
            data : { title: 'Time Off' },
            controller: 'timeoffListCtrl',
            resolve: load(['scripts/controllers/timeoff.js'])
          })

           .state('staff.timeoffAdd', {
              url: '/:staff_id/timeoff',
              templateUrl: 'views/staff/timeoff-add.html',
              data : { title: 'Timeoff Add' },
              controller: 'timeoffAddEditCtrl',
             resolve: load(['scripts/controllers/bootstrap.js','scripts/controllers/timeoff.js'])
            })

             .state('staff.timeoffEdit', {
              url: '/:staff_id/timeoff/:timeoff_id',
             templateUrl: 'views/staff/timeoff-add.html',
              data : { title: 'Timeoff Edit' },
                controller: 'timeoffAddEditCtrl',
              resolve: load(['scripts/controllers/bootstrap.js','scripts/controllers/timeoff.js'])
            })


            .state('vendor.list', {
              url: '/list',
              templateUrl: 'views/vendor/vendor.html',
              data : { title: 'Vendor' },
              controller: 'vendorListCtrl',
              resolve: load(['scripts/controllers/vendor.js'])
            })

            .state('vendor.add', {
              url: '/add',
              templateUrl: 'views/vendor/vendor-add.html',
              data : { title: 'Vendor Add' },
               controller: 'vendorAddEditCtrl',
              resolve: load(['scripts/controllers/vendor.js'])
            })

             .state('vendor.edit', {
              url: '/edit/:id',
             templateUrl: 'views/vendor/vendor-add.html',
              data : { title: 'Vendor Edit' },
               controller: 'vendorAddEditCtrl',
              resolve: load(['scripts/controllers/vendor.js'])
            })


          .state('account.list', {
              url: '/list',
              templateUrl: 'views/account/list.html',
              controller: 'accountListCtrl',
              resolve: {
                            checklogin: function (AuthService) {
                               return AuthService.checksession();
                            }
                       }
              
            })
           .state('account.add', {
              url: '/add',
              templateUrl: 'views/account/add.html',
              controller: 'accountAddCtrl',
              resolve: load('scripts/controllers/account.js')
            })
           .state('account.edit', {
              url: '/edit/:id',
              templateUrl: 'views/account/add.html',
              controller: 'accountEditCtrl',
              resolve: load('scripts/controllers/account.js')
            })
           .state('account.delete', {
              url: '/delete/:id',
              controller: 'accountEditCtrl',
              resolve: load('scripts/controllers/account.js')
            })
;

          function load(srcs, callback) {
            return {
                deps: ['$ocLazyLoad', '$q',
                  function( $ocLazyLoad, $q ){
                    var deferred = $q.defer();
                    var promise  = false;
                    srcs = angular.isArray(srcs) ? srcs : srcs.split(/\s+/);
                    if(!promise){
                      promise = deferred.promise;
                    }
                    angular.forEach(srcs, function(src) {
                      promise = promise.then( function(){
                        angular.forEach(MODULE_CONFIG, function(module) {
                          if( module.name == src){
                            if(!module.module){
                              name = module.files;
                            }else{
                              name = module.name;
                            }
                          }else{
                            name = src;
                          }
                        });
                        return $ocLazyLoad.load(name);
                      } );
                    });
                    deferred.resolve();
                    return callback ? promise.then(function(){ return callback(); }) : promise;
                }]
            }
          }
      }
    ]
  );
